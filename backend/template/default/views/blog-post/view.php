<?php

use yii\helpers\Html;
use funson86\blog\Module;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogPost */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-view">

    <p>
        <?= Html::a(Module::t('blog', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('blog', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('blog', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
    		'sku',
            [
                'attribute' => 'catalog_id',
                'value' => $model->catalog->title,
            ],
            
            'title',
            'keywords',
            'description',
            'banner',
            'endtime',
            'exurl',
            'brief:ntext',
            'surname',
            'click',
            'heat',
            'market_price',
            'price',
            
            [
                'attribute' => 'tax_included',
                'value' => $model->getTaxStatus(),
            ],
            [
                'attribute' => 'delivery_included',
                'value' => $model->getDeliveryStatus(),
            ],
            'content:ntext',
            [
                'attribute' => 'type',
                'value' => $model->getType()->label,
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->username,
            ],
            [
                'attribute' => 'status',
                'value' => $model->getStatus()->label,
            ],

            'endtime:datetime',
            'tags',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
