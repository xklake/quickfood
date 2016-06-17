<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Images');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Images', [
    'modelClass' => 'Image',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'group_name',
            'name',

            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {
                    if($data['image'] != null ){
                    return Html::img('/'.$data['image'],
                        ['maxwidth' => '100']);
                    } else {
                        return Html::img('/images/noimage.png',
                            ['maxwidth' => '100']);
                    }
                },

                'contentOptions'=>['style'=>'max-width: 100px;']
            ],

            'image',
            'url:url',

            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->status === \funson86\blog\models\Status::STATUS_ACTIVE) {
                        $class = 'label-success';
                    } elseif ($model->status === \funson86\blog\models\Status::STATUS_INACTIVE) {
                        $class = 'label-warning';
                    } else {
                        $class = 'label-danger';
                    }

                    return '<span class="label ' . $class . '">' . $model->getStatus()->label . '</span>';
                },
            ],

            'sort_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
