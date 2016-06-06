<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use funson86\blog\models\BlogCatalog;
use yii\helpers\ArrayHelper;
use funson86\blog\Module;

use kartik\markdown\MarkdownEditor;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */

$parentCatalog = ArrayHelper::merge([0 => Module::t('blog', 'Root Catalog')], ArrayHelper::map(BlogCatalog::get(0, BlogCatalog::find()->all()), 'id', 'str_label'));
unset($parentCatalog[$model->id]);
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options'=>['class' => 'form-horizontal', 'enctype'=>'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-7\">{input}</div>\n<div class=\"col-lg-1\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'catalog_id')->dropDownList($parentCatalog) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'brief')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'introduction')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full',
            'filebrowserBrowseUrl' => 'up',
            'inline' => false,
        ]),
    ]) ?>

    <?= $form->field($model, 'thumb')->fileInput() ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'brand')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(\funson86\blog\models\Status::labels()) ?>

    <!--?= $form->field($model, 'endtime_at')->textInput() ?-->


    <!--
    <?= $form->field($model, 'starttime')->widget(DateTimePicker::className(), [
        'name' => 'starttime',
        'options' => ['placeholder' => 'Select operating time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'd-M-Y g:i A',
            'startDate' => '01-Mar-2014 12:00 AM',
            'todayHighlight' => true
        ]
    ]);?>

    <?php
    echo '<label class="control-label">Birth Date</label>';
    echo DateTimePicker::widget([
    'name' => 'dp_3',
    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
    'value' => '23-Feb-1982',
    'pluginOptions' => [
    'autoclose'=>true,
    'format' => 'dd-M-yyyy'
    ]
    ]);
    ?>

    <?= $form->field($model, 'endtime')->widget(DateTimePicker::className(), [
        'name' => 'dp_3',
        'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
        'value' => '23-03-1982',
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-M-yyyy'
        ]
    ]);?>
    -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
