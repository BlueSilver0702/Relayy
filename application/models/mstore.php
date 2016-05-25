<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 1/7/15
 * Time: 9:35 PM
 */

use Parse\ParseException;
use Parse\ParseObject;
use Parse\ParseQuery;

class MStore extends CI_Model {

    var $store_id;
    var $store_name;
    var $store_address;
    var $store_from_monday;
    var $store_to_monday;
    var $store_logo; //Store Icon
    var $store_description;


    // will show at edit
    
    var $store_from_tuesday;
    var $store_to_tuesday;
    var $store_from_wednesday;
    var $store_to_wednesday;
    var $store_from_thursday;
    var $store_to_thursday;
    var $store_from_friday;
    var $store_to_friday;
    var $store_from_saturday;
    var $store_to_saturday;
    var $store_from_sunday;
    var $store_to_sunday;
    var $store_image1;
    var $store_image2;

    public function __construct()
    {
        parent::__construct();
    }
}