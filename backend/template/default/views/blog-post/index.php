<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use funson86\blog\Module;
use funson86\blog\models\Status;
use funson86\blog\models\Type;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\blog\models\BlogPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('blog', 'Blog Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('blog', 'Create ') . Module::t('blog', 'Blog Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\ActionColumn'],
            
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
            'id', 
            'title',
            'keywords',
            'description',

            'commentsCount',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                        if ($model->status === Status::STATUS_ACTIVE) {
                            $class = 'label-success';
                        } elseif ($model->status === Status::STATUS_INACTIVE) {
                            $class = 'label-warning';
                        } else {
                            $class = 'label-danger';
                        }

                        return '<span class="label ' . $class . '">' . $model->getStatus()->label . '</span>';
                    },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'status',
                        Status::labels(),
                        ['class' => 'form-control', 'prompt' => Module::t('blog', 'PROMPT_STATUS')]
                    )
            ],
            'created_at:date',
            // 'update_time',

        ],
    ]); ?>

</div>
