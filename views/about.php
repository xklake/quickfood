<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/10/16
 * Time: 11:35 AM
 */
    echo \frontend\web\template\quickfood\widgets\BreadcrumbsEx::widget();

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
                <?php 
                    echo \frontend\web\template\quickfood\widgets\Contact::widget();
                    echo \frontend\web\template\quickfood\widgets\OpeningHour::widget();
                ?>
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