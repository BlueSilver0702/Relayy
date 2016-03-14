<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ChatController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mchat');
		$this->load->model('muser');
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

	    	if ($d_owner->id == gf_cu_id()) $chat_data['d_owner'] = "Me";
		}
    	
		$chat_data['history'] = $dialog_arr;

		$chat_data['u_id'] = gf_cu_id();
		
		$chat_data['u_name'] = gf_cu_fname();

		$chat_data['u_login'] = gf_cu_email();

		$chat_data['u_email'] = gf_cu_email();

		$chat_data['u_password'] = gf_cu_password();

		$chat_data['u_type'] = gf_cu_type();

		$chat_data['u_photo'] = gf_cu_photo();

		$chat_data['u_phone'] = gf_cu_phone();

		$chat_data['u_facebook'] = gf_cu_facebook();

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