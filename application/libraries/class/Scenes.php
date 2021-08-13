<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/15/17
 * Time: 1:32 PM
 */
class Scenes
{
    public $scenes_id;
    public $scenes_name;
    public $blurb;
    public $description;
    public $rewards;
    public $sponsor;
    public $sponsor_message;
    public $scene_image_url;
    public $scene_image_url_thumb;
    public $reward_image_url;
    public $reward_image_url_thumb;
    public $sponsor_image_url;
    public $sponsor_image_url_thumb;
    public $post_date;
    public $youtube_post_text;
    public $email_notification_text;
    public $facebook_text;
    public $twitter_text;
    public $instagram_text;
    public $rules;
    public $scene_status;
    public $campaign_id;
    public $admin_id;
    public $update_by;
    public $tags;
    public $campaign_difficulty_id;
    public $youtube_video;

    /**
     * @return mixed
     */
    public function getYoutubeVideo()
    {
        return $this->youtube_video;
    }

    /**
     * @param mixed $youtube_video
     */
    public function setYoutubeVideo($youtube_video)
    {
        $this->youtube_video = $youtube_video;
    }



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
    public function getSceneImageUrlThumb()
    {
        return $this->scene_image_url_thumb;
    }

    /**
     * @param mixed $scene_image_url_thumb
     */
    public function setSceneImageUrlThumb($scene_image_url_thumb)
    {
        $this->scene_image_url_thumb = $scene_image_url_thumb;
    }

    /**
     * @return mixed
     */
    public function getRewardImageUrlThumb()
    {
        return $this->reward_image_url_thumb;
    }

    /**
     * @param mixed $reward_image_url_thumb
     */
    public function setRewardImageUrlThumb($reward_image_url_thumb)
    {
        $this->reward_image_url_thumb = $reward_image_url_thumb;
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
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
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
    public function getScenesId()
    {
        return $this->scenes_id;
    }

    /**
     * @param mixed $scenes_id
     */
    public function setScenesId($scenes_id)
    {
        $this->scenes_id = $scenes_id;
    }

    /**
     * @return mixed
     */
    public function getScenesName()
    {
        return $this->scenes_name;
    }

    /**
     * @param mixed $scenes_name
     */
    public function setScenesName($scenes_name)
    {
        $this->scenes_name = $scenes_name;
    }

    /**
     * @return mixed
     */
    public function getBlurb()
    {
        return $this->blurb;
    }

    /**
     * @param mixed $blurb
     */
    public function setBlurb($blurb)
    {
        $this->blurb = $blurb;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getRewards()
    {
        return $this->rewards;
    }

    /**
     * @param mixed $rewards
     */
    public function setRewards($rewards)
    {
        $this->rewards = $rewards;
    }

    /**
     * @return mixed
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }

    /**
     * @param mixed $sponsor
     */
    public function setSponsor($sponsor)
    {
        $this->sponsor = $sponsor;
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
    public function getSceneImageUrl()
    {
        return $this->scene_image_url;
    }

    /**
     * @param mixed $scene_image_url
     */
    public function setSceneImageUrl($scene_image_url)
    {
        $this->scene_image_url = $scene_image_url;
    }

    /**
     * @return mixed
     */
    public function getRewardImageUrl()
    {
        return $this->reward_image_url;
    }

    /**
     * @param mixed $reward_image_url
     */
    public function setRewardImageUrl($reward_image_url)
    {
        $this->reward_image_url = $reward_image_url;
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
    public function getYoutubePostText()
    {
        return $this->youtube_post_text;
    }

    /**
     * @param mixed $youtube_post_text
     */
    public function setYoutubePostText($youtube_post_text)
    {
        $this->youtube_post_text = $youtube_post_text;
    }

    /**
     * @return mixed
     */
    public function getEmailNotificationText()
    {
        return $this->email_notification_text;
    }

    /**
     * @param mixed $email_notification_text
     */
    public function setEmailNotificationText($email_notification_text)
    {
        $this->email_notification_text = $email_notification_text;
    }

    /**
     * @return mixed
     */
    public function getFacebookText()
    {
        return $this->facebook_text;
    }

    /**
     * @param mixed $facebook_text
     */
    public function setFacebookText($facebook_text)
    {
        $this->facebook_text = $facebook_text;
    }

    /**
     * @return mixed
     */
    public function getTwitterText()
    {
        return $this->twitter_text;
    }

    /**
     * @param mixed $twitter_text
     */
    public function setTwitterText($twitter_text)
    {
        $this->twitter_text = $twitter_text;
    }

    /**
     * @return mixed
     */
    public function getInstagramText()
    {
        return $this->instagram_text;
    }

    /**
     * @param mixed $instagram_text
     */
    public function setInstagramText($instagram_text)
    {
        $this->instagram_text = $instagram_text;
    }

    /**
     * @return mixed
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param mixed $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    /**
     * @return mixed
     */
    public function getSceneStatus()
    {
        return $this->scene_status;
    }

    /**
     * @param mixed $scene_status
     */
    public function setSceneStatus($scene_status)
    {
        $this->scene_status = $scene_status;
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
     * Scenes constructor.
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