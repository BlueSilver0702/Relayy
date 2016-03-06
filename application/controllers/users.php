<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('muser');
		$this->load->library('session');
	}

	public function index()
	{
    	$this->loginCheck();    	

    	$data['body_class'] = 'users-page';

		$data['page_title'] = 'User Management | Relayy';

		$data['role'] = gf_cu_type();

		$data['user_name'] = gf_cu_fname();

		$chat_data['users'] = $this->muser->getUserlist(100);

		// print_r($chat_data['users']);exit;
		$chat_data['current'] = gf_cu_id();

		$chat_data['page'] = 0;
    
    	$this->load->view('templates/header-chat', $data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('users');

		$this->load->view('templates/footer-chat');
	}

	public function pending() 
	{
		$this->loginCheck();    	

    	$data['body_class'] = 'users-page';

		$data['page_title'] = 'User Management | Relayy';

		$data['role'] = gf_cu_type();

		$data['user_name'] = gf_cu_fname();

		$chat_data['users'] = $this->muser->getUserlist(0);

		$chat_data['current'] = gf_cu_id();

		$chat_data['page'] = 1;
    
    	$this->load->view('templates/header-chat', $data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('users');

		$this->load->view('templates/footer-chat');
	}

	public function activated() 
	{
		$this->loginCheck();    	

    	$data['body_class'] = 'users-page';

		$data['page_title'] = 'User Management | Relayy';

		$data['role'] = gf_cu_type();

		$data['user_name'] = gf_cu_fname();

		$chat_data['users'] = $this->muser->getUserlist(1);

		$chat_data['current'] = gf_cu_id();

		$chat_data['page'] = 2;
    
    	$this->load->view('templates/header-chat', $data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('users');

		$this->load->view('templates/footer-chat');
	}

	public function action($uid, $page) 
	{
		$this->loginCheck();

		$this->muser->changeStatus($uid);

		if ($page == 0) {
			redirect(site_url('users'), 'get');
		} else if ($page == 1) {
			redirect(site_url('users/pending'), 'get');
		} else {
			redirect(site_url('users/activated'), 'get');
		}
	}

	private function loginCheck()
	{
		if ( !gf_isLogin() )
		{
			redirect(site_url('home'), 'get');
			
			return;	
		}

		$this->roleCheck();
	}

	private function roleCheck() {
		if (gf_cu_type() != 1) 
		{
			redirect(site_url('profile'), 'get');
		}
	}
}