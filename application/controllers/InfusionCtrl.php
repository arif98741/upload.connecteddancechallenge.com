<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 9/7/17
 * Time: 12:14 PM
 */

class InfusionCtrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('infusionsoft');
    }

//http://upload.connecteddancechallenge.com/infusionCtrl/

    public function infusionsoftCallback(){

        $crediential=array(
            'clientId'     => 'ugqc98qmfcymx2f6zwwpph4u',
            'clientSecret' => 'BH2qX7nVg4',
            'redirectUri'  => 'http://upload.connecteddancechallenge.com/infusionCtrl/infusionsoftCallback',
        );
        $infusionsoft=new Infusionsoft($crediential);

        if(isset($_GET['code']) && !$infusionsoft->getToken()){
            $infusionsoft->requestAccessToken($_GET['code']);
        }

        if($infusionsoft->getToken()){


            $token=$infusionsoft->getToken();


            $this->load->library('class/InfusionsoftToken');

            $this->load->model('DLModel');
            $dlModel=new DLModel();

            $infusionsoftTokenData=$dlModel->getInfusionsoftTokenById(1);
            if(count($infusionsoftTokenData)>0){
                $infusionsoftToken=new InfusionsoftToken($infusionsoftTokenData[0]);
                $infusionsoftToken->setToken(serialize($token));
                $infusionsoftToken->setAuthBy($_SESSION['adminId']);
                $dlModel->updateInfusionsoftToken($infusionsoftToken);

            }else{
                $infusionsoftToken=new InfusionsoftToken();
                $infusionsoftToken->setAuthDate(date('Y-m-d H:i:s'));
                $infusionsoftToken->setToken(serialize($token));
                $infusionsoftToken->setAuthBy($_SESSION['adminId']);

                $dlModel->insertInfusionsoftToken($infusionsoftToken);
            }


            echo '<pre>';
            print_r($token);



        }
    }

    public function addContact(){
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $infusionsoftTokenData=$dlModel->getInfusionsoftTokenById(1);
        $this->load->library('class/InfusionsoftToken');

        $infusionsoftToken=new InfusionsoftToken($infusionsoftTokenData[0]);

        $crediential=array(
            'clientId'     => 'ugqc98qmfcymx2f6zwwpph4u',
            'clientSecret' => 'BH2qX7nVg4',
            'redirectUri'  => 'http://upload.connecteddancechallenge.com/infusionCtrl/infusionsoftCallback',
        );
        $infusionsoft=new Infusionsoft($crediential);

        $infusionsoft->setToken(unserialize($infusionsoftToken->getToken()));

        if(!$infusionsoft->isTokenExpired()){
            try{

                $contactId=$infusionsoft->contacts('xml')->add(array(
                    'FirstName'=>'adnan',
                    'LastName'=>'dev',
                    'Email'=>'ahmedadnan786@ymail.com'
                ));

                echo '<pre>';
                print_r($contactId);
                $tagResult=$infusionsoft->contacts('xml')->addToGroup($contactId,337);
                echo $tagResult;
            }catch (\GuzzleHttp\Exception\ClientException $e){
                echo '<pre>';
                print_r($e->getMessage());
            }
            catch (\Infusionsoft\InfusionsoftException $exception){
                echo '<pre>';
                print_r($exception->getMessage());
            }
        }else{
            echo 'expire';

        }
    }

    public function addTag($contactId,$tagId){
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $infusionsoftTokenData=$dlModel->getInfusionsoftTokenById(1);
        $this->load->library('class/InfusionsoftToken');

        $infusionsoftToken=new InfusionsoftToken($infusionsoftTokenData[0]);

        $crediential=array(
            'clientId'     => 'ugqc98qmfcymx2f6zwwpph4u',
            'clientSecret' => 'BH2qX7nVg4',
            'redirectUri'  => 'http://upload.connecteddancechallenge.com/infusionCtrl/infusionsoftCallback',
        );
        $infusionsoft=new Infusionsoft($crediential);

        $infusionsoft->setToken(unserialize($infusionsoftToken->getToken()));

        if(!$infusionsoft->isTokenExpired()){
            try{

                $result=$infusionsoft->contacts('xml')->addToGroup($contactId,$tagId);

                echo '<pre>';
                print_r($result);
            }catch (\GuzzleHttp\Exception\ClientException $e){
                echo '<pre>';
                print_r($e->getMessage());
            }
            catch (\Infusionsoft\InfusionsoftException $exception){
                echo '<pre>';
                print_r($exception->getMessage());
            }
        }else{
            echo 'expire';
        }
    }

    public function tokenizer(){
        $name='adnan ahmed';
        print_r(explode(' ',$name));
    }

}