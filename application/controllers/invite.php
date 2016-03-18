<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/ChatController.php");

class Invite extends ChatController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	
	$this->maintenance();return;
	
    	$this->loginCheck();    	

    	$chat_data = $this->getChatData();

    	$chat_data['body_class'] = 'invite-page';

		$chat_data['page_title'] = 'Invite Management | Relayy';

		$chat_data['users'] = $this->muser->getUserlist(100);

		// print_r($chat_data['users']);exit;
		$chat_data['current'] = gf_cu_id();

		$chat_data['page'] = 0;
    
    		$this->load->view('templates/header-chat', $chat_data);

		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('invite');

		$this->load->view('templates/footer-chat', $chat_data);
	}

	public function add()
	{
		$this->loginCheck();    	

    		$chat_data = $this->getChatData();

    		$chat_data['body_class'] = 'invite-page';

		$chat_data['page_title'] = 'Invite Management | Relayy';

		$chat_data['users'] = $this->muser->getUserlist(100);

		// print_r($chat_data['users']);exit;
		$chat_data['current'] = gf_cu_id();

		$chat_data['page'] = 1;
    
    		$this->load->view('templates/header-chat', $chat_data);

		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('invite');

		$this->load->view('templates/footer-chat', $chat_data);	
	}
}