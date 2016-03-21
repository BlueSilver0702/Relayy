<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/ChatController.php");

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

		$user = $this->muser->get($uid);
		
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

		$uid = $this->input->post('reg_id');

        $password = $this->input->post('reg_pwd');

        $user = $this->muser->get($uid);

        $this->muser->edit($user->uid, $user->fname, $user->lname, $user->email, $password, $user->type, $user->bio, $user->picture);

		$object = $this->muser->login($user->email, $password);
        
        if($object) {

            gf_registerCurrentUser($object);

            redirect(site_url('profile/edit'), 'get');

        } else {

            show_error("An Error has occurred while logging in!", 500, "Login Error");
        }		        
	}
}