<!DOCTYPE html>
<html lang="en">
<head>


    <?php $this->load->view('partialView/head')?>
    <link href="<?=base_url('resource/datetimepicker/css/bootstrap-datetimepicker.css')?>" rel="stylesheet">
    <link href="<?=base_url('resource/validation/validation.css')?>" rel="stylesheet">
    <link href="<?=base_url('resource/bootstrap-select/css/bootstrap-select.css')?>" rel="stylesheet">
    <link href="<?=base_url('resource/owl-carousel/owl.carousel.css')?>" rel="stylesheet">
    <link href="<?=base_url('resource/owl-carousel/owl.theme.default.css')?>" rel="stylesheet">
    <link href="<?=base_url('resource/bootstrap-switch/css/bootstrap-switch.css')?>" rel="stylesheet">
    <link href="<?=base_url('resource/datatable/dataTables.bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('resource/datatable/responsive.bootstrap.min.css')?>" rel="stylesheet">

    <script src="<?=base_url('resource/Google/cors_upload.js')?>"></script>
    <script src="<?=base_url('resource/Google/upload_video.js')?>"></script>

</head>
<!--<body style="background-color: #08ACD3;font-family: 'New Century Gothic'">-->
<body style="background-color: #08ACD3;font-family: 'Century Gothic'">
<?php $this->load->view('partialView/header') ?>
<div class="container-fluid mainContainer" style="margin-top: 0px; ">
    <?php
    if((isset($_SESSION['loginStatus']) && $_SESSION['loginStatus']) && (isset($_SESSION['loginType']) && $_SESSION['loginType']=='userLogin')){
        $this->load->model('DLModel');
        $dlModel=new DLModel();
        $scheduleVideoCount=$dlModel->getScheduleVideoCount();
        $scheduleVideoCount=$scheduleVideoCount[0]['count'];
        if(isset($scenesListCount) && $scenesListCount>1){
            $campaignShow=true;
        }elseif (isset($scenesListCount) && $scenesListCount<=1){
            $campaignShow=false;
        }else{
            $campaignShow=true;
        }
        ?>
        <div class="hidden-lg hidden-md hidden-sm col-xs-12 leftPanel">
            <?php $this->load->view('partialView/leftPanelUser')?>
        </div>
        <div class="col-xs-12 rightPanel" style="background-color: #08ACD3;padding: 0">
            <div style="display: flex;background-color: white">
                <div style="align-items: center;margin: auto">
                    <img style="width: 90%;padding-left: 5%" src="<?=base_url('images/logo3.png')?>">
                </div>
            </div>
            <div style="margin-top: -5px">
                <img class="img-responsive" src="<?=base_url('images/Clouds.png')?>">
            </div>
            <div class="hidden-xs desktop-menu"  style="display: flex;padding: 4px 0px;margin-bottom: 15px">
                <ul class="nav nav-pills nav-stacked" style="display: inline-flex;align-items: center;margin: auto">
                    <li style="margin: 0 5px" ><a href="<?=base_url('user/social')?>">Social Accounts</a></li>
                    <li class="<?=$campaignShow==true?'':'hidden'?>" style="margin: 0 5px" ><a href="<?=base_url('user')?>">Challenges</a></li>
                    <li class="<?=$scheduleVideoCount==0?'hidden':'' ?> " style="margin: 0 5px" ><a href="<?=base_url('user/leaderboard')?>">Leader Board</a></li>
                    <li style="margin: 0 5px" ><a href="<?=base_url('GoogleCtrl/logout')?>">Logout</a></li>
                </ul>
            </div>
            <?php $this->load->view($rightLayout) ?>
        </div>
    <?php
    }else{
        ?>
        <div class="rightPanel" style="background-color: #08ACD3;">
            <div style="display: flex;background-color: white">
                <div style="align-items: center;margin: auto">
                    <img style="width: 90%;padding-left: 5%" src="<?=base_url('images/logo3.png')?>">
                </div>
            </div>
            <div style="margin-top: -5px">
                <img class="img-responsive" src="<?=base_url('images/Clouds.png')?>">
            </div>
            <div class="hidden" style="display: flex;background-color: rgba(0,0,0,.5);padding: 4px 0px;margin-bottom: 15px">
                <ul class="nav nav-pills nav-stacked" style="display: inline-flex;align-items: center;margin: auto">
                    <?php
                    if(isset($scenes)){
                        $labelName=$scenes['scenes_name'];
                    }else{
                        $labelName='Connected Dance challenge';
                    }
                    ?>
                    <li><p style="line-height:40px;margin-bottom: 0px;font-size: 20px;color: white"><?=$labelName?></p></li>
                </ul>
            </div>
            <?php $this->load->view($rightLayout) ?>
        </div>
    <?php
    }
    ?>

</div>


<script src="<?=base_url('resource/datatable/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('resource/datatable/dataTables.bootstrap.min.js')?>"></script>
<script src="<?=base_url('resource/datatable/dataTables.responsive.min.js')?>"></script>
<script src="<?=base_url('resource/datatable/responsive.bootstrap.min.js')?>"></script>

<?php $this->load->view('partialView/script')?>
<script src="<?=base_url('resource/datetimepicker/js/bootstrap-datetimepicker.js')?>"></script>
<script src="<?=base_url('resource/validation/validation.js')?>"></script>
<script src="<?=base_url('resource/bootstrap-select/js/bootstrap-select.js')?>"></script>
<script src="<?=base_url('resource/bootstrap-filestyle/bootstrap-filestyle.js')?>"></script>
<script src="<?=base_url('resource/owl-carousel/owl.carousel.js')?>"></script>
<script src="<?=base_url('resource/bootstrap-switch/js/bootstrap-switch.js')?>"></script>
<?php
if((isset($_SESSION['loginStatus']) && $_SESSION['loginStatus']) && (isset($_SESSION['loginType']) && $_SESSION['loginType']=='userLogin')){
    ?>

    <script src="//apis.google.com/js/client:plusone.js"></script>

<?php
if(isset($_GET['id']) && $_GET['id']!=''){
    $token=$_GET['id'];
}else{
    $token='';
}
?>
    <script>

        var baseUrl='<?=base_url()?>';

        function getUserData() {
            var token='<?=$token?>';

            if(token!=''){
                $.ajax({
                    url:'https://www.googleapis.com/oauth2/v1/userinfo',
                    type:'get',
                    dataType:'json',
                    data:{access_token:token},
                    success:function (data) {
                        console.log(data);
                        var userData={
                            'user_email':data.email,
                            'youtube_username':data.name,
                            'picture_url':data.picture,
                            'user_google_id':data.id,
                            'access_token':token
                        };

                        saveUserData(userData);
                    },
                    error:function (data) {
                        console.log(data);
                    }
                })
            }
        }

        function saveUserData(data) {
            $.ajax({
                url:baseUrl+'m/addUser',
                type:'post',
                dataType:'json',
                data:data,
                success:function (data) {

                },
                error:function (data) {

                }
            });
        }


    </script>


<?php
$a=$_SESSION['accessToken'];
$accessToken=$a['access_token'];
?>

    <script>
        $(document).ready(function () {

            //localhost
            var a={
                'access_token':'<?=$a['access_token']?>',
                'client_id':'266333030446-4g1q3ccuuo9nb4khmb61ep5dikol2g95.apps.googleusercontent.com',
                'expires_in':'<?=$a['expires_in']?>',
                'id_token':'<?=$a['id_token']?>',
                'token_type':'<?=$a['token_type']?>',
                'created':'<?=$a['created']?>'
            };

            signinCallback(a);
        })
    </script>

    <?php
}
?>

</body>
</html>