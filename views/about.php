<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/10/16
 * Time: 11:35 AM
 */
?>
<!-- Content ================================================== -->
<div class="container margin_60_35">
		<div class="row">
        
			<div class="col-md-4">
				<div class='box_style_2'>
                    <?php 
                        $storeimage = Yii::$app->getImages('storeimage');
                        if($storeimage != null){
                    ?>  
                        <img src='<?='/'.$storeimage->image?>' class='img-thumbnail'>
                    <?php } ?>
				</div>
                
				<div class="box_style_2" id="help">
					<i class="icon_lifesaver"></i>
                    <h4><span>Contact Us</span></h4>
                    <?php
                        $phone = Yii::$app->setting->get('phone');
                        if ($phone != null) {
                    ?>
                        <a href="<?= 'tel:' . $phone ?>" class="phone">
                            <?= $phone ?>
                        </a>
                    <?php } ?>

                    <?php
                        $mobile = Yii::$app->setting->get('mobile');
                        if ($mobile != null) {
                    ?>
                        <a href="<?= 'tel:' . $mobile ?>" class="phone">
                            <?= $mobile ?>
                        </a>
                    <?php } ?>    
                    
                    <?php
                        $email = Yii::$app->setting->get('email');
                        if ($email != null) {
                    ?>
                        <a href="<?= 'tel:' . $email ?>" class="email">
                            <?=$email?>
                        </a>
                    <?php } ?>
				</div>
                
				<div class="box_style_2">
					<h4 class="nomargin_top">Opening time <i class="icon_clock_alt pull-right"></i></h4>
                    <ul class="opening_list">
                    <?php 
                        $openinghour = Yii::$app->getHtmlBlock('openinghour');
                        if($openinghour != null){
                            echo($openinghour->content);
                        }
                    ?>
                    </ul>
				</div>
			</div>
            
			<div class="col-md-8">
				<div class="box_style_2">
					<h2 class="inner">Description</h2>
                    <?php 
                        $address = Yii::$app->setting->get('address');
                        if($address != null){
                    ?>        
                    <div style="margin-bottom: 10px;">
                            <strong>Address:</strong><?=$address?>
                        </div>
                    <?php } ?>
                    <?php 
                        $googlemap = Yii::$app->setting->get('googlemap');
                        if($googlemap != null){
                    ?> 
                        <div>
                            <iframe src="<?= Yii::$app->setting->get('googlemap') ?>" frameborder="0" style="border:0;width:100%;min-height:435px;" height="435px" allowfullscreen></iframe>
                        </div>
                    <?php } ?>

                    <h3>About us</h3>
                    <?php 
                        $aboutus = Yii::$app->getHtmlBlock('aboutus');
                        if($aboutus != null){
                            echo($aboutus->content);
                        } 
                    ?>
                </div>
			</div>
		</div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== 


<script type="text/javascript">
	$( document ).ready(function( $ ) {
		$( '#Img_carousel' ).sliderPro({
			width: 960,
			height: 500,
			fade: true,
			arrows: true,
			buttons: false,
			fullScreen: false,
			smallSize: 500,
			startSlide: 0,
			mediumSize: 1000,
			largeSize: 3000,
			thumbnailArrows: true,
			autoplay: false
		});
	});
</script>
-->