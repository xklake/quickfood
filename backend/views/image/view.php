<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Image */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'group_name',
            'name',
            [
                'attribute'=>'Image',
                'value'=> $model->image != null? '/'.$model->image:'/images/noimage.png',
                'format' => ['image', ['width' => '100']],
            ],
            'image',
            'keywords',
            'description:ntext',
            'url:url',
            'sort_order',

            [
                'attribute'=>'Status',
                'value' => $model->getStatus()->label
            ],

            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
