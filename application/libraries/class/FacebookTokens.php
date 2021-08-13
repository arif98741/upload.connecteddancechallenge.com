<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/15/17
 * Time: 1:07 PM
 */
class FacebookTokens
{
    public $user_id;
    public $entry_date;
    public $fb_numeric_id;
    public $fb_username;
    public $fb_token;
    public $fb_token_secret;
    public $fb_auth_date;
    public $fb_auth_status;

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
    public function getFbNumericId()
    {
        return $this->fb_numeric_id;
    }

    /**
     * @param mixed $fb_numeric_id
     */
    public function setFbNumericId($fb_numeric_id)
    {
        $this->fb_numeric_id = $fb_numeric_id;
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
    public function getFbToken()
    {
        return $this->fb_token;
    }

    /**
     * @param mixed $fb_token
     */
    public function setFbToken($fb_token)
    {
        $this->fb_token = $fb_token;
    }

    /**
     * @return mixed
     */
    public function getFbTokenSecret()
    {
        return $this->fb_token_secret;
    }

    /**
     * @param mixed $fb_token_secret
     */
    public function setFbTokenSecret($fb_token_secret)
    {
        $this->fb_token_secret = $fb_token_secret;
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
     * facebookTokens constructor.
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