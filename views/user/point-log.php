<?php
$this->title = Yii::t('app', 'My') . Yii::t('app', 'Point Log');
$this->params['breadcrumbs'][] = $this->title;

/* @var $this yii\web\View */

\frontend\assets\UikitAsset::register($this);
//$this->registerCssFile('@web/css/comment.css', ['depends' => \frontend\assets\AppAsset::className()]);
?>


<div class='uk-width-1-1'>
    <div class="uk-panel uk-panel-box uk-width-1-1  uk-margin-bottom  uk-clearfix">
        <div><span class='uk-text-large'><?= $this->title ?></span></div>

        <div class='uk-grid-divider'></div>

        <div class='uk-margin-bottom'>
            <span class='uk-text-primary'>当前积分为： <span class='uk-text-danger uk-text-bold'> <?= Yii::$app->user->identity->point ?> </span> 分，  100积分可抵现金1元</span> 
        </div>

        <?php foreach ($models as $item) { ?>
            <div class='uk-panel uk-panel-box uk-panel-box-secondary uk-margin-bottom'>
                <div>积分时间：<span class='uk-margin-left'><?= Yii::$app->formatter->asDate($item->created_at) ?></span></div>
                <div>积分情况：<span class='uk-margin-left uk-text-danger'><?= $item->point > 0 ? '+' . $item->point : $item->point ?></span></div>
                <div>积分类型：<span class='uk-margin-left'><?= \common\models\PointLog::getTypeLabels($item->type) ?></div>
                <div>积分备注：<span class='uk-margin-left'><?= $item->remark ?></span></div>
                <div>积分余额：<span class='uk-margin-left uk-text-danger'><?= $item->balance ?></span></div>
            </div>
        <?php } ?>


        <div class="pagination-right">
            <?= \frontend\widgets\LinkPagerUikit::widget(['pagination' => $pagination]) ?>
        </div>
    </div>
</div>

