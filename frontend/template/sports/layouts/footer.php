<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/23/16
 * Time: 3:47 PM
 */
?>

<footer id="footer" class="top-space">

    <div class="footer1">
        <div class="container">
            <div class="row">

                <div class="col-md-3 widget">
                    <h3 class="widget-title">Contact</h3>
                    <div class="widget-body">
                        <p>
                            <a href='tel:<?=Yii::$app->setting->get('phone')?>' class="fa fa-phone">
                                <?=Yii::$app->setting->get('phone')?>
                            </a>
                            <br/>
                            <a href="mailto:<?=Yii::$app->setting->get('email')?>"   class="fa fa-envelope-o">
                                <?=Yii::$app->setting->get('email')?>
                            </a> <br/>


                            <a href='#'  class="fa fa-map-marker">
                                <?=Yii::$app->setting->get('address')?>
                            </a
                        </p>
                    </div>
                </div>

                <div class="col-md-3 widget">
                    <h3 class="widget-title">Follow us</h3>
                    <div class="widget-body">
                        <p class="follow-me-icons">
                            <a href="<?=Yii::$app->setting->get('twitter')?>"><i class="fa fa-twitter fa-2"></i></a>
                            <!--a href="<?=Yii::$app->setting->get('twitter')?>"><i class="fa fa-dribbble fa-2"></i></a>
                            <a href=""><i class="fa fa-github fa-2"></i></a-->
                            <a href="<?=Yii::$app->setting->get('facebook')?>"><i class="fa fa-facebook fa-2"></i></a>
                        </p>
                    </div>
                </div>

                <div class="col-md-6 widget">
                    <h3 class="widget-title">About Xu Huaiwen 徐怀雯</h3>
                    <div class="widget-body">
                        <p>
                            <?php
                            if(($text = Yii::$app->getTextBlock('xuhuaiwen')) != null){
                                echo ($text->content);
                            }
                            ?>
                        </p>
                    </div>
                </div>

            </div> <!-- /row of widgets -->
        </div>
    </div>

    <div class="footer2">
        <div class="container">
            <div class="row">

                <div class="col-md-6 widget">
                    <div class="widget-body">
                        <p class="simplenav">
                            <a href="<?=Yii::$app->homeUrl?>">Home</a> |
                            <a href="<?=Yii::$app->urlManager->createUrl(['blog/default/catalog', 'id'=>14])?>">About</a> |
                            <a href="<?=Yii::$app->urlManager->createUrl(['blog/default/catalog', 'id'=>16])?>">Coaching</a> |
                            <a href="<?=Yii::$app->urlManager->createUrl(['blog/default/catalog', 'id'=>17])?>">Blog</a>
                            <!--b><a href="signup.html">Sign up</a></b-->
                        </p>
                    </div>
                </div>

                <div class="col-md-6 widget">
                    <div class="widget-body">
                        <p class="text-right">
                            Copyright &copy; <?=date('Y')?>, <a href="<?=Yii::$app->homeUrl?>" style="font-size:1.6rem;;"> xuhuaiwen.org </a>. Powered by <a href="http://epandaeye.com/" rel="designer" target="_blank">epandaeye</a>
                        </p>
                    </div>
                </div>

            </div> <!-- /row of widgets -->
        </div>
    </div>
</footer>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

<?php
$google_analysis = Yii::$app->getHtmlBlock('google-analysis');

if($google_analysis != null){
    echo($google_analysis->content);
}
?>

