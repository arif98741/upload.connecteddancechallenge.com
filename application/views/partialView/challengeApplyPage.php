<?php
if(isset($_SESSION['videoFormData'])){
    $preserveData=$_SESSION['videoFormData'];
    if((isset($_SESSION['loginStatus']) && $_SESSION['loginStatus']) && (isset($_SESSION['loginType']) && $_SESSION['loginType']=='userLogin')){
        $name=$_SESSION['userName'];
        $nameArray=explode(' ',$name);
        $firstName=$nameArray[0];
        $title=$firstName.' - City, Country | '.$scenes['scenes_name'] .' #ConnectedDanceChallenge';
    }else{
        $title='';
    }
    $preserveData['title']=$title;
    unset($_SESSION['videoFormData']);
}else{
    $preserveData=array('title'=>'','description'=>$scenes['description'],'tags'=>'','twitter_text'=>$scenes['twitter_text']);
}



?>
<div class="container-fluid">
    <div class="panel panel-body col-lg-10 col-lg-offset-1" style="padding: 0px">

        <div class="videoUploadDiv" style="<?php isset($_SESSION['loginStatus'])?'':'display:none;' ?>">
            <div class="post-sign-in">
                <div>
                    <img id="channel-thumbnail"><br>
                    <span id="channel-name"></span>
                </div>

                <div class="container-fluid col-lg-10 col-lg-offset-1" >
                    <div class="scenesDiv  col-lg-6 col-md-6 col-sm-6" style="cursor: pointer" data-id="<?=$scenes['scenes_id']?>">
                        <?php
                        if($scenes['youtube_video']!='' && $scenes['youtube_video']!=null){
                            $videoId=explode('?v=',$scenes['youtube_video']);
                            ?>
                            <div class="video-container">
                                <iframe width="100%"  src="https://www.youtube.com/embed/<?=$videoId[1]?>" allowfullscreen></iframe>
                            </div>
                        <?php
                        }else{
                            ?>
                            <img height="300px" width="100%" style="object-fit: cover" src="<?=base_url('images/large/'.$scenes['scene_image_url_thumb'])?>" >
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6" style="padding: 0px 10px 5px 10px">
                        <div class="scenesDiv" style="cursor: pointer" data-id="<?=$scenes['scenes_id']?>">
                            <h3 style="font-size: 35px;color: #08ACD3;margin-top: 0;"><?=$scenes['scenes_name']?></h3>
<!--                            <div><label>Campaign Name: </label> <span >--><?//=$scenes['campaign_name']?><!--</span></div>-->
<!--                            <div><label>Challenge Name: </label> <span >--><?///*=$scenes['scenes_name']*/?><!--</span></div>-->
                            <div><label>Post Date: </label> <span ><?=date('d/m/Y H:i',strtotime($scenes['post_date']))?></span></div>
                            <div class="<?=$scenes['description']==''?'hidden':'' ?>"><label>Description: </label> <span ><?=$scenes['description']?></span></div>
                            <div class="<?=$scenes['rewards']==''?'hidden':'' ?>"><label>Rewards: </label> <span ><?=$scenes['rewards']?></span></div>
                            <div class="<?=$scenes['sponsor']==''?'hidden':'' ?>"><label>Sponsor: </label> <span ><?=$scenes['sponsor']?></span></div>
                            <div class="<?=$scenes['sponsor_message']==''?'hidden':'' ?>"><label>Sponsor Message: </label> <span ><?=$scenes['sponsor_message']?></span></div>
                            <div class="<?=$scenes['rules']==''?'hidden':'' ?>"><label>Rules: </label> <span ><?=$scenes['rules']?></span></div>
                        </div>
                        <div>

                        </div>
                        <?php
                        if($scenes['youtube_video']!='' && $scenes['youtube_video']!=null){
                            $videoId=explode('?v=',$scenes['youtube_video']);
                            ?>

                            <div class="hidden"><button type="button" id="playVideoBtn"  class="btn btn-default playVideoBtn" data-value="<?=$videoId[1]?>" >Watch Video</button></div>
                            <?php
                        }
                        ?>
                        <!--<div class="scenesDiv" style="cursor: pointer;<?/*= isset($_SESSION['challenge_id'])?'':'display:none' */?>">
                            <button class="btn btn-primary pull-right applyBtn">Apply</button>
                        </div>-->
                    </div>
                </div>
                <!--<div class="imageDiv col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                    <img class="image "  style="max-height: 250px;width: 100%;object-fit: cover" src="">
                </div>-->

                <div class="clearfix"></div>

                <?php
                if( false && isset($scenesList) && count($scenesList)>1){
                    ?>
                    <div class="container-fluid col-lg-10 col-lg-offset-1 panel panel-body" style="background-color: whitesmoke;text-align: center;padding-left: 15px;padding-right: 15px">
                        <h4>Other related challenges</h4>
                        <div class="owl-carousel ">
                            <?php
                            foreach ($scenesList as $item){
                                $scenes1=new Scenes($item);
                                if(true || $scenes1->scenes_id != $scenes['scenes_id']){
                                    ?>
                                    <a href="<?= (isset($_SESSION['loginType']) && $_SESSION['loginType']=='userLogin')?base_url('user/challenge/'.$scenes1->getScenesId()):base_url('?challenge='.$scenes1->getScenesId()) ?>">
                                        <div class="item resultBox-shadow" style="padding: 5px;margin: 5px;background-color: white;border-radius: 3px">
                                            <div class="container-fluid" style="width: 100%;padding-left: 0px;padding-right:0px;display: inline-flex" >
                                                <div class="scenesDiv " data-id="<?=$scenes1->getScenesId()?>">
                                                    <img  style="object-fit: cover;width: 100px;height: 100px" src="<?=base_url('images/large/'.$scenes1->getSceneImageUrlThumb())?>" >
                                                </div>
                                                <div style="align-items: center;margin: auto;margin-top: 0px;text-align: left">
                                                    <span><?= $scenes1->getScenesName()?></span><br>
                                                    <span><?= date('M d, Y',strtotime($scenes1->getPostDate()))?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                }
                            }
                            ?>
                            <!--<button class="btn btn-default btn-sm prev-btn"><i class="fa fa-step-backward" aria-hidden="true"></i> Prev</button>
                            <button class="btn btn-default btn-sm next-btn"><i class="fa fa-step-forward" aria-hidden="true"></i> Next</button>-->
                        </div>
                    </div>
                <?php
                }
                ?>

                <div class="clearfix"></div>
                <div class="container-fluid formDiv" id="formDiv" style="padding: 0px;">
                    <hr style="border-color: #CCCCCC">
                    <div class="form-horizontal scheduleVideoForm" style="margin-top: 20px">
                        <input type="hidden" id="video_publish_date" name="video_publish_date" value="<?=$scenes['post_date']?>">
                        <input type="hidden" id="video_published_id" name="video_published_id">
                        <input type="hidden" id="user_id" name="user_id" value="">
                        <input type="hidden" id="campaign_id" name="campaign_id" value="<?=$scenes['campaign_id']?>">
                        <input type="hidden" id="scenes_id" name="scenes_id" value="<?=$scenes['scenes_id']?>">

                        <div class="form-group col-lg-12 col-md-12">
                            <label for="fil" class="col-lg-2 col-md-2 control-label">Choose Video</label>
                            <div class="col-lg-10 col-md-10">
                                <input type="file" id="file" class="button" accept="video/mp4,video/*">
                            </div>
                        </div>

                        <div class="form-group col-lg-12 col-md-12">
                            <label for="title" class="col-lg-2 col-md-2 control-label">YouTube Title</label>
                            <div class="col-lg-10 col-md-10">
                                <input id="title" name="video_title" type="text" class="form-control" value="<?=$preserveData['title']?>">
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="tags" class="col-lg-4 col-md-4 control-label">YouTube Tags</label>
                            <div class="col-lg-8 col-md-8">
                                <span id="defaultTags" data-value=""></span>
                                <input id="tags" name="tags" type="text" class="form-control" value="<?=$preserveData['tags']?>">
                                <span class="">separated with commas</span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="description" class="col-lg-4 col-md-4 control-label">Youtube Text</label>
                            <div class="col-lg-8 col-md-8">
                                <textarea id="description" name="youtube_post_text" class="form-control"><?=$preserveData['description']!=''?$preserveData['description']:'Default description' ?></textarea>
                            </div>
                        </div>
                        <div class="form-group" hidden>
                            <label for="email_notification_text" class="col-lg-4 control-label">Email Notification Text</label>
                            <div class="col-lg-8">
                                <textarea id="email_notification_text" name="email_notification_text" class="form-control" ></textarea>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <label for="twitter_text" class="col-lg-4 col-md-4 control-label">Twitter Text</label>
                            <div class="col-lg-8 col-md-8">
                                <textarea id="twitter_text" name="twitter_text" class="form-control"><?=$preserveData['twitter_text']?></textarea>
                            </div>
                            <div class="col-lg-12">
                                <span class="pull-right twitterLength"></span>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 hidden">
                            <label for="hash_tag" class="col-lg-2 col-md-2 control-label">Hash Tag</label>
                            <div class="col-lg-10 col-md-10">
                                <input type="text" class="form-control" value="" id="hash_tag" name="hash_tag" readonly>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <label for="instagram_text" class="col-lg-2 control-label">Instagram Text</label>
                            <div class="col-lg-10">
                                <textarea id="instagram_text" name="instagram_text" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <label for="privacy-status" class="col-lg-2 control-label">Privacy Status</label>
                            <input type="text" value="private" id="privacy-status">
                        </div>

                        <div class="form-group col-lg-12 col-md-12">
                            <div class="col-lg-10 col-lg-offset-2 col-md-offset-2">
                                <?php
                                if(isset($_SESSION['loginType']) && $_SESSION['loginType']=='userLogin'){
                                    ?>
                                    <button id="button" class="btn btn-primary" data-session="true">Upload Video</button>
                                <?php
                                }else{
                                    ?>
                                    <button id="button" class="btn btn-primary" data-session="false">Upload Video</button>
                                <?php
                                }
                                ?>
                                <span class="uploadWait" style="padding-left: 10px;position: absolute;bottom: 0px"></span>
                            </div>
                        </div>

                        <div class="form-group col-lg-12 col-md-12">
                            <div class="col-lg-offset-2 col-md-offset-2">
                                <div class="during-upload" style="display: none">
                                    <p><span id="percent-transferred"></span>% (<span id="bytes-transferred"></span> of <span id="total-bytes"></span> MB.)</p>
                                    <progress id="upload-progress" max="1" value="0"></progress>
                                </div>

                                <div class="post-upload" style="display: none">
                                    <p>Video uploaded successfully. Please wait while Youtube verifies your video. It may take several minutes...</p>
                                    <ul id="post-upload-status"></ul>
                                    <div id="player"></div>
                                </div>
                                
                                <p style="padding-left: 10px;padding-right: 10px">By submitting your videos to YouTube through the Connected Dance Challenge, you acknowledge that you agree to <a target="_blank" href="https://www.youtube.com/t/terms">YouTube's Terms of Service</a> and <a target="_blank" href="https://www.youtube.com/t/community_guidelines">Community Guidelines</a> and <a target="_blank" href="http://connecteddancechallenge.com/rules">the Connected Dance Challenge Rules</a>. Please be sure not to violate others' copyright or privacy rights. <a href="https://www.youtube.com/yt/copyright/" target="_blank">Learn more</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myVideoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="video-container">
                    <iframe width="100%"  src="https://www.youtube.com/embed/" allowfullscreen></iframe>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid" style="padding-top: 5%;padding-bottom: 5%">
                    <h3 style="margin-bottom: 15px">Please login with Google before uploading your video</h3>
                    <a href="<?=base_url('GoogleCtrl')?>" style="color: whitesmoke">
                        <div class="" style="margin-top: 5px;margin-bottom: 5px;background-color: red;line-height: 50px;font-size: x-large;text-align: center;border-radius: 5px;">
                            <span>User Login <small style="font-style: italic">with</small> Youtube</span><span class="fa fa-youtube img-circle" style="background-color: red;line-height: 40px;width: 40px;height: 40px;text-align: center;color: white;border: 1px solid whitesmoke;margin-top: 3px;margin-left: 10px"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var baseUrl='<?=base_url()?>';
    $(document).ready(function () {

        var owl=$(".owl-carousel").owlCarousel({
            /*loop:true,
            margin:10,
            dots:false,
            autoHeight:true,
            items:4,*/
            center: true,
            items:2,
            loop:false,
            margin:10,
            responsive:{
                600:{
                    items:4
                }
            }
        });

        $(document).on('click','.next-btn',function () {
            owl.trigger('next.owl.carousel');
        });
        $(document).on('click','.prev-btn',function () {
            owl.trigger('prev.owl.carousel', [300]);
        });

        $(document).on('click','.playVideoBtn',function () {
            console.log($(this));
            var youtubeKey=$(this).attr('data-value');
            var myModal=$('#myVideoModal');
            $(myModal).find('iframe').attr('src','https://www.youtube.com/embed/'+youtubeKey);
            $(myModal).modal({'show':true});
        });

        $("#myVideoModal").on('hidden.bs.modal', function (e) {
            $("#myVideoModal iframe").attr("src", $("#myVideoModal iframe").attr("src"));
        });



        function getChallenge(scenesId) {
            $.ajax({
                url:baseUrl+'m/getScenesByScenesId2',
                dataType:'json',
                type:'get',
                data:{scenes_id:scenesId},
                success:function (data) {
                    $('.scenesListDiv').hide();
                    $('.videoUploadDiv').slideDown(300);
                    var scheduleVideoFormObj=$('.scheduleVideoForm');
                    var scenes=data.scenes;
                    var formObj=$('.scheduleVideoForm :input');
                    for(var i=0;i<formObj.length;i++){
                        var element=$(formObj[i]).attr('name');
                        $('[name="'+element+'"]').val(scenes[element]);
                    }

                    $('[name="tags"]').val('');
                    $('[name="video_publish_date"]').val(scenes['post_date']);
//                        $('[name="video_publish_date"').val(scenes['post_date']);
                    $('.image').attr('src','');
                    $('.image').attr('src',baseUrl+'images/medium/'+scenes['scene_image_url_thumb']);

                    $('.during-upload').hide();
                    $('.post-upload').hide();

                    twitterTextCount($('#hash_tag'));

                    $('#defaultTags').html('');
                    $('#defaultTags').html(tags(scenes['tags']));
                    $('#defaultTags').attr('data-value',scenes['tags']);

                    $('#title').val(scenes['title']);

                    $('.videoUploadDiv').show();
                },
                error:function (data) {
                    console.log(data);
                }
            })
        }

        function getChallengeTags(scenesId) {
            $.ajax({
                url:baseUrl+'m/getScenesByScenesId2',
                dataType:'json',
                type:'get',
                data:{scenes_id:scenesId},
                success:function (data) {
                    var scheduleVideoFormObj=$('.scheduleVideoForm');
                    var scenes=data.scenes;

                    twitterTextCount($('#hash_tag'));

                    $('#defaultTags').html('');
                    $('#defaultTags').html(tags(scenes['tags']));
                    $('#defaultTags').attr('data-value',scenes['tags']);

                    $('.videoUploadDiv').show();
                },
                error:function (data) {
                    console.log(data);
                }
            })
        }

        setTimeout(function () {
            <?php
            if(isset($_SESSION['challenge_id'])){
                ?>
            var scenesId='<?=$_SESSION['challenge_id'] ?>';
            getChallenge(scenesId);

            <?php
            }else{
                ?>
            var scenesObj=$('#scenes_id');
            if(scenesObj.val()!=''){
                getChallengeTags(scenesObj.val());
            }
            <?php
        }
            ?>
        },100);

        $('#button').on('click',function (e) {
            var submitBtn=$(this);
            if(submitBtn.attr('data-session')=='false'){
                var loginModal=$('#loginModal');
                $(loginModal).modal({'show':true});
                var title=$('#title').val();
                var tags=$('#tags').val();
                var description=$('#description').val();
                var twitter_text=$('#twitter_text').val();
                $.ajax({
                    url:baseUrl+'/m/saveFormData',
                    type:'post',
                    data:{title:title,tags:tags,description:description,twitter_text:twitter_text},
                    success:function (data) {
                        console.log(data);
                    },
                    error:function (data) {
                        console.log(data);
                    }
                })

            }
        });

        $('#file').on('click',function (e) {
            var submitBtn=$('#button');
            if(submitBtn.attr('data-session')=='false'){
                e.preventDefault();
                submitBtn.click();
            }else {
                return true;
            }
        });

        $('.applyBtn').on('click',function () {
            $('.formDiv').slideDown();
            $('#formDiv').focus();
        });

        $(document).on('click','#backBtn',function () {
            $('.videoUploadDiv').hide();
            $('.scenesListDiv').slideDown(300);
        });


        $(document).on('keyup','#twitter_text',function () {
            twitterTextCount($('#hash_tag'));
        });

        function twitterTextCount(elem) {
            var hashTagObj=$(elem);
            var twitterTextObj=$('#twitter_text');
            var twitterLengthObj=$('.twitterLength');
            var remainingLength=115 -(twitterTextObj.val().length + hashTagObj.val().length);
            twitterLengthObj.html(remainingLength);
            if(remainingLength<0){
                twitterLengthObj.css('color','red');
                twitterLengthObj.addClass('inValid');
            }else {
                twitterLengthObj.css('color','black');
                twitterLengthObj.removeClass('inValid');
            }

        }

        function tags(tagsData) {
            if(tagsData!=null){
                var separators = [',', ';','\n'];
                var a=$('<span class="tags"></span>');
                $.each(tagsData.split(new RegExp(separators.join('|'), 'g')), function(index, item) {
                    $(a).append('<span class="badge" style="margin: 2px">'+item+'</span>');
                });
                return $(a);
            }

        }

    })
</script>

