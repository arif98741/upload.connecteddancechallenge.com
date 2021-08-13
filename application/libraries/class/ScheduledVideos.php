<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/15/17
 * Time: 1:33 PM
 */
class ScheduledVideos
{
    public $video_schedule_id;
    public $video_publish_date;
    public $video_published_id;
    public $entry_date;
    public $user_id;
    public $campaign_id;
    public $scenes_id;
    public $youtube_post_text;
    public $email_notification_text;
    public $facebook_text;
    public $twitter_text;
    public $instagram_text;
    public $facebook_post_status;
    public $twitter_post_status;
    public $email_notification_status;
    public $publish_status;
    public $twitter_response;
    public $facebook_response;
    public $video_download_status;
    public $video_title;
    public $tags;
    public $twitter_response_id;

    /**
     * @return mixed
     */
    public function getTwitterResponseId()
    {
        return $this->twitter_response_id;
    }

    /**
     * @param mixed $twitter_response_id
     */
    public function setTwitterResponseId($twitter_response_id)
    {
        $this->twitter_response_id = $twitter_response_id;
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
    public function getVideoTitle()
    {
        return $this->video_title;
    }

    /**
     * @param mixed $video_title
     */
    public function setVideoTitle($video_title)
    {
        $this->video_title = $video_title;
    }



    /**
     * @return mixed
     */
    public function getVideoDownloadStatus()
    {
        return $this->video_download_status;
    }

    /**
     * @param mixed $video_download_status
     */
    public function setVideoDownloadStatus($video_download_status)
    {
        $this->video_download_status = $video_download_status;
    }



    /**
     * @return mixed
     */
    public function getTwitterResponse()
    {
        return $this->twitter_response;
    }

    /**
     * @param mixed $twitter_response
     */
    public function setTwitterResponse($twitter_response)
    {
        $this->twitter_response = $twitter_response;
    }

    /**
     * @return mixed
     */
    public function getFacebookResponse()
    {
        return $this->facebook_response;
    }

    /**
     * @param mixed $facebook_response
     */
    public function setFacebookResponse($facebook_response)
    {
        $this->facebook_response = $facebook_response;
    }



    /**
     * @return mixed
     */
    public function getPublishStatus()
    {
        return $this->publish_status;
    }

    /**
     * @param mixed $publish_status
     */
    public function setPublishStatus($publish_status)
    {
        $this->publish_status = $publish_status;
    }



    /**
     * @return mixed
     */
    public function getVideoScheduleId()
    {
        return $this->video_schedule_id;
    }

    /**
     * @param mixed $video_schedule_id
     */
    public function setVideoScheduleId($video_schedule_id)
    {
        $this->video_schedule_id = $video_schedule_id;
    }

    /**
     * @return mixed
     */
    public function getVideoPublishDate()
    {
        return $this->video_publish_date;
    }

    /**
     * @param mixed $video_publish_date
     */
    public function setVideoPublishDate($video_publish_date)
    {
        $this->video_publish_date = $video_publish_date;
    }

    /**
     * @return mixed
     */
    public function getVideoPublishedId()
    {
        return $this->video_published_id;
    }

    /**
     * @param mixed $video_published_id
     */
    public function setVideoPublishedId($video_published_id)
    {
        $this->video_published_id = $video_published_id;
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
    public function getFacebookPostStatus()
    {
        return $this->facebook_post_status;
    }

    /**
     * @param mixed $facebook_post_status
     */
    public function setFacebookPostStatus($facebook_post_status)
    {
        $this->facebook_post_status = $facebook_post_status;
    }

    /**
     * @return mixed
     */
    public function getTwitterPostStatus()
    {
        return $this->twitter_post_status;
    }

    /**
     * @param mixed $twitter_post_status
     */
    public function setTwitterPostStatus($twitter_post_status)
    {
        $this->twitter_post_status = $twitter_post_status;
    }

    /**
     * @return mixed
     */
    public function getEmailNotificationStatus()
    {
        return $this->email_notification_status;
    }

    /**
     * @param mixed $email_notification_status
     */
    public function setEmailNotificationStatus($email_notification_status)
    {
        $this->email_notification_status = $email_notification_status;
    }


    /**
     * ScheduledVideos constructor.
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