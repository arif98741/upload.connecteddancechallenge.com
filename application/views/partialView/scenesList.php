<?php
if(isset($scenesList) && count($scenesList)>0){
    ?>
    <table class="table table-bordered table-condense">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Post Date</th>
            <th>Rewards</th>
            <th>Sponsor Name</th>
            <th>Status</th>
            <th>Action</th>
            <th>Link</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($scenesList as $item){
            $scenes=new Scenes($item);
            ?>
            <tr id="tr_<?=$scenes->getScenesId()?>">
                <td><?=$scenes->getScenesId()?></td>
                <td class="scenesName" data-id="<?=$scenes->getScenesId()?>"><a href="<?=base_url('admin/scenes/'.$scenes->getScenesId())?>"><?=$scenes->getScenesName()?></a></td>
                <td><?=date('d/m/Y',strtotime($scenes->getPostDate()))?></td>
                <td><?=$scenes->getRewards()?></td>
                <td><?=$scenes->getSponsor()?></td>
                <td class="status" data-id="<?=$scenes->getScenesId()?>" data-status="<?=$scenes->getSceneStatus()?>" style="cursor: pointer"><?=$scenes->getSceneStatus()?></td>
                <td><button type="button" id="deleteBtn_<?=$scenes->getScenesId()?>" class="btn btn-default btn-sm deleteBtn"><i class="fa fa-trash"></i></button> </td>
                <td><a target="_blank" href="<?=base_url('?challenge='.$scenes->getScenesId()) ?>">Link</a></td>
            </tr>

        <?php
        }
        ?>
        </tbody>
    </table>
<?php
}else{

}
?>

<div id="confirmationModel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" align="center" style="padding-bottom: 40px">
                <div class="container-fluid">
                    <div class="">
                        <p style="line-height: 50px">Are you sure want to <strong style="color: red">Delete</strong> data</p>
                        <button type="button" data-id="" data-trRowId="" data-deleteBtnId="" class="btn btn-default modelCancelBtn" data-dismiss="modal" style="width: 100px">No</button>
                        <button type="button" data-id="" data-trRowId="" data-deleteBtnId="" class="btn btn-primary yesBtn" style="width: 100px">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var baseUrl='<?=base_url()?>';
    $(document).ready(function () {
        $(document).on('click','.deleteBtn',function () {
            var deleteBtnObj=$(this);
            var row=deleteBtnObj.parent().parent();
            var scenesId=row.find('.scenesName').attr('data-id');
            console.log(row);
            if(scenesId!=undefined){
                deleteBtnObj.attr('disabled',true);
                deleteBtnObj.html('<i class="fa fa-spin fa-spinner"></i>');

                $('#confirmationModel').modal({'show':true,'backdrop':'static'});

                $('#confirmationModel').find('.yesBtn').attr('data-id',scenesId);
                $('#confirmationModel').find('.yesBtn').attr('data-trRowId',row.attr('id'));
                $('#confirmationModel').find('.yesBtn').attr('data-deleteBtnId',deleteBtnObj.attr('id'));

                $('#confirmationModel').find('.modelCancelBtn').attr('data-id',scenesId);
                $('#confirmationModel').find('.modelCancelBtn').attr('data-trRowId',row.attr('id'));
                $('#confirmationModel').find('.modelCancelBtn').attr('data-deleteBtnId',deleteBtnObj.attr('id'));

            }
        });


        $(document).on('click','.yesBtn',function () {
            var yesBtnObj=$(this);
            var scenesId=yesBtnObj.attr('data-id');
            var rowId=yesBtnObj.attr('data-trRowId');
            var deleteBtnId=yesBtnObj.attr('data-deleteBtnId');
            var deleteBtnObj=$('#'+deleteBtnId);
            var row=$('#'+rowId);
            $.ajax({
                url:baseUrl+'m/deleteScenes',
                type:'get',
                dataType:'json',
                data:{scenesId:scenesId},
                success:function (data) {
                    deleteBtnObj.attr('disabled',false);
                    deleteBtnObj.html('<i class="fa fa-trash"></i>');
                    if(data.result){
                        row.remove();
                    }
                    $('#confirmationModel').modal('hide');
                },
                error:function () {
                    deleteBtnObj.attr('disabled',false);
                    deleteBtnObj.html('<i class="fa fa-trash"></i>');
                    $('#confirmationModel').modal('hide');
                }
            });
        });

        $(document).on('click','.modelCancelBtn',function () {
            var yesBtnObj=$(this);
            var scenesId=yesBtnObj.attr('data-id');
            var rowId=yesBtnObj.attr('data-trRowId');
            var deleteBtnId=yesBtnObj.attr('data-deleteBtnId');
            var deleteBtnObj=$('#'+deleteBtnId);
            var row=$('#'+rowId);

            deleteBtnObj.attr('disabled',false);
            deleteBtnObj.html('<i class="fa fa-trash"></i>');
        });


        $(document).on('click','.status',function () {
            var statusObj=$(this);
            var scenesId=statusObj.attr('data-id');
            var status=statusObj.attr('data-status');
            if(status!==''){
                $.ajax({
                    url:baseUrl+'m/changeScenesStatus',
                    type:'get',
                    dataType:'json',
                    data:{scenesId:scenesId,status:status},
                    success:function (data) {
                        console.log(data);
                        statusObj.text(data.status);
                        statusObj.attr('data-status',data.status);
                    },
                    error:function (data) {
                        console.log(data);
                    }
                })
            }
        });
    })
</script>
