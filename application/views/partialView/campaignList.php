<?php
if(isset($campaignList) && count($campaignList)>0){
    ?>
    <table class="table table-bordered table-condense">
        <thead>
        <tr>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Post Date</th>
            <th>Sponsor Name</th>
            <th>Entry Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($campaignList as $item){
            $campaigns=new Campaigns($item);
            ?>
            <tr id="tr_<?=$campaigns->getCampaignId()?>">
                <td class="campaignsName" data-id="<?=$campaigns->getCampaignId()?>"><a href="<?=base_url('admin/campaigns/'.$campaigns->getCampaignId())?>"><?=$campaigns->getCampaignName()?></a></td>
                <td><?=date('d/m/Y',strtotime($campaigns->getStartDate()))?></td>
                <td><?=date('d/m/Y',strtotime($campaigns->getEndDate()))?></td>
                <td><?=date('d/m/Y',strtotime($campaigns->getPostDate()))?></td>
                <td><?=$campaigns->getSponsorName()?></td>
                <td><?=$campaigns->getEntryDate()?></td>
                <td class="status" data-id="<?=$campaigns->getCampaignId()?>" data-status="<?=$campaigns->getCampaignStatus()?>" style="cursor: pointer"><?=$campaigns->getCampaignStatus()?></td>
                <td><button type="button" id="deleteBtn_<?=$campaigns->getCampaignId()?>" class="btn btn-default btn-sm deleteBtn"><i class="fa fa-trash"></i></button> </td>
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
            var campaignId=row.find('.campaignsName').attr('data-id');
            if(campaignId!=undefined){
                deleteBtnObj.attr('disabled',true);
                deleteBtnObj.html('<i class="fa fa-spin fa-spinner"></i>');

                $('#confirmationModel').modal({'show':true,'backdrop':'static'});

                $('#confirmationModel').find('.yesBtn').attr('data-id',campaignId);
                $('#confirmationModel').find('.yesBtn').attr('data-trRowId',row.attr('id'));
                $('#confirmationModel').find('.yesBtn').attr('data-deleteBtnId',deleteBtnObj.attr('id'));

                $('#confirmationModel').find('.modelCancelBtn').attr('data-id',campaignId);
                $('#confirmationModel').find('.modelCancelBtn').attr('data-trRowId',row.attr('id'));
                $('#confirmationModel').find('.modelCancelBtn').attr('data-deleteBtnId',deleteBtnObj.attr('id'));

            }
        });

        $(document).on('click','.yesBtn',function () {
            var yesBtnObj=$(this);
            var campaignId=yesBtnObj.attr('data-id');
            var rowId=yesBtnObj.attr('data-trRowId');
            var deleteBtnId=yesBtnObj.attr('data-deleteBtnId');
            var deleteBtnObj=$('#'+deleteBtnId);
            var row=$('#'+rowId);
            row.remove();
            $.ajax({
                url:baseUrl+'m/deleteCampaign',
                type:'get',
                dataType:'json',
                data:{campaignId:campaignId},
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
            var campaignId=statusObj.attr('data-id');
            var status=statusObj.attr('data-status');
            if(status!==''){
                $.ajax({
                    url:baseUrl+'m/changeCampaignStatus',
                    type:'get',
                    dataType:'json',
                    data:{campaignId:campaignId,status:status},
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
        })
    })
</script>
