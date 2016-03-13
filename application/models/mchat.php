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
    var $jid;
    var $status;
    var $message;
    var $time;

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function addDialog($id, $name, $occupants, $message, $type, $jid)
    {
        $data = array(
            'did'        => $id,
            'name'      => $name,
            'occupants'        => json_encode($occupants),
            'message'      => $message,
            'type'      => $type,
            'jid'       => $jid
        );

        $this->db->insert('tbl_chat', $data);

        $nid = $this->db->insert_id();

        return (isset($nid)) ? $nid : FALSE;
    }

    public function getDialogs($uid)
    {
        $query = $this->db->select('*')
                      ->like('occupants', $uid."", 'both')
                      ->order_by("time", "desc")
                      ->get('tbl_chat');

        return $query->result_array();
    }

    public function getDialog($did)
    {
        $query = $this->db->select('*')
                          ->where('did', $did)
                          ->limit(1)
                          ->get('tbl_chat');

        if ($query->num_rows() === 1)
        {
            $dialog = $query->row();

            $dialog_one = new Mchat();
        
            $dialog_one->id = $dialog->did;
            $dialog_one->name = $dialog->name;
            $dialog_one->occupants = json_decode($dialog->occupants);
            $dialog_one->type = $dialog->type;
            $dialog_one->jid = $dialog->jid;
            $dialog_one->status = $dialog->status;
            $dialog_one->message = $dialog->message;
            $dialog_one->time = $dialog->time;

            return $dialog_one;

        }

        return FALSE;
    }

    public function updateChat($id, $message)
    {

    }

    public function updateStatus()
    {

    }
}