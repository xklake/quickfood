<?php
use funson86\courier\models\CourierFee;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

    /* @var $this yii\web\View */
    $totalProduct = 0;
    $totalPrice = 0;
    $courier = null;

    foreach($products as $product) {
        if($product->source == 3)
        {
            $courier = $product;
        }
        $totalProduct += $product->number;
        $totalPrice += $product->number * $product->price;
    }

    $shipmentFee = 0;

    if ($totalPrice < floatval(Yii::$app->setting->get('freedelivery'))) {
        $shipmentFee = floatval(Yii::$app->setting->get('shippmentfee'));
    }
    $totalPrice += $shipmentFee;

    $i = 0;

    $this->title = 'Order information confirmation'; 
?>

<div class="box_style_2" id="main">
	<h2>Checkout</h2>
    <div class="row" style="margin-top:100px; margin-bottom: 100px;">
        <div class="col-md-4 col-md-offset-4 col-xs-12 col-sm-8 col-md-offset-4 col-sm-offset-2">
            <div class="" id="checkout" tabindex="-1" role="dialog" aria-labelledby="checkout" aria-hidden="true">
            <?php $form = ActiveForm::begin(['id' => 'checkoutform']); ?>
                <?= Html::activeHiddenInput($model, 'payment_method', ['value' => \common\models\Order::PAYMENT_METHOD_PAY]) ?>
                <?= Html::activeHiddenInput($model, 'shipment_fee', ['value' => $shipmentFee]) ?>

                <div class='uk-panel uk-panel-box-secondary uk-panel-box'>
                <div>
                    <span class=''> Please confirm delievery information </span> 
                </div>

                <ul class="uk-list uk-margin-large-left">
                    <?php foreach ($addresses as $address) { ?>
                        <li class="uk-margin-top uk-text-muted"> 
                            <?php 
                                $add = ''; 

                                if(isset($address['country'])){
                                    $add = $address['country']; 
                                } else {
                                    $add = '&nbsp;'; 
                                }

                                if(isset($address['province'])){
                                    $add = $add . $address['province']; 
                                } else {
                                    $add = $add . '&nbsp;'; 
                                }

                                if(isset($address['city'])){
                                    $add = $add . $address['city']; 
                                } else {
                                    $add = $add . '&nbsp;'; 
                                }

                                if(isset($address['district'])){
                                    $add = $add . $address['district']; 
                                } else {
                                    $add = $add . '&nbsp;'; 
                                }

                                if(isset($address['consignee'])){
                                    $add = $add . $address['consignee']; 
                                } else {
                                    $add = $add . '&nbsp;'; 
                                }

                                $add = $add . $address['address1'] . '('. $address['consignee'] . '     ' . $address['mobile']. ')';
                            ?>

                            <?= Html::radio('address_id', ($i === 0), [
                                'value' => $address->id,
                                'label' => $address->name . $add ,
                                'class' => 'uk-grid-margin'
                            ]); ?>
                        </li>
                    <?php } ?>
                </ul>

                <div> 
                    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['cart/address']) ?>" id="add-newaddr">New Address</a> 
                </div>


                <div id='use-jifen-1' class='uk-grid-margin'> 
                    <input type='checkbox' id='use_point_checkbox' name='use_point_checkbox'> Use points
                    <input type="hidden" value="<?= Yii::$app->user->identity->point ?>" name="user-point" id="user-point">
                </div>

                <div class='uk-panel uk-panel-box uk-panel-box-primary uk-margin-small' style='display:none;' id='use_point_con'>
                    <div >
                        You can get point from this order：<span id="point-total" class="uk-text-danger">
                        <?= Yii::$app->user->identity->point ?></span>，as<span class="red">￥<?= Yii::$app->user->identity->point / 100 ?></span>
                    </div>

                    <div class='uk-grid-divider'></div>

                    <div>
                        <span id='point-form'>
                            Use points this time <input type='text' class='uk-text-middle  uk-margin-small-left uk-width-1-4' id='point_used'>
                        </span>
                        <span class='uk-button uk-button-danger' id='point-submit'>Confirm</span>
                    </div>
                </div>

                <div class='uk-grid-margin'>
                    <?php if ($totalPrice >= floatval(Yii::$app->setting->get('freedelivery'))) { ?>
                        <span class="uk-text-success  uk-float-right">It is free delivery！</span>
                    <?php } else { ?>
                        <span class="uk-text-danger uk-float-right">Delivery charge<?= Yii::$app->setting->get('shippmentfee') ?>元，满<?= Yii::$app->setting->get('freedelivery') ?>元包邮（对于通过折扣信息购买的直邮产品不包邮）</span>
                    <?php } ?>
                </div>

                <div class='uk-panel uk-panel-box uk-panel-box-secondary uk-width-1-1'>
                    <div class='uk-grid uk-margin-small-top uk-width-1-1'>
                        <div class='uk-width-1-2'>
                            <div> Note: </div>
                            <div>
                                <?= Html::activeTextarea($model, 'remark', ['class' => 'uk-width-1-1', 'maxlength' => '500', 'style' => "color: rgb(51, 51, 51);", 'rows' => '4']) ?>
                            </div>
                        </div>
                        
                        <div class='uk-width-1-2'>
                            <div class="uk-clearfix">
                                <div class='uk-align-right'> Total： <?= Html::hiddenInput('totalPrice', $totalPrice) ?>
                                    <span class='uk-text-muted uk-text-large uk-icon-rmb uk-text-bold'><em id="total-price"><?= $totalPrice ?></em></span>
                                </div>
                            </div>

                            <div class='uk-clearfix uk-display-block'>
                                <div class='uk-align-right'> 
                                    Points Gained：<span id="earnpoints"><?= intval($totalPrice) ?></span>
                                </div>
                            </div>

                            <div class=' uk-clearfix uk-display-block'>
                                <div class='uk-align-right'>
                                    <?= Html::submitButton( Yii::t('app', 'Confirm'), ['class' => 'uk-button uk-button-danger']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$urlHelpCoupon = Yii::$app->urlManager->createAbsoluteUrl(['/cms/default/page', 'id' => 14, 'surname' => 'coupon']);
$urlCoupon = Yii::$app->urlManager->createAbsoluteUrl(['cart/json-coupon']);
$urlCouponCode = Yii::$app->urlManager->createAbsoluteUrl(['cart/ajax-coupon-code']);
$js = <<<JS
jQuery("input[name='checkbox-coupon']").click(function(){
    if ($("#checkbox-coupon").is(":checked")) {
        $.get("{$urlCoupon}", function(data, status) {
            if (status == "success") {
                var count = 0;
                var str = '<div>该订单可用优惠券（<em>' + data.count +'</em>）<a target="_blank" href="{$urlHelpCoupon}">【优惠券如何使用】</a></div>';
                $.each(data.data, function(k, v) {
                    if (v.min_amount < parseInt($('#total-price').html())) {

                        count ++;
                        str += '<p style="margin-top:10px"><input type="checkbox" name="coupon" value="'+ v.id +'" data-money="' + parseInt(v.money) + '"><span title="购物满' + parseInt(v.min_amount) + '减' + parseInt(v.money) + '购物券">' +parseInt(v.min_amount) + '-' + parseInt(v.money) + '优惠券</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;有效期至'+ v.ended_time +'</p>';
                    }

                });

                $('#coupon_list').html(str);
            } else {
                $('#coupon_list').html('<div>查找优惠券发生错误 </div>'); 
            }
        });
        $('#coupon_box_con').css('display', 'block');
    } else {
        $('#coupon_box_con').css('display', 'none');
    }
});

jQuery("#coupon_list").on("click", 'input[name^=coupon]', function(){
    $("input[name='coupon']").removeAttr("checked");
    $(this).prop('checked', 'checked');
    money = parseInt($(this).data('money'));
    $("#total-price").html(parseFloat($("#total-price").html()) - money);
    $(".dixiao-tip").html("优惠券：<em>-￥" + money + ".00</em>");
    $(".dixiao-tip").css('display', 'block');
});

jQuery("#coupon_code_trg").click(function(){
    $("#coupon_code").css('display', 'block');
});

jQuery("#coupon-code-input").click(function(){
    this.value = '';
});

jQuery("#coupon-code-submit").click(function(){
    var couponCode = $(this).prev().val();
    $.get("{$urlCouponCode}?sn=" + couponCode, function(data, status) {
        if (status == "success") {
            if (parseInt(data.status) == -1) {
                alert('优惠码不存在');
            } else if (parseInt(data.status) == -2) {
                alert('优惠码已使用');
            } else if (parseInt(data.status) == -3) {
                alert('优惠码已过期');
            } else if (parseInt(data.status) == 1) {
                $("#coupon_code").html("优惠" + data.money + "元" + '<input type="hidden" name="sn" value="' + data.sn +'" />');
                $("#total-price").html(parseFloat($("#total-price").html()) - parseInt(data.money));
            }
        }
    });
});

jQuery("input[name='checkbox-collect-fee']").click(function(){
		if($("#checkbox-collect-fee").is(":checked")){
        	$("#total-price").html(parseFloat($("#total-price").html()) + parseFloat($("#collect_fee").html()));
        	$("#earnpoints").html(parseFloat($("#earnpoints").html()) + parseFloat($("#collect_fee").html()));
        	$("#collect_fee_va").html('<input type="hidden" name="collectfee" value="' + parseFloat($("#collect_fee").html()) +'"/>')
        }
        else{
        	$("#total-price").html(parseFloat($("#total-price").html()) - parseFloat($("#collect_fee").html()));
        	$("#earnpoints").html(parseFloat($("#earnpoints").html()) - parseFloat($("#collect_fee").html()));
        	$("#collect_fee_va").html('<input type="hidden" name="collectfee" value="0"/>')
        }
    }
);


jQuery("input[name='use_point_checkbox']").click(function(){
    if ($("#use_point_checkbox").is(":checked")) {
        $('#use_point_con').css('display', 'block');
    } else {
        $('#use_point_con').css('display', 'none');
    }
});

jQuery("#point-submit").click(function(){

    var usePoint = parseInt($('#point_used').val());
    var ownPoint = parseInt($("#user-point").val());
    if (usePoint > ownPoint) {
        alert('您本次最多可以使用' + ownPoint + '个积分');
    } else {
        var usePointYuan = usePoint / 100;
        $("#point-form").html("优惠" + usePointYuan + "元" + '<input type="hidden" name="point" value="' + usePoint +'" />');
        $("#total-price").html(parseFloat($("#total-price").html()) - usePointYuan);
        $('#point-submit').hide();
    }
});

JS;

$this->registerJs($js);