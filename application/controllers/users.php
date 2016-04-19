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

		$chat_data['users'] = $this->muser->getUserlist(USER_STATUS_ALL);

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

		$chat_data['users'] = $this->muser->getUserlist();

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

		$chat_data['users'] = $this->muser->getUserlist(USER_STATUS_LIVE);

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

		$chat_data['users'] = $this->muser->getUserlist(USER_STATUS_INVITE);

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

		$this->email->removeUser($this->cemail, $this->cfname." ".$this->clname, $userObj->{TBL_USER_EMAIL});

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

		if ($userObj->{TBL_USER_STATUS} == USER_STATUS_LIVE) $this->email->approveUser($this->cemail, $this->cfname." ".$this->clname, $userObj->{TBL_USER_EMAIL});
		else $this->email->deproveUser($this->cemail, $this->cfname." ".$this->clname, $userObj->{TBL_USER_EMAIL});

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

	public function invite($type, $email, $page) 
	{
		$this->loginCheck();

		$this->roleCheck();

		$emailAddress = urldecode($email);

        $oldUser = $this->muser->getEmail($emailAddress);
        
        $newID = NULL;
        
        if ($oldUser) {
            $newID = $oldUser->{TBL_USER_ID};
            $this->muser->edit($newID, array(TBL_USER_STATUS=>USER_STATUS_INVITE));
        } else {
            $newID = $this->muser->add(array(
                TBL_USER_TYPE => $type,
                TBL_USER_STATUS => USER_STATUS_INVITE,
                TBL_USER_EMAIL => strtolower($emailAddress)
            ));    
        }

		$this->email->inviteUser($this->cemail, $this->cfname." ".$this->clname, $this->inviteUserLink($newID, $emailAddress), $emailAddress);

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
		if (gf_cu_type() != USER_TYPE_ADMIN) 
		{
			redirect(site_url('profile'), 'get');
		}
	}
}