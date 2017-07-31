<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->registerCssFile('', ['depends' => \frontend\assets\UikitAsset::className()]);

$this->title = Yii::t('app', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>

<div id='main' class='uk-grid uk-grid-margin'>
    <div class="uk-vertical-align uk-text-center uk-height-1-1 uk-container-center">
        <div class="uk-vertical-align-middle uk-align-center uk-margin-large-top" style="width: 260px;">
            <?php $form = ActiveForm::begin(['id' => 'login-nala-form', 'options' => ['class'=> 'uk-panel uk-panel-box uk-form']]); ?>
                <div class='uk-form-row'>
                    <span class='uk-text-primary uk-text-large uk-text-center'> 密码重置
                    </span>
                </div>

                <div class='uk-form-row'>
                    <?= Yii::t('app', 'Please fill out your email. A link to reset password will be sent there.') ?>
                </div>    

                <div class="uk-form-row">
                    <?= Html::activeTextInput($model, 'email', ['class' => 'text', 'placeholder' => "输入邮箱"]) ?>
                </div>


                <div class="uk-form-row">
                    <?= Html::submitButton( Yii::t('app', 'Send'), ['class' => 'uk-width-1-1 uk-button uk-button-danger', 'name' => 'login-button']) ?>
                </div>

                <div class='uk-form-row'>
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>">点击登录</a>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

