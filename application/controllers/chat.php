<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/chatController.php");

class Chat extends ChatController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
    	$this->loginCheck();    	

		///////////////////////////
    	$chat_data = $this->getChatData();

    	$chat_data['d_current'] = $chat_data['d_id'];

    	$chat_data['body_class'] = 'chat-page';

		$chat_data['page_title'] = 'Chat | Relayy';		

    	$this->load->view('templates/header-chat', $chat_data);

		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('chat');

		$this->load->view('templates/right-sidebar', $chat_data);

		$this->load->view('templates/footer-chat', $chat_data);

	}

	public function channel($cid)
	{
		$this->loginCheck();    	

		///////////////////////////

		$chat_data = $this->getChatData();
		
		$dialog_arr = $this->mchat->getDialogs(gf_cu_id());

		$find = FALSE;

		foreach ($dialog_arr as $dialog) {

			if ($dialog['did'] == $cid) {
				$chat_data['d_id'] = $dialog['did'];

		    	$chat_data['d_name'] = $dialog['name'];

		    	$chat_data['d_occupants'] = json_decode($dialog['occupants']);

		    	$chat_data['d_users'] = array();
		    	foreach ($chat_data['d_occupants'] as $d_user) {
					$chat_data['d_users'][] = $this->muser->getUserArray($d_user);
		    	}

		    	$chat_data['d_type'] = $dialog['type'];

		    	$chat_data['d_jid'] = $dialog['jid'];

		    	$chat_data['d_status'] = $dialog['status'];

		    	$chat_data['d_message'] = $dialog['message'];

		    	$chat_data['d_time'] = $dialog['time'];

		    	$find = TRUE;
			}
		}

		$d_owner = $this->muser->getUser($chat_data['d_occupants'][0]);
	    	
    	$chat_data['d_owner'] = $d_owner->fname;

    	if ($d_owner->id == gf_cu_id()) $chat_data['d_owner'] = "Me";

		if (!$find) redirect(site_url('chat'), 'get');

    	///////////////////////////

    	$chat_data['d_current'] = $chat_data['d_id'];

    	$chat_data['body_class'] = 'chat-page';

		$chat_data['page_title'] = 'Chat | Relayy';

    	$this->load->view('templates/header-chat', $chat_data);

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

}