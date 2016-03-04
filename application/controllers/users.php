<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
    	$this->loginCheck();    	

    	$data['body_class'] = 'users-page';

		$data['page_title'] = 'User Management | Relayy';

		$chat_data = array();
    
    	$this->load->view('templates/header-chat', $data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('users');

		$this->load->view('templates/footer-chat');
	}

	public function pending() {

	}

	public function activated() {

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