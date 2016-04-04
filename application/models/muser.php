<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 1/7/15
 * Time: 9:35 PM
 */

class Muser extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function add( $data_arr )
    {
        // $data = array(
        //     'uid'        => $uid,
        //     'fname'      => $fname,
        //     'lname'      => $lname,
        //     'pwd'        => $password,
        //     'email'      => $email,
        //     'photo'      => $photo,
        //     'status'     => $status,
        //     'type'       => $type,
        //     'bio'       => $bio,
        //     'facebook'   => $facebook
        // );
        
        $query = $this->db->select(TBL_USER_ID)
                          ->where(TBL_USER_EMAIL, $data_arr[TBL_USER_EMAIL])
                          ->limit(1)
                          ->get(TBL_NAME_USER);
        
        if ($query->num_rows() === 1) {
            $user = $query->row();
            return $user->{TBL_USER_ID};
        }

        $this->db->insert(TBL_NAME_USER, $data_arr);

        $id = $this->db->insert_id();

        return $id ? $id : FALSE;
    }

    public function getUserlist($status = USER_STATUS_INIT)
    {
        if ($status == USER_STATUS_ALL) {
            $query = $this->db->select('*')
                          ->get(TBL_NAME_USER);
        } else {
            $query = $this->db->select('*')
                          ->where(TBL_USER_STATUS, $status)
                          ->get(TBL_NAME_USER);
        }

        return $query->result_array();

    }
    
    public function searchUserlist($searchText = "")
    {
        $query = $this->db->select('*')
                      ->or_like(TBL_USER_FNAME, $searchText, 'both')
                      ->or_like(TBL_USER_LNAME, $searchText, 'both')
                      ->or_like(TBL_USER_EMAIL, $searchText, 'both')
                      ->where(TBL_USER_STATUS, USER_STATUS_LIVE)
                      ->get(TBL_NAME_USER);

        return $query->result_array();

    }

    public function get($where_id)
    {
        $query = $this->db->select('*')
                          ->where(TBL_USER_ID, $where_id)
                          ->limit(1)
                          ->get(TBL_NAME_USER);

        if ($query->num_rows() === 1)
        {
            $user = $query->row();
            return $user;
        }

        return FALSE;
    }

    public function getUserArray($where_id)
    {
        $query = $this->db->select('*')
                          ->where(TBL_USER_ID, $where_id)
                          ->limit(1)
                          ->get(TBL_NAME_USER);

        if ($query->num_rows() === 1)
        {
            $result = $query->result_array();
            return $result[0];
        }

        return FALSE;
    }

    public function edit($where_id, $data_arr)
    {
        $this->db->update(TBL_NAME_USER, $data_arr, array(TBL_USER_ID => $where_id));

        return $this->get($where_id);
    }

    public function changeStatus($where_id)
    {
        $user = $this->get($where_id);

        if ($user->status == USER_STATUS_INIT) {
            $data = array(
                TBL_USER_STATUS => USER_STATUS_LIVE
            );

            $this->db->update(TBL_NAME_USER, $data, array(TBL_USER_ID => $where_id));            

            return $this->get($where_id);
        } else {
            $data = array(
                TBL_USER_STATUS => USER_STATUS_INIT
            );

            $this->db->update(TBL_NAME_USER, $data, array(TBL_USER_ID => $where_id));

            return $this->get($where_id);
        }
    }

    public function approve($where_id) {
        $data = array(
            TBL_USER_STATUS => USER_STATUS_LIVE
        );

        $this->db->update(TBL_NAME_USER, $data, array(TBL_USER_ID => $where_id));
        return $this->get($where_id);                
    }

    public function delete($where_id)
    {
        $this->db->where(TBL_USER_ID, $where_id);
        $this->db->delete(TBL_NAME_USER);

        return "success";
    }

    public function resetPassword($emailAddress, $password)
    {

    }

    public function login($email, $password)
    {

        //$query = $this->db->select('uid, fname, pwd, type, status, email, photo')
        $query = $this->db->select('*')
                          ->where(TBL_USER_EMAIL, $email)
                          ->limit(1)
                          ->get(TBL_NAME_USER);

        if ($query->num_rows() === 1)
        {
            $user = $query->row();

            $pwd = $user->{TBL_USER_PWD};

            if ($password == $pwd) return $user;
        }

        return FALSE;
    }

    public function register($data_arr) {

        $query = $this->db->select('*')
                          ->where(TBL_USER_UID, $data_arr[TBL_USER_UID])
                          ->limit(1)
                          ->get(TBL_NAME_USER);

        if ($query->num_rows() >= 1) {
            $newUser = $query->row();

            return $newUser;
        } else {
            $data_arr[TBL_USER_STATUS] = USER_STATUS_INIT;
            $data_arr[TBL_USER_TYPE] = USER_TYPE_EXPERT;
            $newUser = $this->add($data_arr);
            return $this->get($newUser);
        }

        return FALSE;
    }
}