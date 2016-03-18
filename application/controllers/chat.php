<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/ChatController.php");

class Chat extends ChatController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	
	$this->maintenance();return;
	
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

	public function channel($current_id)
	{
		$this->loginCheck();    	

		///////////////////////////

		$chat_data = $this->getChatData();
		
		$dialog_arr = $this->mchat->getDialogs($this->cid);

		$find = FALSE;

		foreach ($dialog_arr as $dialog) {

			if ($dialog['did'] == $current_id) {
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

		    	$chat_data['d_noti'] = $this->moption->get($this->cid, 'notify_'.$chat_data['d_id']);

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

	public function add()
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

	public function notification() {

		$did = $this->input->post('did');
		
		$notification = $this->input->post('notification');

        echo $this->moption->update($this->cid, "notify_".$did, $notification);

        exit;
	}

	public function dialog() {
		
		$did = $this->input->post('did');

		$ret_arr = array(
        			'notify' => $this->moption->get($this->cid, "notify_".$did)
        			// 'd_name' => ,
        			// 'd_owner' => ,
        			// 'd_users' => 
        		);

		$dialog_arr = $this->mchat->getDialogs($this->cid);

		$find = FALSE;

		foreach ($dialog_arr as $dialog) {

			if ($dialog['did'] == $did) {

				$ret_arr['d_id'] = $dialog['did'];

		    	$ret_arr['d_name'] = $dialog['name'];

		    	$ret_arr['d_type'] = $dialog['type'];

		    	$d_occupants = json_decode($dialog['occupants']);

		    	$d_users = array();

		    	foreach ($d_occupants as $d_user) {
					$d_users[] = $this->muser->getUserArray($d_user);
		    	}

		    	$ret_arr['d_users'] = $d_users;

		    	$d_owner = $this->muser->getUser($d_occupants[0]);

		    	if ($d_owner->id == $this->cid) $ret_arr['d_owner'] = "Me";
		    	else $ret_arr['d_owner'] = $d_owner->fname;

		    	$find = TRUE;

		    	break;
			}
		}

		if (!$find) {echo "error"; exit;}

        echo json_encode($ret_arr);
        exit;	
	}

	public function delete() {
		
		$did = $this->input->post('did');

        echo $this->mchat->deleteDialog($did);

        exit;	
	}

	public function leave() {
		
		$did = $this->input->post('did');

		$dialog = $this->mchat->getDialog($did);

		$new_occupants = array();

		foreach (json_decode($dialog->occupants) as $occu_id) {
			if ($occu_id != $this->cid) {
				$new_occupants[] = $occu_id;
			}
		}

		$dialog->occupants = json_encode($new_occupants);

		echo $this->mchat->updateDialog($dialog);

        exit;	
	}

	public function remove() {
		
		$did = $this->input->post('did');
		$uid = $this->input->post('uid');

		$dialog = $this->mchat->getDialog($did);

		$new_occupants = array();

		foreach (json_decode($dialog->occupants) as $occu_id) {
			if ($occu_id != $uid) {
				$new_occupants[] = $occu_id;
			}
		}

		$dialog->occupants = json_encode($new_occupants);

		echo $this->mchat->updateDialog($dialog);

        exit;	
	}


}