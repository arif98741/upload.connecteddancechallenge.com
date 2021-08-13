<div class="hidden-xs leftMenu" >
    <p class="orangeHeading" style="font-size: 20px">Admin</p>
    <ul class="nav nav-pills nav-stacked margintop20 left-menu" id="menu-li">
        <li ><a href="<?=base_url('admin/campaigns')?>">Campaigns</a></li>
        <li ><a href="<?=base_url('admin/scenes')?>">Challenges</a></li>
        <li ><a href="<?=base_url('admin/leaderboard')?>">Leader Board</a></li>
        <li ><a href="<?=base_url('admin/adminList')?>">Admin Users</a></li>
        <li ><a href="<?=base_url('FacebookCtrl/logout')?>">Logout</a></li>
    </ul>
</div>
<div class="hidden-lg hidden-md hidden-sm" id="cbp-spmenu-div">
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1" style="overflow-y: auto;">
        <?php
        if(isset($_SESSION['userName'])) {
            ?>
            <p class="orangeHeading" style="font-size: 20px"><?=$_SESSION['userName']?></p>
            <?php
        }else{
            ?>
            <p class="orangeHeading" style="font-size: 20px">Admin Name</p>
            <?php
        }
        ?>
        <ul class="nav nav-pills nav-stacked margintop20 left-menu">
            <li ><a href="<?=base_url('admin/campaigns')?>">Campaigns</a></li>
            <li ><a href="<?=base_url('admin/scenes')?>">Challenges</a></li>
            <li ><a href="<?=base_url('admin/leaderboard')?>">Leader Board</a></li>
            <li ><a href="<?=base_url('admin/adminList')?>">Admin Users</a></li>
            <li ><a href="<?=base_url('FacebookCtrl/logout')?>">Logout</a></li>
        </ul>
    </nav>

    <script src="<?= base_url('resource/js/leftMenu.js')?>"></script>
    <script src="<?= base_url('resource/js/classie.js')?>"></script>
</div>