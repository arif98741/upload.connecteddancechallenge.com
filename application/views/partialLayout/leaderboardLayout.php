<div class="container-fluid panel panel-body" style="margin: 10px">
    <div class="">

        <div class="container-fluid">
            <?php
            if(isset($campaignList) && count($campaignList)>0){
                ?>
                <div class="campaignDiv" style="padding: 10px">
                    <div class="form-horizontal col-lg-6 col-md-7">
                        <div class="form-group">
                            <label for="campaignSelect" class="control-label col-lg-2 col-md-3">Campaign</label>
                            <div class="col-lg-10 col-md-9">
                                <select id="campaignSelect" class="form-control " >
                                    <option value="0">select campaign</option>
                                    <?php
                                    foreach ($campaignList as $campaign){
                                        $campaign=new Campaigns($campaign);
                                        ?>
                                        <option value="<?=$campaign->getCampaignId()?>"><?=$campaign->getCampaignName()?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>

            <div class="clearfix"></div>
            <div class="challengeDiv" style="padding: 10px"></div>
            <div class="clearfix"></div>
            <div class="message" style="padding: 10px"></div>
        </div>

        <hr>

        <div class="challengeTableContainer">
            <div style="padding-top: 5px;padding-bottom: 5px">
                <a  href="" style="visibility: hidden" id="csvBtn" class="btn btn-link" target="_blank">Export CSV</a>
            </div>
            <div class="container-fluid" style="padding: 0px 0px 5px">
                <div class="col-lg-6 col-md-6" style="border:1px solid #CCCCCC">
                    <div style="line-height: 30px">
                        <span>Campaign / <small id="campaignName"></small></span>
                        <button class="btn btn-link pull-right viewBtn">
                            <span>[View : <span id="totalCampaignView"></span>]</span>
                        </button>
                        <button class="btn btn-link pull-right likeBtn">
                            <span class="">[Like : <span id="totalCampaignLike"></span>]</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6" style="border:1px solid #CCCCCC">
                    <div style="line-height: 30px">
                        <span>Challenge / <small id="challengeName"></small></span>
                        <button class="btn btn-link pull-right viewBtn">
                            <span>[View : <span id="totalChallengeView"></span>]</span>
                        </button>
                        <button class="btn btn-link pull-right likeBtn">
                            <span class="">[Like : <span id="totalChallengeLike"></span>]</span>
                        </button>
                    </div>
                </div>
            </div>
            <table id="example" class="display table table-bordered table-striped" width="100%" cellspacing="0">
                <thead>
                <tr style="background-color: green;color: whitesmoke">
                    <th ></th>
                    <th>Name</th>
                    <th>Challenge Name</th>
                    <th>Difficulty Level</th>
                    <th>Video Title</th>
                    <th id="fbLike">Facebook Likes</th>
                    <th id="twLike">Twitter Likes</th>
                    <th id="ytLike">Youtube Likes</th>
                    <th id="totalLike">Total Likes</th>
                    <th id="fbView" >Facebook View</th>
                    <th id="ytView" >Youtube View</th>
                    <th id="totalView" >Total View</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<script>
    var baseUrl='<?=base_url()?>';

    $(document).ready(function () {

        var videoDataTable=$('#example').dataTable().api();

        videoDataTable.column(9).visible(false);
        videoDataTable.column(10).visible(false);
        videoDataTable.column(11).visible(false);

        $(document).on('click','.viewBtn',function () {
            videoDataTable.column(9).visible(true);
            videoDataTable.column(10).visible(true);
            videoDataTable.column(11).visible(true);

            videoDataTable.column(5).visible(false);
            videoDataTable.column(6).visible(false);
            videoDataTable.column(7).visible(false);
            videoDataTable.column(8).visible(false);
        });

        $(document).on('click','.likeBtn',function () {
            videoDataTable.column(9).visible(false);
            videoDataTable.column(10).visible(false);
            videoDataTable.column(11).visible(false);

            videoDataTable.column(5).visible(true);
            videoDataTable.column(6).visible(true);
            videoDataTable.column(7).visible(true);
            videoDataTable.column(8).visible(true);
        });

        <?php
            if (isset($campaignId)){
                ?>
        var campaignId='<?=$campaignId?>';
        console.log(campaignId);
        getSocialInfoByCampaignId(campaignId);
        <?
            }
        ?>

        $(document).on('change','#campaignSelect',function () {
            var campaignSelectObj=$(this);
            var campaignId=campaignSelectObj.val();
            if(campaignId!=0){
                $.ajax({
                    url:baseUrl+'/m/getSensesByCampaignId',
                    type:'get',
                    dataType:'json',
                    data:{campaign_id:campaignId},
                    success:function (data) {
//                        console.log(data);
                        if(data.result){
                            $('.challengeDiv').html('<div class="form-horizontal col-lg-6 col-md-7"><div class="form-group"><label for="challengeSelect" class="control-label col-lg-2 col-md-3">Challenge</label><div class="col-lg-10 col-md-9"><select id="challengeSelect" class="form-control">'+challengeOptions(data.scenesList)+'</select></div>');
                        }else {
                            $('.challengeDiv').html('<div class="alert alert-danger">'+data.message+'</div>');
                        }
                    }
                });

                getSocialInfoByCampaignId(campaignId);
            }else{
            }
        });



        $(document).on('change','#challengeSelect',function () {

            var challengeSelectObj=$(this);
            var scenesId=challengeSelectObj.val();
            if(scenesId!=0){


                $.ajax({
                    url:baseUrl+'/m/getScheduleVideosByScenesId',
                    type:'get',
                    dataType:'json',
                    data:{scenes_id:scenesId},
                    success:function (data) {
//                        console.log(data);
                        if(data.result){
                            $('#csvBtn').attr('href',data.csvFileUrl);
                            $('#csvBtn').css('visibility','visible');
                            $('#campaignName').html(data.campaignName);
                            $('#totalCampaignView').html(data.campaignTotalView);
                            $('#totalCampaignLike').html(data.campaignTotalLike);
                            $('#challengeName').html(data.challengeName);
                            $('#totalChallengeView').html(data.challengeTotalView);
                            $('#totalChallengeLike').html(data.challengeTotalLike);

                            videoDataTable.clear();
                            var videoList=dataForDatatable(data.videoList);
                            videoDataTable.rows.add(videoList);
                            videoDataTable.draw();
                        }else {
                            $('.message').html('<div class="alert alert-danger">'+data.message+'</div>');
                            setTimeout(function () {
                                $('.message').html('');
                            },10000);
                        }
                    }
                })

            }else{
            }
        });


        function getSocialInfoByCampaignId(campaignId) {
            $.ajax({
                url:baseUrl+'/m/getScheduleVideosByCampaignId',
                type:'get',
                dataType:'json',
                data:{campaign_id:campaignId},
                success:function (data) {
//                        console.log(data);
                    if(data.result){
                        $('#csvBtn').attr('href',data.csvFileUrl);
                        $('#csvBtn').css('visibility','visible');
                        $('#campaignName').html(data.campaignName);
                        $('#totalCampaignView').html(data.campaignTotalView);
                        $('#totalCampaignLike').html(data.campaignTotalLike);
                        $('#challengeName').html(data.challengeName);
                        $('#totalChallengeView').html(data.challengeTotalView);
                        $('#totalChallengeLike').html(data.challengeTotalLike);

                        videoDataTable.clear();
                        var videoList=dataForDatatable(data.videoList);
                        videoDataTable.rows.add(videoList);
                        videoDataTable.draw();
                    }else {
                        $('.message').html('<div class="alert alert-danger">'+data.message+'</div>');
                        setTimeout(function () {
                            $('.message').html('');
                        },10000);

                        $('#csvBtn').attr('href',data.csvFileUrl);
                        $('#csvBtn').css('visibility','hidden');
                        $('#campaignName').html(data.campaignName);
                        $('#totalCampaignView').html(data.campaignTotalView);
                        $('#totalCampaignLike').html(data.campaignTotalLike);
                        $('#challengeName').html('');
                        $('#totalChallengeView').html('');
                        $('#totalChallengeLike').html('');

                        videoDataTable.clear();
                        videoDataTable.draw();
                        /*var videoList=dataForDatatable(data.videoList);
                        videoDataTable.rows.add(videoList);
                        videoDataTable.draw();*/
                    }
                }
            })
        }

    });

    function challengeOptions(options) {
        var a='<option value="0">select challenge</option>';
        for (var i=0;i<options.length;i++){
            a=a+'<option value="'+options[i]['scenes_id']+'">'+options[i]['scenes_name']+'</option>';
        }
        return a;
    }

    function dataForDatatable(videoList) {

        var data=[];
        for(var i=0;i<videoList.length;i++){

            var tmp=[];
            tmp.push('<img width="50px" src="'+videoList[i]['picture_url']+'" alt="">');
            tmp.push(videoList[i]['youtube_username']);
            tmp.push(videoList[i]['scenes_name']);
            tmp.push(null);
            tmp.push('<a target="_blank" href="https://www.youtube.com/watch?v='+videoList[i]['video_published_id']+'">'+videoList[i]['video_title']+'</a>');
            if(videoList[i]['facebook_response']!=null && videoList[i]['facebook_response']!=''){
                tmp.push('<a target="_blank" href="https://facebook.com/'+videoList[i]['fb_numeric_id']+'/videos/'+videoList[i]['facebook_response']+'">'+videoList[i]['fb_like']+'</a>');
            }else {
                tmp.push(videoList[i]['fb_like']);
            }
            if(videoList[i]['twitter_response_id']!=null && videoList[i]['twitter_response_id']!=''){
                tmp.push('<a target="_blank" href="https://twitter.com/statuses/'+videoList[i]['twitter_response_id']+'">'+videoList[i]['tw_like']+'</a>');
            }else {
                tmp.push(videoList[i]['tw_like']);
            }
            tmp.push('<a target="_blank" href="https://www.youtube.com/watch?v='+videoList[i]['video_published_id']+'">'+videoList[i]['yt_like']+'</a>');
            tmp.push(videoList[i]['total_likes']);


            if(videoList[i]['facebook_response']!=null && videoList[i]['facebook_response']!=''){
                tmp.push('<a target="_blank" href="https://facebook.com/'+videoList[i]['fb_numeric_id']+'/videos/'+videoList[i]['facebook_response']+'">'+videoList[i]['fb_view']+'</a>');
            }else {
                tmp.push(videoList[i]['fb_view']);
            }
            tmp.push('<a target="_blank" href="https://www.youtube.com/watch?v='+videoList[i]['video_published_id']+'">'+videoList[i]['yt_view']+'</a>');
            tmp.push(videoList[i]['total_view']);



            data.push(tmp);

        }

        return data;

    }



</script>
