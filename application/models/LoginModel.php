<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/24/17
 * Time: 3:38 PM
 */
class LoginModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }


}