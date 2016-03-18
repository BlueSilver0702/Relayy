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

	public function user($c_uid)
	{
    	$this->loginCheck();    	

    	$c_data = $this->getChatData();

    	$c_data['body_class'] = 'profile-page';

		$c_data['page_title'] = 'Profile | Relayy';

		$user_data = $this->muser->getUserArray($c_uid);
		// print_r($user);exit;
    
    	$this->load->view('templates/header-chat', $c_data);
		
		$this->load->view('templates/left-sidebar', $c_data);

		$this->load->view('uprofile', $user_data);

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

        $object = $this->muser->editUser($this->cuid, $fname, $lname, $this->cemail, $password, $this->ctype, $bio, $picture);

        // print_r($object);exit;
        gf_registerCurrentUser($object);

        $this->email->profile($this->cemail, $fname." ".$lname);

		redirect(site_url('profile/edit'), 'get');
	}

	public function upload()
	{
		$upload_handler = new UploadHandler();
	}
}