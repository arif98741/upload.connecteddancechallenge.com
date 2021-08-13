<div class="hidden-xs leftMenu" >
<!--    <p class="orangeHeading" style="font-size: 20px">--><?//=$_SESSION['userEmail']?><!--</p>-->
    <ul class="nav nav-pills nav-stacked margintop20 left-menu" id="menu-li">
        <li ><a href="<?=base_url('user/social')?>">Social Accounts</a></li>
        <li ><a href="<?=base_url('user')?>">Challenges</a></li>
        <li ><a href="<?=base_url('user/leaderboard')?>">Leader Board</a></li>
        <li ><a href="<?=base_url('GoogleCtrl/logout')?>">Logout</a></li>
    </ul>
</div>
<div class="hidden-lg hidden-md hidden-sm" id="cbp-spmenu-div">
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1" style="overflow-y: auto;top: 0px">
<!--        <p class="orangeHeading" style="font-size: 20px">Admin Name</p>-->
        <ul class="nav nav-pills nav-stacked margintop20 left-menu">
            <li ><a href="<?=base_url('user/social')?>">Social Accounts</a></li>
            <li ><a href="<?=base_url('user')?>">Challenges</a></li>
            <li ><a href="<?=base_url('user/leaderboard')?>">Leader Board</a></li>
            <li ><a href="<?=base_url('GoogleCtrl/logout')?>">Logout</a></li>

        </ul>
    </nav>

    <script src="<?= base_url('resource/js/leftMenu.js')?>"></script>
    <script src="<?= base_url('resource/js/classie.js')?>"></script>
</div>