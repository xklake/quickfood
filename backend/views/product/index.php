<?php

use yii\helpers\Html;
use yii\grid\GridView;
use funson86\blog\Module;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product', [
    'modelClass' => 'Product',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'catalog_id',
                'value'=>function ($model) {
                    return $model->catalog->title;
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'catalog_id',
                    \funson86\blog\models\BlogPost::getArrayCatalog(),
                    ['class' => 'form-control', 'prompt' => Module::t('blog', 'Please Filter')]
                )
            ],
            'name',
            'sku',
            //'stock',
            // 'weight',
            'price',
            // 'brief:ntext',
            // 'introduction:ntext',
            // 'content:ntext',

            [
                'attribute' => 'thumb',
                'format' => 'image',
                'value' => function ($data) {
                    if($data['thumb'] != '') {
                        return '/' . $data['thumb'];
                    } else {
                        return  '/images/noimage.png';
                    }

                },

                'contentOptions'=>['style'=>'max-width: 300px;']
            ],
            //'thumb',
            //'image',
            // 'keywords',
            // 'description:ntext',
            // 'brand_id',
            // 'sales',
            'status',
            // 'created_at',
            // 'endtime_at:datetime',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
