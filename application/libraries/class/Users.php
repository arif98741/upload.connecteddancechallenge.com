<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/15/17
 * Time: 1:54 PM
 */

class Users{
    public $user_id;
    public $entry_date;
    public $user_first_name;
    public $user_last_name;
    public $user_email;
    public $youtube_username;
    public $youtube_channel_name;
    public $youtube_channel_id;
    public $youtube_auth_date;
    public $youtube_token;
    public $youtube_token_secret;
    public $youtube_auth_status;
    public $user_status;
    public $picture_url;
    public $access_token;
    public $id_token;
    public $user_google_id;
    public $refresh_token;
    public $infusionsoft_user_id;
    public $mailchimp_user_id;

    /**
     * @return mixed
     */
    public function getMailchimpUserId()
    {
        return $this->mailchimp_user_id;
    }

    /**
     * @param mixed $mailchimp_user_id
     */
    public function setMailchimpUserId($mailchimp_user_id)
    {
        $this->mailchimp_user_id = $mailchimp_user_id;
    }



    /**
     * @return mixed
     */
    public function getInfusionsoftUserId()
    {
        return $this->infusionsoft_user_id;
    }

    /**
     * @param mixed $infusionsoft_user_id
     */
    public function setInfusionsoftUserId($infusionsoft_user_id)
    {
        $this->infusionsoft_user_id = $infusionsoft_user_id;
    }



    /**
     * @return mixed
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * @param mixed $refresh_token
     */
    public function setRefreshToken($refresh_token)
    {
        $this->refresh_token = $refresh_token;
    }



    /**
     * @return mixed
     */
    public function getUserGoogleId()
    {
        return $this->user_google_id;
    }

    /**
     * @param mixed $user_google_id
     */
    public function setUserGoogleId($user_google_id)
    {
        $this->user_google_id = $user_google_id;
    }


    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * @return mixed
     */
    public function getIdToken()
    {
        return $this->id_token;
    }

    /**
     * @param mixed $id_token
     */
    public function setIdToken($id_token)
    {
        $this->id_token = $id_token;
    }



    /**
     * @return mixed
     */
    public function getPictureUrl()
    {
        return $this->picture_url;
    }

    /**
     * @param mixed $picture_url
     */
    public function setPictureUrl($picture_url)
    {
        $this->picture_url = $picture_url;
    }



    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getEntryDate()
    {
        return $this->entry_date;
    }

    /**
     * @param mixed $entry_date
     */
    public function setEntryDate($entry_date)
    {
        $this->entry_date = $entry_date;
    }

    /**
     * @return mixed
     */
    public function getUserFirstName()
    {
        return $this->user_first_name;
    }

    /**
     * @param mixed $user_first_name
     */
    public function setUserFirstName($user_first_name)
    {
        $this->user_first_name = $user_first_name;
    }

    /**
     * @return mixed
     */
    public function getUserLastName()
    {
        return $this->user_last_name;
    }

    /**
     * @param mixed $user_last_name
     */
    public function setUserLastName($user_last_name)
    {
        $this->user_last_name = $user_last_name;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param mixed $user_email
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }

    /**
     * @return mixed
     */
    public function getYoutubeUsername()
    {
        return $this->youtube_username;
    }

    /**
     * @param mixed $youtube_username
     */
    public function setYoutubeUsername($youtube_username)
    {
        $this->youtube_username = $youtube_username;
    }

    /**
     * @return mixed
     */
    public function getYoutubeChannelName()
    {
        return $this->youtube_channel_name;
    }

    /**
     * @param mixed $youtube_channel_name
     */
    public function setYoutubeChannelName($youtube_channel_name)
    {
        $this->youtube_channel_name = $youtube_channel_name;
    }

    /**
     * @return mixed
     */
    public function getYoutubeChannelId()
    {
        return $this->youtube_channel_id;
    }

    /**
     * @param mixed $youtube_channel_id
     */
    public function setYoutubeChannelId($youtube_channel_id)
    {
        $this->youtube_channel_id = $youtube_channel_id;
    }

    /**
     * @return mixed
     */
    public function getYoutubeAuthDate()
    {
        return $this->youtube_auth_date;
    }

    /**
     * @param mixed $youtube_auth_date
     */
    public function setYoutubeAuthDate($youtube_auth_date)
    {
        $this->youtube_auth_date = $youtube_auth_date;
    }

    /**
     * @return mixed
     */
    public function getYoutubeToken()
    {
        return $this->youtube_token;
    }

    /**
     * @param mixed $youtube_token
     */
    public function setYoutubeToken($youtube_token)
    {
        $this->youtube_token = $youtube_token;
    }

    /**
     * @return mixed
     */
    public function getYoutubeTokenSecret()
    {
        return $this->youtube_token_secret;
    }

    /**
     * @param mixed $youtube_token_secret
     */
    public function setYoutubeTokenSecret($youtube_token_secret)
    {
        $this->youtube_token_secret = $youtube_token_secret;
    }

    /**
     * @return mixed
     */
    public function getYoutubeAuthStatus()
    {
        return $this->youtube_auth_status;
    }

    /**
     * @param mixed $youtube_auth_status
     */
    public function setYoutubeAuthStatus($youtube_auth_status)
    {
        $this->youtube_auth_status = $youtube_auth_status;
    }

    /**
     * @return mixed
     */
    public function getUserStatus()
    {
        return $this->user_status;
    }

    /**
     * @param mixed $user_status
     */
    public function setUserStatus($user_status)
    {
        $this->user_status = $user_status;
    }


    /**
     * Users constructor.
     * @param null $arr
     */
    public function __construct($arr=null)
    {
        if(is_array($arr) && $arr!=null){
            foreach ($arr as $name=>$value){
                if(property_exists($this,$name)){
                    $this->$name=$value;
                }

            }
        }
    }
}