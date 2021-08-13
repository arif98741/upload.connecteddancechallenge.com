<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TwitterSchoBot extends CI_Controller
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
        date_default_timezone_set('Asia/Kolkata');

        //include 3rd part apis-> given full path
        $this->load->library('ftp');
        include APPPATH . 'TwitterLibrary/codebird.php';

        $this->load->model('TweetModel');

    }

    public function index()
    {
        $this->load->view('schobot_home');
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
        $tokenData['app_consumer_key'] = "9EbsIFW8Zcf6A0TuW2yFxqNX1";
        $tokenData['app_consumer_secret']="4btfZAUU64MmlSAVOKy1xFykpp7qilwjhZuYgBLOzjXMpsQx93";

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

        echo "<pre>";
        print_r($response);
        echo "</pre>";

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

/*            echo "<pre>";
            print_r($reply);
            echo "</pre>";*/

            $oauth_token = $reply->oauth_token;
            $oauth_token_secret = $reply->oauth_token_secret;
            $twitterApiInstance->setToken($reply->oauth_token, $reply->oauth_token_secret);
            //$token = $Twitter->getAccessToken();

            //$Twitter->setToken($token->oauth_token, $token->oauth_token_secret);

            $userData = $twitterApiInstance->account_verifyCredentials();

/*            echo '<pre>';
            print_r($userData);
            echo '<pre/>';*/


            $twitterUserData['twitter_numeric_id']=$userData->id_str;
            $twitterUserData['twitter_screen_name']=$userData->screen_name;
            $twitterUserData['twitter_token']=$oauth_token;
            $twitterUserData['twitter_token_secret']=$oauth_token_secret;

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