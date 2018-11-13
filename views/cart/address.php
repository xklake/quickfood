<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
$this->title = 'Order Address';
?>

<div class="box_style_2" id="main">
    <h2 class='inner'>
        <?php if($model->id > 0){ ?>
        Edit Address
        <?php } else { ?>
        Create New Address
        <?php } ?>
    </h2>
    <div class="row">
        <div>
            <?php $form = ActiveForm::begin(['id' => 'newaddress', 'class' => 'popup-form']); ?>
            <div class="form-group">
                <?= Html::activeTextInput($model, 'name', ['class' => 'form-control', 'placeholder' => "Name"]) ?>
            </div>

            <div class="form-group">
                <?= Html::activeTextInput($model, 'consignee', ['class' => 'form-control', 'placeholder' => "Consignee"]) ?>
            </div>
            <div class="form-group">
                <?= Html::activeTextInput($model, 'phone', ['class' => 'form-control', 'placeholder' => "Phone"]) ?>
            </div>
            <div class="form-group">
                <?= Html::activeTextInput($model, 'mobile', ['class' => 'form-control', 'placeholder' => "mobile"]) ?>
            </div>
            <div class="form-group">
                <?= Html::activeTextInput($model, 'zipcode', ['class' => 'form-control', 'placeholder' => "Postcode"]) ?>
            </div>
            <div class="form-group">
                <?= Html::activeTextInput($model, 'address1', ['class' => 'form-control', 'placeholder' => "Street"]) ?>
            </div>
            <div class="form-group">
                <?= Html::activeTextInput($model, 'address2', ['class' => 'form-control', 'placeholder' => "Town"]) ?>
            </div>

            <div class="form-group">
                <?= Html::activeTextInput($model, 'city', ['class' => 'form-control', 'placeholder' => "City"]) ?>
            </div>

            <div class="form-group">
                <?= Html::activeTextInput($model, 'state', ['class' => 'form-control', 'placeholder' => "State"]) ?>
            </div>

            <div class="form-group">
                <?= Html::activeTextInput($model, 'country', ['class' => 'form-control', 'placeholder' => "Country"]) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn_full', 'name' => 'submit']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
