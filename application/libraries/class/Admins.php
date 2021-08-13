<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/15/17
 * Time: 12:52 PM
 */
class Admins
{
    public $admin_id;
    public $entry_date;
    public $admin_first_name;
    public $admin_last_name;
    public $admin_email;
    public $fb_username;
    public $admin_password;
    public $fb_access_token;
    public $admin_status;
    public $fb_auth_date;
    public $fb_auth_status;
    public $oauth_provider;
    public $oauth_uid;
    public $locale;
    public $gender;
    public $profile_url;
    public $picture_url;
    public $add_by;
    public $update_by;

    /**
     * @return mixed
     */
    public function getUpdateBy()
    {
        return $this->update_by;
    }

    /**
     * @param mixed $update_by
     */
    public function setUpdateBy($update_by)
    {
        $this->update_by = $update_by;
    }


    /**
     * @return mixed
     */
    public function getAddBy()
    {
        return $this->add_by;
    }

    /**
     * @param mixed $add_by
     */
    public function setAddBy($add_by)
    {
        $this->add_by = $add_by;
    }


    /**
     * @return mixed
     */
    public function getAdminId()
    {
        return $this->admin_id;
    }

    /**
     * @param mixed $admin_id
     */
    public function setAdminId($admin_id)
    {
        $this->admin_id = $admin_id;
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
    public function getAdminFirstName()
    {
        return $this->admin_first_name;
    }

    /**
     * @param mixed $admin_first_name
     */
    public function setAdminFirstName($admin_first_name)
    {
        $this->admin_first_name = $admin_first_name;
    }

    /**
     * @return mixed
     */
    public function getAdminLastName()
    {
        return $this->admin_last_name;
    }

    /**
     * @param mixed $admin_last_name
     */
    public function setAdminLastName($admin_last_name)
    {
        $this->admin_last_name = $admin_last_name;
    }

    /**
     * @return mixed
     */
    public function getAdminEmail()
    {
        return $this->admin_email;
    }

    /**
     * @param mixed $admin_email
     */
    public function setAdminEmail($admin_email)
    {
        $this->admin_email = $admin_email;
    }

    /**
     * @return mixed
     */
    public function getFbUsername()
    {
        return $this->fb_username;
    }

    /**
     * @param mixed $fb_username
     */
    public function setFbUsername($fb_username)
    {
        $this->fb_username = $fb_username;
    }

    /**
     * @return mixed
     */
    public function getAdminPassword()
    {
        return $this->admin_password;
    }

    /**
     * @param mixed $admin_password
     */
    public function setAdminPassword($admin_password)
    {
        $this->admin_password = $admin_password;
    }

    /**
     * @return mixed
     */
    public function getFbAccessToken()
    {
        return $this->fb_access_token;
    }

    /**
     * @param mixed $fb_access_token
     */
    public function setFbAccessToken($fb_access_token)
    {
        $this->fb_access_token = $fb_access_token;
    }

    /**
     * @return mixed
     */
    public function getAdminStatus()
    {
        return $this->admin_status;
    }

    /**
     * @param mixed $admin_status
     */
    public function setAdminStatus($admin_status)
    {
        $this->admin_status = $admin_status;
    }

    /**
     * @return mixed
     */
    public function getFbAuthDate()
    {
        return $this->fb_auth_date;
    }

    /**
     * @param mixed $fb_auth_date
     */
    public function setFbAuthDate($fb_auth_date)
    {
        $this->fb_auth_date = $fb_auth_date;
    }

    /**
     * @return mixed
     */
    public function getFbAuthStatus()
    {
        return $this->fb_auth_status;
    }

    /**
     * @param mixed $fb_auth_status
     */
    public function setFbAuthStatus($fb_auth_status)
    {
        $this->fb_auth_status = $fb_auth_status;
    }

    /**
     * @return mixed
     */
    public function getOauthProvider()
    {
        return $this->oauth_provider;
    }

    /**
     * @param mixed $oauth_provider
     */
    public function setOauthProvider($oauth_provider)
    {
        $this->oauth_provider = $oauth_provider;
    }

    /**
     * @return mixed
     */
    public function getOauthUid()
    {
        return $this->oauth_uid;
    }

    /**
     * @param mixed $oauth_uid
     */
    public function setOauthUid($oauth_uid)
    {
        $this->oauth_uid = $oauth_uid;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getProfileUrl()
    {
        return $this->profile_url;
    }

    /**
     * @param mixed $profile_url
     */
    public function setProfileUrl($profile_url)
    {
        $this->profile_url = $profile_url;
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
     * Admins constructor.
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