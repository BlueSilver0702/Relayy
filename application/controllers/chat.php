<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mchat');
	}

	public function index()
	{
    	$this->loginCheck();    	

    	$data['body_class'] = 'chat-page';

		$data['page_title'] = 'Chat | Relayy';

		$data['role'] = gf_cu_type();

		$data['user_name'] = gf_cu_fname();

		$chat_data['u_id'] = gf_cu_id();
		
		$chat_data['u_name'] = gf_cu_fname();

		$chat_data['u_login'] = gf_cu_email();

		$chat_data['u_password'] = gf_cu_password();
    
    	$this->load->view('templates/header-chat', $data);
		
		$chat_data['history'] = $this->mchat->getDialogs(gf_cu_id());

		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('chat');

		$this->load->view('templates/right-sidebar', $chat_data);

		$this->load->view('templates/footer-chat', $chat_data);


	}

	public function channel($cid)
	{
		$this->loginCheck();    	

    	$data['body_class'] = 'chat-page';

		$data['page_title'] = 'Chat | Relayy';

		$data['role'] = gf_cu_type();

		$data['user_name'] = gf_cu_fname();

		$chat_data['u_id'] = gf_cu_id();
		
		$chat_data['u_name'] = gf_cu_fname();

		$chat_data['u_login'] = gf_cu_email();

		$chat_data['u_password'] = gf_cu_password();
    
    	$this->load->view('templates/header-chat', $data);
		
		$chat_data['history'] = $this->mchat->getDialogs(gf_cu_id());

		$chat_data['current_dialog'] = $cid;

		$this->load->view('templates/left-sidebar', $chat_data);

		$chat_data['history'] = $this->mchat->getDialog($cid);

		$this->load->view('chat');

		$this->load->view('templates/right-sidebar', $chat_data);

		$this->load->view('templates/footer-chat', $chat_data);
	}

	public function new()
	{
		$did = $this->input->post('did');
		
		$dname = $this->input->post('dname');
        
        $dusers = $this->input->post('dusers');

        $dmessage = $this->input->post('dmessage');

        $dtype = $this->input->post('dtype');

        $this->mchat->addDialog($did, $dname, $dusers, $dmessage, $dtype);

        exit;
	}

	private function loginCheck()
	{
		if ( !gf_isLogin() )
		{
			redirect(site_url('home'), 'get');
			
			return;	
		}
	}
}