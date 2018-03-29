<?php

use funson86\courier\models\CourierFee;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Order details';
$i = 0;

?>
<div class="box_style_2" id="main">
    <h2 class='inner'>Order details</h2>
    <div class="row">
        <div>
            <?php $form = ActiveForm::begin(['id' => 'checkoutform','class'=> 'popup-form']); ?>
            <?= Html::activeHiddenInput($model, 'payment_method', ['value' => \common\models\Order::PAYMENT_METHOD_PAY]) ?>

            <div style="margin-bottom:10px;">
                <label>
                    Please confirm delievery information 
                </label> 
            </div>

            <div style='margin:0px;padding:0px;' >
                <?php foreach ($addresses as $address) { ?>
                    <?php
                    $add = '';

                    if (isset($address['country'])) {
                        $add = $address['country'];
                    } else {
                        $add = '&nbsp;';
                    }

                    if (isset($address['province'])) {
                        $add = $add . $address['province'];
                    } else {
                        $add = $add . '&nbsp;';
                    }

                    if (isset($address['city'])) {
                        $add = $add . $address['city'];
                    } else {
                        $add = $add . '&nbsp;';
                    }

                    if (isset($address['district'])) {
                        $add = $add . $address['district'];
                    } else {
                        $add = $add . '&nbsp;';
                    }

                    if (isset($address['consignee'])) {
                        $add = $add . $address['consignee'];
                    } else {
                        $add = $add . '&nbsp;';
                    }

                    $add = $add . $address['address1'] . '(' . $address['consignee'] . '     ' . $address['mobile'] . ')';
                    ?>
                
                    <div class="col-lg-12">
                        <label>
                            <div class="iradio_square-grey" style="position: relative;">
                                <?=
                                    Html::radio('address_id', ($i === 0), [
                                        'value' => $address->id,
                                        'class' => 'icheck',
                                        'style' => 'position: absolute; opacity: 0;',
                                        'name' =>'selected_address'
                                    ]);
                                ?>
                                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>                                    
                            </div>
                            <?=$address->name.':'.$add?>
                        </label>
                    </div>
                <?php } ?>
            </div>
            
            <label style='padding-left:15px;'>
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['cart/address']) ?>" id="add-newaddr" style='font-size:0.8rem;'>New Address</a> 
            </label>

            <div class='dashedcartlist' style='margin:20px 0px;'></div>
            
            <div  id='usepoints' >
                <label>
                    <input type="hidden" value="" id='user-point'>
                    <div class="icheckbox_square-grey" style="position: relative;" name="div_use_point_checkbox" id="div_use_point_checkbox">
                        <input type="checkbox" class="icheck" style="position: absolute; opacity: 0;" name="use_point_checkbox" id="use_point_checkbox">
                        <ins  class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                        </ins>
                    </div> Use your points
                </label>            
            </div>
            
            <!-- show points -->
            <div style='display:none;background-color:#eee;margin: 0px;padding:10px;font-size:0.95rem;' id='use_point_con'>
                <div>
                    You have 
                    <span id="usertotalpoints"> 
                        <?= isset(Yii::$app->user->identity->point)?Yii::$app->user->identity->point: 0?>
                    </span> points，as <span class=""><?=isset(Yii::$app->params['currency'])?Yii::$app->params['currency']->symbol:''?><?= Yii::$app->user->identity->point / 100 ?></span>
                </div>
                
                <div>
                    <span id='point-form'>
                        Use points this time <input type='text' id='point_used'>
                    </span>
                    <span class='btn_1_small' id='point-submit'>Confirm</span>
                </div>
            </div>
            
            <div class='dashedcartlist' style='margin:20px 0px;'></div>
            
            <div class="payment_select">
                <label class=""><div class="iradio_square-grey checked" style="position: relative;"><input type="radio" value="" checked="" name="payment_method" class="icheck" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>Credit card</label>
                <i class="icon_creditcard"></i>
            </div>
            
            <div class="form-group">
                <label>Name on card</label>
                <input type="text" class="form-control" id="name_card_order" name="name_card_order" placeholder="First and last name">
            </div>
            
            <div class="form-group">
                <label>Card number</label>
                <input type="text" id="card_number" name="card_number" class="form-control" placeholder="Card number">
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <label>Expiration date</label>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" id="expire_month" name="expire_month" class="form-control" placeholder="mm">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" id="expire_year" name="expire_year" class="form-control" placeholder="yyyy">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Security code</label>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="text" id="ccv" name="ccv" class="form-control" placeholder="CCV">
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-6">
                                <img src="/images/icon_ccv.gif" width="50" height="29" alt="ccv"><small>Last 3 digits</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--End row -->
            <div class="payment_select" id="paypal">
                <label class=""><div class="iradio_square-grey" style="position: relative;"><input type="radio" value="" name="payment_method" class="icheck" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>Pay with paypal</label>
            </div>
            <div class="payment_select nomargin">
                <label class=""><div class="iradio_square-grey" style="position: relative;"><input type="radio" value="" name="payment_method" class="icheck" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>Pay with cash</label>
                <i class="icon_wallet"></i>
            </div>
            
            <div class='dashedcartlist' style='margin:20px 0px;'></div>

            <div>
                <div>
                    <label> Note: </label>
                    <div>
                        <?= Html::activeTextarea($model, 'remark', ['class' => 'form-control', 'maxlength' => '500', 'rows' => '4']) ?>
                    </div>
                </div>
            </div>            
        </div>
    <?php ActiveForm::end(); ?>
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


//因为css的效果，其实逻辑上是反过来的
jQuery("#div_use_point_checkbox").click(function(){
    if ($("#div_use_point_checkbox").children().first().hasClass("checked")) {
        $('#use_point_con').css('display', 'none');
    } else {
        $('#use_point_con').css('display', 'block');
    }
});

jQuery("#point-submit").click(function(){
    var usePoint = parseInt($('#point_used').val()) || 0;
    var ownPoint = parseInt($("#usertotalpoints").html()) || 0;
    if (usePoint > ownPoint) {
        alert('You can only use ' + ownPoint + ' points.');
    } else {
        var usePointYuan = usePoint / 100;
        $("#point-form").html("You saved " + usePointYuan + "" + '<input type="hidden" name="point" value="' + usePoint +'" />');
        $("#total-price").html(parseFloat($("#total-price").html()) - usePointYuan);
        $('#point-submit').hide();
    }
});

JS;

$this->registerJs($js);
