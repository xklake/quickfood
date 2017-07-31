<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

//$this->registerCssFile('', ['depends' => \frontend\assets\UikitAsset::className()]);

$this->title = Yii::t('app', 'Signup');
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
                            <label for="username" class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-10">
                                <?= Html::activeTextInput($model, 'username', ['class' => 'form-control', 'placeholder' => "用户名"]) ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-10">
                                <?= Html::activePasswordInput($model, 'password', ['class' => 'form-control', 'placeholder' => "密码"]) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-10">
                                <?= Html::activeTextInput($model, 'email', ['class' => 'form-control', 'placeholder' => "邮箱"]) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <?= Html::submitButton( Yii::t('app', 'Signup'), ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </li>
            </ul>
        </div>
    </div>
</div>

