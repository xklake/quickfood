<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'reset password');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row" style="margin-top:100px; margin-bottom: 100px;">
        <div class="col-md-4 col-md-offset-4 col-xs-12 col-sm-8 col-md-offset-4 col-sm-offset-2">
            <div class="" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
                    <div class="modal-content modal-popup">
                        <?php $form = ActiveForm::begin(['options' => ['class'=> 'popup-form']]); ?>
                            <div class="login_icon"><i class="icon_lock_alt"></i></div>
                            <div class="">
                                <?= Yii::t('app', 'Please input your new password:') ?>
                            </div>

                            <?= Html::activePasswordInput($odel, 'password', ['class' => 'form-control form-white', 'placeholder' => "New Password"]) ?>                            
                            
                            <div>                    
                                <em>
                                    <?= Yii::$app->session->getFlash('success') ?>
                                </em>
                            </div>

                            <?= Html::submitButton( Yii::t('app', 'Save'), ['class' => 'btn btn-save', 'name' => 'save-button']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
            </div><!-- End modal -->   
        </div>
    </div>
</div>

