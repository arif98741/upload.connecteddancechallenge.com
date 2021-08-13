<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/15/17
 * Time: 1:05 PM
 */
class Campaigns
{
    public $campaign_id;
    public $campaign_name;
    public $short_description;
    public $long_description;
    public $start_date;
    public $end_date;
    public $post_date;
    public $sponsor_name;
    public $sponsor_message;
    public $sponsor_image_url;
    public $sponsor_image_url_thumb;
    public $campaign_image_url;
    public $campaign_image_url_thumb;
    public $entry_date;
    public $campaign_status;
    public $admin_id;
    public $hash_tag;

    /**
     * @return mixed
     */
    public function getHashTag()
    {
        return $this->hash_tag;
    }

    /**
     * @param mixed $hash_tag
     */
    public function setHashTag($hash_tag)
    {
        $this->hash_tag = $hash_tag;
    }



    /**
     * @return mixed
     */
    public function getSponsorImageUrlThumb()
    {
        return $this->sponsor_image_url_thumb;
    }

    /**
     * @param mixed $sponsor_image_url_thumb
     */
    public function setSponsorImageUrlThumb($sponsor_image_url_thumb)
    {
        $this->sponsor_image_url_thumb = $sponsor_image_url_thumb;
    }

    /**
     * @return mixed
     */
    public function getCampaignImageUrlThumb()
    {
        return $this->campaign_image_url_thumb;
    }

    /**
     * @param mixed $campaign_image_url_thumb
     */
    public function setCampaignImageUrlThumb($campaign_image_url_thumb)
    {
        $this->campaign_image_url_thumb = $campaign_image_url_thumb;
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
    public function getCampaignName()
    {
        return $this->campaign_name;
    }

    /**
     * @param mixed $campaign_name
     */
    public function setCampaignName($campaign_name)
    {
        $this->campaign_name = $campaign_name;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->short_description;
    }

    /**
     * @param mixed $short_description
     */
    public function setShortDescription($short_description)
    {
        $this->short_description = $short_description;
    }

    /**
     * @return mixed
     */
    public function getLongDescription()
    {
        return $this->long_description;
    }

    /**
     * @param mixed $long_description
     */
    public function setLongDescription($long_description)
    {
        $this->long_description = $long_description;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * @param mixed $start_date
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * @param mixed $end_date
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
    }

    /**
     * @return mixed
     */
    public function getPostDate()
    {
        return $this->post_date;
    }

    /**
     * @param mixed $post_date
     */
    public function setPostDate($post_date)
    {
        $this->post_date = $post_date;
    }

    /**
     * @return mixed
     */
    public function getSponsorName()
    {
        return $this->sponsor_name;
    }

    /**
     * @param mixed $sponsor_name
     */
    public function setSponsorName($sponsor_name)
    {
        $this->sponsor_name = $sponsor_name;
    }

    /**
     * @return mixed
     */
    public function getSponsorMessage()
    {
        return $this->sponsor_message;
    }

    /**
     * @param mixed $sponsor_message
     */
    public function setSponsorMessage($sponsor_message)
    {
        $this->sponsor_message = $sponsor_message;
    }

    /**
     * @return mixed
     */
    public function getSponsorImageUrl()
    {
        return $this->sponsor_image_url;
    }

    /**
     * @param mixed $sponsor_image_url
     */
    public function setSponsorImageUrl($sponsor_image_url)
    {
        $this->sponsor_image_url = $sponsor_image_url;
    }

    /**
     * @return mixed
     */
    public function getCampaignImageUrl()
    {
        return $this->campaign_image_url;
    }

    /**
     * @param mixed $campaign_image_url
     */
    public function setCampaignImageUrl($campaign_image_url)
    {
        $this->campaign_image_url = $campaign_image_url;
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
    public function getCampaignStatus()
    {
        return $this->campaign_status;
    }

    /**
     * @param mixed $campaign_status
     */
    public function setCampaignStatus($campaign_status)
    {
        $this->campaign_status = $campaign_status;
    }


    /**
     * Campaigns constructor.
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