<?php
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->registerCssFile('', ['depends' => \frontend\assets\UikitAsset::className()]);

$this->title = Yii::t('app', 'Recommend');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class='uk-width-1-1'>
    <div class="uk-panel uk-panel-box uk-width-1-1  uk-margin-bottom  uk-clearfix">
        <div><span class='uk-text-large'><?= $this->title ?></span></div>

        <div class='uk-grid-divider'></div>

        <div class='uk-text-danger uk-panel uk-panel-box uk-panel-box-secondary'>
            只要您在你的朋友圈，网站或者任何的可以发布以下链接的地方，一旦有人点击该链接，那么系统会自动识别到该客户是您推荐过来的客户，以后该客户下的每个订单都能给你提取一定的佣金。
        </div>

        <div class="uk-margin-top ">
                <span id='uk-text-success'>
                    <form class="uk-form">
                        推广链接：<input class=" uk-form-width-large" type="text" value="<?= Yii::$app->urlManager->createAbsoluteUrl(['site/signup', 'code' => \common\components\CommonHelper::encode(Yii::$app->user->id)]) ?>"/>
                    </form>
                </span>
        </div>

        <div class='uk-margin-large-top'>
                我推荐来注册的用户：
                <?php foreach ($recommends as $item) { ?>
                <span class='uk-text-primary uk-margin-left'> <?= $item->username  ?> </span>
                <?php } ?>
        </div>         
    </div>
</div>

