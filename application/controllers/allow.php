<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/ChatController.php");

class Allow extends ChatController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	
	// $this->maintenance();return;
	
    	$this->loginCheck();  

    	$this->roleCheck();  	

    	$chat_data = $this->getChatData();

    	$chat_data['body_class'] = 'allow-page';

		$chat_data['page_title'] = 'Chat Management | Relayy';

		$chat_data['chats'] = $this->mchat->getDialoglist();

		foreach ($chat_data['chats'] as &$chat) {
			foreach (json_decode($chat['occupants']) as $occupant) {
				$userObj = $this->muser->get($occupant);
				$chat['emails'][] = $userObj->email;
			}		
		}

		$chat_data['page'] = 0;
    
    	$this->load->view('templates/header-chat', $chat_data);

		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('allow');

		$this->load->view('templates/footer-chat', $chat_data);
	}

	public function pending()
	{
    	$this->loginCheck();    	

    	$this->roleCheck();

    	$chat_data = $this->getChatData();

    	$chat_data['body_class'] = 'allow-page';

		$chat_data['page_title'] = 'Chat Management | Relayy';

		$chat_data['chats'] = $this->mchat->getDialoglist();

		foreach ($chat_data['chats'] as &$chat) {
			foreach (json_decode($chat['occupants']) as $occupant) {
				$userObj = $this->muser->get($occupant);
				$chat['emails'][] = $userObj->email;
			}		
		}

		$chat_data['page'] = 1;
    
    	$this->load->view('templates/header-chat', $chat_data);

		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('allow');

		$this->load->view('templates/footer-chat', $chat_data);
	}

	public function activated()
	{
    	$this->loginCheck();

    	$this->roleCheck();    	

    	$chat_data = $this->getChatData();

    	$chat_data['body_class'] = 'allow-page';

		$chat_data['page_title'] = 'Chat Management | Relayy';

		$chat_data['chats'] = $this->mchat->getDialoglist();

		foreach ($chat_data['chats'] as &$chat) {
			foreach (json_decode($chat['occupants']) as $occupant) {
				$userObj = $this->muser->get($occupant);
				$chat['emails'][] = $userObj->email;
			}		
		}

		$chat_data['page'] = 2;
    
    	$this->load->view('templates/header-chat', $chat_data);

		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('allow');

		$this->load->view('templates/footer-chat', $chat_data);
	}

	public function delete($did, $page) 
	{
		$this->loginCheck();

		$this->roleCheck();    	

		$chatObj = $this->mchat->get($did);
		$this->mchat->delete($did);

		foreach ($chatObj->occupants as $user_id) {
			$userObj = $this->muser->get($user_id);
			$this->email->removeChat($this->cemail, $this->cfname." ".$this->clname, $userObj->email, $userObj->fname, $chatObj->name);		
		}

		if ($page == 0) {
			redirect(site_url('allow'), 'get');
		} else if ($page == 1) {
			redirect(site_url('allow/pending'), 'get');
		} else {
			redirect(site_url('allow/activated'), 'get');
		}
	}

	public function action($did, $page) 
	{
		$this->loginCheck();

		$this->roleCheck();

		$chatObj = $this->mchat->changeStatus($did);
		foreach ($chatObj->occupants as $user_id) {
			$userObj = $this->muser->get($user_id);
			if ($chatObj->type == 1) $this->email->approveChat($this->cemail, $this->cfname." ".$this->clname, $userObj->email, $userObj->fname, $this->inviteChatLink($user_id, $userObj->email, $chatObj->did), $chatObj->name);
			else $this->email->deproveChat($this->cemail, $this->cfname." ".$this->clname, $userObj->email, $userObj->fname, $chatObj->name);
		}

		if ($page == 0) {
			redirect(site_url('allow'), 'get');
		} else if ($page == 1) {
			redirect(site_url('allow/pending'), 'get');
		} else {
			redirect(site_url('allow/activated'), 'get');
		}
	}

	private function roleCheck() {
		if (gf_cu_type() != 1) 
		{
			redirect(site_url('profile'), 'get');
		}
	}
}