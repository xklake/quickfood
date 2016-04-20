<?php

use yii\helpers\Html;
use funson86\blog\Module;


/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogTag */

$this->title = Module::t('blog', 'Create ') . Module::t('blog', 'Tag');
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-tag-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
