<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 9/19/17
 * Time: 1:24 PM
 */

class InfusionsoftToken
{
    public $infusion_id;
    public $token;
    public $auth_date;
    public $auth_by;

    /**
     * @return mixed
     */
    public function getInfusionId()
    {
        return $this->infusion_id;
    }

    /**
     * @param mixed $infusion_id
     */
    public function setInfusionId($infusion_id)
    {
        $this->infusion_id = $infusion_id;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getAuthDate()
    {
        return $this->auth_date;
    }

    /**
     * @param mixed $auth_date
     */
    public function setAuthDate($auth_date)
    {
        $this->auth_date = $auth_date;
    }

    /**
     * @return mixed
     */
    public function getAuthBy()
    {
        return $this->auth_by;
    }

    /**
     * @param mixed $auth_by
     */
    public function setAuthBy($auth_by)
    {
        $this->auth_by = $auth_by;
    }

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