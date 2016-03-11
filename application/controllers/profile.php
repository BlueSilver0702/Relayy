<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('muser');
		$this->load->model('mchat');
		$this->load->library('session');
	}

	public function index()
	{
    	$this->loginCheck();    	

    	$data['body_class'] = 'profile-page';

		$data['page_title'] = 'Profile | Relayy';

		$data['role'] = gf_cu_type();

		$data['user_name'] = gf_cu_fname();

		$chat_data = array();

		$user_data['fname'] = gf_cu_fname();

		$user_data['email'] = gf_cu_email();

		$user_data['password'] = gf_cu_password();

		$user_data['photo'] = gf_cu_photo();

		$user_data['phone'] = gf_cu_phone();

		$user_data['facebook'] = gf_cu_facebook();
    
    	$this->load->view('templates/header-chat', $data);
		
		$chat_data['history'] = $this->mchat->getDialogs(gf_cu_id());

		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('profile', $user_data);

		$this->load->view('templates/footer-chat');
	}

	public function edit()
	{
		$this->loginCheck();    	

    	$data['body_class'] = 'profile-page';

		$data['page_title'] = 'Edit Profile | Relayy';

		$data['role'] = gf_cu_type();

		$data['user_name'] = gf_cu_fname();

		$chat_data = array();

		$user_data['fname'] = gf_cu_fname();

		$user_data['email'] = gf_cu_email();

		$user_data['password'] = gf_cu_password();

		$user_data['photo'] = gf_cu_photo();

		$user_data['phone'] = gf_cu_phone();

		$user_data['facebook'] = gf_cu_facebook();		
    
    	$this->load->view('templates/header-chat', $data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('profile_edit', $user_data);

		$this->load->view('templates/footer-chat');	
	}

	public function save()
	{
    	
    	$this->loginCheck();

    	$fname = $this->input->post('fname');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');

        $object = $this->muser->editUser(gf_cu_id(), $fname, gf_cu_email(), $password, gf_cu_type(), $phone);

        // print_r($object);exit;
        gf_registerCurrentUser($object);

		redirect(site_url('profile/edit'), 'get');
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