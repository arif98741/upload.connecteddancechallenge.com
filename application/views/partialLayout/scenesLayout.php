<div class="container-fluid panel panel-body" style="margin: 10px">
    <div class="">
        <a href="<?=base_url('admin/scenes/new')?>" class="btn btn-default">New Challenge</a>
        <a href="<?=base_url('admin/scenes')?>" class="btn btn-default">Challenge List</a>
    </div>
</div>


<?php
if(isset($scenesFormPanel) && $scenesFormPanel!=''){
    ?>
    <div class="container-fluid panel panel-body" style="margin: 10px">
        <div class="">
            <?php $this->load->view($scenesFormPanel)?>
        </div>
    </div>
    <?php
}
?>
<?php
if(isset($scenesListPanel) && $scenesListPanel!=''){
    ?>
    <div class="container-fluid panel panel-body" style="margin: 10px">
        <?php $this->load->view($scenesListPanel);?>
    </div>
    <?php
}
?>

<script>
    var baseUrl='<?=base_url()?>';

    $(document).ready(function () {
        $('#scenesSubmitBtn').on('click',function () {
            var campaignFormObj=$('#scenesForm');
            var data={};
            var hasError;
            var formInputs=$('#scenesForm :input');
            for(var i=0;i<formInputs.length;i++){
                var elementName=$(formInputs[i]).attr('name');
                if(elementName!==undefined){
                    var validateResult=validation(formInputs[i]);
                    if(validateResult){
                        hasError=validateResult;
                    }
                    data[elementName]=$(formInputs[i]).val();
                }
            }

            var waitCircleObj=campaignFormObj.find('.wait');

            var formData =new FormData(document.querySelector('#scenesForm'));

            var btnObj=$(this);

            if(!hasError){
                waitCircleObj.html(waitCircle);
                btnObj.attr('disabled',true);
                $.ajax({
                    url:'<?=base_url('m/addScenes')?>',
                    type:'post',
                    dataType:'json',
                    contentType: false,
                    processData: false,
                    data:formData,
                    success:function (data) {
                        if(data.result){
                            btnObj.attr('disabled',false);
                            waitCircleObj.html('<span style="padding-left: 20px;color: yellowgreen">'+data.message+'</span>');
                            setTimeout(function () {
                                window.location.href=baseUrl+'admin/scenes';
                            },3000);

                        }else {
                            btnObj.attr('disabled',false);
                            waitCircleObj.html('<span style="padding-left: 20px;color: coral">'+data.message+'</span>');
                        }
                    },
                    error:function (data) {
                        console.log(data);
                    }
                })
            }

        });

        $('#scenesUpdateBtn').on('click',function () {
            var campaignFormObj=$('#scenesForm');
            var data={};
            var hasError;
            var formInputs=$('#scenesForm :input');
            for(var i=0;i<formInputs.length;i++){
                var elementName=$(formInputs[i]).attr('name');
                if(elementName!==undefined){
                    var validateResult=validation(formInputs[i]);
                    if(validateResult){
                        hasError=validateResult;
                    }
                    data[elementName]=$(formInputs[i]).val();
                }
            }

            var waitCircleObj=campaignFormObj.find('.wait');

            var formData =new FormData(document.querySelector('#scenesForm'));

            var btnObj=$(this);

            if(!hasError){
                waitCircleObj.html(waitCircle);
                btnObj.attr('disabled',true);
                $.ajax({
                    url:'<?=base_url('m/updateScenes')?>',
                    type:'post',
                    dataType:'json',
                    contentType: false,
                    processData: false,
                    data:formData,
                    success:function (data) {
                        if(data.result){
                            btnObj.attr('disabled',false);
                            waitCircleObj.html('<span style="padding-left: 20px;color: yellowgreen">'+data.message+'</span>');
                            setTimeout(function () {
                                window.location.href=baseUrl+'admin/scenes';
                            },3000);

                        }else {
                            btnObj.attr('disabled',false);
                            waitCircleObj.html('<span style="padding-left: 20px;color: coral">'+data.message+'</span>');
                        }
                    },
                    error:function (data) {
                        console.log(data);
                    }
                })
            }

        });

        $(document).on('change','#campaign_id',function () {
           var campaignSelectObj=$(this);
           var campaign_id=campaignSelectObj.val();
           if(campaign_id!=0){
               $.ajax({
                   url:baseUrl+'m/getSensesByCampaignId',
                   type:'get',
                   dataType:'json',
                   data:{campaign_id:campaign_id},
                   success:function (data) {
                       if(data.result){
                           $('#scenesListBox').html('');
                           var scenesList=data.scenesList;
                           for(var i=0;i<data.scenesList.length;i++){
                               $('#scenesListBox').append('<p class="scenesListItem" style="line-height: 20px;padding: 5px;width: 100%;cursor: pointer;border-bottom: 1px solid #CCCCCC;margin-bottom: 0px" data-id="'+scenesList[i].scenes_id+'">'+scenesList[i].scenes_name+'</p>');
                           }
                       }else{
                           $('#scenesListBox').html('');
                       }
                   },
                   error:function (data) {
                       console.log(data);
                   }
               })
           }
        });

        $(document).on('click','.scenesListItem',function () {
            var scenesListItemObj=$(this);
            var scenesId=scenesListItemObj.attr('data-id');
            var scenesName=scenesListItemObj.text();
            $('#scenes_name').val(scenesName);
            $('#scenesListBox').hide();
            $.ajax({
                url:baseUrl+'m/getScenesByScenesId',
                type:'get',
                dataType:'json',
                data:{scenes_id:scenesId},
                success:function (data) {
                    var scenes=data.scenes;
                    var formObj=$('#scenesForm :input');
                    for(var i=0;i<formObj.length;i++){
                        var element=$(formObj[i]).attr('name');

                        $('[name="'+element+'"]').val(scenes[element]);
                    }
                    $('[name="scenes_id"]').val('');

                    console.log(data);
                }
            })
        });

        $(document).on('focus','#scenes_name',function () {
            var scenesListBoxObj=$('#scenesListBox');
            if(scenesListBoxObj.children().length!==0){
                scenesListBoxObj.show();
            }
        });

        $(document).on('focusout','#scenes_name',function () {
            var scenesListBoxObj=$('#scenesListBox');
            setTimeout(function () {
                scenesListBoxObj.hide();
            },100);

        });

        $(document).on('click','#changeSponsorImgBtn',function () {
            var id=$(this).attr('data-id');
            $('.sponsorImageUploadDiv').html(createFormSponsorImage(id));
            $('#sponsorImage').click();
        });

        $(document).on('click','#changeScenesImgBtn',function () {
            var id=$(this).attr('data-id');
            $('.scenesImageUploadDiv').html(createFormScenesImage(id));
            $('#scenesImage').click();
        });

        $(document).on('click','#changeRewardImgBtn',function () {
            var id=$(this).attr('data-id');
            $('.rewardImageUploadDiv').html(createFormRewardImage(id));
            $('#rewardImage').click();
        });


        $(document).on('click','#sponsorImgUpdateBtn',function () {

            var formData =new FormData(document.querySelector('#fileInput_imgPreviewSponsor'));

            var btnObj=$(this);
            btnObj.attr('disabled',true);
            $.ajax({
                url:'<?=base_url('m/updateScenesSponsorImage')?>',
                type:'post',
                dataType:'json',
                contentType: false,
                processData: false,
                data:formData,
                success:function (data) {
                    if(data.result){
                        btnObj.attr('disabled',false);
                        btnObj.parent().parent().hide();
                        btnObj.parent().parent().parent().find('.mainImage').show();
                        $('#sponsorMainImage').attr('src',baseUrl+'images/original/'+data.imagePath);
                    }else {
                        btnObj.attr('disabled',false);
                    }
                },
                error:function (data) {
                    console.log(data);
                }
            })
        });

        $(document).on('click','#rewardImgUpdateBtn',function () {

            var formData =new FormData(document.querySelector('#fileInput_imgPreviewReward'));

            var btnObj=$(this);
            btnObj.attr('disabled',true);
            $.ajax({
                url:'<?=base_url('m/updateScenesRewardImage')?>',
                type:'post',
                dataType:'json',
                contentType: false,
                processData: false,
                data:formData,
                success:function (data) {
                    if(data.result){
                        btnObj.attr('disabled',false);
                        btnObj.parent().parent().hide();
                        btnObj.parent().parent().parent().find('.mainImage').show();
                        $('#rewardMainImage').attr('src',baseUrl+'images/original/'+data.imagePath);
                    }else {
                        btnObj.attr('disabled',false);
                    }
                },
                error:function (data) {
                    console.log(data);
                }
            })
        });

        $(document).on('click','#scenesImgUpdateBtn',function () {

            var formData =new FormData(document.querySelector('#fileInput_imgPreviewScenes'));

            var btnObj=$(this);
            btnObj.attr('disabled',true);
            $.ajax({
                url:'<?=base_url('m/updateScenesScenesImage')?>',
                type:'post',
                dataType:'json',
                contentType: false,
                processData: false,
                data:formData,
                success:function (data) {
                    if(data.result){
                        btnObj.attr('disabled',false);
                        btnObj.parent().parent().hide();
                        btnObj.parent().parent().parent().find('.mainImage').show();
                        $('#scenesMainImage').attr('src',baseUrl+'images/original/'+data.imagePath);
                    }else {
                        btnObj.attr('disabled',false);
                    }
                },
                error:function (data) {
                    console.log(data);
                }
            })
        });

        $(document).on('click','.editCancelBtn',function () {
            $(this).parent().parent().hide();
            $(this).parent().parent().parent().find('.mainImage').show();
        })
    });


    function previewFileScenes(elm) {
        var previewFileID=$(elm).attr('data-prev-id');
        var preview = document.querySelector('#'+previewFileID);
        var file = document.querySelector('#scenesImage').files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
        };
        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
        if(preview.src!==''){
            $('#scenesMainImage').hide();
            $(preview).parent().show();
        }

    }

    function previewFileSponsor(elm) {
        var previewFileID=$(elm).attr('data-prev-id');
        var preview = document.querySelector('#'+previewFileID);
        var file = document.querySelector('#sponsorImage').files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
        };
        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
        if(preview.src!==''){
            $('#sponsorMainImage').hide();
            $(preview).parent().show();
        }

    }

    function previewFileReward(elm) {
        var previewFileID=$(elm).attr('data-prev-id');
        var preview = document.querySelector('#'+previewFileID);
        var file = document.querySelector('#rewardImage').files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
        };
        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
        if(preview.src!==''){
            $('#rewardMainImage').hide();
            $(preview).parent().show();
        }

    }

    var createFormScenesImage=function (id) {
        return '<form id="fileInput_imgPreviewScenes" enctype="multipart/form-data"><input type="hidden" name="scenesImageId" value="'+id+'"><input type="file" id="scenesImage" name="scenes_image" data-prev-id="imgPreviewScenes" onchange="previewFileScenes(this);"></form>';
    };

    var createFormSponsorImage=function (id) {
        return '<form id="fileInput_imgPreviewSponsor" enctype="multipart/form-data"><input type="hidden" name="scenesImageId" value="'+id+'"><input type="file" id="sponsorImage" name="sponsor_image" data-prev-id="imgPreviewSponsor" onchange="previewFileSponsor(this);"></form>';
    };

    var createFormRewardImage=function (id) {
        return '<form id="fileInput_imgPreviewReward" enctype="multipart/form-data"><input type="hidden" name="scenesImageId" value="'+id+'"><input type="file" id="rewardImage" name="reward_image" data-prev-id="imgPreviewReward" onchange="previewFileReward(this);"></form>';
    };
</script>
