<!DOCTYPE html>
<html>
<head>
<!--    <meta name="google-signin-client_id" content="116680965403-kqim5ueg8hv11fotgilv1nq972tce8sf.apps.googleusercontent.com">-->

    <?php $this->load->view('partialView/head')?>

<!--    <script src="https://apis.google.com/js/platform.js" async defer></script>-->

<!--    <script src="--><?//=base_url('resource/Google/auth.js')?><!--"></script>-->
    <script src="<?=base_url('resource/Google/cors_upload.js')?>"></script>
    <script src="<?=base_url('resource/Google/upload_video.js')?>"></script>
</head>
<body>

<?php $this->load->view('partialView/adminHeader')?>

<div class="container-fluid" style="padding-top: 80px">
    <div class="col-lg-6 col-lg-offset-3">
        <?php $this->load->view($loginForm)?>
    </div>
</div>

<!--<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>-->
<script src="https://apis.google.com/js/client.js"></script>

<script>
    $(document).ready(function () {
        $('#login-link').click(function () {
            document.cookie='glo=true';
            googleApiClientReady();
        })
    })
</script>
</body>
</html>
