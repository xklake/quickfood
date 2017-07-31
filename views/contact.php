<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/10/16
 * Time: 2:18 PM
 */
?>

<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle"><?=$catalog->surname?></h2>
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2><span class=''>We look forward to hearing from you!</span></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5 text-center map-content">
                <p>
                    <img src='/images/office.png' style='margin-right: 10px;max-width: 100%;height: auto;' class="img-fluid">
                </p>
                <p>
                    <a href='tel:<?= Yii::$app->setting->get('mobile') ?>' class="fa fa-mobile">
                        <?= Yii::$app->setting->get('mobile') ?>
                    </a>
                </p>

                <p>
                    <a href='tel:<?= Yii::$app->setting->get('phone') ?>' class="fa fa-phone">
                        <?= Yii::$app->setting->get('phone') ?>
                    </a>
                </p>
                <p>
                    <a href="mailto:<?= Yii::$app->setting->get('email') ?>"   class="fa fa-envelope-o">
                        <?= Yii::$app->setting->get('email') ?>
                    </a>
                </p>

                <p>
                    <a href='#'  class="fa fa-map-marker">
                        <?= Yii::$app->setting->get('address') ?>
                    </a>
                    <br/>
                    <span style='font-size:1rem;'>（Office visit by appointment only）</span>
                </p>
                <!--p>
                    <a href='tel:<?= Yii::$app->setting->get('wechat') ?>' class="fa fa-weixin">
                <?= Yii::$app->setting->get('wechat') ?>
                    </a>
                </p-->
            </div>

            <div class="col-sm-7 map-content">
                <div class="width:100%;">
                    <iframe src="<?= Yii::$app->setting->get('googlemap') ?>" frameborder="0" style="border:0;width:100%;" height="435px" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>