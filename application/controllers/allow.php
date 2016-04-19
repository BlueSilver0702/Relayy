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
			foreach (json_decode($chat[TBL_CHAT_OCCUPANTS]) as $occupant) {
				$userObj = $this->muser->get($occupant);
                if ($userObj)
				    $chat['emails'][] = $userObj->{TBL_USER_EMAIL};
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
			foreach (json_decode($chat[TBL_CHAT_OCCUPANTS]) as $occupant) {
				$userObj = $this->muser->get($occupant);
				if ($userObj && $userObj->{TBL_USER_STATUS} != USER_STATUS_DELETE)
					$chat['emails'][] = $userObj->{TBL_USER_EMAIL};
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
			foreach (json_decode($chat[TBL_CHAT_OCCUPANTS]) as $occupant) {
				$userObj = $this->muser->get($occupant);
				$chat['emails'][] = $userObj->{TBL_USER_EMAIL};
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
		$occupants_arr = json_decode($chatObj->{TBL_CHAT_OCCUPANTS});
		foreach ($occupants_arr as $user_id) {
			$userObj = $this->muser->get($user_id);
			$this->email->removeChat($this->cemail, $this->cfname." ".$this->clname, $userObj->{TBL_USER_EMAIL}, $userObj->{TBL_USER_FNAME}, $chatObj->{TBL_CHAT_NAME});		
		}

		$this->mchat->delete($did);

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
		foreach (json_decode($chatObj->{TBL_CHAT_OCCUPANTS}) as $user_id) {
			$userObj = $this->muser->get($user_id);
			if ($chatObj->{TBL_CHAT_STATUS} == CHAT_STATUS_LIVE) $this->email->approveChat($this->cemail, $this->cfname." ".$this->clname, $userObj->{TBL_USER_EMAIL}, $userObj->{TBL_USER_FNAME}, $this->inviteChatLink($user_id, $userObj->{TBL_USER_EMAIL}, $chatObj->{TBL_CHAT_DID}), $chatObj->{TBL_CHAT_NAME});
			else $this->email->deproveChat($this->cemail, $this->cfname." ".$this->clname, $userObj->{TBL_USER_EMAIL}, $userObj->{TBL_USER_FNAME}, $chatObj->{TBL_CHAT_NAME});
		}

		if ($page == 0) {
			redirect(site_url('allow'), 'get');
		} else if ($page == 1) {
			redirect(site_url('allow/pending'), 'get');
		} else {
			redirect(site_url('allow/activated'), 'get');
		}
	}

	public function users()
	{
		$email = $this->input->post('email');
		$randUserList = $this->muser->getUserlist(100);
        
        $userList = array();
        foreach ($randUserList as $user) {
            if ($user[TBL_USER_EMAIL] == $this->cemail) continue;
            $userList[] = $user;
        }

		if ($email == '') {echo json_encode($userList);exit;}
		$is_new = FALSE;
		foreach ($userList as $user) {
			if ($user[TBL_USER_EMAIL] == $email) {
				$is_new = TRUE;
				echo json_encode(array($user)); exit;
			}
		}
		if (!$is_new) echo json_encode(array());exit;
	}

	public function newChat()
	{
		$did = $this->input->post('did');
		$jid = $this->input->post('jid');
        $dname = $this->input->post('dname');
        $ddetail = $this->input->post('ddesc');
        $dtype = $this->input->post('type');
		$occupants = $this->input->post('occupants');
        
        $r_occupants = array($this->cid);
        $r_emails = array($this->cemail);
        
        foreach ($occupants as $occupant) {
            if (in_array($occupant[1], $r_occupants)) continue;
            if ($occupant[1] == "") {
                $data_arr = array(
                        TBL_USER_TYPE => USER_TYPE_EXPERT,
                        TBL_USER_STATUS => USER_STATUS_INVITE,
                        TBL_USER_EMAIL => strtolower($occupant[0])
                    );
                $new_id = $this->muser->add($data_arr);
                if (!$new_id) {echo "error";exit;}
                $this->email->inviteUser($this->cemail, $this->cfname." ".$this->clname, $this->inviteUserLink($new_id, $occupant[0]), $occupant[0]);
                $r_occupants[] = $new_id;
                $r_emails[] = $occupant[0];
            } else {
                $r_occupants[] = $occupant[1];
                $r_emails[] = $occupant[0];
            }    
        }                  
        
		$newChat = $this->mchat->add(array(
				TBL_CHAT_DID => $did,
				TBL_CHAT_NAME => $dname,
				TBL_CHAT_OCCUPANTS => json_encode($r_occupants),
				TBL_CHAT_TYPE => $dtype,
				TBL_CHAT_STATUS => CHAT_STATUS_LIVE,
				TBL_CHAT_JID => $jid
			));

        if ($newChat) {
            for ($i = 0; $i < count($r_occupants); $i++) {
                $user_email = $r_emails[$i];
                $this->email->inviteChat($this->cemail, $this->cfname." ".$this->clname, $this->inviteChatLink($r_occupants[$i], $user_email, $did), $user_email, $dname, $ddetail);
            }
            echo "success";
        }
        else echo "error";
		exit;
	}

	private function roleCheck()
	{
		if (gf_cu_type() != 1) 
		{
			redirect(site_url('profile'), 'get');
		}
	}
}