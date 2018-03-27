<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row" style="margin-top:50px; margin-bottom: 50px;">
        <div class="col-md-4 col-md-offset-4 col-xs-12 col-sm-8 col-md-offset-4 col-sm-offset-2">
            <div class="" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
                <div class="modal-content modal-popup">
                    <?php $form = ActiveForm::begin(['id' => 'login-nala-form','options' => ['class' => 'popup-form']]); ?>
                    <div class="login_icon"><i class="icon_lock_alt"></i></div>
                    <h4><?=Yii::t('app', 'sign up')?></h4>

                    <?= Html::activeTextInput($model, 'username', ['class' => 'form-control form-white', 'placeholder' => "User Name"]) ?>
                    <?= Html::activeTextInput($model, 'email', ['class' => 'form-control form-white', 'placeholder' => "Email"]) ?>
                    <?= Html::activePasswordInput($model, 'password', ['class' => 'form-control', 'placeholder' => "Password"]) ?>

                    <div>
                        <label>
                            <input type="checkbox" checked="checked" name="accept_lizi_law" tabindex="5">
                            <a href="#" target="_blank">I Have Read and Agree to These Terms and Conditions</a>
                        </label>
                    </div>

                    <?= Html::submitButton(Yii::t('app', 'sign up'), ['class' => 'form-control', 'name' => 'login-button']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
