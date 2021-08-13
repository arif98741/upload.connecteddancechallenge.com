<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/20/17
 * Time: 2:55 PM
 */
class DLModel extends CI_Model
{

    /**
     * DLModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function insertCampaigns($campaigns){
        return $this->db->insert('campaigns',$campaigns);
    }
    public function deleteCampaignByCampaignId($campaignId){
         return $this->db->query('DELETE FROM campaigns WHERE campaign_id=?',array($campaignId));
    }
    public function getCampaignsList(){
        $sql="SELECT * FROM campaigns ORDER BY campaign_id DESC ";
        return $this->db->query($sql)->result_array();
    }
    public function getCampaignsByCampaignsId($campaignId){
        $sql="SELECT * FROM campaigns WHERE campaign_id=?";
        return $this->db->query($sql,array($campaignId))->result_array();
    }
    public function updateCampaignStatusByCampaignId($campaignId,$status,$userId){
        $sql="UPDATE campaigns SET campaign_status=?,update_by=? WHERE campaign_id=?";
        return $this->db->query($sql,array($status,$userId,$campaignId));
    }
    public function updateCampaignsByCampaignsId($campaignsData,$campaignsId){
        return $this->db->update('campaigns',$campaignsData,array('campaign_id'=>$campaignsId));
    }
    public function updateCampaignImageInCampaignsByCampaignId($campaignId,$imageUrl,$imageUrlThumb){
        $sql="UPDATE campaigns SET campaign_image_url=?,campaign_image_url_thumb=? WHERE campaign_id=?";
        return $this->db->query($sql,array($imageUrl,$imageUrlThumb,$campaignId));
    }
    public function updateCampaignSponsorImageInCampaignsByCampaignId($campaignId,$imageUrl,$imageUrlThumb){
        $sql="UPDATE campaigns SET sponsor_image_url=?,sponsor_image_url_thumb=? WHERE campaign_id=?";
        return $this->db->query($sql,array($imageUrl,$imageUrlThumb,$campaignId));
    }
    public function getCampaignsBasicDetail(){
        $sql="SELECT campaign_id,campaign_name FROM campaigns";
        return $this->db->query($sql)->result_array();
    }


    public function insertScenes($scenes){
        return $this->db->insert('scenes',$scenes);
    }
    public function deleteScenesByScenesId($scenesId){
        return $this->db->query('DELETE FROM scenes WHERE scenes_id=?',array($scenesId));
    }
    public function updateScenesStatusByScenesId($scenesId,$status,$userId){
        $sql="UPDATE scenes SET scene_status=?,update_by=? WHERE scenes_id=?";
        return $this->db->query($sql,array($status,$userId,$scenesId));
    }
    public function getScenesList(){
        $sql="SELECT * FROM scenes ORDER BY scenes_id DESC ";
        return $this->db->query($sql)->result_array();
    }
    public function getScenesListByStatus($status){
        $sql="SELECT * FROM scenes WHERE scene_status=? ORDER BY scenes_id DESC ";
        return $this->db->query($sql,$status)->result_array();
    }

    public function getScenesCampaignListByStatus($status){
        $sql="SELECT s.*,c.campaign_name FROM scenes s
              LEFT JOIN campaigns c on c.campaign_id=s.campaign_id
              WHERE scene_status=? ORDER BY scenes_id DESC ";
        return $this->db->query($sql,$status)->result_array();
    }

    public function getScenesByScenesId($scenesId){
        $sql="SELECT * FROM scenes WHERE scenes_id=?";
        return $this->db->query($sql,array($scenesId))->result_array();
    }

    public function getScenesAndCampaignBasicInfoByScenesId($scenesId){
        $sql="SELECT s.*,c.hash_tag,c.campaign_name FROM scenes s LEFT JOIN campaigns c ON c.campaign_id=s.campaign_id WHERE s.scenes_id=?";
        return $this->db->query($sql,array($scenesId))->result_array();
    }
    public function updateScenesByScenesId($scenesData,$scenesId){
        return $this->db->update('scenes',$scenesData,array('scenes_id'=>$scenesId));
    }
    public function updateScenesSponsorImageInScenesByScenesId($scenesId,$imageUrl,$thumbPath){
        $sql="UPDATE scenes SET sponsor_image_url=?,sponsor_image_url_thumb=? WHERE scenes_id=?";
        return $this->db->query($sql,array($imageUrl,$thumbPath,$scenesId));
    }
    public function updateScenesScenesImageInScenesByScenesId($scenesId,$imageUrl,$thumbPath){
        $sql="UPDATE scenes SET scene_image_url=?,scene_image_url_thumb=? WHERE scenes_id=?";
        return $this->db->query($sql,array($imageUrl,$thumbPath,$scenesId));
    }
    public function updateScenesRewardImageInScenesByScenesId($scenesId,$imageUrl,$thumbPath){
        $sql="UPDATE scenes SET reward_image_url=?,reward_image_url_thumb=? WHERE scenes_id=?";
        return $this->db->query($sql,array($imageUrl,$thumbPath,$scenesId));
    }
    public function getScenesBasicByCampaignId($campaignId){
        $sql="SELECT s.*,c.campaign_name FROM scenes s
              LEFT JOIN campaigns c on c.campaign_id=s.campaign_id
              WHERE s.campaign_id=?";
        return $this->db->query($sql,array($campaignId))->result_array();
    }


    public function insertAdmin($admin){
        return $this->db->insert('admins',$admin);
    }
    public function getAdminByAdminEmail($email){
        $sql="SELECT * FROM admins WHERE admin_email=?";
        return $this->db->query($sql,array($email))->result_array();
    }
    public function updateAdminByAdminId($admin){
        return $this->db->update('admins',$admin,array('admin_id'=>$admin->getAdminId()));
    }
    public function getAdminList(){
        $sql="SELECT * FROM admins ORDER BY admin_id DESC ";
        return $this->db->query($sql)->result_array();
    }
    public function updateAdminStatus($adminId,$status,$updateBy){
        $sql="UPDATE admins SET admin_status=?,update_by=? WHERE admin_id=?";
        return $this->db->query($sql,array($status,$updateBy,$adminId));
    }
    public function updateAdminOauthStatus($adminId,$status,$updateBy){
        $sql="UPDATE admins SET fb_auth_status=?,update_by=? WHERE admin_id=?";
        return $this->db->query($sql,array($status,$updateBy,$adminId));
    }

    public function insertUser($user){
        return $this->db->insert('users',$user);
    }
    public function getUserByUserEmail($userEmail){
        $sql="SELECT * FROM users WHERE user_email=?";
        return $this->db->query($sql,array($userEmail))->result_array();
    }
    public function updateUserByUserId(Users $user){
        return $this->db->update('users',$user,array('user_id'=>$user->getUserId()));
    }
    public function getUserByUserId($userId){
        $sql="SELECT * FROM users WHERE user_id=?";
        return $this->db->query($sql,array($userId))->result_array();
    }
    public function getAllUsers(){
        $sql="SELECT * FROM users";
        return $this->db->query($sql)->result_array();
    }
    public function getUserWhereRefreshTokenNotNull(){
        $refreshToken='';
        return $this->db->query('SELECT * FROM users WHERE refresh_token is NOT NULL AND refresh_token!=?',array($refreshToken))->result_array();
    }

    public function insertScheduleVideos($scheduleVideo){
        return $this->db->insert('scheduled_videos',$scheduleVideo);
    }
    public function updateScheduleVideos($scheduleVideo){
        return $this->db->update('scheduled_videos',$scheduleVideo,array('video_schedule_id'=>$scheduleVideo->getVideoScheduleId()));
    }
    public function getScheduleVideoByVideoPublishId($videoPublishId){
        $sql="SELECT * FROM scheduled_videos WHERE video_published_id=?";
        return $this->db->query($sql,array($videoPublishId))->result_array();
    }
    public function updateFacebookPostStatusByVideoScheduleId($videoScheduleId,$status){
        $sql="UPDATE scheduled_videos SET facebook_post_status=? WHERE video_schedule_id=?";
        return $this->db->query($sql,array($status,$videoScheduleId));
    }
    public function updateFacebookPostTextByVideoScheduleId($videoScheduleId,$fbText){
        $sql="UPDATE scheduled_videos SET facebook_text=? WHERE video_schedule_id=?";
        return $this->db->query($sql,array($fbText,$videoScheduleId));
    }
    public function updateTwitterPostStatusByVideoScheduleId($videoScheduleId,$status){
        $sql="UPDATE scheduled_videos SET twitter_post_status=? WHERE video_schedule_id=?";
        return $this->db->query($sql,array($status,$videoScheduleId));
    }


    public function getFacebookTokenByUserId($userId){
        $sql="SELECT * FROM facebook_tokens WHERE user_id=?";
        return $this->db->query($sql,array($userId))->result_array();
    }
    public function insertFacebookTokens($facebookToken){
        return $this->db->insert('facebook_tokens',$facebookToken);
    }
    public function updateFacebookTokensByUserId($facebookToken){
        return $this->db->update('facebook_tokens',$facebookToken,array('user_id'=>$facebookToken->getUserId()));
    }
    public function removeFacebookTokenByUserId($userId){
        $sql="UPDATE  facebook_tokens SET fb_token=NULL,fb_auth_status='inactive'  WHERE user_id=?";
        return $this->db->query($sql,array($userId));
    }

    public function getTwitterTokenByUserId($userId){
        $sql="SELECT * FROM twitter_tokens WHERE user_id=?";
        return $this->db->query($sql,array($userId))->result_array();
    }
    public function insertTwitterTokens($twitterToken){
        return $this->db->insert('twitter_tokens',$twitterToken);
    }
    public function updateTwitterTokensByUserId($twitterToken){
        return $this->db->update('twitter_tokens',$twitterToken,array('user_id'=>$twitterToken->getUserId()));
    }
    public function removeTwitterTonekByUserId($userId){
        $sql="UPDATE  twitter_tokens SET twitter_token=NULL ,twitter_token_secret=NULL,twitter_auth_status='inactive' WHERE user_id=?";
        return $this->db->query($sql,array($userId));
    }

    public function getScheduledVideosForPublishStatus($currentDate){
        $sql="SELECT * FROM scheduled_videos WHERE (video_publish_date < ? AND ((publish_status!='public' AND publish_status !='deleted' AND publish_status!='revoke') OR publish_status IS NULL OR publish_status='')) AND (email_notification_status IS NULL OR email_notification_status='')LIMIT 5";
        return $this->db->query($sql,array($currentDate))->result_array();
    }

    public function getScheduleVideoForPostAndMail($currentDate){
        $sql="SELECT * FROM scheduled_videos WHERE (video_publish_date < ?) AND ((email_notification_status IS NULL OR email_notification_status='' ) AND publish_status='public' AND video_download_status != -1) LIMIT 1";
        return $this->db->query($sql,array($currentDate))->result_array();
    }

    public function getScheduleVideoForDownload($currentDate){
        $sql="SELECT * FROM scheduled_videos WHERE (video_publish_date < ?) AND (facebook_post_status='0' AND publish_status='public' ) AND video_download_status is NULL LIMIT 1";
        return $this->db->query($sql,array($currentDate))->result_array();
    }

    public function getScheduleVideoCount(){
        return $this->db->query("select count(*) as 'count'  from scheduled_videos")->result_array();
    }

    /*public function updateVideoDownloadStatusInScheduleVideo($videoId,$status){
        $sql="UPDATE scheduled_videos SET video_download_status=? WHERE video_schedule_id=?";
        return $this->db->query($sql,array($status,$videoId));
    }*/

