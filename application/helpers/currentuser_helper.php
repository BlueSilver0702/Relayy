<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 1/10/15
 * Time: 4:17 PM
 */

function gf_isLogin()
{

    // get the superobject
    $CI =& get_instance();

    $cu_type = $CI->session->userdata('cu_type');

    if($cu_type > 0) {
        return true;
    } else {
        return false;
    }
}


function gf_isAdmin()
{
    // get the superobject
    $CI =& get_instance();

    $cu_type = $CI->session->userdata('cu_type');

    if($cu_type == 1) {
        return true;
    } else {
        return false;
    }
}

function gf_isAdvisor()
{

    // get the superobject
    $CI =& get_instance();

    $cu_userType = $CI->session->userdata('cu_type');

    if($cu_userType == 2) {
        return true;
    } else {
        return false;
    }
}

function gf_isExpert()
{

    // get the superobject
    $CI =& get_instance();

    $cu_userType = $CI->session->userdata('cu_type');

    if($cu_userType == 3) {
        return true;
    } else {
        return false;
    }
}
    
function gf_registerCurrentUser($userObject)
{
    // get the superobject
    $CI =& get_instance();

    $arr = array(
        'logged_in' => true,
        'logged_in_time' => time(),
        'cu_id' => $userObject->id,
        'cu_uid' => $userObject->uid,
        'cu_fname' => $userObject->fname,
        'cu_lname' => $userObject->lname,
        'cu_email' => $userObject->email,
        'cu_password' => $userObject->password,
        'cu_type' => $userObject->type,
        'cu_status' => $userObject->status,
        'cu_photo' => $userObject->photo,
        'cu_bio' => $userObject->bio,
        'cu_facebook' => $userObject->facebook,
    );                                              
    $CI->session->set_userdata($arr);
}

function gf_unregisterCurrentUser()
{
    $CI =& get_instance();

    $arr = array(
        'logged_in' => '',
        'logged_in_time' => '',
        'cu_id' => '',
        'cu_uid' => '',
        'cu_fname' => '',
        'cu_lname' => '',
        'cu_email' => '',
        'cu_password' => '',
        'cu_type' => '',
        'cu_status' => '',
        'cu_photo' => '',
        'cu_bio' => '',
        'cu_facebook' => '',
    );

    $CI->session->set_userdata($arr);
}

function gf_isCurrentUser($user_id)
{

    $CI =& get_instance();

    $cu_id = $CI->session->userdata('cu_id');

    if($cu_id == $user_id)
        return true;
    else
        return false;
}
                                                               
function gf_cu_id(){$CI =& get_instance(); return $CI->session->userdata('cu_id');}
function gf_cu_uid(){$CI =& get_instance(); return $CI->session->userdata('cu_uid');}
function gf_cu_password(){$CI =& get_instance(); return $CI->session->userdata('cu_password');}
function gf_cu_fname(){$CI =& get_instance(); return $CI->session->userdata('cu_fname');}
function gf_cu_lname(){$CI =& get_instance(); return $CI->session->userdata('cu_lname');}
function gf_cu_email(){$CI =& get_instance(); return $CI->session->userdata('cu_email');}
function gf_cu_type(){$CI =& get_instance(); return $CI->session->userdata('cu_type');}
function gf_cu_status(){$CI =& get_instance(); return $CI->session->userdata('cu_status');}
function gf_cu_photo(){$CI =& get_instance(); return $CI->session->userdata('cu_photo');}
function gf_cu_bio(){$CI =& get_instance(); return $CI->session->userdata('cu_bio');}
function gf_cu_facebook(){$CI =& get_instance(); return $CI->session->userdata('cu_facebook');}