<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 1/7/15
 * Time: 9:35 PM
 */

define('CHAT_TYPE_PRIVATE', 1);
define('CHAT_TYPE_GROUP',   2);

define('CHAT_STATUS_INIT',    0);
define('CHAT_STATUS_LIVE',       1);

class Mchat extends CI_Model {

    var $id;
    var $name;
    var $occupants;
    var $type;
    var $status;
    var $message;
    var $time;

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function addDialog($id, $name, $occupants, $message)
    {
        $data = array(
            'did'        => $id,
            'name'      => $name,
            'occupants'        => $occupants,
            'message'      => $message
        );

        $this->db->insert('tbl_chat', $data);

        $nid = $this->db->insert_id();

        return (isset($nid)) ? $nid : FALSE;
    }

    public function updateChat($id, $message)
    {

    }

    public function updateStatus()
    {

    }
}