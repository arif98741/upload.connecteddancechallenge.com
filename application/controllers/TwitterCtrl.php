<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TwitterCtrl extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->database();

        //include 3rd part apis-> given full path
        $this->load->library('ftp');
        include APPPATH . 'libraries/TwitterLibrary/codebird.php';



//        $this->load->model('TweetModel');

        $this->load->library('class/TwitterTokens');

    }

    public function index()
    {
//        $this->load->view('schobot_home');

        redirect('user/social');
    }

    public function getUserAuthTokens()
    {
        

    }


    public  function initializeOAuthRequest()
    {
        $appKey = $this->SchoBotModel->getAppAccessTokens();
        $consumerKey = $appKey[0]['app_consumer_key'];
        $consumerKeySecret = $appKey[0]['app_consumer_secret'];
        $dbAppId = $appKey[0]['app_id'];
        $codebirdLib = new \Codebird\Codebird();
        $codebirdLib->setConsumerKey($consumerKey, $consumerKeySecret);
        $twitterObject = $codebirdLib->getInstance();
        return $twitterObject;
    }

    public function getAppAccessTokens()
    {
        //$this->load->model('TweetModel');
        $tweetModel = new TweetModel();
        $tokenData = $tweetModel->getAppTokens();
        //print_r($tokenData);
        return $tokenData;
    }


    public function getTwitterAppTokens()
    {

        // localhost
//        $tokenData['app_consumer_key'] = "afAIffFOX4HdYvBxSIyeSiBg8";
//        $tokenData['app_consumer_secret']="SpK4vuyydwgCn911dp3UgZBjDSjAOn86VH7amKWyeUD1PLxhjD";

        // for server testing
        $tokenData['app_consumer_key'] = "WMPCyfQaujP3SxhCidfTmVbfT";
        $tokenData['app_consumer_secret']="gWJyIhiMHzWrMW9lFSpD1b8oU2MdGITwlydeQyHmDxIzGmJvLl";


        return $tokenData;
    }


    public function getTwitterApiInstance()
    {

        $tokenData=$this->getTwitterAppTokens();

        \Codebird\Codebird::setConsumerKey($tokenData['app_consumer_key'], $tokenData['app_consumer_secret']);
        $twitterApiInstance = \Codebird\Codebird::getInstance();

        return $twitterApiInstance;

    }


    public function twitterLogin()
    {
        $twitterApiInstance=$this->getTwitterApiInstance();
        $response=$twitterApiInstance->oauth_requestToken();//['oauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']]);



        $oauthToken=$response->oauth_token;
        $oauthTokenSecret=$response->oauth_token_secret;




        $_SESSION['oauth_token']=$oauthToken;
        $_SESSION['oauth_token_secret']=$oauthTokenSecret;
        $_SESSION['oauth_verify'] = true;

        $twitterApiInstance->setToken($oauthToken,$oauthTokenSecret);

        // redirect to auth website
        $auth_url = $twitterApiInstance->oauth_authorize();
        //echo $auth_url;
        redirect($auth_url);
    }

    public function twitterCallback()
    {

        $twitterUserData=array();
        $twitterApiInstance = $this->getTwitterApiInstance();

        if (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {

            // verify the token
            $twitterApiInstance->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
            unset($_SESSION['oauth_verify']);

            // get the access token
            $reply = $twitterApiInstance->oauth_accessToken([
                'oauth_verifier' => $_GET['oauth_verifier']
            ]);


            $oauth_token = $reply->oauth_token;
            $oauth_token_secret = $reply->oauth_token_secret;
            $twitterApiInstance->setToken($reply->oauth_token, $reply->oauth_token_secret);


            $userData = $twitterApiInstance->account_verifyCredentials();


            $this->load->model('DLModel');
            $dlModel=new DLModel();

            $twitterTokensData=$dlModel->getTwitterTokenByUserId($_SESSION['userId']);
            if(count($twitterTokensData)==1){
                $twitterTokens=new TwitterTokens($twitterTokensData[0]);
//            $twitterTokens->setUserId($_SESSION['userId']);
                $twitterTokens->setTwitterToken($oauth_token);
                $twitterTokens->setTwitterTokenSecret($oauth_token_secret);
                $twitterTokens->setTwitterAuthStatus('active');
                $twitterTokens->setTwitterAuthDate(date('Y/m/d H:s:i'));
                $twitterTokens->setTwitterNumericId($userData->id_str);
                $twitterTokens->setTwitterScreenName($userData->screen_name);

                $dlModel->updateTwitterTokensByUserId($twitterTokens);

                if((isset($_SESSION['uploadedVideoId']) && $_SESSION['uploadedVideoId']!='') && (isset($_SESSION['videoScheduleId']) && $_SESSION['videoScheduleId']!='')){
                    $dlModel->updateTwitterPostStatusByVideoScheduleId($_SESSION['videoScheduleId'],0);
                    redirect('user/shareToSocial');
                }else{
                    redirect('user/social');
                }

            }else{
                $twitterTokens=new TwitterTokens();
                $twitterTokens->setUserId($_SESSION['userId']);
                $twitterTokens->setTwitterToken($oauth_token);
                $twitterTokens->setTwitterTokenSecret($oauth_token_secret);
                $twitterTokens->setTwitterAuthStatus('active');
                $twitterTokens->setTwitterAuthDate(date('Y/m/d H:s:i'));
                $twitterTokens->setEntryDate(date('Y/m/d H:s:i'));
                $twitterTokens->setTwitterNumericId($userData->id_str);
                $twitterTokens->setTwitterScreenName($userData->screen_name);

                $dlModel->insertTwitterTokens($twitterTokens);

                if((isset($_SESSION['uploadedVideoId']) && $_SESSION['uploadedVideoId']!='') && (isset($_SESSION['videoScheduleId']) && $_SESSION['videoScheduleId']!='')){
                    $dlModel->updateTwitterPostStatusByVideoScheduleId($_SESSION['videoScheduleId'],0);
                    redirect('user/shareToSocial');
                }else{
                    redirect('user/social');
                }
            }

//            redirect('user/social');
           // $this->postTweet($twitterUserData['twitter_screen_name'],$oauth_token,$oauth_token_secret);

        }
    }



    public function postTweet($screenName,$userToken,$userTokenSecret)
    {

        $tweetMessage="Watching #IPL #RCB #MI";
        $twitterUserData=array();
        $twitterApiInstance = $this->getTwitterApiInstance();

        $twitterApiInstance->setToken($userToken, $userTokenSecret);

        $params = array(
            'status' => $tweetMessage,

        );
        $response = $twitterApiInstance->statuses_update($params);

        echo "<pre>";
        print_r($response);
        echo "</pre>";

    }
}