<?php
if(isset($campaignsData)){
    $campaigns=new Campaigns($campaignsData);
}else{
    $campaigns=new Campaigns();
}

if(isset($difficultyLevel_1)){
    $campaignDifficulty1=new CampaignDifficulty($difficultyLevel_1);
}else{
    $campaignDifficulty1=new CampaignDifficulty();
    $campaignDifficulty1->setDifficultyName('Easy Peasy - No Practice Needed');
}

if(isset($difficultyLevel_2)){
    $campaignDifficulty2=new CampaignDifficulty($difficultyLevel_2);
}else{
    $campaignDifficulty2=new CampaignDifficulty();
    $campaignDifficulty2->setDifficultyName('Mildly Challenging - Light Practice');
}

if(isset($difficultyLevel_3)){
    $campaignDifficulty3=new CampaignDifficulty($difficultyLevel_3);
}else{
    $campaignDifficulty3=new CampaignDifficulty();
    $campaignDifficulty3->setDifficultyName('Formidable - A Fair Amount of Practice and Talent');
}

if(isset($difficultyLevel_4)){
    $campaignDifficulty4=new CampaignDifficulty($difficultyLevel_4);
}else{
    $campaignDifficulty4=new CampaignDifficulty();
    $campaignDifficulty4->setDifficultyName('Off the Charts - A lot of Practice and Talent');
}
?>
<form id="campaignsForm" class="form-horizontal" style="padding-top: 20px" enctype="multipart/form-data">
    <input type="hidden" name="campaign_id" value="<?=$campaigns->getCampaignId()?>">
    <input type="hidden" name="admin_id" value="<?=$campaigns->getAdminId()?>">

    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="campaign_name">Campaign Name</label>
            <div class="col-lg-8">
                <input type="text" class="form-control required" id="campaign_name" name="campaign_name" value="<?=$campaigns->getCampaignName()?>">
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="short_description">Short Description</label>
            <div class="col-lg-8">
                <textarea type="textarea" class="form-control" id="short_description" name="short_description"><?=$campaigns->getShortDescription()?></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="control-label col-lg-2" for="long_description">Long Description</label>
            <div class="col-lg-10">
                <textarea type="text" class="form-control" id="long_description" name="long_description"><?=$campaigns->getLongDescription()?></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="start_date">Start Date</label>
            <div class="col-lg-8">
                <input type="text" class="form-control datetimepicker required2" readonly id="start_date" name="start_date" value="<?php echo $campaigns->getStartDate()!=''?date('d/m/Y',strtotime($campaigns->getStartDate())):''; ?>">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="end_date" >End Date</label>
            <div class="col-lg-8">
                <input type="text" class="form-control datetimepicker required2" readonly id="end_date" name="end_date" value="<?php echo $campaigns->getEndDate()!=''?date('d/m/Y',strtotime($campaigns->getEndDate())):''; ?>">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="post_date">Post Date</label>
            <div class="col-lg-8">
                <input type="text" class="form-control datetimepicker required2" readonly id="post_date" name="post_date" value="<?php echo $campaigns->getPostDate()!=''?date('d/m/Y',strtotime($campaigns->getPostDate())):''; ?>">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="hash_tag">Hash Tag</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" maxlength="50" id="hash_tag" name="hash_tag" value='<?= $campaigns->getHashTag()?>'>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="sponsor_name">Sponsor Name</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" id="sponsor_name" name="sponsor_name" value="<?=$campaigns->getSponsorName()?>">
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label class="control-label col-lg-2" for="sponsor_message">Sponsor Message</label>
            <div class="col-lg-10">
                <textarea type="text" class="form-control" id="sponsor_message" name="sponsor_message"><?=$campaigns->getSponsorMessage()?></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="campaign_image">Campaign Image</label>
            <div class="col-lg-8">
                <?php
                if(isset($update) && $update!=''){
                    ?>
                    <img src="<?=base_url('images/original/'.$campaigns->getCampaignImageUrl())?>" style="width: 200px;height: 200px;object-fit: contain;margin-bottom: 5px" id="campaignMainImage" class="img-responsive img-thumbnail mainImage">
                    <div class="imagePreviewDiv img-thumbnail" id="imagePreviewDiv" style="display: none;">
                        <img src="" style="width: 200px;height: 200px;object-fit: contain" class="img-responsive imgPreviewCampaign" id="imgPreviewCampaign">
                        <div class="saveDiscardButtonDiv" id="saveDiscardButtonDiv4" style="position: absolute;top: 50%;text-align:center;float: right;z-index: 51;background-color: rgba(95,80,84,0.83);width: 200px;padding: 5px">
                            <button type="button" class="btn btn-sm  editCancelBtn" style="border: 1px solid darkblue; padding-top: 4px;color: darkblue;text-decoration: none">Discard</button>
                            <input type="button" class="btn btn-sm" id="campaignImgUpdateBtn" style="border: 1px solid darkblue; padding-top: 4px;color: darkblue;text-decoration: none" value="Upload">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <button type="button" class="btn btn-default" data-id="<?=$campaigns->getCampaignId();?>" id="changeCampaignImgBtn">Change campaign Image</button>

                    <?php
                }else{
                    ?>
                    <input type="file" class="form-control filestyle" id="campaign_image" name="campaign_image">
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label col-lg-4" for="sponsor_image">Sponsor Image</label>
            <div class="col-lg-8">
                <?php
                if(isset($update) && $update!=''){
                    ?>
                    <img src="<?=base_url('images/original/'.$campaigns->getSponsorImageUrl())?>" style="width: 200px;height: 200px;object-fit: contain;margin-bottom: 5px" id="sponsorMainImage" class="img-responsive img-thumbnail mainImage">
                    <div class="imagePreviewDiv img-thumbnail" id="imagePreviewDiv" style="display: none;">
                        <img src="" style="width: 200px;height: 200px;object-fit: contain" class="img-responsive imgPreviewSponsor" id="imgPreviewSponsor">
                        <div class="saveDiscardButtonDiv" id="saveDiscardButtonDiv4" style="position: absolute;top: 50%;text-align:center;float: right;z-index: 51;background-color: rgba(95,80,84,0.83);width: 200px;padding: 5px">
                            <button type="button" class="btn btn-sm  editCancelBtn" style="border: 1px solid darkblue; padding-top: 4px;color: darkblue;text-decoration: none">Discard</button>
                            <input type="button" class="btn btn-sm " id="sponsorImgUpdateBtn"  style="border: 1px solid darkblue; padding-top: 4px;color: darkblue;text-decoration: none" value="Upload">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <button type="button" class="btn btn-default" data-id="<?=$campaigns->getCampaignId()?>" id="changeSponsorImgBtn">Change sponsor Image</button>

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


    <div class="container-fluid" style="padding-left: 0;padding-right: 0px">
        <div class="col-lg-12">
            <h4>Difficulty Level</h4>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label col-lg-4" for="difficulty_1">Level 1</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="difficulty_1" name="difficulty_1" value="<?=$campaignDifficulty1->getDifficultyName()?>">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label col-lg-4" for="difficulty_2">Level 2</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="difficulty_2" name="difficulty_2" value="<?=$campaignDifficulty2->getDifficultyName()?>">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label col-lg-4" for="difficulty_3">Level 3</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="difficulty_3" name="difficulty_3" value="<?=$campaignDifficulty3->getDifficultyName()?>">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label col-lg-4" for="difficulty_4">Level 4</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="difficulty_4" name="difficulty_4" value="<?=$campaignDifficulty4->getDifficultyName()?>">
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="col-lg-offset-2">
            <div style="float: left">
                <?php
                if(isset($addNew) && $addNew){
                    ?>
                    <button type="button" class="btn btn-default" id="campaignSubmitBtn">Submit</button>
                <?php
                }
                ?>
                <?php
                if(isset($save) && $save){
                    ?>
                    <button  type="button" class="btn btn-default hidden" id="campaignSaveBtn">Save</button>
                    <?php
                }
                ?>
                <?php
                if(isset($update) && $update){
                    ?>
                    <button type="button" class="btn btn-default" id="campaignUpdateBtn">Update</button>
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


<div class="campaignImageUploadDiv hidden"></div>
<div class="sponsorImageUploadDiv hidden"></div>


<script>
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
        });
    })
</script>