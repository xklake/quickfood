<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/10/16
 * Time: 2:25 PM
 */
?>

<section id="error" class="container text-center" style="margin: 200px 0px;">
    <div class="container">
        <div class="row">
            <h1>SOMETHING IS WRONG !!</h1>
            <p>The page does not exist, please check your url or contact the website owner.</p>

            <span class="btn btn-success">
                Back To <a  href="<?= Yii::$app->urlManager->getHostInfo() . Yii::$app->homeUrl ?>" style="margin-top: 20px;">Home Page</a>
            <span>
        </div>
    </div>
</section><!--/#error-->
