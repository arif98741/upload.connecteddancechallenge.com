<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/15/17
 * Time: 1:52 PM
 */
class TwitterTokens
{
    public $user_id;
    public $entry_date;
    public $twitter_numeric_id;
    public $twitter_screen_name;
    public $twitter_token;
    public $twitter_token_secret;
    public $twitter_auth_date;
    public $twitter_auth_status;

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
    public function getTwitterNumericId()
    {
        return $this->twitter_numeric_id;
    }

    /**
     * @param mixed $twitter_numeric_id
     */
    public function setTwitterNumericId($twitter_numeric_id)
    {
        $this->twitter_numeric_id = $twitter_numeric_id;
    }

    /**
     * @return mixed
     */
    public function getTwitterScreenName()
    {
        return $this->twitter_screen_name;
    }

    /**
     * @param mixed $twitter_screen_name
     */
    public function setTwitterScreenName($twitter_screen_name)
    {
        $this->twitter_screen_name = $twitter_screen_name;
    }

    /**
     * @return mixed
     */
    public function getTwitterToken()
    {
        return $this->twitter_token;
    }

    /**
     * @param mixed $twitter_token
     */
    public function setTwitterToken($twitter_token)
    {
        $this->twitter_token = $twitter_token;
    }

    /**
     * @return mixed
     */
    public function getTwitterTokenSecret()
    {
        return $this->twitter_token_secret;
    }

    /**
     * @param mixed $twitter_token_secret
     */
    public function setTwitterTokenSecret($twitter_token_secret)
    {
        $this->twitter_token_secret = $twitter_token_secret;
    }

    /**
     * @return mixed
     */
    public function getTwitterAuthDate()
    {
        return $this->twitter_auth_date;
    }

    /**
     * @param mixed $twitter_auth_date
     */
    public function setTwitterAuthDate($twitter_auth_date)
    {
        $this->twitter_auth_date = $twitter_auth_date;
    }

    /**
     * @return mixed
     */
    public function getTwitterAuthStatus()
    {
        return $this->twitter_auth_status;
    }

    /**
     * @param mixed $twitter_auth_status
     */
    public function setTwitterAuthStatus($twitter_auth_status)
    {
        $this->twitter_auth_status = $twitter_auth_status;
    }

    /**
     * TwitterTokens constructor.
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
