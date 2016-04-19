<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	
	// $this->maintenance();return;
	
    	if ( gf_isLogin() )
		{
			redirect(site_url('profile'), 'get');
			
			return;
		}

    	$chat_data['body_class'] = 'login-page';

		$chat_data['page_title'] = 'Sign In | Relayy';
    
		$this->load->view('login');
	}

    public function link() {
        
        $email = $this->input->post('email');
        $this->load->model('muser');
        $user = $this->muser->getEmail($email);
        if ($user) {
            if ($user->{TBL_USER_STATUS} == USER_STATUS_LIVE) {
                echo "no";exit;
            }
        }
        
        echo "yes";exit;
    }
}