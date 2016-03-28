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
            TBL_OPTION_UID      => $uid,
            TBL_OPTION_KEY      => $key,
            TBL_OPTION_VALUE    => $value
        );

        $this->db->insert(TBL_NAME_OPTION, $data);

        $nid = $this->db->insert_id();

        return (isset($nid)) ? $nid : FALSE;
    }

    public function get($uid, $key)
    {
        $query = $this->db->select('*')
                          ->where(array(TBL_OPTION_UID => $uid, TBL_OPTION_KEY => $key))
                          ->limit(1)
                          ->get(TBL_NAME_OPTION);

        if ($query->num_rows() === 1)
        {
            $dialog = $query->row();

            return $dialog->{TBL_OPTION_VALUE};

        }

        return FALSE;
    }

    public function update($uid, $key, $value)
    {
        $data = array(
            TBL_OPTION_VALUE => $value
        );

        $this->db->update(TBL_NAME_OPTION, $data, array(TBL_OPTION_UID => $uid, TBL_OPTION_KEY => $key));

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