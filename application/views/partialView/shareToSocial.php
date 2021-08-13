
<div class="col-lg-8 col-lg-offset-2" style="padding-top: 20px;">

    <?php
    if(isset($_SESSION['uploadedVideoId']) && $_SESSION['uploadedVideoId']!=''){
        ?>
<!--        <span id="video" data-videoId="--><?//=$_SESSION['uploadedVideoId']?><!--" data-videoScheduleId="--><?//=$_SESSION['videoScheduleId']?><!--">Video uploaded on Youtube with id --><?//=$_SESSION['uploadedVideoId']?><!--</span>-->


        <?php

        if($pDate > $cDate){

            ?>
            <span id="video" data-videoId="<?=$_SESSION['uploadedVideoId']?>" data-videoScheduleId="<?=$_SESSION['videoScheduleId']?>">Your video <a style="color: white" href="https://www.youtube.com/watch?v=<?=$_SESSION['uploadedVideoId']?>" target="_blank"><?=$videoTitle?></a> have been uploaded to YouTube and is schedule to post on <?=$postDate?></span>
            <?php
        }else{

            ?>
            <span id="video" data-videoId="<?=$_SESSION['uploadedVideoId']?>" data-videoScheduleId="<?=$_SESSION['videoScheduleId']?>">Your video <a style="color: white;" href="https://www.youtube.com/watch?v=<?=$_SESSION['uploadedVideoId']?>" target="_blank"><?=$videoTitle?></a> have been uploaded to YouTube and is now available for viewing</span>
            <?php
        }
        ?>


        <div style="margin: 10px;">
            <div class="panel container-fluid" style="padding: 10px">
                <div class="">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                        <span class="fa fa-facebook fa-2x img-circle" style="background-color: #484AAF;line-height: 50px;width: 50px;height: 50px;text-align: center;color: white"></span>
                    </div>
                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                        <div  style="padding-top: 15px" class="col-lg-10 col-md-10 col-sm-10">
                            <span>Do you want to post This video on facebook</span>
                        </div>
                        <div style="padding-top: 7px" class="col-lg-2 col-md-2 col-sm-2">
                            <input style="float: right" type="checkbox" id="fbCheckBox" <?= $facebookShare?'checked':'' ?> class="bootstrap-switch" data-link="<?= $authUrl?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin: 10px;">
            <div class="panel container-fluid" style="padding: 10px">
                <div class="">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                        <span class="fa fa-twitter fa-2x img-circle" style="background-color: #1DA1F2;line-height: 50px;width: 50px;height: 50px;text-align: center;color: white"></span>
                    </div>
                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                        <div  style="padding-top: 15px" class="col-lg-10 col-md-10 col-sm-10">
                            <span>Do you want to post This video on twitter</span>
                        </div>
                        <div style="padding-top: 7px" class="col-lg-2 col-md-2 col-sm-2">
                            <input style="float: right" type="checkbox" id="twCheckBox" <?= $twitterShare?'checked':'' ?> class="bootstrap-switch" data-link="<?= $twAuthUrl?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

</div>

<?php
if(isset($_SESSION['uploadedVideoId']) && $_SESSION['uploadedVideoId']!=''){
    ?>
    <div class="modal fade" id="fbPostModel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
<!--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                    <?php
                    if(isset($fbUserName) && isset($fbId)){
                        ?>
                        <h4 class="modal-title">Post to <a target="_blank" href="https://facebook.com/<?=$fbId?>"><?=$fbUserName?></a> </span></h4>
                        <?php
                    }
                    ?>
                </div>
                <div class="modal-body">
                    <div style="padding: 20px">
                        <div class="form-horizontal" id="fbPostForm">
                            <div class="form-group">
                                <textarea placeholder="write text to post on facebook" class="form-control" id="fbPostText"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closeModelBtn" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="fbPostBtn"><?= $pDate > $cDate ? 'Schedule':'Post' ?></button>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>




<script>
    var baseUrl='<?=base_url()?>';
    $(document).ready(function () {
        $('.bootstrap-switch').bootstrapSwitch({
            onText:'Yes',
            offText:'No'
        });

        var fbPostModel=$('#fbPostModel').modal({
            'show':false,
            'backdrop':'static',
        });

        <?php
            if(isset($fbText) && ($fbText=='' || $fbText==null)  && $facebookShare==1){
                ?>
        setTimeout(function () {
            fbPostModel.modal({
                'show':true,
                'backdrop':'static',
            });
        },1000);
        <?php
            }
        ?>


        $('.closeModelBtn').on('click',function () {
           $('#fbCheckBox').bootstrapSwitch('state',false,true);
            var videoObj=$('#video');
            var video_id=videoObj.attr('data-videoScheduleId');
            var status=null;
            $.ajax({
                url:baseUrl+'user/changeFbPostStatus',
                type:'get',
                dataType:'json',
                data:{video_id:video_id,status:status},
                success:function (data) {
                    console.log(data);
                },
                error:function (data) {
                    console.log(data);
                }
            })
        });

        $('#fbPostBtn').on('click',function () {
            var submitBtn=$(this);
            var fbTextObj=$('#fbPostText');
            var videoObj=$('#video');
            var video_id=videoObj.attr('data-videoScheduleId');

            if(required(fbTextObj)){
                submitBtn.attr('disabled',true);
                $.ajax({
                    url:baseUrl+'user/updateFbText',
                    type:'post',
                    dataType:'json',
                    data:{fbText:fbTextObj.val(),video_id:video_id},
                    success:function (data) {
                        console.log(data);
                        if(data.result){
                            fbPostModel.modal('hide');
                        }
                        submitBtn.attr('disabled',false);
                    },
                    error:function (data) {
                        submitBtn.attr('disabled',false);
                        var error=data.responseJSON;
                        console.log(error);
                    }
                })
            }
        });

        $('#fbCheckBox').bootstrapSwitch('onSwitchChange',function (event,state) {

            var fbCheckBoxObj=$(this);
            var status='';
            if(state){
                status=0;
            }

            var videoObj=$('#video');
            var video_id=videoObj.attr('data-videoScheduleId');
            var dataLink=fbCheckBoxObj.attr('data-link');
            if(dataLink!=''){
                window.location.href=dataLink;
            }else {
                $.ajax({
                    url:baseUrl+'user/changeFbPostStatus',
                    type:'get',
                    dataTyepe:'json',
                    data:{video_id:video_id,status:status},
                    success:function (data) {
                        console.log(data);
                        if(status===0){
                            fbPostModel.modal({'show':true});
                        }
                    },
                    error:function (data) {
                        console.log(data);
                    }
                });
            }
        });

        $('#twCheckBox').bootstrapSwitch('onSwitchChange',function (event,state) {

            var twCheckBoxObj=$(this);
            var status='';
            if(state){
                status=0;
            }
            var videoObj=$('#video');
            var video_id=videoObj.attr('data-videoScheduleId');
            var dataLink=twCheckBoxObj.attr('data-link');
            if(dataLink!=''){
                window.location.href=dataLink;
            }else {
                $.ajax({
                    url:baseUrl+'user/changeTwPostStatus',
                    type:'get',
                    dataTyepe:'json',
                    data:{video_id:video_id,status:status},
                    success:function (data) {
                        console.log(data);
                    },
                    error:function (data) {
                        console.log(data);
                    }
                });
            }
        });

    })
</script>