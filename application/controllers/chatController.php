<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ChatController extends CI_Controller
{
	var $cid;
	var $cuid;
    var $cfname;
    var $clname;
    var $cemail;
    var $clogin;
    var $cpassword;
    var $ctype;
    var $cstatus;
    var $cphoto;
    var $cbio;
    var $cfacebook;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('mchat');
		$this->load->model('muser');
		$this->load->model('moption');
        $this->load->library('email');

		$this->cid = gf_cu_id();

		$this->cuid = gf_cu_uid();
		
		$this->cfname = gf_cu_fname();

		$this->clname = gf_cu_lname();

		$this->cemail = gf_cu_email();

		$this->clogin = gf_cu_email();

		$this->cpassword = gf_cu_password();

		$this->ctype = gf_cu_type();

		$this->cstatus = gf_cu_status();

		$this->cphoto = gf_cu_photo();

		$this->cbio = gf_cu_bio();

		$this->cfacebook = gf_cu_facebook();
	}

	public function getChatData()
	{   	

		///////////////////////////
		
		$dialog_arr = $this->mchat->getDialogs(gf_cu_id());

		$chat_data = array();

		if (count($dialog_arr) > 0) {
			$chat_data['d_id'] = $dialog_arr[0][TBL_CHAT_DID];

	    	$chat_data['d_name'] = $dialog_arr[0][TBL_CHAT_NAME];

	    	$chat_data['d_occupants'] = json_decode($dialog_arr[0][TBL_CHAT_OCCUPANTS]);

	    	$chat_data['d_users'] = array();

	    	foreach ($chat_data['d_occupants'] as $d_user) {
				$chat_data['d_users'][] = $this->muser->getUserArray($d_user);
	    	}

	    	$chat_data['d_type'] = $dialog_arr[0][TBL_CHAT_TYPE];

	    	$chat_data['d_jid'] = $dialog_arr[0][TBL_CHAT_JID];

	    	$chat_data['d_status'] = $dialog_arr[0][TBL_CHAT_STATUS];

	    	$chat_data['d_message'] = $dialog_arr[0][TBL_CHAT_MESSAGE];

	    	$chat_data['d_time'] = $dialog_arr[0][TBL_CHAT_TIME];

	    	$occupants_arr = json_decode($dialog_arr[0][TBL_CHAT_OCCUPANTS]);
	    	
	    	$d_owner = $this->muser->get($occupants_arr[0]);
	    	
	    	$chat_data['d_owner'] = $d_owner->{TBL_USER_FNAME};

	    	$chat_data['d_noti'] = $this->moption->get($this->cid, 'notify_'.$chat_data['d_id']);

	    	if ($d_owner->{TBL_USER_ID} == gf_cu_id()) $chat_data['d_owner'] = "Me";
		}
    	
		$chat_data['history'] = $dialog_arr;

		$chat_data['u_id'] = $this->cid;

		$chat_data['u_uid'] = $this->cuid;
		
		$chat_data['u_name'] = $this->cfname." ".$this->clname;

		$chat_data['u_fname'] = $this->cfname;

		$chat_data['u_lname'] = $this->clname;

		$chat_data['u_login'] = $this->clogin;

		$chat_data['u_email'] = $this->cemail;

		$chat_data['u_password'] = $this->cpassword;

		$chat_data['u_type'] = $this->ctype;

		$chat_data['u_status'] = $this->cstatus;

		$chat_data['u_photo'] = $this->cphoto;

		$chat_data['u_bio'] = $this->cbio;

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

	public function maintenance()
	{
		$this->loginCheck();    	

		///////////////////////////
    	$chat_data = $this->getChatData();

    	$chat_data['body_class'] = 'maintenance-page';

		$chat_data['page_title'] = 'Maintenance | Relayy';		

    	$this->load->view('templates/header-chat', $chat_data);

		$this->load->view('maintenance');

		$this->load->view('templates/footer-chat', $chat_data);

	}

	public function inviteUserLink($id, $email)
	{
		return site_url('invite/user/'.$id."/".urlencode($email));
	}

	public function inviteChatLink($id, $email, $did)
	{
		return site_url('invite/chat/'.$id."/".urlencode($email)."/".$did);
	}
}