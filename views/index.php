<?php
/**
    * Created by PhpStorm.
    * User: qiang
    * Date: 6/9/16
    * Time: 5:32 PM
    */

    $banners = Yii::$app->getImageByGroup('banner1');

    $currency = Yii::$app->params['currency']; 
    if($currency){
        $symbol = $currency->symbol;
    }
    
    $home_paralle = Yii::$app->getImages('home-paralle'); 
    
?>

<!-- Content ================================================== -->
<div class="container margin_60">
    <div class="main_title">
        <h2 class="nomargin_top" style="padding-top:0">How it works</h2>
        <p>
            Make online ordering so much easy than ever
        </p>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="box_home" id="two">
                <span>1</span>
                <h3>Visit online website,click</h3>
                <p>
                    Search our most popular menus
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box_home" id="one">
                <span>2</span>
                <h3>Order and select your delivery address</h3>
                <p>
                    Leave the rest to us with minutes
                </p>
            </div>
        </div>        
        
        <div class="col-md-3">
            <div class="box_home" id="three">
                <span>3</span>
                <h3>Pay by card or cash</h3>
                <p>
                    It's quick, easy and totally secure. 
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box_home" id="four">
                <span>4</span>
                <h3>Delivery or takeaway</h3>
                <p>
                    You can choose collect at our store or delivery
                </p>
            </div>
        </div>
    </div><!-- End row -->

    <div id="delivery_time" class="hidden-xs">
        <strong><span>3</span><span>0</span></strong>
        <h4>The minutes that usually takes to deliver!</h4>
    </div>
</div><!-- End container -->

<div class="white_bg">
    <div class="container margin_60">
        <div class="main_title">
            <h2 class="nomargin_top">Choose from Most Popular</h2>
            <p>
                Follow, follow, will not make a mistake
            </p>
        </div>

        <div class="row">
            <?php foreach($topsale as $item){ ?>
                <div class="col-md-6">
                    <a class="strip_list">
                        <div class="desc">
                            <div class="ribbon_1"></div>

                            <div class="thumb_strip">
                                <img src="<?='/'.$item->thumb?>" alt="<?=$item->name?>">
                            </div>
                            
                            <div>
                                <label><?=$item->name?></label>
                            </div>

                            <div class="location">
                                <?=trim($item->content)?> 
                                <div class="options text-left" style="display:inline;">
                                    <div class="addproduct" style="display:inline;">
                                        <span class="text-danger" style="margin-left:4px;"><?=$symbol?><?=$item->price?></span> 
                                        <i class="icon_plus_alt2 pull-right text-danger" name="<?=$item->id?>" count="1"></i>
                                    </div>
                                </div>                         
                            </div>
                        </div><!-- End desc-->
                    </a><!-- End strip_list-->
                </div>
            <?php } ?>
        </div>
    </div><!-- End container -->
</div><!-- End white_bg -->

<div class="high_light">
    <div class="container">
        <h3>Choose from over 100 dishes from our website</h3>
        <p>You click, we delivery, amazing, isn't?.</p>
        <a href="list_page.html">Ordering Now</a>
    </div><!-- End container -->
</div><!-- End hight_light -->

<section class="parallax-window" data-parallax="scroll" data-image-src="<?=$home_paralle == null? '':$home_paralle->image?>" data-natural-width="1200" data-natural-height="600">
    <div class="parallax-content">
        <div class="sub_content">
            <i class="icon_mug"></i>
            <h3>We also deliver to your office</h3>
            <p>
                Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.
            </p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End Content =============================================== -->

<div class="container margin_60">
    <div class="main_title margin_mobile">
        <h2 class="nomargin_top">Work with Us</h2>
        <p>
            Cum doctus civibus efficiantur in imperdiet deterruisset.
        </p>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <a class="box_work" href="submit_restaurant.html">
                <img src="/images/submit_restaurant.jpg" width="848" height="480" alt="" class="img-responsive">
                <h3>Submit your Restaurant<span>Start to earn customers</span></h3>
                <p>Lorem ipsum dolor sit amet, ut virtute fabellas vix, no pri falli eloquentiam adversarium. Ea legere labore eam. Et eum sumo ocurreret, eos ei saepe oratio omittantur, legere eligendi partiendo pro te.</p>
                <div class="btn_1">Read more</div>
            </a>
        </div>
        <div class="col-md-4">
            <a class="box_work" href="submit_driver.html">
                <img src="/images/delivery.jpg" width="848" height="480" alt="" class="img-responsive">
                <h3>We are looking for a Driver<span>Start to earn money</span></h3>
                <p>Lorem ipsum dolor sit amet, ut virtute fabellas vix, no pri falli eloquentiam adversarium. Ea legere labore eam. Et eum sumo ocurreret, eos ei saepe oratio omittantur, legere eligendi partiendo pro te.</p>
                <div class="btn_1">Read more</div>
            </a>
        </div>
    </div><!-- End row -->
</div><!-- End container -->