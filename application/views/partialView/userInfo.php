
<div class="container-fluid">
    <div class="panel panel-body col-lg-10 col-lg-offset-1" style="padding: 20px 0px">
        <div class="scenesListDiv container-fluid col-lg-10 col-lg-offset-1">
            <?php
            if(count($scenesList)>0){
                ?>

                <div class="owl-carousel">
                    <?php
                    foreach ($scenesList as $item){
                        $scenes=new Scenes($item);
                        ?>
                        <div class="item" style="">
                            <div class="container-fluid" style="width: 100%;padding-left: 0px;padding-right:0px" >
                                <div class="scenesDiv  col-lg-6 col-md-6 col-sm-6" style="cursor: pointer" data-id="<?=$scenes->getScenesId()?>">
                                    <img height="300px" width="100%" style="object-fit: cover" src="<?=base_url('images/large/'.$scenes->getSceneImageUrlThumb())?>" >
                                    <?php
/*                                    if($scenes->youtube_video!='' && $scenes->youtube_video!=null){
                                        $videoId=explode('?v=',$scenes->youtube_video);
                                        */?><!--
                                        <div class="video-container">
                                            <iframe width="100%"  src="https://www.youtube.com/embed/<?/*=$videoId[1]*/?>" allowfullscreen></iframe>
                                        </div>
                                        <?php
/*                                    }else{
                                        */?>
                                        <img height="300px" width="100%" style="object-fit: cover" src="<?/*=base_url('images/large/'.$scenes->scene_image_url_thumb)*/?>" >
                                        --><?php
/*                                    }
                                    */?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6" style="padding: 0px 10px 5px 10px">
                                    <div class="scenesDiv" style="cursor: pointer" data-id="<?=$scenes->getScenesId()?>">
                                        <h3 style="font-size: 35px;color: #08ACD3;margin-top: 0;"><?=$scenes->getScenesName()?></h3>
                                        <div><label>Campaign Name: </label> <span ><?=$item['campaign_name']?></span></div>
<!--                                        <div><label>Challenge Name: </label> <span >--><?//=$scenes->getScenesName()?><!--</span></div>-->
                                        <div><label>Post Date: </label> <span ><?=date('d/m/Y H:i',strtotime($scenes->getPostDate()))?></span></div>
                                        <div class="<?=$scenes->getDescription()==''?'hidden':''?>"><label>Description: </label> <span ><?=$scenes->getDescription()?></span></div>
                                        <div class="<?=$scenes->getRewards()==''?'hidden':'' ?>"><label>Rewards: </label> <span ><?=$scenes->getRewards()?></span></div>
                                        <div class="<?=$scenes->getSponsor()==''?'hidden':'' ?>"><label>Sponsor: </label> <span ><?=$scenes->getSponsor()?></span></div>
                                        <div class="<?=$scenes->getSponsorMessage()==''?'hidden':'' ?>"><label>Sponsor Message: </label> <span ><?=$scenes->getSponsorMessage()?></span></div>
                                        <div class="<?=$scenes->getRules()==''?'hidden':'' ?>"><label>Rules: </label> <span ><?=$scenes->getRules()?></span></div>
                                    </div>
                                    <div>

                                    </div>
                                    <?php
                                    if($scenes->getYoutubeVideo()!='' && $scenes->getYoutubeVideo()!=null){
                                        $videoId=explode('?v=',$scenes->getYoutubeVideo());
                                        ?>

                                        <div><button type="button" id="playVideoBtn"  class="btn btn-default playVideoBtn" data-value="<?=$videoId[1]?>" >Watch Video</button></div>
                                        <?php
                                    }
                                    ?>


                                    <div class="scenesDiv" style="cursor: pointer" data-id="<?=$scenes->getScenesId()?>">
                                        <button class="btn btn-primary pull-right">Choose</button>
                                    </div>
                                </div>
                            </div>

                            <div class="pull-right" style="padding-top: 20px" >
                                <button class="btn btn-default btn-sm prev-btn"><i class="fa fa-step-backward" aria-hidden="true"></i> Prev</button>
                                <button class="btn btn-default btn-sm next-btn"><i class="fa fa-step-forward" aria-hidden="true"></i> Next</button>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <?php
            }
            ?>
        </div>

        <div class="clearfix"></div>


        <div class="videoUploadDiv container-fluid col-lg-10 col-lg-offset-1" style="display: none">
            <button class="btn btn-default" id="backBtn"><i class="fa fa-arrow-left"></i>Back</button>
            <div class="post-sign-in">
                <div>
                    <img id="channel-thumbnail"><br>
                    <span id="channel-name"></span>
                </div>


                <div class="imageDiv col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                    <img class="image "  style="max-height: 250px;width: 100%;object-fit: cover" src="">
                </div>

                <div class="clearfix"></div>
                <div class="form-horizontal scheduleVideoForm" style="margin-top: 20px">
                    <input type="hidden" id="video_publish_date" name="video_publish_date">
                    <input type="hidden" id="video_published_id" name="video_published_id">
                    <input type="hidden" id="user_id" name="user_id">
                    <input type="hidden" id="campaign_id" name="campaign_id">
                    <input type="hidden" id="scenes_id" name="scenes_id">

                    <!--<div id="videoDiv" class="col-lg-offset-3 col-lg-6" style="">
                        <div class="" style="position: relative">
                            <a class="playVideo" style="text-decoration: none;color: black;cursor: pointer" data-value="">
                                <img class="youtubeVideoImage" width="100%" src="">
                                <div class="desc text-center " style="position: absolute;top: 50%;left: 50%;margin: -30px 0 0 -30px;">
                                    <img src="<?/*=base_url('images/play-now.png')*/?>" style="width: 60px">
                                </div>
                            </a>
                        </div>
                    </div>-->

                    <!--<div class="form-group" style="display: none">
                        <label for="youtube_video" class="col-lg-2 control-label"></label>
                        <div class="col-lg-10">
                            <a id="youtube_video" target="_blank" href="" class="btn btn-default" >Watch Video</a>
                        </div>
                    </div>-->

                    <div class="form-group">
                        <label for="fil" class="col-lg-2 control-label">Choose Video</label>
                        <div class="col-lg-10">
                            <input type="file" id="file" class="button" accept="video/mp4,video/*">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">YouTube Title</label>
                        <div class="col-lg-10">
                            <input id="title" name="video_title" type="text" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tags" class="col-lg-2 control-label">YouTube Tags</label>
                        <div class="col-lg-10">
                            <span id="defaultTags" data-value=""></span>
                            <input id="tags" name="tags" type="text" class="form-control" value="">
                            <span class="">separated with commas</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-lg-2 control-label">Youtube Text</label>
                        <div class="col-lg-10">
                            <textarea id="description" name="youtube_post_text" class="form-control">Default description</textarea>
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <label for="email_notification_text" class="col-lg-2 control-label">Email Notification Text</label>
                        <div class="col-lg-10">
                            <textarea id="email_notification_text" name="email_notification_text" class="form-control"></textarea>
                        </div>
                    </div>
<!--                    <div class="form-group">-->
<!--                        <label for="facebook_text" class="col-lg-2 control-label">Facebook Text</label>-->
<!--                        <div class="col-lg-10">-->
<!--                            <textarea id="facebook_text" name="facebook_text" class="form-control"></textarea>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="form-group">
                        <label for="twitter_text" class="col-lg-2 control-label">Twitter Text</label>
                        <div class="col-lg-10">
                            <textarea id="twitter_text" name="twitter_text" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <span class="pull-right twitterLength"></span>
                        </div>
                    </div>
                    <div class="form-group hidden">
                        <label for="hash_tag" class="col-lg-2 control-label">Hash Tag</label>
                        <div class="col-lg-10">
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

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button id="button" class="btn btn-primary">Upload Video</button>
                            <span class="uploadWait" style="padding-left: 10px;position: absolute;bottom: 0px"></span>
                        </div>
                    </div>

                    <div class="col-lg-offset-2">
                        <div>
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

<script>
    var baseUrl='<?=base_url()?>';
    $(document).ready(function () {

        var owl=$(".owl-carousel").owlCarousel({
            loop:true,
            margin:10,
            dots:false,
            autoHeight:true,
            items:1,
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

        $(document).on('click','.scenesDiv',function () {
            var scenesDivObj=$(this);
            var scenesId=scenesDivObj.attr('data-id');

            if(scenesId!=undefined){
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

                        $('#title').val(scenes['title']);

                        $('#defaultTags').html('');
                        $('#defaultTags').html(tags(scenes['tags']));
                        $('#defaultTags').attr('data-value',scenes['tags']);
                        $('[name="tags"]').val('');
                        $('[name="video_publish_date"]').val(scenes['post_date']);
                        $('.image').attr('src','');
                        $('.image').attr('src',baseUrl+'images/large/'+scenes['scene_image_url_thumb']);


                        $('.during-upload').hide();
                        $('.post-upload').hide();

                        twitterTextCount($('#hash_tag'));
                    },
                    error:function (data) {
                        console.log(data);
                    }
                })
            }
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

