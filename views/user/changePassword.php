<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title =  Yii::t('app', 'Change Password');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row" style="margin-top:100px; margin-bottom: 100px;">
        <div class="col-md-6 col-md-offset-3 col-lg-6 col-xs-12 col-sm-9">
            <ul class="list-group">
                <li class="list-group-item">
                    <h3 style="width: 100%;text-align: center;font-size:2.3rem;" ><?=$this->title?></h3>
                </li>
                <li class="list-group-item">
                    <?php $form = ActiveForm::begin(['id' => 'login-nala-form', 'options' => ['class'=> 'form-horizontal']]); ?>
                        <div class="form-group">
                            <h4 style="text-align: center;">
                                <?=$this->title?>
                            </h4>
                            <p><?= Yii::t('app', 'Please fill out the following fields to change password') ?></p>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">现有密码</label>
                            <div class="col-sm-10">
                                <?= Html::activePasswordInput($model, 'oldpassword', ['class' => 'form-control', 'placeholder' => "现有密码"]) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">新密码</label>
                            <div class="col-sm-10">
                                <?= Html::activePasswordInput($model, 'password', ['class' => 'form-control', 'placeholder' => "新密码"]) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">重复新密码</label>
                            <div class="col-sm-10">
                                <?= Html::activePasswordInput($model, 'repassword', ['class' => 'form-control', 'placeholder' => "重复新密码"]) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <?= Html::submitButton( Yii::t('app', 'Update'), ['class' => 'btn btn-success', 'name' => 'login-button']) ?>

                                <?php if($model->errors != null) {?>
                                    错误：<?=$model->errors['email'][0]?>
                                <?php } else { ?>
                                    成功：<?=Yii::$app->getSession()->getFlash('success')?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </li>
            </ul>
        </div>
    </div>
</div>