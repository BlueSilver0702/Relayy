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

		///////////////////////////
		
		$dialog_arr = $this->mchat->getDialogs(gf_cu_id());

		if (count($dialog_arr) > 0) {
			$chat_data['d_id'] = $dialog_arr[0]['did'];

	    	$chat_data['d_name'] = $dialog_arr[0]['name'];

	    	$chat_data['d_occupants'] = $dialog_arr[0]['occupants'];

	    	$chat_data['d_type'] = $dialog_arr[0]['type'];

	    	$chat_data['d_jid'] = $dialog_arr[0]['jid'];

	    	$chat_data['d_status'] = $dialog_arr[0]['status'];

	    	$chat_data['d_message'] = $dialog_arr[0]['message'];

	    	$chat_data['d_time'] = $dialog_arr[0]['time'];	
		}
    	
		$chat_data['history'] = $dialog_arr;
    	///////////////////////////

    	$data['body_class'] = 'chat-page';

		$data['page_title'] = 'Chat | Relayy';

		$data['role'] = gf_cu_type();

		$data['user_name'] = gf_cu_fname();

		$chat_data['u_id'] = gf_cu_id();
		
		$chat_data['u_name'] = gf_cu_fname();

		$chat_data['u_login'] = gf_cu_email();

		$chat_data['u_password'] = gf_cu_password();

    	$this->load->view('templates/header-chat', $data);

		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('chat');

		$this->load->view('templates/right-sidebar', $chat_data);

		$this->load->view('templates/footer-chat', $chat_data);


	}

	public function channel($cid)
	{
		$this->loginCheck();    	

		///////////////////////////
		
		$dialog_arr = $this->mchat->getDialogs(gf_cu_id());

		$find = FALSE;

		foreach ($dialog_arr as $dialog) {

			if ($dialog['did'] == $cid) {
				$chat_data['d_id'] = $dialog['did'];

		    	$chat_data['d_name'] = $dialog['name'];

		    	$chat_data['d_occupants'] = $dialog['occupants'];

		    	$chat_data['d_type'] = $dialog['type'];

		    	$chat_data['d_jid'] = $dialog['jid'];

		    	$chat_data['d_status'] = $dialog['status'];

		    	$chat_data['d_message'] = $dialog['message'];

		    	$chat_data['d_time'] = $dialog['time'];

		    	$find = TRUE;
			}
		}

		if (!$find) redirect(site_url('chat'), 'get');

		$chat_data['history'] = $dialog_arr;
    	///////////////////////////

    	$data['body_class'] = 'chat-page';

		$data['page_title'] = 'Chat | Relayy';

		$data['role'] = gf_cu_type();

		$data['user_name'] = gf_cu_fname();

		$chat_data['u_id'] = gf_cu_id();
		
		$chat_data['u_name'] = gf_cu_fname();

		$chat_data['u_login'] = gf_cu_email();

		$chat_data['u_password'] = gf_cu_password();

    	$this->load->view('templates/header-chat', $data);

		$this->load->view('templates/left-sidebar', $chat_data);

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

        $djid = $this->input->post('djid');

        $this->mchat->addDialog($did, $dname, $dusers, $dmessage, $dtype, $djid);

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