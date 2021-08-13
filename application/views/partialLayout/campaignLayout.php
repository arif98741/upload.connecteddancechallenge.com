<div class="container-fluid panel panel-body" style="margin: 10px">
    <div class="">
        <a href="<?=base_url('admin/campaigns/new')?>" class="btn btn-default">New Campaign</a>
        <a href="<?=base_url('admin/campaigns')?>" class="btn btn-default">Campaign List</a>
    </div>
</div>


<?php
if(isset($campaignsFormPanel) && $campaignsFormPanel!=''){
    ?>
    <div class="container-fluid panel panel-body" style="margin: 10px">
        <div class="">
            <?php $this->load->view($campaignsFormPanel)?>
        </div>
    </div>
<?php
}
?>
<?php
if(isset($campaignsListPanel) && $campaignsListPanel!=''){
    ?>
    <div class="container-fluid panel panel-body" style="margin: 10px">
        <?php $this->load->view($campaignsListPanel);?>
    </div>
<?php
}
?>



<script>
    var baseUrl='<?=base_url()?>';
    $(document).ready(function () {
        $('#campaignSubmitBtn').on('click',function () {
            var campaignFormObj=$('#campaignsForm');
            var data={};
            var hasError;
            var formInputs=$('#campaignsForm :input');
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

            var formData =new FormData(document.querySelector('#campaignsForm'));

            var btnObj=$(this);

            if(!hasError){
                waitCircleObj.html(waitCircle);
                btnObj.attr('disabled',true);
                $.ajax({
                    url:'<?=base_url('m/addCampaign')?>',
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
                                window.location.href=baseUrl+'admin/campaigns';
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

        $(document).on('click','#campaignUpdateBtn',function () {
            var campaignFormObj=$('#campaignsForm');
            var data={};
            var hasError;
            var formInputs=$('#campaignsForm :input');
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

            var formData =new FormData(document.querySelector('#campaignsForm'));

            var btnObj=$(this);

            if(!hasError){
                waitCircleObj.html(waitCircle);
                btnObj.attr('disabled',true);
                $.ajax({
                    url:baseUrl+'m/updateCampaign',
                    type:'post',
                    dataType:'json',
                    contentType: false,
                    processData: false,
                    data:formData,
                    success:function (data) {
                        console.log(data);
                        if(data.result){
                            btnObj.attr('disabled',false);
                            waitCircleObj.html('<span style="padding-left: 20px;color: yellowgreen">'+data.message+'</span>');
                            setTimeout(function () {
                                window.location.href=baseUrl+'admin/campaigns';
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

        $(document).on('click','#changeCampaignImgBtn',function () {

            var id=$(this).attr('data-id');
            $('.campaignImageUploadDiv').html(createFormCampaignImage(id));
            $('#campaignImage').click();
        });

        $(document).on('click','#changeSponsorImgBtn',function () {
            var id=$(this).attr('data-id');
            $('.sponsorImageUploadDiv').html(createFormSponsorImage(id));
            $('#sponsorImage').click();
        });

        $(document).on('click','#campaignImgUpdateBtn',function () {

            var formData =new FormData(document.querySelector('#fileInput_imgPreviewCampaign'));

            var btnObj=$(this);
            btnObj.attr('disabled',true);
            $.ajax({
                url:'<?=base_url('m/updateCampaignImage')?>',
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
                        $('#campaignMainImage').attr('src',baseUrl+'images/original/'+data.imagePath);
                    }else {
                        btnObj.attr('disabled',false);
                    }
                },
                error:function (data) {
                    console.log(data);
                }
            })
        });

        $(document).on('click','#sponsorImgUpdateBtn',function () {

            var formData =new FormData(document.querySelector('#fileInput_imgPreviewSponsor'));

            var btnObj=$(this);
            btnObj.attr('disabled',true);
            $.ajax({
                url:'<?=base_url('m/updateCampaignSponsorImage')?>',
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

        $(document).on('click','.editCancelBtn',function () {
            $(this).parent().parent().hide();
            $(this).parent().parent().parent().find('.mainImage').show();
        })

    });

    function previewFileCampaign(elm) {
        var previewFileID=$(elm).attr('data-prev-id');
        var preview = document.querySelector('#'+previewFileID);
        var file = document.querySelector('#campaignImage').files[0];
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
            $('#campaignMainImage').hide();
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

    var createFormCampaignImage=function (id) {
        return '<form id="fileInput_imgPreviewCampaign" enctype="multipart/form-data"><input type="hidden" name="campaignImageId" value="'+id+'"><input type="file" id="campaignImage" name="campaign_image" data-prev-id="imgPreviewCampaign" onchange="previewFileCampaign(this);"></form>';
    };

    var createFormSponsorImage=function (id) {
        return '<form id="fileInput_imgPreviewSponsor" enctype="multipart/form-data"><input type="hidden" name="campaignImageId" value="'+id+'"><input type="file" id="sponsorImage" name="sponsor_image" data-prev-id="imgPreviewSponsor" onchange="previewFileSponsor(this);"></form>';
    };
</script>