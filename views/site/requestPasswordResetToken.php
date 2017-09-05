<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = Yii::t('app', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row" style="margin-top:100px; margin-bottom: 100px;">
        <div class="col-md-4 col-md-offset-4 col-xs-12 col-sm-8 col-md-offset-4 col-sm-offset-2">
            <div class="" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
                    <div class="modal-content modal-popup">
                        <?php $form = ActiveForm::begin(['options' => ['class'=> 'popup-form']]); ?>
                            <div class="login_icon"><i class="icon_lock_alt"></i></div>

                            <div style="margin:10px 0px;">
                                <span class="font-size:14px;">
                                    <?= Yii::t('app', 'Please out in your email. A link to reset password will be sent there.') ?>
                                </span>
                            </div>           

                            <?= Html::activeTextInput($model, 'email', ['class' => 'form-control form-white', 'placeholder' => "Email address"]) ?>
                            <?= Html::submitButton( Yii::t('app', 'Submit'), ['class' => 'btn btn-submit', 'name' => 'submit-button']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
            </div><!-- End modal -->   
        </div>
    </div>
</div>


