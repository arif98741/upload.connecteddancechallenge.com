<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 9/7/17
 * Time: 12:14 PM
 */

class InfusionsoftCtrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('infusionsoft');
    }

//http://upload.connecteddancechallenge.com/infusionCtrl/

    public function infusionsoftCallback(){
        echo 'enfusion';
        $crediential=array(
            'clientId'     => 'ugqc98qmfcymx2f6zwwpph4u',
            'clientSecret' => 'BH2qX7nVg4',
            'redirectUri'  => 'http://upload.connecteddancechallenge.com/infusionCtrl/infusionsoftCallback',
        );
        $infusionsoft=new Infusionsoft($crediential);

        if (isset($_GET['code']) and !$infusionsoft->getToken()) {
            $data=$infusionsoft->requestAccessToken($_GET['code']);

            echo '<pre>';
            print_r($data);
        }
    }

}