<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ChatController extends CI_Controller
{
	var $cid;
    var $cname;
    var $cemail;
    var $clogin;
    var $cpassword;
    var $ctype;
    var $cphoto;
    var $cphone;
    var $cfacebook;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('mchat');
		$this->load->model('muser');
		$this->load->model('moption');

		$this->cid = gf_cu_id();
		
		$this->cname = gf_cu_fname();

		$this->cemail = gf_cu_email();

		$this->clogin = gf_cu_email();

		$this->cpassword = gf_cu_password();

		$this->ctype = gf_cu_type();

		$this->cphoto = gf_cu_photo();

		$this->cphone = gf_cu_phone();

		$this->cfacebook = gf_cu_facebook();
	}

	public function getChatData()
	{   	

		///////////////////////////
		
		$dialog_arr = $this->mchat->getDialogs(gf_cu_id());

		$chat_data = array();

		if (count($dialog_arr) > 0) {
			$chat_data['d_id'] = $dialog_arr[0]['did'];

	    	$chat_data['d_name'] = $dialog_arr[0]['name'];

	    	$chat_data['d_occupants'] = json_decode($dialog_arr[0]['occupants']);

	    	$chat_data['d_users'] = array();

	    	foreach ($chat_data['d_occupants'] as $d_user) {
				$chat_data['d_users'][] = $this->muser->getUserArray($d_user);
	    	}

	    	$chat_data['d_type'] = $dialog_arr[0]['type'];

	    	$chat_data['d_jid'] = $dialog_arr[0]['jid'];

	    	$chat_data['d_status'] = $dialog_arr[0]['status'];

	    	$chat_data['d_message'] = $dialog_arr[0]['message'];

	    	$chat_data['d_time'] = $dialog_arr[0]['time'];

	    	$occupants_arr = json_decode($dialog_arr[0]['occupants']);
	    	
	    	$d_owner = $this->muser->getUser($occupants_arr[0]);
	    	
	    	$chat_data['d_owner'] = $d_owner->fname;

	    	$chat_data['d_noti'] = $this->moption->get($this->cid, 'notify_'.$chat_data['d_id']);

	    	if ($d_owner->id == gf_cu_id()) $chat_data['d_owner'] = "Me";
		}
    	
		$chat_data['history'] = $dialog_arr;

		$chat_data['u_id'] = $this->cid;
		
		$chat_data['u_name'] = $this->cname;

		$chat_data['u_login'] = $this->clogin;

		$chat_data['u_email'] = $this->cemail;

		$chat_data['u_password'] = $this->cpassword;

		$chat_data['u_type'] = $this->ctype;

		$chat_data['u_photo'] = $this->cphoto;

		$chat_data['u_phone'] = $this->cphone;

		$chat_data['u_facebook'] = $this->cfacebook;

		return $chat_data;
	}

	public function loginCheck()
	{
		if ( !gf_isLogin() )
		{
			redirect(site_url('home'), 'get');
			
			return;
		}
	}
}