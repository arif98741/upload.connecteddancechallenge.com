<?php
if(isset($adminList) && count($adminList)>0){
    ?>
    <table class="table table-bordered table-condense">
        <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Entry Date</th>
            <th>Oauth Date</th>
            <th hidden>Oauth Id</th>
            <th>Oauth Status</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($adminList as $item){
            $admin=new Admins($item);
            ?>
            <tr>
                <td><img src="<?=$admin->getPictureUrl()?>"></td>
                <td><?=$admin->getAdminFirstName().' '.$admin->getAdminLastName()?></td>
                <td><?=$admin->getAdminEmail()?></td>
                <td><?=($admin->getEntryDate()!='' && $admin->getEntryDate()!=null)?date('d-m-Y H:i',strtotime($admin->getEntryDate())):''?></td>
                <td><?=($admin->getFbAuthDate()!='' && $admin->getFbAuthDate()!=null)?date('d-m-Y H:i',strtotime($admin->getFbAuthDate())):''?></td>
                <td hidden><?=$admin->getOauthUid()?></td>
                <td class="adminOauthStatus" data-id="<?=$admin->getAdminId()?>" data-adminOauthStatus="<?=$admin->getFbAuthStatus()?>" style="cursor: pointer"><?=$admin->getFbAuthStatus()?></td>
                <td class="adminStatus" data-id="<?=$admin->getAdminId()?>" data-adminStatus="<?=$admin->getAdminStatus()?>" style="cursor: pointer"><?=$admin->getAdminStatus()?></td>
            </tr>

            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}
?>
