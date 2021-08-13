<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/19/17
 * Time: 5:52 PM
 */
class M extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }



    public function addCampaign(){

        $this->load->library('class/Campaigns');
        $campaigns=new Campaigns($_POST);
        $this->load->model('UploadFile');
        $uploadFile=new UploadFile();
        $campaignsImage=$_FILES['campaign_image'];
        $sponsorImage=$_FILES['sponsor_image'];
        $campaignsImageFlag='';
        $data=array();
        if($campaignsImage['name']!=''){
            $campaignsImageResult=$uploadFile->uploadImage('campaign_image');
            if($campaignsImageResult['result']){
                $campaignsImageFlag=true;
                $campaigns->setCampaignImageUrl($campaignsImageResult['image_path']);
                $campaigns->setCampaignImageUrlThumb($campaignsImageResult['thumb_path']);
            }else{
                $campaignsImageFlag=false;
                $data['messageCampaignsImage']=$campaignsImageResult['message'];
            }
        }


        $sponsorImageFlag='';
        if($sponsorImage['name']!=''){
            $sponsorImageResult=$uploadFile->uploadImage('sponsor_image');
            if($sponsorImageResult['result']){
                $sponsorImageFlag=true;
                $campaigns->setSponsorImageUrl($sponsorImageResult['image_path']);
                $campaigns->setSponsorImageUrlThumb($sponsorImageResult['thumb_path']);
            }else{
                $sponsorImageFlag=false;
                $data['messageSponsorImage']=$sponsorImageResult['message'];
            }
        }

        if($campaignsImageFlag===false && $sponsorImageFlag=== false){
            $data['result']=false;
        }else{
            $this->load->model('DLModel');
            $dlModel=new DLModel();
            $userFunctionModel=new UserFunctionModel();
            $campaigns->setStartDate($userFunctionModel->convertDateInMysqlFormat($campaigns->getStartDate()));
            $campaigns->setEndDate($userFunctionModel->convertDateInMysqlFormat($campaigns->getEndDate()));
            $campaigns->setPostDate($userFunctionModel->convertDateInMysqlFormat($campaigns->getPostDate()));
            $campaigns->setEntryDate(date('Y-m-d H:i:s'));
            $campaigns->setCampaignStatus('active');
            $campaigns->setAdminId($_SESSION['adminId']);

            $this->db->trans_start();

            $dlModel->insertCampaigns($campaigns);

            $campaignId=$this->db->insert_id();
            $this->load->library('class/CampaignDifficulty');

            for($i=0;$i<4;$i++){
                $campaignDifficulty=new CampaignDifficulty();
                $campaignDifficulty->setCampaignId($campaignId);
                $campaignDifficulty->setDifficultyName($_POST['difficulty_'.($i+1)]);
                $campaignDifficulty->setDifficultyDefaultValue($i+1);
                $dlModel->insertCampaignDifficulty($campaignDifficulty);
            }
            /*if( true || $_POST['difficulty_1']!=''){
                $campaignDifficulty=new CampaignDifficulty();
                $campaignDifficulty->setCampaignId($campaignId);
                $campaignDifficulty->setDifficultyName($_POST['difficulty_1']);
                $campaignDifficulty->setDifficultyDefaultValue(1);
                $dlModel->insertCampaignDifficulty($campaignDifficulty);
            }
            if(true || $_POST['difficulty_2']!=''){
                $campaignDifficulty=new CampaignDifficulty();
                $campaignDifficulty->setCampaignId($campaignId);
                $campaignDifficulty->setDifficultyName($_POST['difficulty_2']);
                $campaignDifficulty->setDifficultyDefaultValue(2);
                $dlModel->insertCampaignDifficulty($campaignDifficulty);
            }
            if(true || $_POST['difficulty_3']!=''){
                $campaignDifficulty=new CampaignDifficulty();
                $campaignDifficulty->setCampaignId($campaignId);
                $campaignDifficulty->setDifficultyName($_POST['difficulty_3']);
                $campaignDifficulty->setDifficultyDefaultValue(3);
                $dlModel->insertCampaignDifficulty($campaignDifficulty);
            }
            if(true || $_POST['difficulty_4']!=''){
                $campaignDifficulty=new CampaignDifficulty();
                $campaignDifficulty->setCampaignId($campaignId);
                $campaignDifficulty->setDifficultyName($_POST['difficulty_4']);
                $campaignDifficulty->setDifficultyDefaultValue(4);
                $dlModel->insertCampaignDifficulty($campaignDifficulty);
            }*/

            /*if(){




                $data['result']=true;
                $data['message']='Campaign add successfully..';
            }else{
                $data['result']=false;
                $data['message']='Unable to add campaign';
            }*/

            $this->db->trans_complete();

            if($this->db->trans_status() === FALSE){
                $data['result']=false;
                $data['message']='Unable to add campaign';
            }else{
                $data['result']=true;
                $data['message']='Campaign add successfully..';
            }

        }

        echo json_encode($data);


    }

    public function updateCampaign(){
        $campaignsData=$_POST;
        $campaignId=$campaignsData['campaign_id'];

        $this->load->library('class/CampaignDifficulty');
        $this->load->model('DLModel');
        $dlModel=new DLModel();

        $userFunctionModel=new UserFunctionModel();
        if($campaignsData['start_date']!=''){
            $campaignsData['start_date']=$userFunctionModel->convertDateInMysqlFormat($campaignsData['start_date']);
        }
        if($campaignsData['end_date']!=''){
            $campaignsData['end_date']=$userFunctionModel->convertDateInMysqlFormat($campaignsData['end_date']);
        }
        if($campaignsData['post_date']!=''){
            $campaignsData['post_date']=$userFunctionModel->convertDateInMysqlFormat($campaignsData['post_date']);
        }

        unset($campaignsData['difficulty_1']);
        unset($campaignsData['difficulty_2']);
        unset($campaignsData['difficulty_3']);
        unset($campaignsData['difficulty_4']);

        $campaignsData['update_by']=$_SESSION['adminId'];

        $this->db->trans_start();

        $dlModel->updateCampaignsByCampaignsId($campaignsData,$campaignId);

        $campaignDifficultyData=$dlModel->getCampaignDifficultyByCampaignId($campaignId);
        if(count($campaignDifficultyData)==4){
            foreach ($campaignDifficultyData as $key=>$item){
                $campaignDifficulty =new CampaignDifficulty($item);
                $campaignDifficulty->setDifficultyName($_POST['difficulty_'.($key+1)]);
                $dlModel->updateCampaignDifficulty($campaignDifficulty);
            }
        }else{
            for($i=0;$i<4;$i++){
                $campaignDifficulty=new CampaignDifficulty();
                $campaignDifficulty->setCampaignId($campaignId);
                $campaignDifficulty->setDifficultyName($_POST['difficulty_'.($i+1)]);
                $campaignDifficulty->setDifficultyDefaultValue($i+1);
                $dlModel->insertCampaignDifficulty($campaignDifficulty);
            }

        }

        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $data['result']=false;
            $data['message']='unable to update';
        }else{
            $data['result']=true;
            $data['message']='Update successfully...';
        }

        /*if($dlModel->updateCampaignsByCampaignsId($campaignsData,$campaignId)){

            $campaignDifficultyData=$dlModel->getCampaignDifficultyByCampaignId($campaignId);
            if(count($campaignDifficultyData)==4){
                foreach ($campaignDifficultyData as $key=>$item){
                    $campaignDifficulty =new CampaignDifficulty($item);
                    $campaignDifficulty->setDifficultyName($_POST['difficulty_'.($key+1)]);
                    $dlModel->updateCampaignDifficulty($campaignDifficulty);
                }
            }else{
                for($i=0;$i<4;$i++){
                    $campaignDifficulty=new CampaignDifficulty();
                    $campaignDifficulty->setCampaignId($campaignId);
                    $campaignDifficulty->setDifficultyName($_POST['difficulty_'.($i+1)]);
                    $campaignDifficulty->setDifficultyDefaultValue($i+1);
                    $dlModel->insertCampaignDifficulty($campaignDifficulty);
                }

            }

            $data['result']=true;
            $data['message']='Update successfully...';
        }else{
            $data['result']=false;
            $data['message']='unable to update';
        }*/

        echo  json_encode($data);
    }
    public function deleteCampaign(){
        $campaignId=$_GET['campaignId'];
        $this->load->model('DLModel');
        $data=array();
        $dlModel=new DLModel();
        if($dlModel->deleteCampaignByCampaignId($campaignId)){
            $data['result']=true;
            $data['message']='Delete successfully..';
        }else{
            $data['result']=false;
            $data['message']='Unable to delete';
        }

        /*$data['result']=true;
        $data['message']='Delete successfully..';*/

        echo json_encode($data);
    }
    public function changeCampaignStatus(){
        $campaignId=$_GET['campaignId'];
        $status=$_GET['status'];

        $changeStatus='';
        if($status=='active'){
            $changeStatus='inactive';
        }
        if($status=='inactive'){
            $changeStatus='active';
        }

        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $updateBy=$_SESSION['adminId'];
        if($dlModel->updateCampaignStatusByCampaignId($campaignId,$changeStatus,$updateBy)){
            $data['result']=true;
            $data['status']=$changeStatus;
        }else{
            $data['result']=false;
        }

        echo json_encode($data);

    }
    public function updateCampaignImage(){
        $campaignId=$_POST['campaignImageId'];
        $campaignsImage=$_FILES['campaign_image'];

        $this->load->model('UploadFile');
        $uploadFile=new UploadFile();
        $data=array();
        if($campaignsImage['name']!=''){
            $campaignsImageResult=$uploadFile->uploadImage('campaign_image');
            if($campaignsImageResult['result']){
                $this->load->model('DLModel');
                $dlModel=new DLModel();
                if($dlModel->updateCampaignImageInCampaignsByCampaignId($campaignId,$campaignsImageResult['image_path'],$campaignsImageResult['thumb_path'])){
                    $data['result']=true;
                    $data['message']='Image update successfully..';
                    $data['imagePath']=$campaignsImageResult['image_path'];
                    $data['imageThumbPath']=$campaignsImageResult['thumb_path'];
                }else{
                    $data['result']=false;
                    $data['message']='Unable to update';
                }

            }else{
                $data['result']=false;
                $data['message']=$campaignsImageResult['message'];
            }
        }else{
            $data['result']=false;
        }

        echo json_encode($data);

    }
    public function updateCampaignSponsorImage(){
        $campaignId=$_POST['campaignImageId'];
        $campaignsImage=$_FILES['sponsor_image'];

        $this->load->model('UploadFile');
        $uploadFile=new UploadFile();
        $data=array();
        if($campaignsImage['name']!=''){
            $campaignsImageResult=$uploadFile->uploadImage('sponsor_image');
            if($campaignsImageResult['result']){
                $this->load->model('DLModel');
                $dlModel=new DLModel();
                if($dlModel->updateCampaignSponsorImageInCampaignsByCampaignId($campaignId,$campaignsImageResult['image_path'],$campaignsImageResult['thumb_path'])){
                    $data['result']=true;
                    $data['message']='Image update successfully..';
                    $data['imagePath']=$campaignsImageResult['image_path'];
                    $data['imageThumbPath']=$campaignsImageResult['thumb_path'];
                }else{
                    $data['result']=false;
                    $data['message']='Unable to update';
                }

            }else{
                $data['result']=false;
                $data['message']=$campaignsImageResult['message'];
            }
        }else{
            $data['result']=false;
        }

        echo json_encode($data);

    }


    public function addScenes(){

        $this->load->library('class/Scenes');
        $scenes=new Scenes($_POST);
        $this->load->model('UploadFile');
        $uploadFile=new UploadFile();
        $scenesImage=$_FILES['scenes_image'];
        $sponsorImage=$_FILES['sponsor_image'];
        $rewardImage=$_FILES['reward_image'];
        $scenesImageFlag='';
        $data=array();
        if($scenesImage['name']!=''){
            $scenesImageResult=$uploadFile->uploadImage('scenes_image');
            if($scenesImageResult['result']){
                $scenesImageFlag=true;
                $scenes->setSceneImageUrl($scenesImageResult['image_path']);
                $scenes->setSceneImageUrlThumb($scenesImageResult['thumb_path']);
            }else{
                $scenesImageFlag=false;
                $data['messageScenesImage']=$scenesImageResult['message'];
            }
        }


        $sponsorImageFlag='';
        if($sponsorImage['name']!=''){
            $sponsorImageResult=$uploadFile->uploadImage('sponsor_image');
            if($sponsorImageResult['result']){
                $sponsorImageFlag=true;
                $scenes->setSponsorImageUrl($sponsorImageResult['image_path']);
                $scenes->setSponsorImageUrlThumb($sponsorImageResult['thumb_path']);
            }else{
                $sponsorImageFlag=false;
                $data['messageSponsorImage']=$sponsorImageResult['message'];
            }
        }

        $rewardImageFlag='';
        if($rewardImage['name']!=''){
            $rewardImageResult=$uploadFile->uploadImage('reward_image');
            if($rewardImageResult['result']){
                $rewardImageFlag=true;
                $scenes->setRewardImageUrl($rewardImageResult['image_path']);
                $scenes->setRewardImageUrlThumb($rewardImageResult['thumb_path']);
            }else{
                $rewardImageFlag=false;
                $data['messageSponsorImage']=$rewardImageResult['message'];
            }
        }

        if($scenesImageFlag===false && $sponsorImageFlag=== false && $rewardImageFlag===false){
            $data['result']=false;
        }else{
            $this->load->model('DLModel');
            $dlModel=new DLModel();
            $userFunctionModel=new UserFunctionModel();
            $scenes->setPostDate($userFunctionModel->convertDateInMysqlFormat($scenes->getPostDate()));
            $scenes->setSceneStatus('active');
            $scenes->setAdminId($_SESSION['adminId']);
            if($dlModel->insertScenes($scenes)){
                $data['result']=true;
                $data['message']='scenes add successfully..';
            }else{
                $data['result']=false;
                $data['message']='Unable to add scenes';
            }

        }

        echo json_encode($data);


    }
    public function updateScenes(){
        $scenesData=$_POST;
        $scenesData['update_by']=$_SESSION['adminId'];
        $scenesId=$scenesData['scenes_id'];


        $this->load->model('DLModel');
        $dlModel=new DLModel();

        $userFunctionModel=new UserFunctionModel();

        if($scenesData['post_date']!=''){
            $scenesData['post_date']=$userFunctionModel->convertDateInMysqlFormat($scenesData['post_date']);
        }
        if($dlModel->updateScenesByScenesId($scenesData,$scenesId)){
            $data['result']=true;
            $data['message']='Update successfully...';
        }else{
            $data['result']=false;
            $data['message']='unable to update';
        }

        echo  json_encode($data);
    }
    public function deleteScenes(){
        $scenesId=$_GET['scenesId'];
        $this->load->model('DLModel');
        $data=array();
        $dlModel=new DLModel();
        if($dlModel->deleteScenesByScenesId($scenesId)){
            $data['result']=true;
            $data['message']='Delete successfully..';
        }else{
            $data['result']=false;
            $data['message']='Unable to delete';
        }

        /*$data['result']=true;
        $data['message']='Delete successfully..';*/

        echo json_encode($data);
    }
    public function changeScenesStatus(){
        $scenesId=$_GET['scenesId'];
        $status=$_GET['status'];

        $changeStatus='';
        if($status=='active'){
            $changeStatus='inactive';
        }
        if($status=='inactive'){
            $changeStatus='active';
        }

        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $updateBy=$_SESSION['adminId'];
        if($dlModel->updateScenesStatusByScenesId($scenesId,$changeStatus,$updateBy)){
            $data['result']=true;
            $data['status']=$changeStatus;
        }else{
            $data['result']=false;
        }

        echo json_encode($data);

    }
    public function updateScenesSponsorImage(){
        $scenesId=$_POST['scenesImageId'];
        $scenesImage=$_FILES['sponsor_image'];

        $this->load->model('UploadFile');
        $uploadFile=new UploadFile();
        $data=array();
        if($scenesImage['name']!=''){
            $scenesImageResult=$uploadFile->uploadImage('sponsor_image');
            if($scenesImageResult['result']){
                $this->load->model('DLModel');
                $dlModel=new DLModel();
                if($dlModel->updateScenesSponsorImageInScenesByScenesId($scenesId,$scenesImageResult['image_path'],$scenesImageResult['thumb_path'])){
                    $data['result']=true;
                    $data['message']='Image update successfully..';
                    $data['imagePath']=$scenesImageResult['image_path'];
                    $data['imageThumbPath']=$scenesImageResult['thumb_path'];
                }else{
                    $data['result']=false;
                    $data['message']='Unable to update';
                }

            }else{
                $data['result']=false;
                $data['message']=$scenesImageResult['message'];
            }
        }else{
            $data['result']=false;
        }

        echo json_encode($data);

    }
    public function updateScenesScenesImage(){
        $scenesId=$_POST['scenesImageId'];
        $scenesImage=$_FILES['scenes_image'];

        $this->load->model('UploadFile');
        $uploadFile=new UploadFile();
        $data=array();
        if($scenesImage['name']!=''){
            $scenesImageResult=$uploadFile->uploadImage('scenes_image');
            if($scenesImageResult['result']){
                $this->load->model('DLModel');
                $dlModel=new DLModel();
                if($dlModel->updateScenesScenesImageInScenesByScenesId($scenesId,$scenesImageResult['image_path'],$scenesImageResult['thumb_path'])){
                    $data['result']=true;
                    $data['message']='Image update successfully..';
                    $data['imagePath']=$scenesImageResult['image_path'];
                    $data['imageThumbPath']=$scenesImageResult['thumb_path'];
                }else{
                    $data['result']=false;
                    $data['message']='Unable to update';
                }

            }else{
                $data['result']=false;
                $data['message']=$scenesImageResult['message'];
            }
        }else{
            $data['result']=false;
        }

        echo json_encode($data);

    }
    public function updateScenesRewardImage(){
        $scenesId=$_POST['scenesImageId'];
        $scenesImage=$_FILES['reward_image'];

        $this->load->model('UploadFile');
        $uploadFile=new UploadFile();
        $data=array();
        if($scenesImage['name']!=''){
            $scenesImageResult=$uploadFile->uploadImage('reward_image');
            if($scenesImageResult['result']){
                $this->load->model('DLModel');
                $dlModel=new DLModel();
                if($dlModel->updateScenesRewardImageInScenesByScenesId($scenesId,$scenesImageResult['image_path'],$scenesImageResult['thumb_path'])){
                    $data['result']=true;
                    $data['message']='Image update successfully..';
                    $data['imagePath']=$scenesImageResult['image_path'];
                    $data['imageThumbPath']=$scenesImageResult['thumb_path'];
                }else{
                    $data['result']=false;
                    $data['message']='Unable to update';
                }

            }else{
                $data['result']=false;
                $data['message']=$scenesImageResult['message'];
            }
        }else{
            $data['result']=false;
        }

        echo json_encode($data);

    }

    public function getSensesByCampaignId(){
        $campaignId=$_GET['campaign_id'];
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $scenesList=$dlModel->getScenesBasicByCampaignId($campaignId);
        if(count($scenesList)>0){
            $data['result']=true;
            $data['scenesList']=$scenesList;
        }else{
            $data['result']=false;
            $data['message']='No challenge on this campaign';
        }

        echo json_encode($data);
    }

    public function getScenesByScenesId(){
        $scenesId=$_GET['scenes_id'];
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $scenesData=$dlModel->getScenesByScenesId($scenesId);
        if(count($scenesData)==1){
            $this->load->library('class/Scenes');
            $scenes=new Scenes($scenesData[0]);
            $scenes->setPostDate(date('d/m/Y H:i',strtotime($scenes->getPostDate())));
            $data['result']=true;
            $data['scenes']=$scenes;
        }else{
            $data['result']=false;
        }

        echo json_encode($data);
    }

    public function getScenesByScenesId2(){
        $scenesId=$_GET['scenes_id'];
        $this->load->model('DLModel');
        $dlModel=new DLModel();
//        $scenesData=$dlModel->getScenesByScenesId($scenesId);
        $scenesData=$dlModel->getScenesAndCampaignBasicInfoByScenesId($scenesId);
        if(count($scenesData)==1){
            $this->load->library('class/Scenes');
            $scenes=new Scenes($scenesData[0]);
            if(isset($_SESSION['p_date'])){
                $scenes->setPostDate($_SESSION['p_date']);
            }
            $date=date_format(date_create($scenes->getPostDate()),'Y-m-d\TH:i:s.Z\Z');
            $scenes->setPostDate($date);

            $data['result']=true;
            $data['scenes']=$scenes;
            $data['scenes']=get_object_vars($scenes);
            $data['scenes']['hash_tag']=$scenesData[0]['hash_tag'];

            if((isset($_SESSION['loginStatus']) && $_SESSION['loginStatus']) && (isset($_SESSION['loginType']) && $_SESSION['loginType']=='userLogin')){
                $name=$_SESSION['userName'];
                $nameArray=explode(' ',$name);
                $firstName=$nameArray[0];
                $title=$firstName.' - City, Country | '.$scenes->getScenesName() .' #ConnectedDanceChallenge';
            }else{
                $title='';
            }
            $data['scenes']['title']=$title;

        }else{
            $data['result']=false;
        }

        echo json_encode($data);
    }




    public function addAdmin(){
        $this->load->library('class/Admins');
        $admin=new Admins($_POST);

        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $admin->setEntryDate(date('Y/m/d H:s:i'));
        $admin->setAdminStatus('active');
        $admin->setAddBy($_SESSION['adminId']);

        if($dlModel->insertAdmin($admin)){
            $data['result']=true;
            $data['message']='data add successfully...';
        }else{
            $data['result']=false;
            $data['message']='unable to add data...';
        }

        echo json_encode($data);
    }
    public function changeAdminStatus(){
        $adminId=$_GET['admin_id'];
        $status=$_GET['admin_status'];

        $changeStatus='';
        if($status=='active'){
            $changeStatus='inactive';
        }
        if($status=='inactive'){
            $changeStatus='active';
        }

        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $updateBy=$_SESSION['adminId'];
        if($dlModel->updateAdminStatus($adminId,$changeStatus,$updateBy)){
            $data['result']=true;
            $data['status']=$changeStatus;
        }else{
            $data['result']=false;
        }

        echo json_encode($data);

    }
    public function changeAdminOauthStatus(){
        $adminId=$_GET['admin_id'];
        $status=$_GET['fb_auth_status'];

        $changeStatus='';
        if($status=='active'){
            $changeStatus='inactive';
        }
        if($status=='inactive'){
            $changeStatus='active';
        }

        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $updateBy=$_SESSION['adminId'];
        if($dlModel->updateAdminOauthStatus($adminId,$changeStatus,$updateBy)){
            $data['result']=true;
            $data['status']=$changeStatus;
        }else{
            $data['result']=false;
        }

        echo json_encode($data);

    }

    public function insertVideoData(){
        $this->load->library('class/ScheduledVideos');
        $scheduledVideos=new ScheduledVideos($_POST);
        $this->load->model('DLModel');
        $dlModel=new DLModel();

        $scheduledVideos->setEntryDate(date('Y/m/d H:i:s'));
        $scheduledVideos->setUserId($_SESSION['userId']);

        $data=array();
        if($dlModel->insertScheduleVideos($scheduledVideos)){
            $id=$this->db->insert_id();
            $data['result']=true;
            $data['message']='video scheduled successfully';
            $data['videoId']=$scheduledVideos->getVideoPublishedId();
            $this->load->library('class/SocialCounts');
            $socialCounts=new SocialCounts();
//            $socialCounts->setVideoPublishedId($id);
            $socialCounts->setVideoPublishedId($scheduledVideos->getVideoPublishedId());
            $socialCounts->setIsUpdate(0);
            $dlModel->insertIntoSocialCounts($socialCounts);
            $userData=$dlModel->getUserByUserId($_SESSION['userId']);

            $this->load->library('class/Users');
            $user=new Users($userData[0]);

            #### add contact to infusionsoft ####
            /*if($user->getInfusionsoftUserId()==null){
                $userName=$user->getYoutubeUsername();
                $name=explode(' ',$userName);
                $firstName=$name[0];
                if(count($name)>1){
                    $lastName=$name[count($name)-1];
                }else{
                    $lastName='';
                }

                $contact=array(
                    'FirstName'=>$firstName,
                    'LastName'=>$lastName,
                    'Email'=>$user->getUserEmail()

                );
                $infusionData=$this->addInfusionsoftContactAndTag($contact);
                if($infusionData['result']){
                    $user->setInfusionsoftUserId($infusionData['contactId']);
                    $dlModel->updateUserByUserId($user);
                }
            }*/
            ##### end infusionsoft add contact ######


            ##### add contacts to mailchimp ####
            if($user->getMailchimpUserId()==null || $user->getMailchimpUserId()==''){
                $userName=$user->getYoutubeUsername();
                $name=explode(' ',$userName);
                $firstName=$name[0];
                if(count($name)>1){
                    $lastName=$name[count($name)-1];
                }else{
                    $lastName='';
                }

                $contact=array(
                    'FirstName'=>$firstName,
                    'LastName'=>$lastName,
                    'Email'=>$user->getUserEmail()

                );
                $mailChimpData=$this->addMailchimpContact($contact);
                if($mailChimpData['result']){
                    $user->setMailchimpUserId($mailChimpData['contactId']);
                    $dlModel->updateUserByUserId($user);
                }
            }
            ### end mailchimp add contact ####

            echo json_encode($data);
        }else{
            $data['result']=false;
            $data['message']='Unable to schedule video';

            echo json_encode($data);
        }

    }

    public function addUser(){
        if(isset($_POST['user_email']) && $_POST['user_email']!=''){
            $this->load->library('class/Users');
            $user=new Users($_POST);


            $this->load->model('DLModel');
            $dlModel=new DLModel();
            // check if user already exist in user table //
            $userResult=$dlModel->getUserByUserEmail($_POST['user_email']);
            $data['userResult']=$userResult;
            if(count($userResult)==1){
                $userData=new Users($userResult[0]);
                $user->setUserId($userData->getUserId());
                $user->setEntryDate($userData->getEntryDate());
                $_SESSION['userId']=$userData->getUserId();
                $_SESSION['userEmail']=$userData->getUserEmail();
                $dlModel->updateUserByUserId($user);
                $data['user']=$user;
            }else{
                $user->setEntryDate(date('Y/m/d H:s:i'));
                $dlModel->insertUser($user);
                $userId=$this->db->insert_id();
                $user->setUserId($userId);
                $_SESSION['userId']=$user->getUserId();
                $_SESSION['userEmail']=$user->getUserEmail();
                $data['user']=$user;
            }

            echo json_encode($data);
        }
    }

    public function getScheduleVideosByScenesId(){
        if(isset($_GET['scenes_id'])){
            $scenesId=$_GET['scenes_id'];
            $this->load->model('DLModel');
            $dlModel=new DLModel();
            $campaignData=$dlModel->getCampaignByScanesId($scenesId);
            $this->load->library('class/Campaigns');

            if(count($campaignData)>0){
                $campaignFlag=true;
                $campaign=new Campaigns($campaignData[0]);
                $socialCampaignData=$dlModel->getSocialViewInfoByCampaignId($campaign->getCampaignId());
            }else{
                $campaignFlag=false;
            }
            $scheduleVideoList=$dlModel->getSocialInfoByScenesId($scenesId);

            $socialScenesData=$dlModel->getSocialViewInfoByScenesId($scenesId);


            if(count($scheduleVideoList)>0){
                //CSV file generate
                $fileName='csv/'.$scenesId.'_'.$_SESSION["__ci_last_regenerate"].'_'.date('Ymd_His').'.csv';

                $this->exportCsv($scheduleVideoList,$fileName);
                $data['csvFileUrl']=base_url($fileName);
                // End CSV file

                $data['result']=true;
                $data['videoList']=$scheduleVideoList;
                $data['challengeTotalView']=0;
                $data['challengeTotalLike']=0;
                $data['challengeName']=$scheduleVideoList[0]['scenes_name'];
                foreach ($socialScenesData as $item){
                    $data['challengeTotalView']=$data['challengeTotalView']+$item['total_view'];
                    $data['challengeTotalLike']=$data['challengeTotalLike']+$item['total_likes'];
                }
                $data['campaignTotalView']=0;
                $data['campaignTotalLike']=0;
                if($campaignFlag){
                    $data['campaignName']=$campaign->getCampaignName();
                    foreach ($socialCampaignData as $item){
                        $data['campaignTotalView']=$data['campaignTotalView']+$item['total_view'];
                        $data['campaignTotalLike']=$data['campaignTotalLike']+$item['total_likes'];
                    }
                }else{
                    $data['campaignName']='';
                    $data['campaignTotalView']='';
                    $data['campaignTotalLike']='';
                }
            }else{
                $data['result']=false;
                $data['message']='No video on selected challenge';
            }

            echo json_encode($data);
        }

    }

    public function getScheduleVideosByCampaignId(){
        if(isset($_GET['campaign_id'])){
            $campaignId=$_GET['campaign_id'];
            $this->load->model('DLModel');
            $dlModel=new DLModel();
            $campaignData=$dlModel->getCampaignsByCampaignsId($campaignId);
            $this->load->library('class/Campaigns');

            $campaign=new Campaigns($campaignData[0]);
            $socialCampaignData=$dlModel->getSocialViewInfoByCampaignId($campaign->getCampaignId());
            $scheduleVideoList=$dlModel->getSocialInfoByCampaignId($campaignId);

//            $socialScenesData=$dlModel->getSocialViewInfoByScenesId($scenesId);


            $data['campaignTotalView']=0;
            $data['campaignTotalLike']=0;
            $data['campaignName']=$campaign->getCampaignName();

            if(count($scheduleVideoList)>0){
                //CSV file generate
                $userFunctionModel=new UserFunctionModel();
                $campaignName=$userFunctionModel->replaceSpacialCharacter($campaign->getCampaignName(),'-');
                $fileName='csv/'.$campaignName.'_'.$_SESSION["__ci_last_regenerate"].'_'.date('Ymd_His').'.csv';

                $this->exportCsv($scheduleVideoList,$fileName);
                $data['csvFileUrl']=base_url($fileName);
                // End CSV file

                $data['result']=true;
                $data['videoList']=$scheduleVideoList;
                $data['challengeTotalView']=0;
                $data['challengeTotalLike']=0;
//                $data['challengeName']=$scheduleVideoList[0]['scenes_name'];
                $data['challengeName']='';


                foreach ($socialCampaignData as $item){
                    $data['campaignTotalView']=$data['campaignTotalView']+$item['total_view'];
                    $data['campaignTotalLike']=$data['campaignTotalLike']+$item['total_likes'];
                }
            }else{
                $data['result']=false;
                $data['message']='No video on selected campaign';
            }

            echo json_encode($data);
        }

    }

    public function getDifficultyLevelByCampaign(){
        $campaignId=$_GET['campaign_id'];
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $result=$dlModel->getCampaignDifficultyByCampaignIdAndNameNotNull($campaignId);
        if(count($result)>0){
            $data['result']=true;
            $data['difficultyLevel']=$result;
        }else{
            $data['result']=false;
            $data['message']='No level for selected campaign';
        }

        echo json_encode($data);

    }

    public function exportCsv($tableData,$fileName){


        $jsonTableData=json_decode(json_encode($tableData));

        $data='';
        if(count($jsonTableData)>0){


            $fp = fopen($fileName, 'w');

            fputcsv($fp, array_keys($tableData[0]));

            foreach ($jsonTableData as $fields) {
                fputcsv($fp, get_object_vars($fields));

            }

            $data['fileName']=$fileName;

            fclose($fp);
        }

        return $data;


    }

    public function addInfusionsoftContactAndTag($contact){

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
        $this->load->library('infusionsoft');
        $infusionsoft=new Infusionsoft($crediential);

        $infusionsoft->setToken(unserialize($infusionsoftToken->getToken()));

        if(!$infusionsoft->isTokenExpired()){

            try{

                $contactId=$infusionsoft->contacts('xml')->add($contact);

                $tagResult=$infusionsoft->contacts('xml')->addToGroup($contactId,337);
                $data['result']=true;
                $data['contactId']=$contactId;

                return $data;
            }catch (\GuzzleHttp\Exception\ClientException $e){
                $data['result']=false;
                return $data;
            }
            catch (\Infusionsoft\InfusionsoftException $exception){
                $data['result']=false;
                return $data;
            }
        }else{
            try{
                $result=$infusionsoft->refreshAccessToken();

                $token=$infusionsoft->getToken();
                $infusionsoftToken->setToken($token);
                $dlModel->updateInfusionsoftToken($infusionsoftToken);

                $contactId=$infusionsoft->contacts('xml')->add($contact);

                $tagResult=$infusionsoft->contacts('xml')->addToGroup($contactId,337);
                $data['result']=true;
                $data['contactId']=$contactId;

                return $data;
            }catch (\GuzzleHttp\Exception\ClientException $e){
                $data['result']=false;
                return $data;
            }
            catch (\Infusionsoft\InfusionsoftException $exception){
                $data['result']=false;
                return $data;
            }
        }
    }

    public function addMailchimpContact($contact){
        $this->load->library('MailChimp');

        ## adnan mailchimp setting
        /*$mail=new MailChimp('a03d80aa1d8ecd54778eee7f82142921-us17');
        $list='6af157fe38';*/

        ## main mailchimp setting
        $mail=new MailChimp('a43c1195e06a2a4ea0b95781d65ded57-us2');
        $list='598ffe8cff';

        $result = $mail->post("lists/$list/members", [
            'email_address' => $contact['Email'],
            'status'        => 'subscribed',
            'merge_fields' => ['FNAME'=>$contact['FirstName'], 'LNAME'=>$contact['LastName']],
        ]);

        if(isset($result['id'])){
            $data['result']=true;
            $data['contactId']=$result['id'];
        }else{
            $data['result']=false;
        }

        return $data;
    }


    public function saveFormData(){
        if(isset($_POST)){
            $_SESSION['videoFormData']=$_POST;
        }

    }
}