<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/27/17
 * Time: 12:28 PM
 */
class GoogleCtrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('google');
        $this->load->library('facebook');
    }

    public function index(){
        $client = new Google_Client();

        // localhost testing
//        $client->setAuthConfigFile('client_secret1.json');

        // for server testing
//        $client->setAuthConfigFile('client_secret_main.json');
        $client->setAuthConfig('client_secret_main.json');

        $client->setRedirectUri(base_url('GoogleCtrl'));
//        $client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/youtube'));

        $client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile','https://www.googleapis.com/auth/youtube'));

        $client->setAccessType('offline');
        $client->setApprovalPrompt("force");

        $objOAuthService = new Google_Service_Oauth2($client);




        if (!isset($_GET['code'])) {
            $auth_url = $client->createAuthUrl();
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        } else {
            $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $_SESSION['accessToken'] = $client->getAccessToken();
            $refreshToken=$client->getRefreshToken();
            $userData = $objOAuthService->userinfo->get();

//            echo '<pre>';
//            print_r($userData);
//
//            exit();


            $this->load->library('class/Users');
            $this->load->model('DLModel');
            $dlModel=new DLModel();
            // check if user already exist in user table //

            $userResult=$dlModel->getUserByUserEmail($userData['email']);
            if(count($userResult)==1){
                $user=new Users($userResult[0]);
                $user->setYoutubeUsername($userData['name']);
                $user->setUserEmail($userData['email']);
                $user->setPictureUrl($userData['picture']);
                $user->setUserStatus('active');
                $token=$client->getAccessToken();
                $user->setAccessToken(serialize($client->getAccessToken()));

                $user->setIdToken($token['id_token']);
                if($client->getRefreshToken()!=''){
                    $user->setRefreshToken($refreshToken);
                }
                $result=$dlModel->updateUserByUserId($user);

            }else{
                $user=new Users();
                $user->setEntryDate(date('Y/m/d H:s:i'));
                $user->setYoutubeUsername($userData['name']);
                $user->setUserEmail($userData['email']);
                $user->setPictureUrl($userData['picture']);
                $user->setUserStatus('active');
                $token=$client->getAccessToken();
                $user->setAccessToken(serialize($client->getAccessToken()));
                $user->setIdToken($token['id_token']);
                $user->setRefreshToken($refreshToken);

                $dlModel->insertUser($user);

                $userId=$this->db->insert_id();
                $user->setUserId($userId);
            }

            $_SESSION['userId']=$user->getUserId();
            $_SESSION['userName']=$user->getYoutubeUsername();
            $_SESSION['email']=$user->getUserEmail();
            $_SESSION['loginStatus']=true;
            $_SESSION['loginType']='userLogin';

//            redirect('/user');
            if(isset($_SESSION['cmp_id']) || isset($_SESSION['challenge_id'])){
                if(isset($_SESSION['challenge_id'])){
                    $challengeId=$_SESSION['challenge_id'];
                    unset($_SESSION['challenge_id']);
                    redirect('user/challenge/'.$challengeId);
                }else{
                    redirect('user/campaign');
//                    echo '<pre>';
//                    echo 'hi';
//                    print_r($_SESSION);
                }
            }else{
                redirect('/user');
//                echo '<pre>';
//                echo 'hello';
//                print_r($_SESSION);
            }
        }
    }


    public function logout() {
//        unset($_SESSION['access_token']);
//        redirect(base_url());

        $userData=array('loginStatus','loginType','userName','email','accessToken','cmp_id','p_date','challenge_id');


        $this->session->unset_userdata($userData);


        $facebook=new Facebook();
        $facebook->destroy_session();

        // Redirect to login page
        redirect(base_url());
    }

    public function checkVideoStatus(){
        $client=new Google_Client();

        // localhost testing
//        $client->setAuthConfigFile('client_secret1.json');

        // for server testing
//        $client->setAuthConfigFile('client_secret_main.json');
        $client->setAuthConfig('client_secret_main.json');

        $client->setRedirectUri(base_url('GoogleCtrl'));

        $client->setAccessToken($_SESSION['accessToken']);

        $videoID=$_GET['video_id'];
        $youtube=new Google_Service_YouTube($client);
        try{
            $status=$youtube->videos->listVideos('status',array('id'=>$videoID));
            $a=$status->getItems();
            $data['result']=true;
            $data['status']=$a[0]['status'];
            echo json_encode($data);
        }catch (Google_Exception $e){

            $data['result']=false;
            $data['message']=$e->getMessage();
            echo json_encode($data);
        }
    }

}