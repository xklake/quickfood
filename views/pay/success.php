<?php
\frontend\assets\UikitAsset::register($this);
?>

<div id="main1" class="uk-grid uk-grid-margin uk-clearfix">
<div class="uk-align-center uk-text-center uk-width-1-1 uk-text-large"> 订单 <span class='uk-text-success'><?= $model->sn ?> </span>支付成功， 我们将尽快为您配送！ </div>
    <div class="uk-align-center uk-text-center uk-width-1-1"> 
        <a class="uk-button uk-button-success" href="<?= Yii::$app->homeUrl ?>">继续购物</a> 
        <a class="uk-button uk-button-success" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['/order']) ?>">查看订单</a> 
    </div>
</div>


<?php
$urlOrder = Yii::$app->urlManager->createAbsoluteUrl(['/order']);
$js = <<<JS
function jump(count) {
    window.setTimeout(function(){
        count--;
        if(count > 0) {
            $('#num').attr('innerHTML', count);
            jump(count);
        } else {
            location.href="{$urlOrder}";
        }
    }, 1000);
}
jump(3);
JS;

$this->registerJs($js);