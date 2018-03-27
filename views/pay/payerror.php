<?php
\frontend\assets\UikitAsset::register($this);

$this->title = '家家优品支付 - 微信支付错误';

?>

<div id="main1" class="uk-grid uk-grid-margin uk-clearfix">
    <div class="uk-align-center uk-text-center uk-width-1-1 uk-text-large">
        <span class='uk-text-success'>
            <?php
                if($msg != null){
                    echo($msg);
                } else {
                    echo ('微信支付出错了，订单未完成！');
                }
            ?>
        </span>
    </div>

    <div class="uk-align-center uk-text-center uk-width-1-1  uk-margin-top">
        <ul class="uk-list">
            <li>请点击下面的“查看订单”重试</li>
            <li>使用其他的支付方式（支付宝）</li>
            <li>如果问题还存在，请联系我们的客服</li>
        </ul>
    </div>

    <div class="uk-align-center uk-text-center uk-width-1-1 uk-margin-large-top">
        <a class="uk-button uk-button-success" href="<?= Yii::$app->homeUrl ?>">继续购物</a>
        <a class="uk-button uk-button-success" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['/order']) ?>">查看订单</a>
    </div>
</div>

