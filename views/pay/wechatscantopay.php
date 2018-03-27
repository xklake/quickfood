<?php
\frontend\assets\UikitAsset::register($this);

$this->title = '家家优品支付 - 微信扫描支付';
?>

<div id="main1" class="uk-grid uk-grid-margin uk-clearfix">
    <div class="uk-align-center uk-text-center uk-width-1-1 uk-text-large">
        <span class='uk-text-success'> </span>请使用微信扫描下面的二维码，完成订单的支付
    </div>

    <div class="uk-align-center uk-text-center uk-width-1-1">
        <img src="<?= \yii\helpers\Url::to(['pay/qrcode', 'code'=>$code])?>" title="微信扫描支付" width="200px">
    </div>

    <div class="uk-align-center uk-text-center uk-width-1-1"> 
        <a class="uk-button uk-button-success" href="<?= Yii::$app->homeUrl ?>">继续购物</a> 
        <a class="uk-button uk-button-success" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['/order']) ?>">查看订单</a> 
    </div>
</div>

