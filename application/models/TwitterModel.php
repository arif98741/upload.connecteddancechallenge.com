<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 5/9/17
 * Time: 1:28 PM
 */
class TwitterModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->database();


        include_once APPPATH . 'libraries/TwitterLibrary/codebird.php';


        $this->load->library('class/TwitterTokens');
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

    public function postTweet($userToken,$userTokenSecret,$tweetMessage)
    {

//        $tweetMessage="Watching #IPL #RCB #MI";
        $twitterUserData=array();
        $twitterApiInstance = $this->getTwitterApiInstance();

        $twitterApiInstance->setToken($userToken, $userTokenSecret);

        $params = array(
            'status' => $tweetMessage,

        );
        $response = $twitterApiInstance->statuses_update($params);

        

        $status=$response->httpstatus;
        if($status==200){
            $data['message']='200 : Post successfully';
            $data['response']=$response->id;
        }else{
            $errorCounts = count($response->errors);
            $activityHistory['error_counts'] = $errorCounts;
            $activityHistory['error_code'] = $response->errors[0]->code;
            $activityHistory['error_message'] = $response->errors[0]->message;

            $data['response']=null;
            $data['message']=$activityHistory['error_code'].' : '.$activityHistory['error_message'];
        }

//        return $data['message'];
        return $data;

    }

    public function getPostInfo($twitterPostId,TwitterTokens $twitterTokens){
        $twitterInstance=$this->getTwitterApiInstance();
        $twitterInstance->setToken($twitterTokens->getTwitterToken(),$twitterTokens->getTwitterTokenSecret());
        $params=array('id'=>$twitterPostId);
        $response=$twitterInstance->statuses_lookup($params);

        /*echo '<pre>';
        print_r($response);*/

        return $response;
    }

}