<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/23/16
 * Time: 5:05 PM
 */
?>

<div class="container">


    <div class="row">

        <!-- Article main content -->
        <article class="col-sm-8 maincontent">
            <header class="page-header">
                <h1 class="page-title">Contact us</h1>
            </header>
            <style>
                .map-responsive{
                    overflow:hidden;
                    padding-bottom:26.25%;
                    position:relative;
                    height:0;
                }
                .map-responsive iframe{
                    left:0;
                    top:0;
                    height:100%;
                    width:100%;
                    position:absolute;
                }
            </style>
            <p>
                <a href='tel:<?=Yii::$app->setting->get('phone')?>' class="fa fa-phone">
                    <?=Yii::$app->setting->get('phone')?>
                </a>
                </p>
            <p>
               <a href="mailto:<?=Yii::$app->setting->get('email')?>"   class="fa fa-envelope-o">
                    <?=Yii::$app->setting->get('email')?>
                </a>
            </p>

            <p>
                <a href='#'  class="fa fa-map-marker">
                    <?=Yii::$app->setting->get('address')?>
                </a

            </p>

            <div class="map-responsive">
                <iframe src="<?=Yii::$app->setting->get('googlemap')?>" width="750" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>

            <div style="margin-top: 40px;">
                <p><b>Xu Huaiwen,Head coach of Xu huaiwen's Badminton Club</b></p>
                <img src="<?='/' . $catalog->banner?>">
            </div>
            <!--p style="margin-top: 40px;">
                We’d love to hear from you. Interested in working together? Fill out the form below with some info about your project and I will get back to you as soon as I can. Please allow a couple days for me to respond.
            </p>
            <br>
            <form>
                <div class="row">
                    <div class="col-sm-4">
                        <input class="form-control" type="text" placeholder="Name">
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" placeholder="Email">
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" placeholder="Phone">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <textarea placeholder="Type your message here..." class="form-control" rows="9"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="checkbox"><input type="checkbox"> Sign up for newsletter</label>
                    </div>
                    <div class="col-sm-6 text-right">
                        <input class="btn btn-action" type="submit" value="Send message">
                    </div>
                </div>
            </form-->


        </article>
        <!-- /Article -->

        <?= $this->render('../layouts/recentpost')?>


    </div>
</div>	<!-- /container -->

<!--section class="container-full top-space">
    <div id="map">

    </div>
</section-->
