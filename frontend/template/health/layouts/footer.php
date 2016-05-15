<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/9/16
 * Time: 5:38 PM
 */
?>

<div id="footer">
    <div>
        <div>
            <!--div id="footer_contact">
                <p style="margin:0px; padding:0px;">Mobile: <?=Yii::$app->setting->get('mobile')?></p>
                <p style="margin:0px; padding:0px;">Working Time:<?=Yii::$app->setting->get('worktime')?></p>
            </div-->

            <div class="section">
                <ul style="margin-left:130px;">
                    <li class="first"><a href="<?=Yii::$app->urlManager->createUrl(['blog/default/catalog', 'id'=> 10])?>">Doctors</a></li>
                    <li><a href="<?=Yii::$app->urlManager->createUrl(['blog/default/catalog', 'id'=> 4])?>">Service & Price</a></li>
                    <li><a href="<?=Yii::$app->urlManager->createUrl(['blog/default/catalog', 'id'=> 4])?>">Guarantee Policy</a></li>
                    <li><a href="<?=Yii::$app->urlManager->createUrl(['blog/default/catalog', 'id'=> 2])?>">Contact Us</a></li>
                </ul>
                <p style="text-align: center;">Copyright &copy; <a href="<?=Yii::$app->homeUrl?>"><?=Yii::$app->setting->get('siteName')?></a> - All Rights Reserved | <a target="_blank" href="http://www.epandaeye.com/">Powered By epandaeye.com</a></p>
            </div>
        </div>
    </div>
</div>
