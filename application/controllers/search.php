<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
    	$this->loginCheck();    	

    	$data['body_class'] = 'search-page';

		$data['page_title'] = 'Search Result | Relayy';

		$data['role'] = gf_cu_type();

		$data['user_name'] = gf_cu_fname();

		$chat_data = array();
    
    	$this->load->view('templates/header-chat', $data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('search');

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