    public function getScheduledVideoByScenesId($scenesId){
        $sql='SELECT * FROM scheduled_videos WHERE scenes_id=?';
        return $this->db->query($sql,array($scenesId))->result_array();
    }

    public function getSocialInfoByScenesId($scenesId){
        $sql="SELECT u.user_id,u.youtube_username,u.picture_url,s.scenes_id,s.scenes_name,sv.video_schedule_id,sv.video_published_id,sv.video_title,sv.twitter_response_id,sv.facebook_response,sc.fb_like,sc.tw_like,sc.yt_like,(if(fb_like is NOT NULL ,fb_like,0) + if(tw_like IS NOT NULL ,tw_like,0) + if(yt_like IS NOT NULL ,yt_like,0)) as 'total_likes',sc.fb_view,sc.yt_view,(if(fb_view is NOT NULL ,fb_view,0)  + if(yt_view IS NOT NULL ,yt_view,0)) as 'total_view', fbt.fb_numeric_id,twt.twitter_numeric_id
FROM scheduled_videos sv
LEFT JOIN social_counts sc ON sv.video_published_id=sc.video_published_id
LEFT JOIN users u ON sv.user_id=u.user_id
LEFT JOIN scenes s ON sv.scenes_id=s.scenes_id
LEFT JOIN facebook_tokens fbt ON fbt.user_id=sv.user_id
LEFT JOIN twitter_tokens twt ON twt.user_id=sv.user_id
WHERE sv.scenes_id=?
ORDER BY total_likes DESC ";
        return $this->db->query($sql,array($scenesId))->result_array();
    }

