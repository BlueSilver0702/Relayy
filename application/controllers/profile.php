<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/ChatController.php");
include_once (dirname(__FILE__) . "/UploadHandler.php");

class Profile extends ChatController
{
	public function __construct()            
	{
		parent::__construct();
	}

	public function index()
	{
    	$this->loginCheck();    	

    	$chat_data = $this->getChatData();
    	
    	//print_r($chat_data);exit;

    	$chat_data['body_class'] = 'profile-page';

		$chat_data['page_title'] = 'Profile | Relayy';
    
    	$this->load->view('templates/header-chat', $chat_data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('profile', $chat_data);
                                             
		$this->load->view('templates/footer-chat', $chat_data);
	}

	public function user($c_id)
	{
    	$this->loginCheck();    	

    	$c_data = $this->getChatData();

    	$c_data['body_class'] = 'profile-page';

		$c_data['page_title'] = 'Profile | Relayy';

		$user_data = $this->muser->getUserArray($c_id);
		// print_r($user);exit;
    
    	$this->load->view('templates/header-chat', $c_data);
		
		$this->load->view('templates/left-sidebar', $c_data);

		$this->load->view('uprofile', $user_data);

		$this->load->view('templates/footer-chat', $c_data);
	}

	public function useredit($c_id)
	{
    	$this->loginCheck();    	

    	$c_data = $this->getChatData();

    	$c_data['body_class'] = 'profile-page';

		$c_data['page_title'] = 'Edit User Profile | Relayy';

		$user_data = $this->muser->getUserArray($c_id);	

		//print_r($user_data);exit;
    
    	$this->load->view('templates/header-chat', $c_data);
		
		$this->load->view('templates/left-sidebar', $c_data);

		$this->load->view('ueditprofile', $user_data);

		$this->load->view('templates/footer-chat', $c_data);
	}

	public function edit()
	{
		$this->loginCheck();    

		$chat_data = $this->getChatData();	

    	$chat_data['body_class'] = 'profile-page';

		$chat_data['page_title'] = 'Edit Profile | Relayy';

		$chat_data['profile_js'] = TRUE;		
    
    	$this->load->view('templates/header-chat', $chat_data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('profile_edit', $chat_data);

		$this->load->view('templates/footer-chat', $chat_data);	
	}

	public function save()
	{
    	$this->loginCheck();

    	$fname = $this->input->post('fname');
    	$lname = $this->input->post('lname');
        $password = $this->input->post('password');
        $bio = $this->input->post('bio');
        $picture = $this->input->post('picture');

        if ($this->cstatus == USER_STATUS_INVITE) $this->muser->approve($this->cid);
        
        $object = $this->muser->edit($this->cid, array(
        		TBL_USER_FNAME => $fname,
        		TBL_USER_LNAME => $lname,
        		TBL_USER_PWD   => $password,
        		TBL_USER_BIO   => $bio,
        		TBL_USER_PHOTO => $picture
        	));

        // print_r($object);exit;
        gf_registerCurrentUser($object);

        $this->email->profile($this->cemail, $fname." ".$lname);

		redirect(site_url('profile/edit'), 'get');
	}

	public function saveuser()
	{
		$this->loginCheck();

		$userid = $this->input->post('uid');
		$userObj = $this->muser->get($userid);

    	$fname = $this->input->post('fname');
    	$lname = $this->input->post('lname');
        $password = $this->input->post('password');
        $bio = $this->input->post('bio');
        $role = $this->input->post('reg_role');
        
        $object = $this->muser->edit($userid, array(
        		TBL_USER_FNAME => $fname,
        		TBL_USER_LNAME => $lname,
        		TBL_USER_PWD   => $password,
                TBL_USER_TYPE  => $role,
                TBL_USER_BIO   => $bio
        	));

        $this->email->profile($object->email, $fname." ".$lname);

		redirect(site_url('users'), 'get');	
	}

	public function upload()
	{
		$upload_handler = new UploadHandler();
	}
}