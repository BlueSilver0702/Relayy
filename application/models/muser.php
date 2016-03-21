<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 1/7/15
 * Time: 9:35 PM
 */

class Muser extends CI_Model {

    var $id;
    var $uid;
    var $fname;
    var $lname;
    var $password;
    var $type;
    var $status;
    var $email;
    var $photo;
    var $bio;
    var $facebook;

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function add(
        $id,
        $fname,
        $lname,
        $password,
        $type,
        $status,
        $email,
        $photo,
        $bio,
        $facebook)
    {
        $data = array(
            'uid'        => $id,
            'fname'      => $fname,
            'lname'      => $lname,
            'pwd'        => $password,
            'email'      => $email,
            'photo'      => $photo,
            'status'     => $status,
            'type'       => $type,
            'bio'       => $bio,
            'facebook'   => $facebook
        );

        $this->db->insert('tbl_user', $data);

        $id = $this->db->insert_id();

        return $id ? $id : FALSE;
    }

    public function getUserlist($status = USER_STATUS_INIT)
    {
        if ($status == 100) {
            $query = $this->db->select('*')
                          ->get('tbl_user');
        } else {
            $query = $this->db->select('*')
                          ->where('status', $status)
                          ->get('tbl_user');
        }

        return $query->result_array();

    }

    public function get($user_id)
    {
        $query = $this->db->select('*')
                          ->where('uid', $user_id)
                          ->limit(1)
                          ->get('tbl_user');

        if ($query->num_rows() === 1)
        {
            $user = $query->row();

            $user_one = new Muser();
        
            $user_one->id = $user->id;
            $user_one->uid = $user->uid;
            $user_one->fname = $user->fname;
            $user_one->lname = $user->lname;
            $user_one->password = $user->pwd;
            $user_one->type = $user->type;
            $user_one->status = $user->status;
            $user_one->email = $user->email;
            $user_one->photo = $user->photo;
            $user_one->bio = $user->bio;
            $user_one->facebook = $user->facebook;

            return $user_one;

        }

        return FALSE;
    }

    public function getUserArray($user_id)
    {
        $query = $this->db->select('*')
                          ->where('uid', $user_id)
                          ->limit(1)
                          ->get('tbl_user');

        if ($query->num_rows() === 1)
        {
            $result = $query->result_array();
            return $result[0];
        }

        return FALSE;
    }

    public function edit($id, $fname, $lname, $email, $password, $type, $bio, $picture)
    {
        $data = array(
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'pwd' => $password,
            'type' => $type,
            'bio' => $bio,
            'photo' => $picture
        );

        $this->db->update('tbl_user', $data, array('uid' => $id));

        return $this->get($id);
    }

    public function changeStatus($user_id)
    {
        $user = $this->get($user_id);

        if ($user->status == USER_STATUS_INIT) {
            $data = array(
                'status' => USER_STATUS_LIVE
            );

            $this->db->update('tbl_user', $data, array('uid' => $user_id));            
        } else {
            $data = array(
                'status' => USER_STATUS_INIT
            );

            $this->db->update('tbl_user', $data, array('uid' => $user_id));            
        }
    }

    public function approve($user_id) {
        $user = $this->get($user_id);

        $data = array(
            'status' => USER_STATUS_LIVE
        );

        $this->db->update('tbl_user', $data, array('uid' => $user_id));                
    }

    public function delete($user_id)
    {
        $this->db->where('uid', $user_id);
        $this->db->delete('tbl_user'); 

        return "success";
    }

    public function resetPassword($emailAddress, $password)
    {

    }

    public function login($email, $password)
    {

        //$query = $this->db->select('uid, fname, pwd, type, status, email, photo')
        $query = $this->db->select('*')
                          ->where('email', $email)
                          ->limit(1)
                          ->get('tbl_user');

        if ($query->num_rows() === 1)
        {
            $user = $query->row();

            $pwd = $user->pwd;


            if ($password == $pwd)
            {
                $user_one = new Muser();
            
                $user_one->id = $user->id;
                $user_one->uid = $user->uid;
                $user_one->fname = $user->fname;
                $user_one->lname = $user->lname;
                $user_one->password = $user->pwd;
                $user_one->type = $user->type;
                $user_one->status = $user->status;
                $user_one->email = $user->email;
                $user_one->photo = $user->photo;
                $user_one->bio = $user->bio;
                $user_one->facebook = $user->facebook;

                return $user_one;
            }
        }

        return FALSE;
    }

    public function register($id, $fname, $lname, $email, $pwd, $type, $facebook, $photo, $bio) {

        $newUser = $this->get($id);

        if (!$newUser)
        {
            $newUser = $this->add($id, $fname, $lname, $pwd, $type, USER_STATUS_INIT, $email, $photo, $bio, $facebook);    
        }

        if ($newUser) 
        {
            $user_one = new Muser();
            
            $user_one->id = $newUser;
            $user_one->uid = $id;
            $user_one->fname = $fname;
            $user_one->lname = $lname;
            $user_one->password = $pwd;
            $user_one->type = $type;
            $user_one->status = USER_STATUS_INIT;
            $user_one->email = $email;
            $user_one->photo = $photo;
            $user_one->bio = $bio;
            $user_one->facebook = $facebook;

            return $user_one;
        }

        return FALSE;
    }
}