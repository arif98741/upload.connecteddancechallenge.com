
<div class="container-fluid" style="padding-top: 10%">

    <?php
    if(isset($message)){
        ?>
        <span><?=$message?></span>
    <?php
    }
    ?>

    <div style="padding-top: 30px;line-height: 25px;font-size: 18px">
        <p>Choose the Youtube account to which you want to upload your Connected Dance video</p>
    </div>

    <a href="<?=$authUrl?>" style="color: whitesmoke;width: 100%">
        <div class="" style="margin-top: 5px;margin-bottom: 5px;background: #3B5998;line-height: 50px;font-size: x-large;text-align: center;border-radius: 5px;">
            <span>Admin Login <small style="font-style: italic">with</small>  Facebook </span><span class="fa fa-facebook img-circle" style="background-color: #484AAF;line-height: 40px;width: 40px;height: 40px;text-align: center;color: white;border: 1px solid whitesmoke;margin-top: 3px;margin-left: 10px"></span>
        </div>
    </a>
    <a href="<?=base_url('GoogleCtrl')?>" style="color: whitesmoke">
        <div class="" style="margin-top: 5px;margin-bottom: 5px;background-color: red;line-height: 50px;font-size: x-large;text-align: center;border-radius: 5px;">
            <span>User Login <small style="font-style: italic">with</small> Youtube</span><span class="fa fa-youtube img-circle" style="background-color: red;line-height: 40px;width: 40px;height: 40px;text-align: center;color: white;border: 1px solid whitesmoke;margin-top: 3px;margin-left: 10px"></span>
        </div>
    </a>

</div>

<script>


    $(document).ready(function () {

        $('#login-link').click(function() {
            console.log('click');
            document.cookie='glo=true';
            gapi.auth.authorize({
                client_id: OAUTH2_CLIENT_ID,
                scope: OAUTH2_SCOPES,
                immediate: false
            },handleAuthResult);
//            checkAuth();
        });

        $('#logout-link').click(function () {
//            window.location.href='https://mail.google.com/mail/u/0/?logout&hl=en';


            /*$.ajax({
                type:'GET',
                url:"https://accounts.google.com/o/oauth2/revoke?token=" + accessToken,
                async: false,
                contentType: "application/json",
                dataType: 'jsonp',
                success:function (data) {
                    console.log(data);
                },
                error:function (data) {
                    console.log(data);
                }
            })*/

//            logout();
            document.cookie='glo=false';
            window.location.href='http://localhost/YoutubeVideoUpload';
        });

        var logout = function() {

            gapi.auth.signOut();
            document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/YoutubeVideoUpload/";
        };


    })
</script>