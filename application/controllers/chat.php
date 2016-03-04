<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
    	$this->loginCheck();    	

    	$data['body_class'] = 'chat-page';

		$data['page_title'] = 'Chat | Relayy';

		$chat_data = array();
    
    	$this->load->view('templates/header-chat', $data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('chat');

		$this->load->view('templates/right-sidebar', $chat_data);

		$this->load->view('templates/footer-chat');
	}

	private function loginCheck()
	{
		if ( !gf_isLogin() )
		{
			redirect(site_url('home'), 'get');
			
			return;	
		}
	}
}