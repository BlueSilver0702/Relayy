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
	
	    //$this->maintenance();return;
	
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
				$chat_data['d_id'] = $dialog[TBL_CHAT_DID];

		    	$chat_data['d_name'] = $dialog[TBL_CHAT_NAME];

		    	$chat_data['d_occupants'] = json_decode($dialog[TBL_CHAT_OCCUPANTS]);

		    	$chat_data['d_users'] = array();
		    	foreach ($chat_data['d_occupants'] as $d_user) {
					$chat_data['d_users'][] = $this->muser->getUserArray($d_user);
		    	}

		    	$chat_data['d_type'] = $dialog[TBL_CHAT_TYPE];

		    	$chat_data['d_jid'] = $dialog[TBL_CHAT_JID];

		    	$chat_data['d_status'] = $dialog[TBL_CHAT_STATUS];

		    	$chat_data['d_message'] = $dialog[TBL_CHAT_MESSAGE];

		    	$chat_data['d_time'] = $dialog[TBL_CHAT_TIME];

		    	$chat_data['d_noti'] = $this->moption->get($this->cid, 'notify_'.$chat_data['d_id']);

		    	$find = TRUE;
			}
		}

		$d_owner = $this->muser->get($chat_data['d_occupants'][0]);
	    	
    	$chat_data['d_owner'] = $d_owner->{TBL_USER_FNAME};
        
        if (!$chat_data['d_owner']) {
            $str_arr = explode("@", $d_owner->{TBL_USER_EMAIL});
            $chat_data['d_owner'] = $str_arr[0];
        }

    	if ($d_owner->{TBL_USER_ID} == gf_cu_id()) $chat_data['d_owner'] = "Me";

		if (!$find && $this->ctype != USER_TYPE_ADMIN) redirect(site_url('chat'), 'get');

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

        $this->mchat->add(array(
            TBL_CHAT_DID => $did,
            TBL_CHAT_NAME => $dname,
            TBL_CHAT_OCCUPANTS => $dusers,
            TBL_CHAT_MESSAGE => $dmessage,
            TBL_CHAT_TYPE => $dtype,
            TBL_CHAT_STATUS => CHAT_STATUS_INIT,
            TBL_CHAT_JID => $djid
        ));

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

			if ($dialog[TBL_CHAT_DID] == $did) {

				$ret_arr['d_id'] = $dialog[TBL_CHAT_DID];

		    	$ret_arr['d_name'] = $dialog[TBL_CHAT_NAME];

		    	$ret_arr['d_type'] = $dialog[TBL_CHAT_TYPE];

		    	$d_occupants = json_decode($dialog[TBL_CHAT_OCCUPANTS]);

		    	$d_users = array();

		    	foreach ($d_occupants as $d_user) {
					$d_users[] = $this->muser->getUserArray($d_user);
		    	}

		    	$ret_arr['d_users'] = $d_users;

		    	$d_owner = $this->muser->get($d_occupants[0]);

		    	if ($d_owner->{TBL_USER_ID} == $this->cid) $ret_arr['d_owner'] = "Me";
		    	else {
                    $ret_arr['d_owner'] = $d_owner->{TBL_USER_FNAME};   
                    if (!$chat_data['d_owner']) {
                        $str_arr = explode("@", $d_owner->{TBL_USER_EMAIL});
                        $chat_data['d_owner'] = $str_arr[0];
                    }
                }

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

        echo $this->mchat->delete($did);

        exit;	
	}

	public function leave() {
		
		$did = $this->input->post('did');

		$dialog = $this->mchat->get($did);

		$new_occupants = array();

		foreach (json_decode($dialog->{TBL_CHAT_OCCPANTS}) as $occu_id) {
			if ($occu_id != $this->cid) {
				$new_occupants[] = $occu_id;
			}
		}

		echo $this->mchat->update($dialog->{TBL_CHAT_ID}, array(
            TBL_CHAT_OCCUPANTS => json_encode($new_occupants)
        ));

        exit;	
	}

	public function remove() {
		
		$did = $this->input->post('did');
		$uid = $this->input->post('uid');

		$dialog = $this->mchat->get($did);

		$new_occupants = array();

		foreach (json_decode($dialog->{TBL_CHAT_OCCUPANTS}) as $occu_id) {
			if ($occu_id != $uid) {
				$new_occupants[] = $occu_id;
			}
		}
           
		echo $this->mchat->update($dialog->{TBL_CHAT_ID}, array(
            TBL_CHAT_OCCUPANTS => json_encode($new_occupants)
        ));

        exit;	
	}

    public function msgUpdate() {
        $did = $this->input->post('did');
        $uid = $this->input->post('sender');
        $msg = $this->input->post('msg');
           
        echo $this->mchat->update($did, array(
            TBL_CHAT_SENDER => $uid,
            TBL_CHAT_MESSAGE => $msg,
            TBL_CHAT_TIME => date('Y-m-d H:i:s')
        ));

        exit;
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
                        TBL_USER_STATUS => $this->ctype!=USER_TYPE_EXPERT?USER_STATUS_INVITE:USER_STATUS_INIT,
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
                TBL_CHAT_STATUS => $this->ctype!=USER_TYPE_EXPERT?CHAT_STATUS_LIVE:CHAT_STATUS_INIT,
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
    
    function addMember()
    {
        $did = $this->input->post('did');
        $occupants = $this->input->post('occupants');
        
        $r_occupants = array();
        $r_emails = array();
        
        $newChat = $this->mchat->get($did);

        foreach ($occupants as $occupant) {
            if ($occupant[1] == "") {
                $data_arr = array(
                        TBL_USER_TYPE => USER_TYPE_EXPERT,
                        TBL_USER_STATUS => $this->ctype!=USER_TYPE_EXPERT?USER_STATUS_INVITE:USER_STATUS_INIT,
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
        
        for ($i = 0; $i < count($r_occupants); $i++) {
            $user_email = $r_emails[$i];
            $this->email->inviteChat($this->cemail, $this->cfname." ".$this->clname, $this->inviteChatLink($r_occupants[$i], $user_email, $did), $user_email, $newChat->{TBL_CHAT_NAME}, "");
        }
        
        $n_occupants = json_decode($newChat->{TBL_CHAT_OCCUPANTS});
        foreach ($r_occupants as $uid) {
            if (!in_array($uid, $n_occupants)) $n_occupants[] = $uid;
        }
        
        $this->mchat->update($did, array(
            TBL_CHAT_OCCUPANTS => json_encode($n_occupants)
        ));
        
        echo "success";
    
        exit;
    }
}