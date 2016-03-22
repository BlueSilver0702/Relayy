<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 1/7/15
 * Time: 9:35 PM
 */

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

    public function add($id, $name, $occupants, $message, $type, $jid)
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

    public function getDialogList()
    {
        $query = $this->db->select('*')
                      ->order_by("time", "desc")
                      ->get('tbl_chat');

        return $query->result_array();
    }

    public function get($did)
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
            $dialog_one->occupants = $dialog->occupants;
            $dialog_one->type = $dialog->type;
            $dialog_one->jid = $dialog->jid;
            $dialog_one->status = $dialog->status;
            $dialog_one->message = $dialog->message;
            $dialog_one->time = $dialog->time;

            return $dialog_one;

        }

        return FALSE;
    }

    public function delete($did) 
    {
        $this->db->where('did', $did);
        $this->db->delete('tbl_chat'); 

        return "success";
    }

    public function update($dialogObj)
    {
        $data = array(
            'name'      => $dialogObj->name,
            'occupants' => $dialogObj->occupants,
            'message'   => $dialogObj->message,
            'type'      => $dialogObj->type,
            'status'    => $dialogObj->status,
            'jid'       => $dialogObj->jid
        );

        $this->db->update('tbl_chat', $data, array('did' => $dialogObj->id));

        return "success";
    }

    public function changeStatus($did)
    {
        $chat = $this->get($did);

        if ($chat->status == CHAT_STATUS_INIT) {
            $data = array(
                'status' => CHAT_STATUS_LIVE
            );

            $this->db->update('tbl_chat', $data, array('did' => $did));
            return $this->get($did);
        } else {
            $data = array(
                'status' => CHAT_STATUS_INIT
            );

            $this->db->update('tbl_chat', $data, array('did' => $did));
            return $this->get($did);
        }
    }
}