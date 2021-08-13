<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 12/2/17
 * Time: 7:45 PM
 */


class Test extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function info(){
        echo phpinfo();
    }

    function mailChimpTest(){

        $this->load->library('MailChimp');
        $mail=new MailChimp('a03d80aa1d8ecd54778eee7f82142921-us17');


//        $result = $mail->get('lists');
        $list='6af157fe38';
        $result = $mail->post("lists/$list/members", [
            'email_address' => 'ahmedadnan786@ymail.com',
            'status'        => 'subscribed',
            'merge_fields' => ['FNAME'=>'adnan', 'LNAME'=>'ahmed'],
        ]);


        echo '<pre>';
        print_r($result);
    }



}