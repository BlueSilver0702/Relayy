<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/chatController.php");
include_once (dirname(__FILE__) . "/uploadHandler.php");

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

    	$chat_data['body_class'] = 'profile-page';

		$chat_data['page_title'] = 'Profile | Relayy';
    
    	$this->load->view('templates/header-chat', $chat_data);
		
		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('profile', $chat_data);

		$this->load->view('templates/footer-chat', $chat_data);
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
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $picture = $this->input->post('picture');

        $object = $this->muser->editUser(gf_cu_id(), $fname, gf_cu_email(), $password, gf_cu_type(), $phone, $picture);

        // print_r($object);exit;
        gf_registerCurrentUser($object);

		redirect(site_url('profile/edit'), 'get');
	}

	public function upload()
	{
		$upload_handler = new UploadHandler();
	}
}