<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/ChatController.php");

class Search extends ChatController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	
	$this->maintenance();return;
	
    	$this->loginCheck();  

    	$chat_data = $this->getChatData();  	

    	$chat_data['body_class'] = 'search-page';

		$chat_data['page_title'] = 'Search Result | Relayy';
    
    	$this->load->view('templates/header-chat', $chat_data);

		$this->load->view('templates/left-sidebar', $chat_data);

		$this->load->view('search');

		$this->load->view('templates/footer-chat', $chat_data);
	}
}