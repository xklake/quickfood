<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Banner */

$this->title = Yii::t('app', 'Create Banner', [
    'modelClass' => 'Banner',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Create Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
