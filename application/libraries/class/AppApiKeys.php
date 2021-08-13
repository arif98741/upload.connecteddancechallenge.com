<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/15/17
 * Time: 1:04 PM
 */
class AppApiKeys
{
    public $application_id;
    public $application_name;
    public $application_platform;
    public $app_key;
    public $app_key_secret;

    /**
     * @return mixed
     */
    public function getApplicationId()
    {
        return $this->application_id;
    }

    /**
     * @param mixed $application_id
     */
    public function setApplicationId($application_id)
    {
        $this->application_id = $application_id;
    }

    /**
     * @return mixed
     */
    public function getApplicationName()
    {
        return $this->application_name;
    }

    /**
     * @param mixed $application_name
     */
    public function setApplicationName($application_name)
    {
        $this->application_name = $application_name;
    }

    /**
     * @return mixed
     */
    public function getApplicationPlatform()
    {
        return $this->application_platform;
    }

    /**
     * @param mixed $application_platform
     */
    public function setApplicationPlatform($application_platform)
    {
        $this->application_platform = $application_platform;
    }

    /**
     * @return mixed
     */
    public function getAppKey()
    {
        return $this->app_key;
    }

    /**
     * @param mixed $app_key
     */
    public function setAppKey($app_key)
    {
        $this->app_key = $app_key;
    }

    /**
     * @return mixed
     */
    public function getAppKeySecret()
    {
        return $this->app_key_secret;
    }

    /**
     * @param mixed $app_key_secret
     */
    public function setAppKeySecret($app_key_secret)
    {
        $this->app_key_secret = $app_key_secret;
    }


    /**
     * AppApiKeys constructor.
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