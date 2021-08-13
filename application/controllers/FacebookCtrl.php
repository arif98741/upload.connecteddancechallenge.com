<?php defined('BASEPATH') OR exit('No direct script access allowed');
class FacebookCtrl extends CI_Controller
{
    function __construct() {
        parent::__construct();

        // Load facebook library
        $this->load->library('facebook');


        $this->load->library('class/Admins');
    }

    /*public function index(){

        $userData = array();


        $facebook=new Facebook();

        if($facebook->is_authenticated()){
            $userProfile = $facebook->request('get', '/me?fields=id,first_name,last_name,name,email,gender,locale,picture');

            $this->load->model('DLModel');
            $dlModel=new DLModel();


            if (!isset($userProfile['email'])){

                $data['message']='Please set email to your facebook account and set public ';
                $data['authUrl']=$facebook->login_url();
                $data['loginForm']='partialView/form/loginForm';
                $facebook->destroy_session();
                $this->load->view('layout/loginLayout',$data);
            }else{

                $adminLoginData=$dlModel->getAdminByAdminEmail($userProfile['email']);

                if(count($adminLoginData)==1){
                    $admin = new Admins($adminLoginData[0]);
                    $admin->setOauthProvider('facebook');
                    $admin->setOauthUid($userProfile['id']);
                    $admin->setAdminFirstName($userProfile['first_name']);
                    $admin->setAdminLastName($userProfile['last_name']);
                    $admin->setFbUsername($userProfile['name']);
                    $admin->setAdminEmail($userProfile['email']);
                    $admin->setGender($userProfile['gender']);
                    $admin->setLocale($userProfile['locale']);
                    $admin->setProfileUrl('https://www.facebook.com/'.$userProfile['id']);
                    $admin->setPictureUrl($userProfile['picture']['data']['url']);
                    $admin->setFbAccessToken($facebook->is_authenticated());
                    $date=date('Y/m/d H:s:i');
                    $admin->setFbAuthStatus('active');
                    $admin->setFbAuthDate($date);

                    $dlModel->updateAdminByAdminId($admin);

                    $_SESSION['adminId']=$admin->getAdminId();
                    $_SESSION['loginStatus']=true;
                    $_SESSION['loginType']='AdminLogin';
                    $_SESSION['userName']=$admin->getAdminFirstName().' '.$admin->getAdminLastName();
                    $_SESSION['userEmail']=$admin->getAdminEmail();
                    $_SESSION['logoutUrl']=$facebook->logout_url();

                    redirect('admin');

                }else{
                    $data['message']='Not valid user';
                    $data['authUrl']=$facebook->login_url();
                    $data['loginForm']='partialView/form/loginForm';
                    $this->load->view('layout/loginLayout',$data);
                }
            }
        }else{
            $data['authUrl'] =  $facebook->login_url();

            $data['loginForm']='partialView/form/loginForm';
            $this->load->view('layout/loginLayout',$data);

        }

    }*/

    public function index(){

        if(isset($_GET['email'])){
            $this->adminLogin($_GET['email']);

        }else{
            $userData = array();


            $facebook=new Facebook();

            if($facebook->is_authenticated()){
                $userProfile = $facebook->request('get', '/me?fields=id,first_name,last_name,name,email,gender,locale,picture');

                $this->load->model('DLModel');
                $dlModel=new DLModel();


                if (!isset($userProfile['email'])){

                    $data['message']='Please set email to your facebook account and set public ';
                    $data['authUrl']=$facebook->login_url();
                    $data['loginForm']='partialView/form/loginForm';
                    $facebook->destroy_session();
                    $this->load->view('layout/loginLayout',$data);
                }else{

                    $adminLoginData=$dlModel->getAdminByAdminEmail($userProfile['email']);

                    if(count($adminLoginData)==1){
                        $admin = new Admins($adminLoginData[0]);
                        if($admin->getAdminStatus()!='inactive'){
                            $admin->setOauthProvider('facebook');
                            $admin->setOauthUid($userProfile['id']);
                            $admin->setAdminFirstName($userProfile['first_name']);
                            $admin->setAdminLastName($userProfile['last_name']);
                            $admin->setFbUsername($userProfile['name']);
                            $admin->setAdminEmail($userProfile['email']);
                            $admin->setGender($userProfile['gender']);
                            $admin->setLocale($userProfile['locale']);
                            $admin->setProfileUrl('https://www.facebook.com/'.$userProfile['id']);
                            $admin->setPictureUrl($userProfile['picture']['data']['url']);
                            $admin->setFbAccessToken($facebook->is_authenticated());
                            $date=date('Y/m/d H:s:i');
                            $admin->setFbAuthStatus('active');
                            $admin->setFbAuthDate($date);

                            $dlModel->updateAdminByAdminId($admin);

                            $_SESSION['adminId']=$admin->getAdminId();
                            $_SESSION['loginStatus']=true;
                            $_SESSION['loginType']='AdminLogin';
                            $_SESSION['userName']=$admin->getAdminFirstName().' '.$admin->getAdminLastName();
                            $_SESSION['userEmail']=$admin->getAdminEmail();
                            $_SESSION['logoutUrl']=$facebook->logout_url();

                            redirect('admin');
                        }else{
                            $data['message']='Your Account is inactivated';
                            $data['authUrl']=$facebook->login_url();
                            $data['loginForm']='partialView/form/loginForm';
                            $this->load->view('layout/loginLayout',$data);
                        }

                    }else{
                        $data['message']='Not valid user';
                        $data['authUrl']=$facebook->login_url();
                        $data['loginForm']='partialView/form/loginForm';
                        $this->load->view('layout/loginLayout',$data);
                    }
                }
            }else{
                $data['authUrl'] =  $facebook->login_url();

                $data['loginForm']='partialView/form/loginForm';
                $this->load->view('layout/loginLayout',$data);

            }
        }


    }

