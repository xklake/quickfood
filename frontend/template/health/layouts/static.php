<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\HealthAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="language" content="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Robots" Content="All">
    <meta name="googlebot" content="All">
    <meta name="keywords" content="<?= Html::encode(Yii::$app->params['keywords']) ?>" />
    <meta name="description" content="<?= Html::encode(Yii::$app->params['description']) ?>" />
    <meta name="author" content="Panda blog Team" />
    <meta name="Copyright" content="Panda blog" />

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->params['title']) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render('header.php') ?>

<div id="content">
    <div>
        <div>
            <!--div class="aside">
                <?= $this->render('nav.php')?>
            </div-->

            <div class="sidebar">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<?= $this->render('footer.php') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
