<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invite extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('muser');
	}

	public function index()
	{
	
	// $this->maintenance();return;

	}

	public function user($uid, $email) 
	{
		if ( gf_isLogin() )
		{
			redirect(site_url('profile'), 'get');
			
			return;	
		}

        $email = urldecode($email);
        
		$user = $this->muser->get($uid);
        
        if ($user->email != $email) show_error("Sorry, You are not allowed to register!", 500, "Invite Error");
		
    	$data['body_class'] = 'invite-page';

		$data['page_title'] = 'Welcome! Relayy';

    	$data['current_section'] = 'invite';

    	$data['current_id'] = $uid;

    	$data['current_email'] = urldecode($email);

    	$data['current_type'] = $user->type;
    
    	$this->load->view('templates/header-home', $data);
		
		$this->load->view('invite', $data);

		$this->load->view('templates/footer', $data);
	}

	public function chat($uid, $email, $did) {

	}

	public function accept() {

		$id = $this->input->post('reg_id');
        
        $uid = $this->input->post('reg_uid');

        $password = $this->input->post('reg_pwd');

        $user = $this->muser->edit($id, array(
            TBL_USER_PWD => $password,
            TBL_USER_UID => $uid
        ));
        
        if (!$user) show_error("An Error has occurred while registering!", 500, "Register Error");

		$object = $this->muser->login($user->{TBL_USER_EMAIL}, $password);
        
        if($object) {

            gf_registerCurrentUser($object);

            redirect(site_url('profile/edit'), 'get');

        } else {

            show_error("An Error has occurred while logging in!", 500, "Login Error");
        }		        
	}
}