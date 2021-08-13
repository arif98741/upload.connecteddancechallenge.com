

<div align="center">
    <div style="margin: 10px;">
        <div style="border: 1px solid #CCCCCC;width: 300px;padding: 10px;border-radius: 5px;text-align: left;background-color: white">
            <span class="fa fa-facebook fa-2x img-circle" style="background-color: #484AAF;line-height: 50px;width: 50px;height: 50px;text-align: center;color: white"></span>
            <?php
            if(isset($fbTokenExpire)){
                if($fbTokenExpire){
                    ?>
                    <a href="<?=$authUrl?>" style="line-height: 50px;font-size: 30px">Facebook</a>
                    <span class="fa fa-2x fa-remove"></span>
                    <span style="float: right;line-height: 50px">Expired</span>
            <?php
                }else{
                    ?>
                    <span  style="line-height: 50px;font-size: 30px">Facebook</span>
                    <span class="fa fa-2x fa-check"></span>
                    <a href="<?=base_url('user/facebookUnlink')?>" style="float: right;line-height: 50px">Unlink</a>
            <?php
                }
            }else{
                ?>
                <a href="<?=$authUrl?>" style="line-height: 50px;font-size: 30px">Facebook</a>
            <?php
            }
            ?>
        </div>
    </div>
    <div style="margin: 10px;">
        <div style="border: 1px solid #CCCCCC;width: 300px;padding: 10px;border-radius: 5px;text-align: left;background-color: white">

            <span class="fa fa-twitter fa-2x img-circle" style="background-color: #1DA1F2;line-height: 50px;width: 50px;height: 50px;text-align: center;color: white"></span>
            <?php
            if(isset($twTokenExpire)){

                if($twTokenExpire){
                    ?>
                    <a href="<?=$twAuthUrl;?>" style="line-height: 50px;font-size: 30px">Twitter</a>
                    <span class="fa fa-2x fa-remove"></span>
                    <span style="float: right;line-height: 50px">Expired</span>
                    <?php
                }else{
                    ?>
                    <span style="line-height: 50px;font-size: 30px">Twitter</span>
                    <span class="fa fa-2x fa-check"></span>
                    <a href="<?=base_url('user/twitterUnlink')?>" style="float: right;line-height: 50px">Unlink</a>
                    <?php
                }
            }else{
                ?>
                <a href="<?=$twAuthUrl?>" style="line-height: 50px;font-size: 30px">Twitter</a>
                <?php
            }
            ?>
        </div>
    </div>
</div>
