<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 5/8/17
 * Time: 6:44 PM
 */
class GoogleModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('google');
    }

    public function getGoogleClientInstance($accessToken){
        $client=new Google_Client();

        // localhost testing
//        $client->setAuthConfigFile('client_secret1.json');

        // for server testing
//        $client->setAuthConfigFile('client_secret_main.json');
        $client->setAuthConfig('client_secret_main.json');

        $client->setRedirectUri(base_url('GoogleCtrl'));

//        $client->setAccessToken($accessToken);
        $client->setAccessToken(unserialize($accessToken));

        return $client;
    }

    /*public function checkYoutubeVideoStatus(Users $user,$videoId){

        $client=$this->getGoogleClientInstance($user->getAccessToken());
        try{
            if($client->isAccessTokenExpired()){
                $refreshToken=$user->getRefreshToken();

                $client->refreshToken($refreshToken);
                $client->getAccessToken();
                $this->load->model('DLModel');
                $dlModel=new DLModel();
                $user->setAccessToken($client->getAccessToken());
                $dlModel->updateUserByUserId($user);
            }

            $videoID=$videoId;
            $youtube=new Google_Service_YouTube($client);
            try{
                $status=$youtube->videos->listVideos('status',array('id'=>$videoID));
                $a=$status->getItems();
                $data['result']=true;
                if(count($a)==1){
                    $data['status']=$a[0]['status']['privacyStatus'];
                }else{
                    $data['status']='deleted';
                }
            }catch (Google_Exception $e){

                $data['result']=false;
                $data['message']=$e->getMessage();
            }
        }catch (Google_Exception $e1){
            $data['result']=false;
            $data['message']=$e1->getMessage();
            $data['status']='revoke';
        }

        return $data;
    }*/

    public function checkYoutubeVideoStatus(Users $user,$videoId){

        $DEVELOPER_KEY = 'AIzaSyA6BnEAca-8BffodqvMx2XLBm7VQOsauz4';

        $client = new Google_Client();
        $client->setDeveloperKey($DEVELOPER_KEY);

        $youtube = new Google_Service_YouTube($client);

        try{
            $status=$youtube->videos->listVideos('status',array('id'=>$videoId));
            $a=$status->getItems();
            $data['result']=true;
            if(count($a)==1){
                $data['status']=$a[0]['status']['privacyStatus'];
            }else{
                $data['status']='deleted';
            }
        }catch (Google_Exception $e){

            print_r($user);

            $data['result']=false;
            $data['message']=$e->getMessage();
        }

        return $data;

        /*$client=$this->getGoogleClientInstance($user->getAccessToken());
        try{
            $this->load->model('DLModel');
            $dlModel=new DLModel();
            if($client->isAccessTokenExpired()){
                if($user->getRefreshToken()!=''&& $user->getRefreshToken()!=null){
                    $refreshToken=$user->getRefreshToken();

                    $client->refreshToken($refreshToken);
                    $client->getAccessToken();
                    $user->setAccessToken($client->getAccessToken());
                    $dlModel->updateUserByUserId($user);
                }else{
                    $this->revokeToken($user);
                    $userData=$dlModel->getUserWhereRefreshTokenNotNull();
                    $user=new Users($userData[0]);
                    $client=$this->getGoogleClientInstance($user->getAccessToken());
                    if($client->isAccessTokenExpired()){
                        $refreshToken=$user->getRefreshToken();
                        $client->refreshToken($refreshToken);
                        $client->getAccessToken();
                        $user->setAccessToken($client->getAccessToken());
                        $dlModel->updateUserByUserId($user);
                    }
                }

            }

            $videoID=$videoId;
            $youtube=new Google_Service_YouTube($client);
            try{
                $status=$youtube->videos->listVideos('status',array('id'=>$videoID));
                $a=$status->getItems();
                $data['result']=true;
                if(count($a)==1){
                    $data['status']=$a[0]['status']['privacyStatus'];
                }else{
                    $data['status']='deleted';
                }
            }catch (Google_Exception $e){
                echo '<pre>';
                echo $videoId.'<br>';
                echo $user->getUserId().'<br>';
                print_r($user->getAccessToken());
                print_r($client->getAccessToken());
                $data['result']=false;
                $data['message']=$e->getMessage();
            }

        }catch (Google_Exception $e1){
            $data['result']=false;
            $data['message']=$e1->getMessage();
            $data['status']='revoke';
        }

        return $data;*/


    }

    public function revokeToken(Users $user){

        if($user->getAccessToken()!=null && $user->getAccessToken()!=''){
            $client=$this->getGoogleClientInstance($user->getAccessToken());
            return $client->revokeToken();
        }
    }

    public function getVideoInfo($videoId){
        $DEVELOPER_KEY = 'AIzaSyA6BnEAca-8BffodqvMx2XLBm7VQOsauz4';

        $client = new Google_Client();
        $client->setDeveloperKey($DEVELOPER_KEY);

        $youtube = new Google_Service_YouTube($client);

        $list=array();
        try {

            # Call the videos.list method to retrieve ratings for video with id hoe9xW7vnpA.
            $videosResponse = $youtube->videos->listVideos('statistics',array(
                'id' => $videoId,
                'part' => 'statistics',
            ));

            $list=$videosResponse['items'];

            return $list;

        } catch (Google_Service_Exception $e) {
            return $list;
        } catch (Google_Exception $e) {
            return $list;
        }
    }

}