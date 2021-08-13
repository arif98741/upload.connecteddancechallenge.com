<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/14/17
 * Time: 10:26 AM
 */
class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');

        if((isset($_SESSION['loginStatus']) && $_SESSION['loginStatus']) && (isset($_SESSION['loginType']) && $_SESSION['loginType']=='AdminLogin')){

        }else{
            redirect(base_url());
        }
    }

    function campaigns(){
        $data['rightLayout']='partialLayout/campaignLayout';
        $data['campaignsListPanel']='partialView/campaignList';
        $this->load->library('class/Campaigns');
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $data['campaignList']=$dlModel->getCampaignsList();
        $this->load->view('layout/adminLayout',$data);
    }

    function addCampaigns(){
        $data['rightLayout']='partialLayout/campaignLayout';
        $data['campaignsFormPanel']='partialView/form/campaignsForm';
        $this->load->library('class/Campaigns');
        $this->load->library('class/CampaignDifficulty');
        $data['update']=false;
        $data['addNew']=true;
        $data['save']=true;
        $this->load->view('layout/adminLayout',$data);
    }

    function campaignsById($campaignsId){
        $data['rightLayout']='partialLayout/campaignLayout';
        $data['campaignsFormPanel']='partialView/form/campaignsForm';
        $this->load->library('class/Campaigns');
        $this->load->library('class/CampaignDifficulty');
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $campaignData=$dlModel->getCampaignsByCampaignsId($campaignsId);
        $campaignDifficultyData=$dlModel->getCampaignDifficultyByCampaignId($campaignsId);
        if(count($campaignData)==1){
            $data['campaignsData']=$campaignData[0];
        }

        if(count($campaignDifficultyData)>0){

            foreach ($campaignDifficultyData as $key=>$item){
                $data['difficultyLevel_'.($key+1)]=$item;
            }
        }
        $data['update']=true;
        $data['addNew']=false;
        $data['save']=false;
        $this->load->view('layout/adminLayout',$data);
    }



    function scenes(){
        $data['rightLayout']='partialLayout/scenesLayout';
        $data['scenesListPanel']='partialView/scenesList';
        $this->load->library('class/Scenes');
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $data['scenesList']=$dlModel->getScenesList();
        $this->load->view('layout/adminLayout',$data);
    }

    function addScenes(){
        $data['rightLayout']='partialLayout/scenesLayout';
        $data['scenesFormPanel']='partialView/form/scenesForm';
        $this->load->library('class/Scenes');
        $data['update']=false;
        $data['addNew']=true;
        $data['save']=true;
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $data['campaignList']=$dlModel->getCampaignsBasicDetail();
        $this->load->library('class/Campaigns');
        $this->load->view('layout/adminLayout',$data);
    }

    function scenesById($scenesId){
        $data['rightLayout']='partialLayout/scenesLayout';
        $data['scenesFormPanel']='partialView/form/scenesForm';
        $this->load->library('class/Scenes');
        $this->load->library('class/Campaigns');
        $this->load->library('class/CampaignDifficulty');
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $scenesData=$dlModel->getScenesByScenesId($scenesId);


        if(count($scenesData)==1){


            $data['scenesData']=$scenesData[0];
//            $data['scenesData']['post_date']=date('d/m/Y H:i',strtotime($scenesData[0]['post_date']));
        }

        $data['difficultyLevel']=$dlModel->getCampaignDifficultyByCampaignIdAndNameNotNull($scenesData[0]['campaign_id']);

        $data['update']=true;
        $data['addNew']=false;
        $data['save']=false;
        $data['campaignList']=$dlModel->getCampaignsBasicDetail();
        $this->load->view('layout/adminLayout',$data);
    }


    function addAdmin(){
        $data['rightLayout']='partialLayout/adminManagement';
        $data['adminForm']='partialView/form/adminForm';
        $this->load->library('class/Admins');
        $data['update']=false;
        $data['addNew']=true;
        $data['save']=true;
        $this->load->view('layout/adminLayout',$data);
    }

    function adminList(){
        $data['rightLayout']='partialLayout/adminManagement';
        $data['adminListPanel']='partialView/adminList';
        $this->load->library('class/Admins');
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $data['adminList']=$dlModel->getAdminList();
        $this->load->view('layout/adminLayout',$data);
    }

    function leaderboard(){


        $data['rightLayout']='partialLayout/leaderboardLayout';

        $this->load->library('class/Campaigns');
        $this->load->model('DLModel');
        $dlModel=new DLModel();

        if (isset($_SESSION['cmp_id'])){
            $data['campaignId']=$_SESSION['cmp_id'];
        }

        $data['campaignList']=$dlModel->getCampaignsList();
        $this->load->view('layout/adminLayout',$data);
    }

    function infusionsoft(){
        $data['loginForm']='partialView/infusionsoftLogin';
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $this->load->library('Infusionsoft');
        $crediential=array(
            'clientId'     => 'ugqc98qmfcymx2f6zwwpph4u',
            'clientSecret' => 'BH2qX7nVg4',
            'redirectUri'  => 'http://upload.connecteddancechallenge.com/infusionCtrl/infusionsoftCallback',
        );
        $infusionsoft=new \Infusionsoft\Infusionsoft($crediential);
        $data['loginUrl']=$infusionsoft->getAuthorizationUrl();

        $this->load->view('layout/loginLayout',$data);
    }


}