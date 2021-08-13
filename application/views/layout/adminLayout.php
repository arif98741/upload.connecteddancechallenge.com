<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partialView/head')?>
    <link href="<?=base_url('resource/datetimepicker/css/bootstrap-datetimepicker.css')?>" rel="stylesheet">
    <link href="<?=base_url('resource/validation/validation.css')?>" rel="stylesheet">
    <link href="<?=base_url('resource/bootstrap-select/css/bootstrap-select.css')?>" rel="stylesheet">
    <link href="<?=base_url('resource/datatable/dataTables.bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('resource/datatable/responsive.bootstrap.min.css')?>" rel="stylesheet">
</head>
<body>

<?php $this->load->view('partialView/adminHeader') ?>
<div class="container-fluid mainContainer">
    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 leftPanel">
        <?php $this->load->view('partialView/leftPanel')?>
    </div>
    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 rightPanel">
        <?php $this->load->view($rightLayout) ?>
    </div>
</div>

<?php $this->load->view('partialView/script')?>
<script src="<?=base_url('resource/datetimepicker/js/bootstrap-datetimepicker.js')?>"></script>
<script src="<?=base_url('resource/validation/validation.js')?>"></script>
<script src="<?=base_url('resource/bootstrap-select/js/bootstrap-select.js')?>"></script>
<script src="<?=base_url('resource/bootstrap-filestyle/bootstrap-filestyle.js')?>"></script>

<script src="<?=base_url('resource/datatable/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('resource/datatable/dataTables.bootstrap.min.js')?>"></script>
<script src="<?=base_url('resource/datatable/dataTables.responsive.min.js')?>"></script>
<script src="<?=base_url('resource/datatable/responsive.bootstrap.min.js')?>"></script>
</body>
</html>