    public function userAuth(){
        $userData = array();

        // Check if user is logged in
        $facebook=new Facebook();

        if($facebook->is_authenticated()){
//            echo $facebook->is_authenticated();
            // Get user facebook profile details
            $userProfile = $facebook->request('get', '/me?fields=id,first_name,last_name,name,email,gender,locale,picture');

            $this->load->library('class/FacebookTokens');
            $this->load->model('DLModel');
            $dlModel=new DLModel();

            /*echo '<pre>';
            print_r($userProfile);
            exit();*/

            $facebookTokenData=$dlModel->getFacebookTokenByUserId($_SESSION['userId']);
            if(count($facebookTokenData)==1){

                $facebookTokens = new FacebookTokens($facebookTokenData[0]);

                $facebookTokens->setFbNumericId($userProfile['id']);

                $facebookTokens->setFbUsername($userProfile['name']);
                $facebookTokens->setFbToken($facebook->is_authenticated());
                $date=date('Y/m/d H:s:i');
                $facebookTokens->setFbAuthStatus('active');
                $facebookTokens->setFbAuthDate($date);

                $dlModel->updateFacebookTokensByUserId($facebookTokens);

                if((isset($_SESSION['uploadedVideoId']) && $_SESSION['uploadedVideoId']!='') && (isset($_SESSION['videoScheduleId']) && $_SESSION['videoScheduleId']!='')){
                    $dlModel->updateFacebookPostStatusByVideoScheduleId($_SESSION['videoScheduleId'],0);
                    redirect('user/shareToSocial');
                }else{
                    redirect('user/social');
                }



            }else{
                $facebookTokens = new FacebookTokens();

                $facebookTokens->setFbNumericId($userProfile['id']);

                $facebookTokens->setFbUsername($userProfile['name']);
                $facebookTokens->setFbToken($facebook->is_authenticated());
                $date=date('Y/m/d H:s:i');
                $facebookTokens->setFbAuthStatus('active');
                $facebookTokens->setFbAuthDate($date);
                $facebookTokens->setUserId($_SESSION['userId']);
                $facebookTokens->setEntryDate($date);
                $dlModel->insertFacebookTokens($facebookTokens);

                if((isset($_SESSION['uploadedVideoId']) && $_SESSION['uploadedVideoId']!='') && (isset($_SESSION['videoScheduleId']) && $_SESSION['videoScheduleId']!='')){
                    $dlModel->updateFacebookPostStatusByVideoScheduleId($_SESSION['videoScheduleId'],0);
                    redirect('user/shareToSocial');
                }else{
                    redirect('user/social');
                }
            }


        }else{
            // Get login URL

            $data['authUrl']=$facebook->login_url_user();
            $data['rightLayout']='partialView/linkSocialAccounts';
            $this->load->view('layout/userLayout',$data);
//            $this->load->view('partialView/',$data);

        }
    }

    public function logout() {

        $userData=array('loginStatus','loginType','userName','userEmail','logoutUrl','cmp_id','p_date');

        // Remove local Facebook session
        $facebook=new Facebook();
        $facebook->destroy_session();
        $this->session->unset_userdata($userData);
        // Redirect to login page
//        redirect('/FacebookCtrl');
        redirect(base_url());
    }

    public function userFacebookLogout(){
        $facebook=new Facebook();
        $facebook->destroy_session();
    }

    public function postLink($userId){
        $fb=new Facebook();
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $this->load->library('class/FacebookTokens');
        $facebookTokensData=$dlModel->getFacebookTokenByUserId($userId);
        if(count($facebookTokensData)==1){
            $facebookTokens=new FacebookTokens($facebookTokensData[0]);
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


    public function adminLogin($email){

        $facebook=new Facebook();
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $adminLoginData=$dlModel->getAdminByAdminEmail($email);

        if(count($adminLoginData)==1){
            $admin = new Admins($adminLoginData[0]);
//            $admin->setOauthProvider('facebook');
//            $admin->setOauthUid($userProfile['id']);
//            $admin->setAdminFirstName($userProfile['first_name']);
//            $admin->setAdminLastName($userProfile['last_name']);
//            $admin->setFbUsername($userProfile['name']);
//            $admin->setAdminEmail($userProfile['email']);
//            $admin->setGender($userProfile['gender']);
//            $admin->setLocale($userProfile['locale']);
//            $admin->setProfileUrl('https://www.facebook.com/'.$userProfile['id']);
//            $admin->setPictureUrl($userProfile['picture']['data']['url']);
//            $admin->setFbAccessToken($facebook->is_authenticated());
//            $date=date('Y/m/d H:s:i');
//            $admin->setFbAuthStatus('active');
//            $admin->setFbAuthDate($date);
//
//            $dlModel->updateAdminByAdminId($admin);

            $_SESSION['adminId']=$admin->getAdminId();
            $_SESSION['loginStatus']=true;
            $_SESSION['loginType']='AdminLogin';
            $_SESSION['userName']=$admin->getAdminFirstName().' '.$admin->getAdminLastName();
            $_SESSION['userEmail']=$admin->getAdminEmail();
            $_SESSION['logoutUrl']=$facebook->logout_url();

            redirect('admin');

        }else{
            $data['message']='Not valid user';
            $data['authUrl']=$facebook->login_url();
            $data['loginForm']='partialView/form/loginForm';
            $this->load->view('layout/loginLayout',$data);
        }
    }
}
