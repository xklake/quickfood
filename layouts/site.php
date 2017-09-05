<?php

use yii\helpers\Html;
use frontend\web\template\quickfood\QuickfoodAssets;

QuickfoodAssets::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="<?= Yii::$app->language ?>" class="js flexbox flexboxlegacy canvas canvastext webgl touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface no-generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">    
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0">
        <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">    
        <link rel="apple-touch-icon" type="image/x-icon" href="/images/apple-touch-icon-57x57-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="/images/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="/images/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="/images/apple-touch-icon-144x144-precomposed.png">
        <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>
        <?php if (isset(Yii::$app->params['keywords'])) { ?>
            <meta name="keywords" content="<?= Html::encode(Yii::$app->params['keywords']) ?>" />
        <?php } ?>
        <?php if (isset(Yii::$app->params['description'])) { ?>    
            <meta name="description" content="<?= Html::encode(Yii::$app->params['description']) ?>" />
<?php } ?>
        <meta name="author" content="http://chinasoftware.co.uk">
        <title><?= $this->title ?></title>

        <!--[if lt IE 9]>
            <script src="<?= Yii::$app->urlManager->getHostInfo() . '/quickfood/assets/js/html5shiv.js' ?>"></script>
            <script src="<?= Yii::$app->urlManager->getHostInfo() . '/quickfood/assets/js/respond.min.js' ?>"></script>
        <![endif]-->
<?php $this->head() ?>
    </head><!--/head-->

    <body style="overflow: visible;">
        <div id="wrapper" class="home-page">
        <?php $this->beginBody() ?>
            <div id="preloader">
                <div class="sk-spinner sk-spinner-wave" id="status">
                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>
                </div>
            </div><!-- End Preload -->

            <?= $this->render('header.php') ?>
            <?= $content ?>
            <?= $this->render('footer.php') ?>
            <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
        <?php $this->endBody() ?>
        </div>
    </body>
</html>
<?php $this->endPage() ?>
