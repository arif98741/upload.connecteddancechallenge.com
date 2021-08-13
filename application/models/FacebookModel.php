<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 5/9/17
 * Time: 4:28 PM
 */
class FacebookModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('facebook');
    }

    public function postLink($userId){
        $fb=new Facebook();
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $this->load->library('class/FacebookTokens');
        $facebookTokensData=$dlModel->getFacebookTokenByUserId($userId);
        if(count($facebookTokensData)==1){
            $facebookTokens=new FacebookTokens($facebookTokensData[0]);
//            $accessToken='EAACz3S1kZBmYBADBeYHupHCLWKouvpF9lUXcghJuuVtGTH11FRhZARZCmGnyiZBkR9My65zl8qQSrShFHY3emFMSTwD8njpklnMBt9ZBc5RlIUVGjVGal3wgXkxZAlkxQG3vwqCZArx55CE5KXoSluq623vjoVozTMZD';
            $fb->setAccessToken($facebookTokens->getFbToken());
            $linkData=[
                'link'=>'http://hindheadlines.com/news/5466/kapil-sibbal',
                'message'=>'कपिल सिब्बल ने मोदी सरकार पर कसा तंज, चूड़ियां उतारो और दिखाओ क्या कर सकते हो'
            ];

            if($fb->is_authenticated()){
                //        $userProfile = $facebook->request('get', '/me?fields=id,first_name,last_name,name,email,gender,locale,picture');
                $response=$fb->request('post','/me/feed',$linkData);


                echo 'hi</br>';
                print_r($response);
            }else{
                echo 'error';
            }
        }
    }

    public function postFacebook($token,$message){
        $fb=new Facebook();
//        $this->load->library('class/FacebookTokens');

        $fb->setAccessToken($token);
        $linkData=[
//            'link'=>'http://hindheadlines.com/news/5466/kapil-sibbal',
            'message'=>$message
        ];

        if($fb->is_authenticated()){
            //        $userProfile = $facebook->request('get', '/me?fields=id,first_name,last_name,name,email,gender,locale,picture');
            $response=$fb->request('post','/me/feed',$linkData);
            if(isset($response['id'])){
                $data['message']=$response['id'];
            }
            if(isset($response['error'])){
                $data['message']=$response['error'].' : '.$response['message'];
            }


        }else{
            $data['message']='not validate';
        }

        return $data;
    }



    public function uploadVideo($token,$title,$description,$videoId){
        $fb=new Facebook();

        $fb->setAccessToken($token);


        $fb1=$fb->getFbInstance();


        $dataPost = [
            'title' => $title,
            'description' => $description,
        ];

        $filename=$videoId;

//        $path=$_SERVER['DOCUMENT_ROOT'].'/YoutubeVideoUpload/video/'.$filename;
//        $path=base_url('video/'.$filename);
        $path='video/'.$filename;
        if($fb->is_authenticated()){
            try {
                $response = $fb1->uploadVideo('me', $path, $dataPost, $token);
                $data['result']=true;
                $data['response']=$response['video_id'];
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                $data['result']=false;
                $data['message']='Graph returned an error: ' . $e->getMessage();
//                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                $data['result']=false;
                $data['message']= 'Facebook SDK returned an error: ' . $e->getMessage();
//                exit;
            }


        }else{
            $data['result']=false;
            $data['message']='not validate';
        }

        return $data;

    }

    public function deleteFacebookTokens($token,$fbNumericId){
        $fb=new Facebook();

        $fb->setAccessToken($token);


        if($fb->is_authenticated()){
            try {
                $response=$fb->request('DELETE',"/$fbNumericId/permissions");
//                $data['response']=$response;
                if(isset($response['success'])){
                    $data['result']=true;
                    $data['message']='Deauthintication success';
                }else{
                    $data['result']=false;
                    $data['message']=$response['message'];
                }

                $fb->destroy_session();

            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                $data['result']=false;
                $data['message']='Graph returned an error: ' . $e->getMessage();
//                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                $data['result']=false;
                $data['message']= 'Facebook SDK returned an error: ' . $e->getMessage();
//                exit;
            }


        }else{
            $data['result']=false;
            $data['message']='not validate';
        }


        return $data;

    }
}