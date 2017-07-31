<?php
use yii\helpers\Html;
use frontend\web\template\quickfood\QuickfoodAssets;

QuickfoodAssets::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0">
    <?php if(isset(Yii::$app->params['keywords'])){ ?>
        <meta name="keywords" content="<?= Html::encode(Yii::$app->params['keywords']) ?>" />
    <?php } ?>
        
    <?php if(isset(Yii::$app->params['description'])) { ?>    
        <meta name="description" content="<?= Html::encode(Yii::$app->params['description']) ?>" />
    <?php } ?>
    <meta name="author" content="http://chinasoftware.co.uk">
    <title><?=$this->title?></title>

    <!--[if lt IE 9]>
        <script src="<?=Yii::$app->urlManager->getHostInfo().'/quickfood/assets/js/html5shiv.js'?>"></script>
        <script src="<?=Yii::$app->urlManager->getHostInfo().'/quickfood/assets/js/respond.min.js'?>"></script>
    <![endif]-->

    <?php $this->head() ?>
</head><!--/head-->

<body id="page-top" data-spy="scroll" data-target=".navbar">
    <div id="wrapper" class="home-page">
        <?php $this->beginBody() ?>
        <?= $this->render('header.php') ?>
        <?= $content ?>
        <?= $this->render('footer.php') ?>
        <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
        <?php $this->endBody() ?>
    </div>
</body>
</html>
<?php $this->endPage() ?>
