<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		if ( gf_isLogin() )
		{
			redirect(site_url('profile'), 'get');
			
			return;	
		}
		
    	$data['body_class'] = 'home';

		$data['page_title'] = 'Welcome! Relayy';

    	$data['current_section'] = 'home';

    	$data['js_home'] = 1;
    
    	$this->load->view('templates/header-home');
		
		$this->load->view('home');

		$this->load->view('templates/footer', $data);
	}

	public function login() 
	{

		if ( gf_isLogin() )
		{
			redirect(site_url('profile'), 'get');
			
			return;	
		}

		$data['body_class'] = 'home';

		$data['page_title'] = 'Welcome! Relayy';

    	$data['current_section'] = 'home';

    	$data['js_home'] = 2;
    
    	$this->load->view('templates/header-home');
		
		$this->load->view('home');

		$this->load->view('templates/footer', $data);	
	}

	 public function channel($email, $did)
	 {
	 	if ( gf_isLogin() )
	 	{
	 		redirect(site_url('chat/channel/'.$did), 'get');
			
	 		return;	
	 	}

	 	$data['body_class'] = 'home';

	 	$data['page_title'] = 'Welcome! Relayy';

     	$data['current_section'] = 'home';

     	$data['js_home'] = 2;
        
        $data['email'] = urldecode($email);
        
        $data['did'] = $did;
    
    	$this->load->view('templates/header-home');
		
	 	$this->load->view('home', $data);

	 	$this->load->view('templates/footer', $data);	
	 }

	public function logout()
	{
		
	}
}