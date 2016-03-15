<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 1/7/15
 * Time: 9:35 PM
 */

class Moption extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function add($uid, $key, $value)
    {
        $data = array(
            'uid'      => $uid,
            'meta_key'        => $key,
            'meta_value'      => $value
        );

        $this->db->insert('tbl_option', $data);

        $nid = $this->db->insert_id();

        return (isset($nid)) ? $nid : FALSE;
    }

    public function get($uid, $key)
    {
        $query = $this->db->select('*')
                          ->where(array('uid' => $uid, 'meta_key' => $key))
                          ->limit(1)
                          ->get('tbl_option');

        if ($query->num_rows() === 1)
        {
            $dialog = $query->row();

            return $dialog->meta_value;

        }

        return FALSE;
    }

    public function update($uid, $key, $value)
    {
        $data = array(
            'meta_value' => $value
        );

        $this->db->update('tbl_option', $data, array('uid' => $uid, 'meta_key' => $key));

        $result = $this->get($uid, $key);
        if ($result == FALSE) {
            return $this->add($uid, $key, $value);
        } else {
            return $result;
        }
    }

    public function delete($uid, $key = "")
    {

    }
}