    public function getSocialInfoByCampaignId($campaignId){
        $sql="SELECT u.user_id,u.youtube_username,u.picture_url,s.scenes_id,s.scenes_name,sv.video_schedule_id,sv.video_published_id,sv.video_title,sv.twitter_response_id,sv.facebook_response,sc.fb_like,sc.tw_like,sc.yt_like,(if(fb_like is NOT NULL ,fb_like,0) + if(tw_like IS NOT NULL ,tw_like,0) + if(yt_like IS NOT NULL ,yt_like,0)) as 'total_likes',sc.fb_view,sc.yt_view,(if(fb_view is NOT NULL ,fb_view,0)  + if(yt_view IS NOT NULL ,yt_view,0)) as 'total_view', fbt.fb_numeric_id,twt.twitter_numeric_id
FROM scheduled_videos sv
LEFT JOIN social_counts sc ON sv.video_published_id=sc.video_published_id
LEFT JOIN users u ON sv.user_id=u.user_id
LEFT JOIN scenes s ON sv.scenes_id=s.scenes_id
LEFT JOIN facebook_tokens fbt ON fbt.user_id=sv.user_id
LEFT JOIN twitter_tokens twt ON twt.user_id=sv.user_id
LEFT JOIN campaigns c ON c.campaign_id=s.campaign_id
WHERE s.campaign_id=?
ORDER BY total_likes DESC ";
        return $this->db->query($sql,array($campaignId))->result_array();
    }

