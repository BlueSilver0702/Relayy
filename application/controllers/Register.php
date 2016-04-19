<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	
	// $this->maintenance();return;
	
    	if ( gf_isLogin() )
		{
			redirect(site_url('profile'), 'get');
			
			return;
		}

    	$chat_data['body_class'] = 'register-page';

		$chat_data['page_title'] = 'Sign Up | Relayy';
    
		$this->load->view('register');
	}
}