<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 5/8/17
 * Time: 3:29 PM
 */
class Cron extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
//        $this->load->library('uri');
        $this->load->model('DLModel');
        $this->load->library('class/ScheduledVideos');
        $this->load->model('TwitterModel');
        $this->load->model('FacebookModel');
    }

    public function checkYoutubeVideoStatus(){
        $dlModel=new DLModel();
        $currentDate=date('Y-m-d H:s:i');

        $scheduleVideoData=$dlModel->getScheduledVideosForPublishStatus($currentDate);
        if(count($scheduleVideoData)>0){
            foreach ($scheduleVideoData as $item){
                $scheduleVideo=new ScheduledVideos($item);
                $userData=$dlModel->getUserByUserId($scheduleVideo->getUserId());
                if(count($userData)==1){
                    $this->load->library('class/Users');
                    $user=new Users($userData[0]);
                    $this->load->model('GoogleModel');
                    $googleModel=new GoogleModel();

                    $videoStatus=$googleModel->checkYoutubeVideoStatus($user,$scheduleVideo->getVideoPublishedId());


                    $scheduleVideo->setPublishStatus($videoStatus['status']);
                    $dlModel->updateScheduleVideos($scheduleVideo);
                }
            }
        }
    }

    public function postOnTwitterFacebookAndSendMail(){
        $dlModel=new DLModel();
        $currentDate=date('Y-m-d H:s:i');
        $scheduleVideoData=$dlModel->getScheduleVideoForPostAndMail($currentDate);

        /*echo '<pre>';
        print_r($scheduleVideoData);
        exit();*/

        if(count($scheduleVideoData)==1){
            $scheduleVideo=new ScheduledVideos($scheduleVideoData[0]);
            $userData=$dlModel->getUserByUserId($scheduleVideo->getUserId());

            if(count($userData)==1){
                $this->load->library('class/Users');
                $user=new Users($userData[0]);

                if($scheduleVideo->getFacebookPostStatus()=='0'){
                    if($scheduleVideo->getVideoDownloadStatus()==1){
                        //// post on twitter /////

                        $twitterMessage=$scheduleVideo->getTwitterText();
                        if($twitterMessage!='' && $scheduleVideo->getTwitterPostStatus()=='0'){
                            $message=$scheduleVideo->getTwitterText()."\n\rhttps://www.youtube.com/watch?v=".$scheduleVideo->getVideoPublishedId();
                            $twitterResponse=$this->postOnTwitter($user,$message);
                            $scheduleVideo->setTwitterPostStatus(1);
                            $scheduleVideo->setTwitterResponse($twitterResponse['message']);
//
                        }

                        //// post on facebook ////

                        if($scheduleVideo->getFacebookPostStatus()=='0'){
//                    $facebookResponse=$this->postOnFacebook($user,$facebookMessage);
                            $facebookResponse=$this->postVideoOnFacebook($user->getUserId(),$scheduleVideo->getVideoTitle(),$scheduleVideo->getFacebookText(),$scheduleVideo->getVideoPublishedId());
                            $scheduleVideo->setFacebookPostStatus(1);
                            $scheduleVideo->setFacebookResponse($facebookResponse['message']['response']);
                            $this->load->model('VideoModel');
                            $videoModel=new VideoModel();
                            $videoModel->deleteYTVideoFromDrive($scheduleVideo->getVideoPublishedId());

                        }


                        /// send Mail ///////////

                        $this->load->model('EmailModel');
                        $emailModel=new EmailModel();
                        $emailResponse=$emailModel->sendMail($user->getUserEmail(),$scheduleVideo->getEmailNotificationText(),'video notification','Connected Dance Challenge');
                        if($emailResponse){
                            $scheduleVideo->setEmailNotificationStatus(1);
                        }

                        $dlModel->updateScheduleVideos($scheduleVideo);
                    }
                }else{
                    //// post on twitter /////

                    $twitterMessage=$scheduleVideo->getTwitterText();
                    if($twitterMessage!='' && $scheduleVideo->getTwitterPostStatus()=='0'){
                        $twitterResponse=$this->postOnTwitter($user,$twitterMessage);
                        $scheduleVideo->setTwitterPostStatus(1);
                        $scheduleVideo->setTwitterResponse($twitterResponse['message']);
//
                    }

                    /// send Mail ///////////

                    $this->load->model('EmailModel');
                    $emailModel=new EmailModel();
                    $emailResponse=$emailModel->sendMail($user->getUserEmail(),$scheduleVideo->getEmailNotificationText(),'video notification','Connected Dance Challenge');
                    if($emailResponse){
                        $scheduleVideo->setEmailNotificationStatus(1);
                    }

                    $dlModel->updateScheduleVideos($scheduleVideo);
                }


            }
        }
    }

    public function postOnTwitter(Users $user,$twitterMessage){
        $dlModel=new DLModel();
        $twitterTokensData=$dlModel->getTwitterTokenByUserId($user->getUserId());
        if(count($twitterTokensData)==1){
            $this->load->library('class/TwitterTokens');
            $twitterTokens=new TwitterTokens($twitterTokensData[0]);
            $twitterModel=new TwitterModel();
            if($twitterTokens->getTwitterAuthStatus()=='active'){
                $twitterResponse=$twitterModel->postTweet($twitterTokens->getTwitterToken(),$twitterTokens->getTwitterTokenSecret(),$twitterMessage);
                $data['result']=true;
                $data['message']=$twitterResponse['message'];
                $data['response']=$twitterResponse['response'];
            }else{
                $data['result']=true;
                $data['message']='user has disables to post on twitter';
            }
        }else{
            $data['result']=false;
            $data['message']='Not link for twitter';
        }

        return $data;
    }

    public function postOnFacebook($user,$facebookMessage){
        $dlModel=new DLModel();
        $facebookTokensData=$dlModel->getFacebookTokenByUserId($user->getUserId());
        if(count($facebookTokensData)==1){
            $this->load->library('class/FacebookTokens');
            $facebookTokens=new FacebookTokens($facebookTokensData[0]);
            $facebookModel=new FacebookModel();
            if($facebookTokens->getFbAuthStatus()=='active'){
                $facebookResponse=$facebookModel->postFacebook($facebookTokens->getFbToken(),$facebookMessage);
                $data['result']=true;
                $data['message']=$facebookResponse['message'];
            }else{
                $data['result']=true;
                $data['message']='user has disables to post on twitter';
            }
        }else{
            $data['result']=false;
            $data['message']='Not link for twitter';
        }

        return $data;
    }

    public function postVideoOnFacebook($userId,$title,$message,$videoId){
        $dlModel=new DLModel();
        $facebookTokensData=$dlModel->getFacebookTokenByUserId($userId);
        if(count($facebookTokensData)==1){
            $this->load->library('class/FacebookTokens');
            $facebookTokens=new FacebookTokens($facebookTokensData[0]);
            $facebookModel=new FacebookModel();
            if($facebookTokens->getFbAuthStatus()=='active'){
                $facebookResponse=$facebookModel->uploadVideo($facebookTokens->getFbToken(),$title,$message,$videoId);
                $data['result']=true;
                $data['message']=$facebookResponse;
            }else{
                $data['result']=true;
                $data['message']='user has disables to post on facebook';
            }
        }else{
            $data['result']=false;
            $data['message']='Not link for facebook';
        }

        echo '<pre>';
        print_r($data);

        return $data;
    }

    public function saveVideoOnLocal(){
        $dlModel=new DLModel();
        $date=date('Y-m-d H:s:i');
        $videoList=$dlModel->getScheduleVideoForDownload($date);
        /*echo '<pre>';
        print_r($videoList);
        exit();*/

        if(count($videoList)>0){
            $this->load->model('VideoModel');
            foreach ($videoList as $item){
                $scheduleVideo=new ScheduledVideos($item);
                $videoModel=new VideoModel();
                $saveResult=$videoModel->saveYTVideo($scheduleVideo->getVideoPublishedId());
                if($saveResult){
                    $scheduleVideo->setVideoDownloadStatus(1);
                }else{
                    $scheduleVideo->setVideoDownloadStatus(-1);
                }
                $dlModel->updateScheduleVideos($scheduleVideo);

            }
        }
    }

    public function removeGoogleTokens(){
        $dlModel=new DLModel();
//        $userData=$dlModel->getUserByUserId($userId);
        $userData=$dlModel->getAllUsers();
        $this->load->model('GoogleModel');
        $googleModel=new GoogleModel();
        $this->load->library('class/Users');
        if(count($userData)>0){
            foreach ($userData as $item){
                $user=new Users($item);
                $result=$googleModel->revokeToken($user);
                $user->setRefreshToken(null);
                $dlModel->updateUserByUserId($user);
                print_r($result);
            }
        }

    }

    public function deleteFacebook($userId){
        $dlModel=new DLModel();
        $facebookTokensData=$dlModel->getFacebookTokenByUserId($userId);
        $data=[];
        if(count($facebookTokensData)==1){
            $this->load->library('class/FacebookTokens');
            $facebookTokens=new FacebookTokens($facebookTokensData[0]);
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

//        return $data;
        echo '<pre>';
        print_r($data);

    }

    public function testYoutubeStatus(){
        $dlModel=new DLModel();
//        $currentDate=date('Y-m-d H:s:i');
        $currentDate='2017-10-6';

        $scheduleVideoData=$dlModel->getScheduledVideosForPublishStatus($currentDate);

        /* echo '<pre>';
         print_r($scheduleVideoData);
         exit();*/
        if(count($scheduleVideoData)>0){
            foreach ($scheduleVideoData as $item){
                $scheduleVideo=new ScheduledVideos($item);
                $userData=$dlModel->getUserByUserId($scheduleVideo->getUserId());
                if(count($userData)==1){
                    $this->load->library('class/Users');
                    $user=new Users($userData[0]);
                    $this->load->model('GoogleModel');
                    $googleModel=new GoogleModel();

                    $videoStatus=$googleModel->checkYoutubeVideoStatus($user,$scheduleVideo->getVideoPublishedId());

                    /*if($videoStatus['result']){
                        $scheduleVideo->setPublishStatus($videoStatus['status']);
                    }*/

                    $scheduleVideo->setPublishStatus($videoStatus['status']);
                    $dlModel->updateScheduleVideos($scheduleVideo);

                    print_r($videoStatus);
                }
            }
        }
    }

    public function testPostOnTwitter(){
        $dlModel=new DLModel();
        $currentDate=date('Y-m-d H:s:i');
        $scheduleVideoData=$dlModel->getScheduleVideoForPostAndMail($currentDate);

        if(count($scheduleVideoData)==1){
            $scheduleVideo=new ScheduledVideos($scheduleVideoData[0]);
            $userData=$dlModel->getUserByUserId($scheduleVideo->getUserId());

            /*echo '<pre>';
            print_r($userData);
            print_r($scheduleVideo);*/

            if(count($userData)==1){
                $this->load->library('class/Users');
                $user=new Users($userData[0]);

                $twitterMessage=$scheduleVideo->getTwitterText();
                if($twitterMessage!='' && $scheduleVideo->getTwitterPostStatus()=='0'){
                    $twitterResponse=$this->postOnTwitter($user,$twitterMessage);
                    /*echo '<pre>';
                    print_r($twitterResponse);*/
                    $scheduleVideo->setTwitterPostStatus(1);
                    $scheduleVideo->setTwitterResponse($twitterResponse['message']);
                    $scheduleVideo->setTwitterResponseId($twitterResponse['response']);
                }

                $dlModel->updateScheduleVideos($scheduleVideo);
                echo '<pre>';
                print_r($scheduleVideo);



            }
        }
    }

    public function getVideoInfo(){
//        $videoId=$_GET['id'];
        $this->load->model('GoogleModel');
        $this->load->model('TwitterModel');
        $twitterModel=new TwitterModel();
        $googleModel=new GoogleModel();

        $date=date('Y-m-d H:i:s');

        $this->load->model('DLModel');
        $dlModel=new DLModel();
//        $result=$this->db->query('SELECT video_schedule_id,twitter_response_id, video_published_id FROM scheduled_videos LIMIT 0, 50')->result_array();
        $result=$this->db->query('SELECT video_schedule_id,twitter_response_id, sv.video_published_id FROM scheduled_videos sv
  LEFT JOIN social_counts sc ON sv.video_published_id=sc.video_published_id
  WHERE sc.is_update!=1 LIMIT 0,20')->result_array();
        $videoIds='';
        $twitterIds='';
        /*echo '<pre>';
        print_r($result);*/
        if(count($result)>0){
            foreach ($result as $key=>$item){
                if($key==0){
                    $videoIds=trim($item['video_published_id']);
                }else{
                    $videoIds=$videoIds.','.trim($item['video_published_id']);
                }

                if($item['twitter_response_id']!=null && $item['twitter_response_id']!=''){
                    $twitterIds=$twitterIds.','.trim($item['twitter_response_id']);
                }

            }

//        $twitterIds='';
            $twitterResponse=$this->getTwitterPostInfo($twitterIds,9);
            unset($twitterResponse->httpstatus);
            unset($twitterResponse->rate);


            $ytResponse=$googleModel->getVideoInfo($videoIds);

            $this->load->library('class/SocialCounts');
            foreach ($result as $item){
                $socialCountData=$this->db->query('SELECT * FROM social_counts WHERE video_published_id=?',array($item['video_published_id']))->result_array();
                $socialCounts=new SocialCounts($socialCountData[0]);

                foreach ($twitterResponse as $key=>$twResponseItem){
                    if($item['twitter_response_id']==$twResponseItem->id){
                        $socialCounts->setTwLike($twResponseItem->favorite_count);
                        $socialCounts->setTwRetweet($twResponseItem->retweet_count);
                        $socialCounts->setTwComment($twResponseItem->retweet_count);
                    }
                }

                if(count($ytResponse)>0){
                    foreach ($ytResponse as $ytItem){
                        if($item['video_published_id']==$ytItem['id']){
                            $socialCounts->setYtComment($ytItem['statistics']['commentCount']);
                            $socialCounts->setYtLike($ytItem['statistics']['likeCount']);
                            $socialCounts->setYtDislike($ytItem['statistics']['dislikeCount']);
                            $socialCounts->setYtView($ytItem['statistics']['viewCount']);
                        }
                    }
                }

                $socialCounts->setUpdateTime(date('Y-m-d H:i:s'));

                $socialCounts->setIsUpdate(1);

                $dlModel->updateSocialCounts($socialCounts);

            }
        }else{
            $this->db->query('UPDATE social_counts SET is_update=0');
        }

    }

    public function getTwitterPostInfo($id,$userId){
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $this->load->model('TwitterModel');
        $userData=$dlModel->getUserByUserId($userId);
        $this->load->library('class/Users');
        $this->load->library('class/TwitterTokens');
        $user=new Users($userData[0]);
        $twitterTokenData=$dlModel->getTwitterTokenByUserId($user->getUserId());
        $twitterTokens=new TwitterTokens($twitterTokenData[0]);
        $twitterModel=new TwitterModel();
        return $twitterModel->getPostInfo($id,$twitterTokens);
    }

    public function testPostOnTwitter1($id){
        $dlModel=new DLModel();
        $currentDate=date('Y-m-d H:s:i');
//        $scheduleVideoData=$dlModel->getScheduleVideoForPostAndMail($currentDate);
        $scheduleVideoData=$dlModel->getScheduleVideoByVideoPublishId($id);

        if(count($scheduleVideoData)==1){
            $scheduleVideo=new ScheduledVideos($scheduleVideoData[0]);
            $userData=$dlModel->getUserByUserId($scheduleVideo->getUserId());

            /*echo '<pre>';
            print_r($userData);
            print_r($scheduleVideo);*/

            if(count($userData)==1){
                $this->load->library('class/Users');
                $user=new Users($userData[0]);

                $twitterMessage=$scheduleVideo->getTwitterText();
                if($twitterMessage!=''){
                    $message=$scheduleVideo->getTwitterText()."\n\rhttps://www.youtube.com/watch?v=".$scheduleVideo->getVideoPublishedId();

                    echo $message;
                    //                    $twitterResponse=$this->postOnTwitter($user,$twitterMessage);
                    /*echo '<pre>';
                    print_r($twitterResponse);*/
//                    $scheduleVideo->setTwitterPostStatus(1);
//                    $scheduleVideo->setTwitterResponse($twitterResponse['message']);
//                    $scheduleVideo->setTwitterResponseId($twitterResponse['response']);
                }

//                $dlModel->updateScheduleVideos($scheduleVideo);
//                echo '<pre>';
//                print_r($scheduleVideo);



            }
        }
    }

    public function test(){
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $data=$dlModel->getUserWhereRefreshTokenNotNull();
        echo '<pre>';
        print_r($data);
    }

    public function info(){
        echo phpinfo();
    }




}