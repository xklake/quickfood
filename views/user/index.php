<?php
use yii\helpers\Html;
use \common\models\Profile;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'User Center');
$this->params['breadcrumbs'][] = $this->title;
$i = 0;
?>


<ul class="list-group">
    <li class="list-group-item">
        亲爱的<?=Yii::$app->user->identity->profile->surname?>，欢迎进入到用户中心
    </li>
    <li class="list-group-item">
        <?php $form = \yii\bootstrap\ActiveForm::begin(['id' => 'login-nala-form', 'options' => ['class'=> 'form-horizontal']]); ?>
            <div class="form-group">
                <h3 style="width: 100%;text-align: center;font-size:2.3rem;" >个人资料</h3>
            </div>


        <div class="form-group ">
            <label for="name" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">

                <?= Html::activeTextInput($model, 'name', ['class' => 'form-control', 'placeholder' => "用户名", 'disabled' => 'disabled']) ?>
            </div>
        </div>


        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">昵称</label>
            <div class="col-sm-10">
                <?= Html::activeTextInput($model, 'surname', ['class' => 'form-control', 'placeholder' => "昵称"]) ?>
            </div>
        </div>


        <div class="form-group">
            <label for="sex" class="col-sm-2 control-label">性别</label>
            <div class="col-sm-10">
                <?= Html::activeRadioList($model, 'sex', [1 => '男', 2 => '女'], ['tag' => 'span']) ?>
            </div>
        </div>

        <div class="form-group">
            <label for="birthday" class="col-sm-2 control-label">生日</label>
            <div class="col-sm-10">
                <?= Html::activeDropDownList($model, 'year', Profile::getYears(), ['prompt' => '--年--']) ?>
                <?= Html::activeDropDownList($model, 'month', Profile::getMonths(), ['prompt' => '--月--']) ?>
                <?= Html::activeDropDownList($model, 'day', Profile::getDays(), ['prompt' => '--日--']) ?>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton( Yii::t('app', 'Update'), ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </li>
</ul>
