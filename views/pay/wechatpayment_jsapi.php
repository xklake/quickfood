
<?php
//    use yii;
//    use yii\log\Logger;

    $this->registerCssFile('', ['depends' => \frontend\assets\UikitAsset::className()]);
    //$this->registerJsFile('http://res.wx.qq.com/open/js/jweixin-1.0.0.js', ['depends' => \frontend\assets\UikitAsset::className()]);
    $this->title = '家家优品支付 - 微信公众号支付';
?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

<div id="main1" class="uk-grid uk-grid-margin uk-clearfix">

    <div class="uk-align-center uk-text-center uk-width-1-1  uk-margin-top" id="msg">
        请按照微信支付的提示完成支付
    </div>

    <div class="uk-align-center uk-text-center uk-width-1-1" id="fbar" style="display: none;">
        <a class="uk-button uk-button-success" href="<?= Yii::$app->homeUrl ?>">继续购物</a>
        <a class="uk-button uk-button-success" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['/order']) ?>">查看订单</a>
    </div>
</div>

<script>

    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        WeixinJSBridge.invoke('getBrandWCPayRequest', {
            'appId' : '<?php echo $jsApiParameters['appId'];?>',
            'timeStamp': '<?php echo $jsApiParameters['timeStamp'];?>',
            'nonceStr' : '<?php echo $jsApiParameters['nonceStr'];?>',
            'package' : '<?php echo $jsApiParameters['package'];?>',
            'signType' : '<?php echo $jsApiParameters['signType'];?>',
            'paySign' : '<?php echo $jsApiParameters['paySign'];?>'
        }, function(res) {
            if(res.err_msg == 'get_brand_wcpay_request:ok') {
                $('#msg').text('支付已完成，稍后您将收到微信支付成功的确认信息');
                $('#fbar').show();
            } else {
                //alert('启动微信支付失败, 请检查你的支付参数. 详细错误为: ' + res.err_msg);
                //Yii::getLogger()->log('微信支付失败 '.$user->wechat_openid, Logger::LEVEL_ERROR);
                $('#msg').text('支付未能完成，请稍后再试或者联系我们的客服');

            }
        });
    }, false);
</script>
