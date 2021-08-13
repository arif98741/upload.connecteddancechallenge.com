<?php
if(isset($scenesData)){
    $scenes=new Scenes($scenesData);
}else{
    $scenes=new Scenes();
}


?>

<form id="scenesForm" class="form-horizontal" enctype="multipart/form-data">
    <input type="hidden" name="scenes_id" value="<?=$scenes->getScenesId()?>">
    <input type="hidden" name="admin_id" value="<?=$scenes->getAdminId()?>">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="campaign_id">Campaign Name</label>
            <div class="col-lg-8">
                <select name="campaign_id" id="campaign_id" class="form-control required">
                    <option value="0">select campaign</option>
                    <?php
                    foreach ($campaignList as $item){
                        $campaign=new Campaigns($item);
                        ?>
                        <option <?php echo $campaign->getCampaignId()===$scenes->getCampaignId()?'selected':''?> value="<?=$campaign->getCampaignId()?>"><?=$campaign->getCampaignName()?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="campaign_difficulty_id">Difficulty Level</label>
            <div class="col-lg-8">
                <select name="campaign_difficulty_id" id="campaign_difficulty_id"  class="form-control">
                    <option value="0">select difficult level</option>
                    <?php
                    if(isset($difficultyLevel) && count($difficultyLevel)>0){
                        foreach ($difficultyLevel as $item){
                            $campaignDifficulty=new CampaignDifficulty($item);
                            ?>
                            <option <?php echo $campaignDifficulty->getCampaignDifficultyId()===$scenes->getCampaignDifficultyId()?'selected':''?> value="<?=$campaignDifficulty->getCampaignDifficultyId()?>"><?=$campaignDifficulty->getDifficultyName()?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="scenes_name">Challenge Name</label>
            <div class="col-lg-8">
                <input type="text" class="form-control required" id="scenes_name" name="scenes_name" value="<?=$scenes->getScenesName()?>">

                <div id="scenesListBox"  class="resultBox-shadow" style="position: absolute;z-index: 100;max-height: 300px;width: 100%;background-color: white;margin-top: 3px;;display: none;">

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="blurb">Blurb</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" id="blurb" name="blurb" value="<?=$scenes->getBlurb()?>">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="description">Description</label>
            <div class="col-lg-8">
                <textarea  class="form-control" id="description" name="description"><?=$scenes->getDescription()?></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="blurb">Rewards</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" id="blurb" name="rewards" value="<?=$scenes->getRewards()?>">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="sponsor">Sponsor</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" id="sponsor" name="sponsor" value="<?=$scenes->getSponsor()?>">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="sponsor_message">Sponsor Message</label>
            <div class="col-lg-8">
                <textarea class="form-control" id="sponsor_message" name="sponsor_message"><?=$scenes->getSponsorMessage()?></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="post_date">Post Date</label>
            <div class="col-lg-8">
                <input type="text" class="form-control datetimepicker" readonly id="post_date" name="post_date" value="<?php echo $scenes->getPostDate()!=''?date('d/m/Y H:i',strtotime($scenes->getPostDate())):''; ?>">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="youtube_post_text">Youtube Post text</label>
            <div class="col-lg-8">
                <textarea class="form-control" id="youtube_post_text" name="youtube_post_text"><?=$scenes->getYoutubePostText()?></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="email_notification_text">Email Notification Text</label>
            <div class="col-lg-8">
                <textarea class="form-control" id="email_notification_text" name="email_notification_text"><?=$scenes->getEmailNotificationText()?></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="facebook_text">Facebook Text</label>
            <div class="col-lg-8">
                <textarea class="form-control" id="facebook_text" name="facebook_text"><?=$scenes->getFacebookText()?></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="twitter_text">Twitter Text</label>
            <div class="col-lg-8">
                <textarea class="form-control" id="twitter_text" name="twitter_text" maxlength="100"><?=$scenes->getTwitterText()?></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-6 hidden">
        <div class="form-group">
            <label class="control-label col-lg-4" for="instagram_text">Instagram Text</label>
            <div class="col-lg-8">
                <textarea class="form-control" id="instagram_text" name="instagram_text"><?=$scenes->getInstagramText()?></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="rules">Rules</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" id="rules" name="rules" value="<?=$scenes->getRules()?>">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="tags">Tags</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" id="tags" name="tags" value="<?=$scenes->getTags()?>">
                <span class="">separated with comma (,)</span>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="youtube_video">Youtube Video Link</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" id="youtube_video" name="youtube_video" value="<?=$scenes->getYoutubeVideo()?>">
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="scenes_image">Challenge Image</label>
            <div class="col-lg-8">
                <?php
                if(isset($update) && $update!=''){
                    ?>
                    <img src="<?=base_url('images/original/'.$scenes->getSceneImageUrl())?>" style="width: 200px;height: 200px;object-fit: contain;margin-bottom: 5px" id="scenesMainImage" class="img-responsive img-thumbnail mainImage">
                    <div class="imagePreviewDiv img-thumbnail" id="imagePreviewDiv" style="display: none;">
                        <img src="" style="width: 200px;height: 200px;object-fit: contain" class="img-responsive imgPreviewScenes" id="imgPreviewScenes">
                        <div class="saveDiscardButtonDiv" id="saveDiscardButtonDiv4" style="position: absolute;top: 50%;text-align:center;float: right;z-index: 51;background-color: rgba(95,80,84,0.83);width: 200px;padding: 5px">
                            <button type="button" class="btn btn-sm  editCancelBtn" style="border: 1px solid darkblue; padding-top: 4px;color: darkblue;text-decoration: none">Discard</button>
                            <input type="button" class="btn btn-sm" id="scenesImgUpdateBtn" style="border: 1px solid darkblue; padding-top: 4px;color: darkblue;text-decoration: none" value="Upload">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <button type="button" class="btn btn-default" data-id="<?=$scenes->getScenesId();?>" id="changeScenesImgBtn">Change scenes Image</button>

                    <?php
                }else{
                    ?>
                    <input type="file" class="form-control filestyle" id="scenes_image" name="scenes_image">
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="reward_image">Reward Image</label>
            <div class="col-lg-8">
                <?php
                if(isset($update) && $update!=''){
                    ?>
                    <img src="<?=base_url('images/original/'.$scenes->getRewardImageUrl())?>" style="width: 200px;height: 200px;object-fit: contain;margin-bottom: 5px" id="rewardMainImage" class="img-responsive img-thumbnail mainImage">
                    <div class="imagePreviewDiv img-thumbnail" id="imagePreviewDiv" style="display: none;">
                        <img src="" style="width: 200px;height: 200px;object-fit: contain" class="img-responsive imgPreviewReward" id="imgPreviewReward">
                        <div class="saveDiscardButtonDiv" id="saveDiscardButtonDiv4" style="position: absolute;top: 50%;text-align:center;float: right;z-index: 51;background-color: rgba(95,80,84,0.83);width: 200px;padding: 5px">
                            <button type="button" class="btn btn-sm  editCancelBtn" style="border: 1px solid darkblue; padding-top: 4px;color: darkblue;text-decoration: none">Discard</button>
                            <input type="button" class="btn btn-sm" id="rewardImgUpdateBtn" style="border: 1px solid darkblue; padding-top: 4px;color: darkblue;text-decoration: none" value="Upload">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <button type="button" class="btn btn-default" data-id="<?=$scenes->getScenesId();?>" id="changeRewardImgBtn">Change reward Image</button>

                    <?php
                }else{
                    ?>
                    <input type="file" class="form-control filestyle" id="reward_image" name="reward_image">
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="sponsor_image">Sponsor Image</label>
            <div class="col-lg-8">
                <?php
                if(isset($update) && $update!=''){
                    ?>
                    <img src="<?=base_url('images/original/'.$scenes->getSponsorImageUrl())?>" style="width: 200px;height: 200px;object-fit: contain;margin-bottom: 5px" id="sponsorMainImage" class="img-responsive img-thumbnail mainImage">
                    <div class="imagePreviewDiv img-thumbnail" id="imagePreviewDiv" style="display: none;">
                        <img src="" style="width: 200px;height: 200px;object-fit: contain" class="img-responsive imgPreviewSponsor" id="imgPreviewSponsor">
                        <div class="saveDiscardButtonDiv" id="saveDiscardButtonDiv4" style="position: absolute;top: 50%;text-align:center;float: right;z-index: 51;background-color: rgba(95,80,84,0.83);width: 200px;padding: 5px">
                            <button type="button" class="btn btn-sm  editCancelBtn" style="border: 1px solid darkblue; padding-top: 4px;color: darkblue;text-decoration: none">Discard</button>
                            <input type="button" class="btn btn-sm " id="sponsorImgUpdateBtn"  style="border: 1px solid darkblue; padding-top: 4px;color: darkblue;text-decoration: none" value="Upload">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <button type="button" class="btn btn-default" data-id="<?=$scenes->getScenesId()    ?>" id="changeSponsorImgBtn">Change sponsor Image</button>

                    <?php
                }else{
                    ?>
                    <input type="file" class="form-control filestyle" id="sponsor_image" name="sponsor_image">
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="col-lg-offset-2">
            <div style="float: left">

                <?php
                if(isset($addNew) && $addNew){
                    ?>
                    <button type="button" class="btn btn-default" id="scenesSubmitBtn">Submit</button>
                    <?php
                }
                ?>
                <?php
                if(isset($save) && $save){
                    ?>
                    <button type="button" class="btn btn-default" id="scenesSaveBtn">Save</button>
                    <?php
                }
                ?>
                <?php
                if(isset($update) && $update){
                    ?>
                    <button type="button" class="btn btn-default" id="scenesUpdateBtn">Update</button>
                    <?php
                }
                ?>
            </div>
            <div style="float: left;padding-top: 4px">
                <span class="wait"></span>
            </div>
        </div>
    </div>
</form>


<div class="scenesImageUploadDiv hidden"></div>
<div class="sponsorImageUploadDiv hidden"></div>
<div class="rewardImageUploadDiv hidden"></div>

<script>
    var baseUrl='<?=base_url()?>';
    $(document).ready(function () {
        $('.datetimepicker').datetimepicker({
            weekStart: 1,
            todayBtn:  1,
            autoclose: true,
//            todayHighlight: 1,
//            startView: 2,
//            minView: 4,
            forceParse: 1,
            showMeridian:true,
            format:'dd/mm/yyyy hh:ii'
        })

        $(document).on('change','#campaign_id',function () {
            var campaignId=$(this).val();
            if(campaignId!=0){
                $.ajax({
                    url:baseUrl+'/m/getDifficultyLevelByCampaign',
                    type:'get',
                    dataType:'json',
                    data:{campaign_id:campaignId},
                    success:function (data) {
                        if(data.difficultyLevel === undefined){
                            var difficultyLevel=[];
                        }else {
                            var difficultyLevel=data.difficultyLevel;
                        }
                        $('#campaign_difficulty_id').html(optionForDifficultLevelSelect(difficultyLevel));
                    },
                    error:function (data) {
                        console.log(data);
                    }
                })
            }
        });

        function optionForDifficultLevelSelect(difficultyLevel) {
            var a='<option value="0">select difficult level</option>';
            for(var i=0;i<difficultyLevel.length;i++){
                a=a+'<option value="'+difficultyLevel[i]['campaign_difficulty_id']+'">'+difficultyLevel[i]['difficulty_name']+'</option>';
            }
            return a;
        }
    });
</script>