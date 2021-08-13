<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/14/17
 * Time: 10:27 AM
 */
class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->library('facebook');
    }

    function index(){
        $data['loginForm']='partialView/form/loginForm';
        $facebook=new Facebook();
        $data['authUrl'] =  $facebook->login_url();
//        $data['authUrl'] = base_url('FacebookCtrl');

        if(isset($_GET['cmp_id'])){
            $_SESSION['cmp_id']=$_GET['cmp_id'];
        }
        if(isset($_GET['challenge'])){
            $_SESSION['challenge_id']=$_GET['challenge'];
        }
        if(isset($_GET['p_date'])){
            $date=date('Y-m-d H:i:s',$_GET['p_date']);
            $_SESSION['p_date']=$date;
        }
        /*if(isset($_GET['cmp_id']) || isset($_GET['challenge'])){
            $rightLayout='partialView/challengeApplyPage';
            $this->load->model('DLModel');
            $dlModel=new DLModel();
            $resultData=$dlModel->getCampaignChallengeBasicInfoByScenesId($_GET['challenge']);
            if($resultData['result']){
                $scenes=$resultData['scenes'];
                $this->load->view('layout/userLayout',compact('rightLayout','scenes'));
            }else{
                $this->load->view('layout/loginLayout',$data);
            }
        }else{
            $this->load->view('layout/loginLayout',$data);
        }*/

        if(isset($_GET['challenge'])){
            $rightLayout='partialView/challengeApplyPage';
            $this->load->model('DLModel');
            $dlModel=new DLModel();
            $resultData=$dlModel->getCampaignChallengeBasicInfoByScenesId($_GET['challenge']);
            if($resultData['result']){
                $scenes=$resultData['scenes'];
                $scenesList=$dlModel->getScenesBasicByCampaignId($scenes['campaign_id']);
                $this->load->view('layout/userLayout',compact('rightLayout','scenes','scenesList'));
            }else{
                $this->load->view('layout/loginLayout',$data);
            }
        }else{
            $this->load->view('layout/loginLayout',$data);
        }

    }
}