    public function getSocialViewInfoByCampaignId($campaignId){
        $sql="SELECT c.campaign_id,c.campaign_name,sc.fb_view,sc.yt_view,(if(fb_view is NOT NULL ,fb_view,0)  + if(yt_view IS NOT NULL ,yt_view,0)) as 'total_view',sc.fb_like,sc.tw_like,sc.yt_like,(if(fb_like is NOT NULL ,fb_like,0) + if(tw_like IS NOT NULL ,tw_like,0) + if(yt_like IS NOT NULL ,yt_like,0)) as 'total_likes'
FROM scheduled_videos sv
  LEFT JOIN social_counts sc ON sv.video_published_id=sc.video_published_id
  LEFT JOIN scenes s ON sv.scenes_id=s.scenes_id
  LEFT JOIN campaigns c on c.campaign_id=s.campaign_id
WHERE c.campaign_id=?";
        return $this->db->query($sql,array($campaignId))->result_array();
    }

    public function getSocialViewInfoByScenesId($scenesId){
        $sql="SELECT s.scenes_id,s.scenes_name,sc.fb_view,sc.yt_view,(if(fb_view is NOT NULL ,fb_view,0)  + if(yt_view IS NOT NULL ,yt_view,0)) as 'total_view' ,sc.fb_like,sc.tw_like,sc.yt_like,(if(fb_like is NOT NULL ,fb_like,0) + if(tw_like IS NOT NULL ,tw_like,0) + if(yt_like IS NOT NULL ,yt_like,0)) as 'total_likes'
FROM scheduled_videos sv
  LEFT JOIN social_counts sc ON sv.video_published_id=sc.video_published_id
  LEFT JOIN scenes s ON sv.scenes_id=s.scenes_id
WHERE s.scenes_id=?";
        return $this->db->query($sql,array($scenesId))->result_array();
    }

