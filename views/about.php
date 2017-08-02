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
				<div>
                    
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
				<div class="box_style_2 hidden-xs" id="help">
					<i class="icon_lifesaver"></i>
					<h4>Need <span>Help?</span></h4>
					<a href="tel://004542344599" class="phone">+45 423 445 99</a>
					<a href="tel://004542344599" class="mobile">+45 423 445 99</a>
					<small>Monday to Friday 9.00am - 7.30pm</small>
				</div>
			</div>
            
			<div class="col-md-8">
				<div class="box_style_2">
					<h2 class="inner">Description</h2>
                    <div >
                        <img src='/images/slider_single_restaurant/1_large.jpg'>
                    </div>

                    <h3>About us</h3>
                    <?php 
                    $aboutus = Yii::$app->getHtmlBlock('aboutus');
                    if($aboutus != null){
                        echo($aboutus->content);
                    } ?>
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