<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 8/31/17
 * Time: 4:10 PM
 */

class CampaignDifficulty
{
    public $campaign_difficulty_id;
    public $difficulty_name;
    public $campaign_id;
    public $difficulty_default_value;

    /**
     * @return mixed
     */
    public function getCampaignDifficultyId()
    {
        return $this->campaign_difficulty_id;
    }

    /**
     * @param mixed $campaign_difficulty_id
     */
    public function setCampaignDifficultyId($campaign_difficulty_id)
    {
        $this->campaign_difficulty_id = $campaign_difficulty_id;
    }

    /**
     * @return mixed
     */
    public function getDifficultyName()
    {
        return $this->difficulty_name;
    }

    /**
     * @param mixed $difficulty_name
     */
    public function setDifficultyName($difficulty_name)
    {
        $this->difficulty_name = $difficulty_name;
    }

    /**
     * @return mixed
     */
    public function getCampaignId()
    {
        return $this->campaign_id;
    }

    /**
     * @param mixed $campaign_id
     */
    public function setCampaignId($campaign_id)
    {
        $this->campaign_id = $campaign_id;
    }

    /**
     * @return mixed
     */
    public function getDifficultyDefaultValue()
    {
        return $this->difficulty_default_value;
    }

    /**
     * @param mixed $difficulty_default_value
     */
    public function setDifficultyDefaultValue($difficulty_default_value)
    {
        $this->difficulty_default_value = $difficulty_default_value;
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