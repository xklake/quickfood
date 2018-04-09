<?php
use common\models\Region;
use yii\widgets\ActiveForm;

$query = new \yii\db\Query();
$result = $query->select('sum(number) as number')->from('order_product')->where(['order_id' => $model->id])->createCommand()->queryOne();
$totalNumber = $result['number'];
$this->title = '订单已提交，请支付';
?>


<div id="main" class="uk-grid uk-grid-margin">
    <div class='uk-width-1-1'>
        <div>
            <div>
                <div class='uk-text-large uk-text-bold'>订单概括</div>
                <table class='uk-table uk-width-1-1'>
                    <tbody>
                        <tr class='uk-width-1-1'>
                            <td class='uk-width-1-4 uk-text-muted'>订单号：</td>
                            <td class='uk-width-3-4'><a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['order/view', 'id' => $model->id])?>"><?= $model->sn ?></a></td>
                        </tr>
                        <tr class='uk-width-1-1'>
                            <td class='uk-width-1-4 uk-text-muted'>购买商品：</td>
                            <td class='uk-width-3-4'><?= $totalNumber ?> 件&nbsp;&nbsp;&nbsp;&nbsp;应付款：¥ <em><?= $model->amount ?></em></td>
                        </tr>

                        <tr>
                            <td class='uk-width-1-4 uk-text-muted'>购买时间：</td>
                            <td class='uk-width-3-4'><?= Yii::$app->formatter->asDatetime($model->created_at) ?></td>
                        </tr>

                        <tr>
                            <td class='uk-width-1-4 uk-text-muted'>收货地址：</td>
                            <td class='uk-width-3-4'><?= $model->country ? Region::findOne($model->country)->name : '' ?> <?= $model->province ? Region::findOne($model->province)->name : '' ?> <?= $model->city ? Region::findOne($model->city)->name : '' ?> <?= $model->district ? Region::findOne($model->district)->name : '' ?>&nbsp;&nbsp;<?= $model->address ?>&nbsp;（<?= $model->mobile ?>）
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>     
        
        <div class='uk-width-1-1 uk-grid-margin'>
            <?php $form = ActiveForm::begin(['id' => 'payform', 'action' => Yii::$app->urlManager->createAbsoluteUrl(['pay/submit']), 'options' => ['name' => 'payform', 'target' => '_blank']]); ?>
                <?= \yii\helpers\Html::hiddenInput('sn', $model->sn) ?>
                <table class='uk-table'> 
                    <div> 
                        <span class='uk-text-large uk-text-bold'>平台支付</span>
                        <span class='uk-text-muted uk-margin-left '>支持所有银行卡或信用卡，更迅速、安全</span>
                    </div>
                    <tbody>
                        <tr>
                            <td class='uk-vertical-align uk-width-1-6 uk-width-medium-1-6 '>
                                <input type="radio" value="ALIPAY" checked="checked" name="channel" class='uk-vertical-align-middle'>
                                <img src="/images/alipay.png" style="width:52px;height:52px;" alt="支付宝" class='uk-vertical-align-middle'>
                            </td>
                            <td class="uk-text-muted uk-width-5-6 uk-width-medium-5-6 uk-text-middle">
                                支持国内外160多家银行以及VISA、MasterCard
                            </td>
                        </tr>

                        <tr>
                            <td class='uk-vertical-align uk-width-1-3 uk-width-medium-1-6 '>
                                <input type="radio" value="WECHATPAY" checked="checked" name="channel" class='uk-vertical-align-middle'>
                                <img src="/images/wechatpay.png" style="width:52px;height:52px;" alt="微信支付">
                            </td>
                            <td class="uk-text-muted uk-width-2-3 uk-width-medium-5-6 uk-text-middle">
                                使用手机微信app扫一扫或公众号支付
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php ActiveForm::end(); ?>
        </div>

        <div class='uk-grid-margin uk-margin-large-top uk-margin-bottom'>
            <div>
                <a href="javascript:;" id="pay-btn" class="uk-button uk-button-primary">
                    去付款<i class="glyphicon glyphicon-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!--div id="bg"></div-->
<div id="show" style='display:none;' class='uk-panel uk-panel-box uk-panel-box-primary uk-container-center uk-width-5-6 uk-margin-large-top uk-margin-large-bottom'>
    <div class='uk-grid-margin uk-align-center uk-text-center'>
        <span class='uk-text-large uk-text-center'>请您在新开页面中完成支付。</span>
    </div>

    <div class='uk-grid-margin  uk-text-center'>支付完成前请不要关闭此窗口。</div>
    
    <div class='uk-grid-margin  uk-text-center'>完成支付后请点击下面的按钮。</div>

    <div class='uk-grid-margin  uk-text-center'>
        <a class="uk-button uk-button-primary" href="<?= Yii::$app->urlManager->createAbsoluteUrl('/order') ?>">支付完成</a>
        <a class="uk-button uk-button-danger" href="javascipt:;" id='btnReturn'>支付遇到问题</a>
    </div>
</div>

<?php
$urlCoupon = Yii::$app->urlManager->createAbsoluteUrl(['cart/json-coupon']);
$urlCouponCode = Yii::$app->urlManager->createAbsoluteUrl(['cart/ajax-coupon-code']);
$urlPaySubmit = Yii::$app->urlManager->createAbsoluteUrl(['cart/pay-submit']);
$js = <<<JS

jQuery("#pay-btn").click(function(){
    $("#show").css('display', 'block');
    $('#main').css('display', 'none');
    $("#payform").submit();
});

jQuery("#btnReturn").click(function(){
    $("#show").css('display', 'none');
    $('#main').css('display', 'block');

});
JS;

$this->registerJs($js);