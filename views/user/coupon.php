<?php
$this->title = Yii::t('app', 'My') . Yii::t('app', 'Coupon');
$this->params['breadcrumbs'][] = $this->title;

/* @var $this yii\web\View */
$this->registerCssFile('', ['depends' => \frontend\assets\UikitAsset::className()]);
?>

<div class='uk-width-1-1'>
    <div class="uk-panel uk-panel-box uk-width-1-1  uk-margin-bottom  uk-clearfix">
        <div><span class='uk-text-large'><?= $this->title ?></span></div>

        <div class='uk-grid-divider'></div>

        <?php foreach ($models as $item) { ?>
            <div class='uk-panel uk-panel-box uk-panel-box-secondary uk-margin-bottom'>
                <div>面值:<span class='uk-margin-left uk-text-danger'>￥<?= $item->money ?></span></div>
                <div>所需消费金额:<span class='uk-margin-left uk-text-danger'>￥<?= $item->min_amount ?></span></div>
                <div>编码: <span class='uk-margin-left'><?= $item->sn ? $item->sn : $item->id ?></div>
                <div>
                    有效期: <span class='uk-margin-left'><?= Yii::$app->formatter->asDate($item->started_at) ?> 到 <?= Yii::$app->formatter->asDate($item->ended_at) ?>
                    </span>
                </div>
                <div>发送时间:<span class='uk-margin-left uk-text-danger'><?= Yii::$app->formatter->asDate($item->created_at) ?></span></div>
            </div>
        <?php } ?>


        <div class="pagination-right">
            <?= \frontend\widgets\LinkPagerUikit::widget(['pagination' => $pagination]) ?>
        </div>
    </div>
</div>

