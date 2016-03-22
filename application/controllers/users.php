<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/ChatController.php");

class Users extends ChatController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	//$this->maintenance();return;
	
    	$this->loginCheck();

    	$this->roleCheck();    	

    	$chat_data = $this->getChatData();

    	$chat_data['body_class'] = 'users-page';

		$chat_data['page_title'] = 'User Management | Relayy';

		$chat_data['users'] = $this->muser->getUserlist(100);

		$chat_data['current'] = gf_cu_id();

		$chat_data['page'] = 0;
    
    	$this->load->view('templates/header-chat', $chat_data);

		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('users');

		$this->load->view('templates/footer-chat', $chat_data);
	}

	public function pending() 
	{
		$this->loginCheck(); 

		$this->roleCheck();

		$chat_data = $this->getChatData();   	

    	$chat_data['body_class'] = 'users-page';

		$chat_data['page_title'] = 'User Management | Relayy';

		$chat_data['users'] = $this->muser->getUserlist(0);

		$chat_data['current'] = gf_cu_id();

		$chat_data['page'] = 1;
    
    	$this->load->view('templates/header-chat', $chat_data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('users');

		$this->load->view('templates/footer-chat', $chat_data);
	}

	public function activated() 
	{
		$this->loginCheck();  

		$this->roleCheck();  	

		$chat_data = $this->getChatData();

    	$chat_data['body_class'] = 'users-page';

		$chat_data['page_title'] = 'User Management | Relayy';

		$data['user_name'] = gf_cu_fname();

		$chat_data['users'] = $this->muser->getUserlist(1);

		$chat_data['current'] = gf_cu_id();

		$chat_data['page'] = 2;
    
    	$this->load->view('templates/header-chat', $chat_data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('users');

		$this->load->view('templates/footer-chat', $chat_data);
	}

	public function invited() 
	{
		$this->loginCheck();   

		$this->roleCheck(); 	

		$chat_data = $this->getChatData();

    	$chat_data['body_class'] = 'users-page';

		$chat_data['page_title'] = 'User Management | Relayy';

		$data['user_name'] = gf_cu_fname();

		$chat_data['users'] = $this->muser->getUserlist(2);

		$chat_data['current'] = gf_cu_id();

		$chat_data['page'] = 3;
    
    	$this->load->view('templates/header-chat', $chat_data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('users');

		$this->load->view('templates/footer-chat', $chat_data);
	}

	public function delete($uid, $page) 
	{
		$this->loginCheck();

		$this->roleCheck();    	

		$userObj = $this->muser->get($uid);
		$this->muser->delete($uid);

		$this->email->removeUser($this->cemail, $this->cfname." ".$this->clname, $userObj->email);

		if ($page == 0) {
			redirect(site_url('users'), 'get');
		} else if ($page == 1) {
			redirect(site_url('users/pending'), 'get');
		} else if ($page == 2) {
			redirect(site_url('users/activated'), 'get');
		} else {
			redirect(site_url('users/invited'), 'get');
		}
	}

	public function action($uid, $page) 
	{
		$this->loginCheck();

		$this->roleCheck();

		$userObj = $this->muser->changeStatus($uid);

		if ($userObj->type == 1) $this->email->approveUser($this->cemail, $this->cfname." ".$this->clname, $userObj->email);
		else $this->email->deproveUser($this->cemail, $this->cfname." ".$this->clname, $userObj->email);

		if ($page == 0) {
			redirect(site_url('users'), 'get');
		} else if ($page == 1) {
			redirect(site_url('users/pending'), 'get');
		} else if ($page == 2) {
			redirect(site_url('users/activated'), 'get');
		} else {
			redirect(site_url('users/invited'), 'get');
		}
	}

	public function invite($type, $email, $id, $page) 
	{
		$this->loginCheck();

		$this->roleCheck();

		$emailAddress = urldecode($email);

		$newID = $this->muser->add($id, "", "", "", $type, USER_STATUS_INVITE, $emailAddress, "", "", "");

		$this->email->inviteUser($this->cemail, $this->cfname." ".$this->clname, $this->inviteUserLink($id, $emailAddress), $emailAddress);

		if ($page == 0) {
			redirect(site_url('users'), 'get');
		} else if ($page == 1) {
			redirect(site_url('users/pending'), 'get');
		} else if ($page == 2) {
			redirect(site_url('users/activated'), 'get');
		} else {
			redirect(site_url('users/invited'), 'get');
		}
	}

	private function roleCheck() {
		if (gf_cu_type() != 1) 
		{
			redirect(site_url('profile'), 'get');
		}
	}
}