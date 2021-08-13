<div class="container-fluid panel panel-body" style="margin: 10px">
    <div class="">
        <a href="<?=base_url('admin/addAdmin')?>" class="btn btn-default">New Admin</a>
        <a href="<?=base_url('admin/adminList')?>" class="btn btn-default">Admin List</a>
    </div>
</div>

<?php
if(isset($adminForm) && $adminForm!=''){
    ?>
    <div class="container-fluid panel panel-body" style="margin: 10px">
        <div class="">
            <?php $this->load->view($adminForm)?>
        </div>
    </div>
    <?php
}
?>
<?php
if(isset($adminListPanel) && $adminListPanel!=''){
    ?>
    <div class="container-fluid panel panel-body" style="margin: 10px">
        <?php $this->load->view($adminListPanel);?>
    </div>
    <?php
}
?>

<script>
    var baseUrl='<?=base_url()?>';

    $(document).ready(function () {
        $(document).on('click','#adminAddBtn',function () {
            var adminFormObj=$('#adminForm');
            var data={};
            var hasError;
            var formInputs=$('#adminForm :input');
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

            var waitCircleObj=adminFormObj.find('.wait');

//            var formData =new FormData(document.querySelector('#adminForm'));


            var btnObj=$(this);

            if(!hasError){
                waitCircleObj.html(waitCircle);
                btnObj.attr('disabled',true);
                $.ajax({
                    url:baseUrl+'m/addAdmin',
                    type:'post',
                    dataType:'json',
                    data:data,
                    success:function (data) {
                        if(data.result){
                            btnObj.attr('disabled',false);
                            waitCircleObj.html('<span style="padding-left: 20px;color: yellowgreen">'+data.message+'</span>');
                            setTimeout(function () {
                                window.location.href=baseUrl+'admin/adminList ';
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

        $(document).on('click','.adminStatus',function () {
            var statusObj=$(this);
            var adminId=statusObj.attr('data-id');
            var adminStatus=statusObj.attr('data-adminStatus');
            if(adminStatus!==''){
                $.ajax({
                    url:baseUrl+'m/changeAdminStatus',
                    type:'get',
                    dataType:'json',
                    data:{admin_id:adminId,admin_status:adminStatus},
                    success:function (data) {
                        console.log(data);
                        statusObj.text(data.status);
                        statusObj.attr('data-adminStatus',data.status);
                    },
                    error:function (data) {
                        console.log(data);
                    }
                })
            }
        });

        /*$(document).on('click','.adminOauthStatus',function () {
            var statusObj=$(this);
            var adminId=statusObj.attr('data-id');
            var adminStatus=statusObj.attr('data-adminOauthStatus');
            if(adminStatus!==''){
                $.ajax({
                    url:baseUrl+'m/changeAdminOauthStatus',
                    type:'get',
                    dataType:'json',
                    data:{admin_id:adminId,fb_auth_status:adminStatus},
                    success:function (data) {
                        console.log(data);
                        statusObj.text(data.status);
                        statusObj.attr('data-adminOauthStatus',data.status);
                    },
                    error:function (data) {
                        console.log(data);
                    }
                })
            }
        })*/
    })
</script>