    public function getScenesByUserId($userId){
        $sql="SELECT s.* from scenes s
LEFT JOIN scheduled_videos sv ON sv.scenes_id=s.scenes_id
WHERE user_id=?
GROUP BY s.scenes_id";
        return $this->db->query($sql,array($userId))->result_array();
    }

    public function getCampaignByScanesId($scenesId){
        $sql="SELECT * FROM campaigns c 
                LEFT JOIN scenes s ON s.campaign_id=c.campaign_id 
                WHERE s.scenes_id=?
                GROUP by c.campaign_id";
        return $this->db->query($sql,array($scenesId))->result_array();
    }
    public function insertIntoSocialCounts(SocialCounts $socialCounts){
        return $this->db->insert('social_counts',$socialCounts);
    }

    public function updateSocialCounts(SocialCounts $socialCounts){
        return $this->db->update('social_counts',$socialCounts,array('social_count_id'=>$socialCounts->getSocialCountId()));
    }

    public function insertCampaignDifficulty(CampaignDifficulty $campaignDifficulty){
        return $this->db->insert('campaign_difficulty',$campaignDifficulty);
    }
    public function getCampaignDifficultyByCampaignId($campaignId){
        $sql="SELECT * FROM campaign_difficulty WHERE campaign_id=? ORDER BY difficulty_default_value";
        return $this->db->query($sql,array($campaignId))->result_array();
    }
    public function updateCampaignDifficulty(CampaignDifficulty $campaignDifficulty){
        return $this->db->update('campaign_difficulty',$campaignDifficulty,array('campaign_difficulty_id'=>$campaignDifficulty->getCampaignDifficultyId()));
    }

    public function getCampaignDifficultyByCampaignIdAndNameNotNull($campaignId){
        $sql="SELECT * FROM campaign_difficulty WHERE campaign_id=? AND (difficulty_name IS NOT NULL AND difficulty_name!='')";
        return $this->db->query($sql,array($campaignId))->result_array();
    }

    public function insertInfusionsoftToken(InfusionsoftToken $infusionsoftToken){
        return $this->db->insert('infusionsoft_token',$infusionsoftToken);
    }

    public function getInfusionsoftTokenById($id){
        return $this->db->query('SELECT * FROM infusionsoft_token WHERE infusion_id=?',array($id))->result_array();
    }

    public function updateInfusionsoftToken(InfusionsoftToken $infusionsoftToken){
        return $this->db->update('infusionsoft_token',$infusionsoftToken);
    }

    public function getCampaignChallengeBasicInfoByScenesId($scenesId){
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $scenesData=$dlModel->getScenesAndCampaignBasicInfoByScenesId($scenesId);
        if(count($scenesData)==1){
            $this->load->library('class/Scenes');
            $scenes=new Scenes($scenesData[0]);
            if(isset($_SESSION['p_date'])){
                $scenes->setPostDate($_SESSION['p_date']);
            }
            $date=date_format(date_create($scenes->getPostDate()),'Y-m-d\TH:i:s.Z\Z');
            $scenes->setPostDate($date);

            $data['result']=true;
            $data['scenes']=$scenes;
            $data['scenes']=get_object_vars($scenes);
            $data['scenes']['campaign_name']=$scenesData[0]['campaign_name'];
            $data['scenes']['hash_tag']=$scenesData[0]['hash_tag'];

        }else{
            $data['result']=false;
        }

        return $data;
    }


}