<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 8/29/17
 * Time: 4:26 PM
 */

class SocialCounts
{

    public $social_count_id;
    public $yt_view;
    public $yt_like;
    public $yt_dislike;
    public $yt_comment;
    public $fb_view;
    public $fb_like;
    public $fb_comment;
    public $tw_like;
    public $tw_retweet;
    public $tw_comment;
    public $update_time;
    public $is_update;
    public $video_published_id;

    /**
     * @return mixed
     */
    public function getSocialCountId()
    {
        return $this->social_count_id;
    }

    /**
     * @param mixed $social_count_id
     */
    public function setSocialCountId($social_count_id)
    {
        $this->social_count_id = $social_count_id;
    }

    /**
     * @return mixed
     */
    public function getYtView()
    {
        return $this->yt_view;
    }

    /**
     * @param mixed $yt_view
     */
    public function setYtView($yt_view)
    {
        $this->yt_view = $yt_view;
    }

    /**
     * @return mixed
     */
    public function getYtLike()
    {
        return $this->yt_like;
    }

    /**
     * @param mixed $yt_like
     */
    public function setYtLike($yt_like)
    {
        $this->yt_like = $yt_like;
    }

    /**
     * @return mixed
     */
    public function getYtDislike()
    {
        return $this->yt_dislike;
    }

    /**
     * @param mixed $yt_dislike
     */
    public function setYtDislike($yt_dislike)
    {
        $this->yt_dislike = $yt_dislike;
    }

    /**
     * @return mixed
     */
    public function getYtComment()
    {
        return $this->yt_comment;
    }

    /**
     * @param mixed $yt_comment
     */
    public function setYtComment($yt_comment)
    {
        $this->yt_comment = $yt_comment;
    }

    /**
     * @return mixed
     */
    public function getFbView()
    {
        return $this->fb_view;
    }

    /**
     * @param mixed $fb_view
     */
    public function setFbView($fb_view)
    {
        $this->fb_view = $fb_view;
    }

    /**
     * @return mixed
     */
    public function getFbLike()
    {
        return $this->fb_like;
    }

    /**
     * @param mixed $fb_like
     */
    public function setFbLike($fb_like)
    {
        $this->fb_like = $fb_like;
    }

    /**
     * @return mixed
     */
    public function getFbComment()
    {
        return $this->fb_comment;
    }

    /**
     * @param mixed $fb_comment
     */
    public function setFbComment($fb_comment)
    {
        $this->fb_comment = $fb_comment;
    }

    /**
     * @return mixed
     */
    public function getTwLike()
    {
        return $this->tw_like;
    }

    /**
     * @param mixed $tw_like
     */
    public function setTwLike($tw_like)
    {
        $this->tw_like = $tw_like;
    }

    /**
     * @return mixed
     */
    public function getTwRetweet()
    {
        return $this->tw_retweet;
    }

    /**
     * @param mixed $tw_retweet
     */
    public function setTwRetweet($tw_retweet)
    {
        $this->tw_retweet = $tw_retweet;
    }

    /**
     * @return mixed
     */
    public function getTwComment()
    {
        return $this->tw_comment;
    }

    /**
     * @param mixed $tw_comment
     */
    public function setTwComment($tw_comment)
    {
        $this->tw_comment = $tw_comment;
    }

    /**
     * @return mixed
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * @param mixed $update_time
     */
    public function setUpdateTime($update_time)
    {
        $this->update_time = $update_time;
    }

    /**
     * @return mixed
     */
    public function getisUpdate()
    {
        return $this->is_update;
    }

    /**
     * @param mixed $is_update
     */
    public function setIsUpdate($is_update)
    {
        $this->is_update = $is_update;
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