<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/ChatController.php");

class Setting extends ChatController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
    	$this->loginCheck();  

    	$set_data['setval'] = intval($this->moption->get($this->cid, 'notification'));

    	$chat_data = $this->getChatData();  	

    	$chat_data['body_class'] = 'setting-page';

		$chat_data['page_title'] = 'Settings | Relayy';
    
    	$this->load->view('templates/header-chat', $chat_data);

		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('setting', $set_data);

		$this->load->view('templates/footer-chat', $chat_data);
	}

	public function save()
	{
		$setvalue = $this->input->post('setvalue');

		$this->moption->update($this->cid, "notification", $setvalue);

		redirect(site_url('setting'), 'get');
	}
}