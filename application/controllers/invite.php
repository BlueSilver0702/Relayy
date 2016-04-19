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
        
        if ($user->{TBL_USER_EMAIL} != $email) show_error("Sorry, You are not allowed to register!", 500, "Invite Error");
		
    	$data['body_class'] = 'invite-page';

		$data['page_title'] = 'Welcome! Relayy';

    	$data['current_section'] = 'invite';

    	$data['current_id'] = $uid;

    	$data['current_email'] = urldecode($email);

    	$data['current_type'] = $user->{TBL_USER_TYPE};
    
    	$this->load->view('templates/header-home', $data);
		
		$this->load->view('invite', $data);

		$this->load->view('templates/footer', $data);
	}

	public function chat($uid, $email, $did) {
        if ( gf_isLogin() )
        {
            redirect(site_url('profile'), 'get');
            
            return;    
        }

        $n_email = urldecode($email);
        
        $user = $this->muser->get($uid);
        
        if ($user->{TBL_USER_EMAIL} != $n_email) show_error("Sorry, You are not allowed to register!", 500, "Invite Error");
        
        if ($user->{TBL_USER_STATUS} == USER_STATUS_INVITE || $user->{TBL_USER_STATUS} == USER_STATUS_INVITED) {
            $data['body_class'] = 'invite-page';

            $data['page_title'] = 'Welcome! Relayy';

            $data['current_section'] = 'invite';

            $data['current_id'] = $uid;

            $data['current_email'] = urldecode($n_email);
            
            $data['current_did'] = urldecode($did);

            $data['current_type'] = $user->{TBL_USER_TYPE};
        
            $this->load->view('templates/header-home', $data);
            
            $this->load->view('invite', $data);

            $this->load->view('templates/footer', $data);    
        } else {
            redirect(site_url('home/channel/'.$email."/".$did), 'get');
        }
	}

	public function accept() {

		$id = $this->input->post('reg_id');
        
        $did = $this->input->post('reg_did');
        
        $uid = $this->input->post('reg_uid');

        $password = $this->input->post('reg_pwd');
        
//        echo $id.$did.$password.$uid; exit;

        $user = $this->muser->edit($id, array(
            TBL_USER_PWD => $password,
            TBL_USER_UID => $uid,
            TBL_USER_STATUS => USER_STATUS_LIVE
        ));
        
        if (!$user) show_error("An Error has occurred while registering!", 500, "Register Error");

		// $object = $this->muser->login($user->{TBL_USER_EMAIL}, $password);

        $login_status = $this->muser->login(strtolower($user->{TBL_USER_EMAIL}), $password);
        
        if($login_status == USER_LOGIN_SUCCESS) {

            $object = $this->muser->getEmail($user->{TBL_USER_EMAIL});
            
            gf_registerCurrentUser($object);

            if ($did) {
                redirect(site_url('chat/channel/'.$did), 'get');
            } else {
                redirect(site_url('profile/edit'), 'get');    
            }

        } else {
            if ($login_status == USER_LOGIN_DELETE)
                show_error("Your account had been deleted by admin!", 500, "Login Error");
            else if ($login_status == USER_LOGIN_PWD)
                show_error("Login password is incorrect!", 500, "Login Error");
            else 
                show_error("Couldn't find user on Relayy!", 500, "Login Error");
        }		        
	}
}