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
            <h2 class="nomargin_top">Choose from Most Popular Dishes</h2>
        </div>

        <div class="row">
            <?php foreach ($hotSale as $item) { ?>
                <div class="col-md-3">
                    <a class="strip_list grid">
                        <div class="desc">
                            <div class="thumb_stripex">
                                <img src="<?= '/' . $item->thumb ?>" alt="<?=  str_replace('[[',' ',str_replace(']]','', $item->name))?>">
                            </div>

                            <div>
                                <label><?=str_replace('[[',' ',str_replace(']]','', $item->name)) ?></label>
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
                        </div>
                   	</a>
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
                        <div class="desc">
                            <div class="thumb_stripex">
                                <img src="<?= '/' . $item->thumb ?>" alt="<?=str_replace('[[',' ',str_replace(']]','', $item->name))?>">
                            </div>
                            <h3><?= str_replace('[[',' ',str_replace(']]','', $item->name))?></h3>
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
            <iframe src="<?= Yii::$app->setting->get('googlemap') ?>" width="2000" height="600" frameborder="0" style="border:1" allowfullscreen></iframe>
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
            var oldclass = ele.attr("class");
            ele.removeClass(oldclass).addClass("icon-spin6 animate-spin");

            $.post(urlCartAdd, param, function(data) 
                {
                    if (data.status > 0) 
                    {
                        var cartparam = {
                            _csrf : product.csrf
                        }; 
            
                        $.post(urlUpdateCart,cartparam);
                    }
            
                    ele.removeClass("icon-spin6 animate-spin").addClass(oldclass);
                },'json');
        }

        jQuery(document).on('click', ".icon_plus_alt2", cartops);
JS;

$this->registerJs($js);
?>