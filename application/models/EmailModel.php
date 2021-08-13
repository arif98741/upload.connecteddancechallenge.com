<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 1/18/17
 * Time: 3:10 PM
 */
class EmailModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $config = Array(
            'protocol' => 'sendmail',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE

        );
        $this->load->library('email',$config);
        $this->load->database();
    }

    public function sendMail($emailTo, $mailBody,$subject,$senderName){

        /*Send data to mail body and Load mail body to the message to send images and message*/
        /*$message=$this->load->view('MailBodyMessageWithImageSrc',$selectImageData,true);*/
        $this->email->clear(TRUE);
        $this->email->set_newline("\r\n");
        $this->email->to($emailTo);
        $this->email->from("mail@nservices.co.in",$senderName);
        $this->email->subject($subject);
        $this->email->message($mailBody);
        if($this->email->send()){
            return true;
        }
        else{
            return false;
        }
    }

    public function sendMailWithAttachment($emailTo, $mailBody,$subject,$senderName,$attachment){

        /*Send data to mail body and Load mail body to the message to send images and message*/
        /*$message=$this->load->view('MailBodyMessageWithImageSrc',$selectImageData,true);*/
        $this->email->clear(TRUE);
        $this->email->set_newline("\r\n");
        $this->email->to($emailTo);
        $this->email->from("contact@schosys.com",$senderName);
        $this->email->subject($subject);
        $this->email->message($mailBody);
        $this->email->attach($attachment);
        if($this->email->send()){
            return true;
        }
        else{
            return false;
        }
    }
}