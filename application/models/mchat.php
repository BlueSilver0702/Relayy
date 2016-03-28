<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 1/7/15
 * Time: 9:35 PM
 */

class Mchat extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function add($data_arr)
    {
        $this->db->insert(TBL_NAME_CHAT, $data_arr);

        $nid = $this->db->insert_id();

        return (isset($nid)) ? $nid : FALSE;
    }

    public function getDialogs($like_uid)
    {
        $query = $this->db->select('*')
                      ->like(TBL_CHAT_OCCUPANTS, $like_uid, 'both')
                      ->order_by(TBL_CHAT_TIME, "desc")
                      ->get(TBL_NAME_CHAT);

        return $query->result_array();
    }

    public function getDialogList()
    {
        $query = $this->db->select('*')
                      ->order_by(TBL_CHAT_TIME, "desc")
                      ->get(TBL_NAME_CHAT);

        return $query->result_array();
    }

    public function get($where_did)
    {
        $query = $this->db->select('*')
                          ->where(TBL_CHAT_DID, $where_did)
                          ->limit(1)
                          ->get(TBL_NAME_CHAT);

        if ($query->num_rows() === 1)
        {
            $dialog = $query->row();
            return $dialog;
        }

        return FALSE;
    }

    public function delete($where_did) 
    {
        $this->db->where(TBL_CHAT_DID, $where_did);
        $this->db->delete(TBL_NAME_CHAT); 

        return "success";
    }

    public function update($where_did, $data_arr)
    {
        $this->db->update(TBL_NAME_CHAT, $data_arr, array(TBL_CHAT_DID => $where_did));

        return "success";
    }

    public function changeStatus($where_did)
    {
        $chat = $this->get($where_did);

        if ($chat->{TBL_CHAT_STATUS} == CHAT_STATUS_INIT) {
            $data = array(
                TBL_CHAT_STATUS => CHAT_STATUS_LIVE
            );

            $this->db->update(TBL_NAME_CHAT, $data, array(TBL_CHAT_DID => $did));
            return $this->get($did);
        } else {
            $data = array(
                TBL_CHAT_STATUS => CHAT_STATUS_INIT
            );

            $this->db->update(TBL_NAME_CHAT, $data, array(TBL_CHAT_DID => $did));
            return $this->get($did);
        }
    }
}