<?php

use yii\helpers\Html;
use funson86\blog\Module;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use funson86\blog\models\BlogCatalog;
use kartik\markdown\MarkdownEditor;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;


/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-post-form">

    <?php $form = ActiveForm::begin([
        'options'=>['class' => 'form-horizontal', 'enctype'=>'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-5\" style=\"width:770px\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'catalog_id')->dropDownList(ArrayHelper::map(BlogCatalog::get(0, BlogCatalog::find()->all()), 'id', 'str_label')) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'status')->dropDownList(\funson86\blog\models\Status::labels()) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'brief')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full',
    		'filebrowserBrowseUrl' => 'up',
            'inline' => false,
        ]),
    ]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'click')->textInput() ?>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="">&nbsp;</label>
        <?= Html::submitButton($model->isNewRecord ? Module::t('blog', 'Create') : Module::t('blog', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
