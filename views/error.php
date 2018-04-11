<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/10/16
 * Time: 2:25 PM
 */
$this->context->layout = 'column1';
?>

<section id="error" class="container text-center" style="margin: 100px 0px;">
    <div class="container">
        <div class="row">
            <h1>Bad luck,something is not right...</h1>
            <p>The page does not exist, please check your url or contact the website owner.</p>

            <p>Back To <a  href="<?= Yii::$app->urlManager->getHostInfo() . Yii::$app->homeUrl ?>" style="margin-top: 20px;">Home Page</a></p>
        </div>
    </div>
</section><!--/#error-->
