<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/14/17
 * Time: 10:27 AM
 */
class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');


        $this->load->library('facebook');

        $this->load->library('google');
        if((isset($_SESSION['loginStatus']) && $_SESSION['loginStatus']) && (isset($_SESSION['loginType']) && $_SESSION['loginType']=='userLogin')){

        }else{
            redirect(base_url());
        }
    }

    public function index(){

        $data['rightLayout']='partialView/userInfo';
        $this->load->model('DLModel');
        $dlModel=new DLModel();
//        $data['scenesList']=$dlModel->getScenesList();
//        $data['scenesList']=$dlModel->getScenesListByStatus('active');

        if(isset($_SESSION['cmp_id']) && $_SESSION['cmp_id']!=''){
            $data['scenesList']=$dlModel->getScenesBasicByCampaignId($_SESSION['cmp_id']);
        }else{
            $data['scenesList']=$dlModel->getScenesCampaignListByStatus('active');
        }
        $this->load->library('class/Scenes');
        $this->load->view('layout/userLayout',$data);
    }


    public function social(){
        $data['rightLayout']='partialView/linkSocialAccounts';

        $facebook=new Facebook();

        $this->load->model('DLModel');
        $this->load->library('class/FacebookTokens');
        $dlModel=new DLModel();
        $facebookTokensData=$dlModel->getFacebookTokenByUserId($_SESSION['userId']);
        if(count($facebookTokensData)==1){
            $facebookTokens=new FacebookTokens($facebookTokensData[0]);
            $facebook->setAccessToken($facebookTokens->getFbToken());
            if($facebook->is_authenticated()){
                $data['fbTokenExpire']=false;
                $data['message']='token has';
            }else{
                $data['fbTokenExpire']=true;
                $data['message']='token expire';
                $data['authUrl']=$facebook->login_url_user();
            }
        }else{
            $data['authUrl']=$facebook->login_url_user();
        }

        $twitterTokensData=$dlModel->getTwitterTokenByUserId($_SESSION['userId']);
        if(count($twitterTokensData)==1){
            $this->load->library('class/TwitterTokens');
            $twitterTokens=new TwitterTokens($twitterTokensData[0]);

            if($twitterTokens->getTwitterToken()!=''){
                $data['twTokenExpire']=false;
                $data['message']='token has';
            }else{
                $data['twTokenExpire']=true;
                $data['message']='token expire';
                $data['twAuthUrl']=base_url('TwitterCtrl/twitterLogin');
            }

        }else{
            $data['twAuthUrl']=base_url('TwitterCtrl/twitterLogin');
        }


        $this->load->view('layout/userLayout',$data);
    }

    public function shareToSocial(){
        $data['rightLayout']='partialView/shareToSocial';

        if(isset($_GET['id']) && $_GET['id']!=''){
            $_SESSION['uploadedVideoId']=$_GET['id'];
        }

        if(isset($_SESSION['uploadedVideoId']) && $_SESSION['uploadedVideoId']!=''){
            $videoPublishId=$_SESSION['uploadedVideoId'];

            $this->load->library('class/ScheduledVideos');
            $this->load->model('DLModel');
            $dlModel=new DLModel();

            $scheduleVideoData=$dlModel->getScheduleVideoByVideoPublishId($videoPublishId);

            if(count($scheduleVideoData)==1){
                $scheduleVideo=new ScheduledVideos($scheduleVideoData[0]);

                $currentDate=date('Y-m-d H:i:s');
                $data['pDate']=strtotime($scheduleVideo->getVideoPublishDate());
                $data['cDate']=strtotime($currentDate);
                $data['videoTitle']=$scheduleVideo->getVideoTitle();
                $data['postDate']=date('d/m/Y H:i',strtotime($scheduleVideo->getVideoPublishDate()));

                $_SESSION['videoScheduleId']=$scheduleVideo->getVideoScheduleId();


                $data['fbText']=($scheduleVideo->getFacebookText()=='' || $scheduleVideo->getFacebookText()==null)?'':$scheduleVideo->getFacebookText();
//                $data['fbText']='';

                $data['videoId']=$scheduleVideo->getVideoPublishedId();

                if($scheduleVideo->getFacebookPostStatus()==null){
                    $data['facebookShare']=false;
                }else{
                    $data['facebookShare']=true;
                }
                if($scheduleVideo->getTwitterPostStatus()==null){
                    $data['twitterShare']=false;
                }else{
                    $data['twitterShare']=true;
                }
            }


            $facebook=new Facebook();
            $this->load->library('class/FacebookTokens');

            $facebookTokensData=$dlModel->getFacebookTokenByUserId($_SESSION['userId']);
            if(count($facebookTokensData)==1){
                $facebookTokens=new FacebookTokens($facebookTokensData[0]);
                $facebook->setAccessToken($facebookTokens->getFbToken());
                if($facebook->is_authenticated()){
                    $data['fbTokenExpire']=false;
                    $data['message']='token has';
                    $data['authUrl']='';
                    $data['fbUserName']=$facebookTokens->getFbUsername();
                    $data['fbId']=$facebookTokens->getFbNumericId();
                }else{
                    $data['fbTokenExpire']=true;
                    $data['message']='token expire';
                    $data['authUrl']=$facebook->login_url_user();
                }
            }else{
                $data['authUrl']=$facebook->login_url_user();
            }

            $twitterTokensData=$dlModel->getTwitterTokenByUserId($_SESSION['userId']);
            if(count($twitterTokensData)==1){
                $this->load->library('class/TwitterTokens');
                $twitterTokens=new TwitterTokens($twitterTokensData[0]);

                if($twitterTokens->getTwitterToken()!=''){
                    $data['twTokenExpire']=false;
                    $data['message']='token has';
                    $data['twAuthUrl']='';
                }else{
                    $data['twTokenExpire']=true;
                    $data['message']='token expire';
                    $data['twAuthUrl']=base_url('TwitterCtrl/twitterLogin');
                }

            }else{
                $data['twAuthUrl']=base_url('TwitterCtrl/twitterLogin');
            }
        }


        $this->load->view('layout/userLayout',$data);
    }

    public function twitterUnlink(){
        $this->load->model('DLModel');
        $dlModel=new DLModel();

        $dlModel->removeTwitterTonekByUserId($_SESSION['userId']);

        redirect('user/social');

    }

    public function facebookUnlink(){
        $this->load->model('DLModel');
        $dlModel=new DLModel();

//        $dlModel->removeFacebookTokenByUserId($_SESSION['userId']);

        $facebookTokensData=$dlModel->getFacebookTokenByUserId($_SESSION['userId']);
        $data=[];
        if(count($facebookTokensData)==1){
            $this->load->library('class/FacebookTokens');
            $facebookTokens=new FacebookTokens($facebookTokensData[0]);
            $this->load->model('FacebookModel');
            $facebookModel=new FacebookModel();
            $facebookResponse=$facebookModel->deleteFacebookTokens($facebookTokens->getFbToken(),$facebookTokens->getFbNumericId());
            if($facebookResponse['result']){
                $facebookTokens->setFbToken('');
                $facebookTokens->setFbAuthStatus('removed');
                $dlModel->updateFacebookTokensByUserId($facebookTokens);
            }
            $data=$facebookResponse;
        }else{
            $data['result']=false;
            $data['message']='Not link for facebook';
        }

        $facebook=new Facebook();
        $facebook->destroy_session();

        redirect('user/social');
    }

    public function changeFbPostStatus(){
        $videoScheduleId=$_GET['video_id'];
        $status=$_GET['status'];

        $this->load->model('DLModel');
        $dlModel=new DLModel();
        if($dlModel->updateFacebookPostStatusByVideoScheduleId($videoScheduleId,$status)){
            $data['result']=true;
            $data['message']='status change successfully';
        }else{
            $data['result']=false;
            $data['message']='unable to change status';
        }

        echo  json_encode($data);
    }

    public function updateFbText(){
        $videoScheduleId=$_POST['video_id'];
        $fbText=$_POST['fbText'];

        $this->load->model('DLModel');
        $dlModel=new DLModel();
        if($dlModel->updateFacebookPostTextByVideoScheduleId($videoScheduleId,$fbText)){
            $data['result']=true;
        }else{
            $data['result']=false;
        }

        echo  json_encode($data);
    }

    public function changeTwPostStatus(){
        $videoScheduleId=$_GET['video_id'];
        $status=$_GET['status'];

        $this->load->model('DLModel');
        $dlModel=new DLModel();
        if($dlModel->updateTwitterPostStatusByVideoScheduleId($videoScheduleId,$status)){
            $data['result']=true;
            $data['message']='status change successfully';
        }else{
            $data['result']=false;
            $data['message']='unable to change status';
        }

        echo  json_encode($data);
    }




    public function campaign(){

        if(isset($_GET['id'])){
            $campaign_id=$_GET['id'];
        }elseif (isset($_SESSION['cmp_id'])){
            $campaign_id=$_SESSION['cmp_id'];
        }else{
            $campaign_id='';
        }

        $data['rightLayout']='partialView/userInfo';
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $data['scenesList']=$dlModel->getScenesBasicByCampaignId($campaign_id);
        $this->load->library('class/Scenes');
        $this->load->view('layout/userLayout',$data);

    }

    public function challenge($challengeId=null){
        if($challengeId!=null){
            $rightLayout='partialView/challengeApplyPage';
            $this->load->model('DLModel');
            $dlModel=new DLModel();
            $resultData=$dlModel->getCampaignChallengeBasicInfoByScenesId($challengeId);
            $_SESSION['challenge_id']=$challengeId;
            if($resultData['result']){
                $scenes=$resultData['scenes'];
                $campaignId=$scenes['campaign_id'];
                $_SESSION['cmp_id']=$campaignId;
                $scenesList=$dlModel->getScenesBasicByCampaignId($scenes['campaign_id']);
                $scenesListCount=count($scenesList);
                $this->load->view('layout/userLayout',compact('rightLayout','scenes','scenesList','scenesListCount'));
            }else{
                redirect(base_url('user'));
            }
        }else{
            redirect(base_url('user'));
        }

    }


    public function leaderboard(){

//        $data['rightLayout']='partialView/userInfo';
        $data['rightLayout']='partialLayout/leaderboardLayoutUser';
        $this->load->model('DLModel');
        $dlModel=new DLModel();
//        $data['scenesList']=$dlModel->getScenesList();
        $userId=$_SESSION['userId'];
        $data['scenesList']=$dlModel->getScenesByUserId($userId);
        $this->load->library('class/Scenes');
        $this->load->view('layout/userLayout',$data);


        /*$data['rightLayout']='partialLayout/leaderboardLayout';

        $this->load->library('class/Campaigns');
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $data['campaignList']=$dlModel->getCampaignsList();
        $this->load->view('layout/adminLayout',$data);*/
    }




    public function searchVideo(){
        $searchKey=$_GET['q'];

        $client = new Google_Client();
//        $client->setAuthConfigFile('client_secret1.json');
        $client->setAuthConfig('client_secret1.json');
        $client->setRedirectUri(base_url('GoogleCtrl'));

        $client->setAccessToken($_SESSION['accessToken']);
        $youtube= new Google_Service_YouTube($client);

        try{
            $searchResponse=$youtube->search->listSearch('id,snippet',array(
                'q'=>$_GET['q'],
                'maxResults'=>10
            ));

            echo '<pre>';
            print_r($searchResponse);

        }catch (Google_Service_Exception $e){
            print_r($e->getMessage());
        }

    }

    public function uploadVideo(){
        $client=new Google_Client();
//        $client->setAuthConfigFile('client_secret1.json');
        $client->setAuthConfig('client_secret1.json');
        $client->setRedirectUri(base_url('GoogleCtrl'));

        $client->setAccessToken($_SESSION['accessToken']);

        $youtube=new Google_Service_YouTube($client);

//        echo $_SERVER['DOCUMENT_ROOT'].'/YoutubeVideoUpload/video/video1.mp4';

//        exit();

        try{
            $videoPath=$_SERVER['DOCUMENT_ROOT'].'/YoutubeVideoUpload/video/video1.mp4';

//            $videoPath='/opt/lampp/htdocs/YoutubeVideoUpload/video/video1.mp4';

            // Create a snippet with title, description, tags and category ID
            // Create an asset resource and set its snippet metadata and type.
            // This example sets the video's title, description, keyword tags, and
            // video category.
            $snippet=new Google_Service_YouTube_VideoSnippet();
            $snippet->setTitle('test1');
            $snippet->setDescription('first video upload testing');
            $snippet->setTags(array("tag1", "tag2"));

            // Numeric video category. See
            // https://developers.google.com/youtube/v3/docs/videoCategories/list
            $snippet->setCategoryId("22");


            // Set the video's status to "public". Valid statuses are "public",
            // "private" and "unlisted".
            $status=new Google_Service_YouTube_VideoStatus();
//            $status->setPrivacyStatus('private');
            $status->privacyStatus='public';

            // Associate the snippet and status objects with a new video resource.
            $video=new Google_Service_YouTube_Video();
            $video->setSnippet($snippet);
            $video->setStatus($status);

            // Specify the size of each chunk of data, in bytes. Set a higher value for
            // reliable connection as fewer chunks lead to faster uploads. Set a lower
            // value for better recovery on less reliable connections.
            $chunkSizeBytes = 1 * 1024 * 1024;

            // Setting the defer flag to true tells the client to return a request which can be called
            // with ->execute(); instead of making the API call immediately.
            $client->setDefer(true);

            // Create a request for the API's videos.insert method to create and upload the video.
            $insertRequest=$youtube->videos->insert("status,snippet",$video);

            // Create a MediaFileUpload object for resumable uploads.
            $media=new Google_Http_MediaFileUpload(
                $client,
                $insertRequest,
                'video/*',
                null,
                true,
                $chunkSizeBytes
            );
            $media->setFileSize(filesize($videoPath));

            $status = false;
            $handle=fopen($videoPath,'rb');
            while (!$status && !feof($handle)){
                $chunk=fread($handle,$chunkSizeBytes);
                $status=$media->nextChunk($chunk);
            }

            fclose($handle);

            echo '<pre>';
            print_r($status);


        }catch (Google_Service_Exception $e){
            echo $e->getMessage();
        }catch (Google_Exception $e){
            echo $e->getMessage();
        }
    }

    public function uploadVideo1(){
        $client=new Google_Client();
//        $client->setAuthConfigFile('client_secret1.json');
        $client->setAuthConfig('client_secret1.json');
        $client->setRedirectUri(base_url('GoogleCtrl'));

        $client->setAccessToken($_SESSION['accessToken']);

        $youtube=new Google_Service_YouTube($client);

//        echo $_SERVER['DOCUMENT_ROOT'].'/YoutubeVideoUpload/video/video1.mp4';

//        exit();

        try{
//            $videoPath=$_SERVER['DOCUMENT_ROOT'].'/YoutubeVideoUpload/video/video1.mp4';
            $videoPath=$_FILES['video']['tmp_name'];

            /*echo '<pre>';
            echo $videoPath.'<br>';
            print_r($_FILES['video']);

            exit();*/
//            $videoPath='/opt/lampp/htdocs/YoutubeVideoUpload/video/video1.mp4';

            // Create a snippet with title, description, tags and category ID
            // Create an asset resource and set its snippet metadata and type.
            // This example sets the video's title, description, keyword tags, and
            // video category.
            $snippet=new Google_Service_YouTube_VideoSnippet();
            $snippet->setTitle('test1');
            $snippet->setDescription('first video upload testing');
            $snippet->setTags(array("tag1", "tag2"));

            // Numeric video category. See
            // https://developers.google.com/youtube/v3/docs/videoCategories/list
            $snippet->setCategoryId("22");


            // Set the video's status to "public". Valid statuses are "public",
            // "private" and "unlisted".
            $status=new Google_Service_YouTube_VideoStatus();
//            $status->setPrivacyStatus('private');
            $status->privacyStatus='public';

            // Associate the snippet and status objects with a new video resource.
            $video=new Google_Service_YouTube_Video();
//            $video=new Google_Service_YouTube();
            $video->setSnippet($snippet);
            $video->setStatus($status);


            // Specify the size of each chunk of data, in bytes. Set a higher value for
            // reliable connection as fewer chunks lead to faster uploads. Set a lower
            // value for better recovery on less reliable connections.
            $chunkSizeBytes = 1 * 1024 * 1024;

            // Setting the defer flag to true tells the client to return a request which can be called
            // with ->execute(); instead of making the API call immediately.
            $client->setDefer(true);

            // Create a request for the API's videos.insert method to create and upload the video.
            $insertRequest=$youtube->videos->insert("status,snippet",$video);

            // Create a MediaFileUpload object for resumable uploads.
            $media=new Google_Http_MediaFileUpload(
                $client,
                $insertRequest,
                'video/*',
                null,
                true,
                $chunkSizeBytes
            );
            $media->setFileSize(filesize($videoPath));

            $status = false;
            $handle=fopen($videoPath,'rb');
            while (!$status && !feof($handle)){
                $chunk=fread($handle,$chunkSizeBytes);
                $status=$media->nextChunk($chunk);
            }

            fclose($handle);

            $data['message']=$status;


        }catch (Google_Service_Exception $e){
//            echo $e->getMessage();
            $data['message']=$e->getMessage();
        }catch (Google_Exception $e){
//            echo $e->getMessage();
            $data['message']= $e->getMessage();
        }

        echo json_encode($data);
    }





}