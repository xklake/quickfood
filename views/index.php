<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/9/16
 * Time: 5:32 PM
 */
$banners = Yii::$app->getImageByGroup('banner1');
$currency = Yii::$app->params['currency'];
if ($currency) {
    $symbol = $currency->symbol;
}

$home_paralle = Yii::$app->getImages('home-paralle');
$chefrecommend = Yii::$app->getImages('chefrecommend');
$this->registerJsFile('/quickfood/assets/js/parallax.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$home_foodstyle = Yii::$app->getHtmlBlock('home-foodstyle');
$home_parallax = Yii::$app->getHtmlBlock('home-parallax');
?>

<!-- Content ================================================== -->
<div class="white_bg">
    <div class="container margin_60">
        <div class="main_title">
            <h2 class="nomargin_top">Choose from Most Popular</h2>
            <p>
                Follow, follow, will not make a mistake
            </p>
        </div>

        <div class="row">
            <?php foreach ($topsale as $item) { ?>
                <div class="col-md-6">
                    <a class="strip_list">
                        <div class="desc">
                            <div class="ribbon_1"></div>

                            <div class="thumb_strip">
                                <img src="<?= '/' . $item->thumb ?>" alt="<?= $item->name ?>">
                            </div>

                            <div>
                                <label><?= $item->name ?></label>
                            </div>

                            <div class="location">
                                <?= trim($item->content) ?> 
                                <div class="text-left" style="display:inline;">
                                    <div class="addproduct" style="display:inline;">
                                        <span class="text-danger" style="margin-left:4px;"><?= $symbol ?><?= $item->price ?></span> 
                                        <i class="icon_plus_alt2 text-danger" name="<?= $item->id ?>" count="1"></i>
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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 nopadding features-intro-img">
            <div class="features-bg">
                <div class="features-img">
                </div>
            </div>
        </div>
        <div class="col-md-6 nopadding">
            <div class="features-content">
                <?= $home_foodstyle == null?"":$home_foodstyle->content?>
            </div>
        </div>
    </div>
</div>

<div class="high_light">
    <div class="container">
        <h3>Choose from over 100 dishes from our website</h3>
        <p>You click, we delivery, amazing, isn't?.</p>
        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id' => 52])?>">Ordering Now</a>
    </div><!-- End container -->
</div><!-- End hight_light -->

<section class="parallax-window" data-parallax="scroll" data-image-src="<?= $home_paralle == null ? '' : $home_paralle->image ?>" data-natural-width="1200" data-natural-height="600">
    <div class="parallax-content">
        <div class="sub_content">
            <i class="icon_mug"></i>
            <?= $home_parallax == null? "":$home_parallax->content?>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End Content =============================================== -->

<div class="white_bg">
    <div class='container margin_60'>
        <div class="main_title">
            <h2 class="nomargin_top">
                <img src="<?= $chefrecommend == null ? '' : $chefrecommend->image ?>" alt="<?= $chefrecommend->description ?>" style='width:200px;height:118px;'>
            </h2>
        </div>

        <div class="row">   
            <?php foreach ($recommends as $item) { ?>
                <div class="col-md-3 col-sm-3 wow zoomIn animated" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: zoomIn;">
                    <a class="strip_list grid">
                        <div class="ribbon_1">Recommended</div>
                        <div class="desc">
                            <div class="thumb_strip">
                                <img src="<?= '/' . $item->thumb ?>" alt="<?= $item->name ?>">
                            </div>
                            <h3><?= $item->name ?></h3>
                            <div class="rating">
                                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
                            </div>                            
                            <div class="location">
                                <?= $symbol . $item->price ?>  <i class="icon_plus_alt2 text-danger" name="<?= $item->id ?>" count="1"></i>
                            </div>
                        </div>
                    </a><!-- End strip_list-->
                </div><!-- End col-md-3-->                
            <?php } ?>
        </div>
    </div>    

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
    </div><!-- End container -->

    <div class="container-fluid">
        <div class="main_title">
            <h2 class="nomargin_top" style="padding-top:0;margin-bottom:10px;">How to find us</h2>
            <p>
                <a href="tel://<?= Yii::$app->setting->get('phone') ?>" class="phone">
                    <i class="icon-phone-circled"></i>  <?= Yii::$app->setting->get('phone') ?>
                </a>
            </p>
        </div>

        <div class='row' style='height:400px;'>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d317718.69319292053!2d-0.3817765050863085!3d51.528307984912544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon!5e0!3m2!1sen!2suk!4v1523617240377" width="2000" height="600" frameborder="0" style="border:1" allowfullscreen></iframe>
        </div>
    </div><!-- End container -->
</div>



<?php
$urlUpdateCart = Yii::$app->urlManager->createAbsoluteUrl(['cart/updatecart']);

$this->registerJs('
    var product = {' . 'csrf:"' . Yii::$app->request->getCsrfToken() . '"};
    var user = {id:' . (Yii::$app->user->isGuest ? 0 : Yii::$app->user->id) . ', ' . '};
    var urlUpdateCart = "'.$urlUpdateCart.'";
    var urlCartAdd = "' . Yii::$app->urlManager->createAbsoluteUrl(['cart/ajax-add']) . '";');
    
    $js = <<<JS

        function cartops()
        {
            param = {
                productId : $(this).attr('name'),
                number : $(this).attr('count'),
                _csrf : product.csrf
            };
            
            var ele = $(this);
            ele.removeClass("icon_plus_alt2").addClass("icon-spin6 animate-spin");

            $.post(urlCartAdd, param, function(data) 
                {
                    if (data.status > 0) 
                    {
                        var cartparam = {
                            _csrf : product.csrf
                        }; 
            
                        $.post(urlUpdateCart,cartparam);
                    }
            
                    ele.removeClass("icon-spin6 animate-spin").addClass("icon_plus_alt2");
                },'json');
        }

        jQuery(document).on('click', ".icon_plus_alt2", cartops);
JS;

$this->registerJs($js);
?>