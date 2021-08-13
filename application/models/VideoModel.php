<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 5/16/17
 * Time: 11:35 AM
 */
class VideoModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getYoutubeVideoDownloadLink($videoId){
        $this->load->library('YouTubeDownloader/GetVideo');
        $yd=new GetVideo();
        $link=$yd->downloadLink($videoId);
        /*print_r($link);
        exit();*/
        return $link;
    }

    public function saveYTVideo($videoId){

        $link=$this->getYoutubeVideoDownloadLink($videoId);

        if($link!=false){
            $file=file_put_contents('video/'.$videoId,file_get_contents($link));
            if($file!=null){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function deleteYTVideoFromDrive($videoId){
        return unlink('video/'.$videoId);
    }

}