<?php
    use funson86\courier\models\CourierFee;
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\ArrayHelper;


    $this->title = 'Order details';
    $i = 0;
    $total = 0.00;
    $deliveryfee = Yii::$app->setting->get('deliveryfee');
    $minorder = Yii::$app->setting->get('minorder');
    $freedeliverymin = Yii::$app->setting->get('freedeliverymin');
    
    $startupuptodistance = floatval(Yii::$app->setting->get('startupuptodistance'));
    $distanceBased = Yii::$app->setting->get('distancebased') == 1;
    $onwardsfeeperUnit = floatval(Yii::$app->setting->get('onwardsfeeperunit'));
    $distanceUint = Yii::$app->setting->get('distanceunit');
    $maxdeliverydistance = Yii::$app->setting->get('maxdeliverydistance');
    
    if($distanceUint == 'Mile'){
        $distance =  $distance /  1.609344;
    }
       
    if($distanceBased){
        if($distance <= $startupuptodistance){
            $distanceCharge = $deliveryfee;
        }
        else{
            $distanceCharge = $deliveryfee + floor($distance - $startupuptodistance) * $onwardsfeeperUnit;
        }
    }
    else{
        $distanceCharge = $deliveryfee;
    }
    
    Yii::$app->params['checkout'] = true;

    $currency = Yii::$app->params['currency']; 
    if($currency){
        $symbol = $currency->symbol;
    }
    
    $defaultAddressId = -1;
?>

<div class="box_style_2" id="main">
    <h2 class='inner'>Order details</h2>
    <div class="row">
        <div>
            <?php $form = ActiveForm::begin(['id' => 'checkoutform','class'=> 'popup-form']); ?>
            <?= Html::activeHiddenInput($model, 'payment_method', ['value' => \common\models\Order::PAYMENT_METHOD_COD]) ?>

            <?= Html::activeHiddenInput($model, 'deliverycharge', ['value' => 0]) ?>

            <div style="margin-bottom:10px;">
                <label>
                    Please confirm delivery information 
                </label> 
            </div>

            <div style='margin:0px;padding:0px;' id="addresses" >
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
                            <div class="iradio_square-grey" style="position: relative;" id="div_<?=$address->id?>">
                                <?=
                                    Html::radio('address_id', $address->default, [
                                        'value' => $address->id,
                                        'class' => 'icheck',
                                        'style' => 'position: absolute; opacity: 0;'
                                    ]);
                                ?>
                                <ins id="<?=$address->id?>" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;" 
                                     link="<?=Yii::$app->urlManager->createAbsoluteUrl(['api/getdistance', 'id'=>$address->id])?>">
                                </ins>                                    
                            </div>
                            <?php  
                            if($address->default){
                                echo '&#9734; '. $address->name.$add;
                                $defaultAddressId = $address->id;
                            }
                            else {
                                echo $address->name.':'.$add;
                            }
                            ?> 
                                <?php if(!$address->default){ ?>
                                    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['cart/defaultaddress', 'id' => $address->id]) ?>" id="add-defaultaddr" style='font-size:0.95rem;margin-left:20px;'>Default</a> 
                                <?php } ?>
                                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['cart/address', 'id' => $address->id]) ?>" id="add-editaddr" style='font-size:0.95rem;margin-left:20px;'>Edit</a> 
                                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['cart/deladdress', 'id' => $address->id]) ?>" id="add-deladdr" style='font-size:0.95rem;margin-left:20px;'>Delete</a> 
                        </label>
                    </div>
                <?php } ?>
            </div>
            
            <label style='padding-left:15px;'>
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['cart/address']) ?>" id="add-newaddr" style='font-size:0.95rem;'>New Address</a> 
            </label>

            <div class='dashedcartlist' style='margin:20px 0px;'></div>
            
            <div  id='usepoints'>
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
            <div style='display:none;background-color:#eee;margin: 20px 0px 20px 0px;padding:10px;font-size:0.95rem;' id='use_point_con'>
                <div>
                    You have 
                    <span id="usertotalpoints"> 
                        <?= isset(Yii::$app->user->identity->point)?Yii::$app->user->identity->point: 0?>
                    </span> points，as <span class=""><?=isset(Yii::$app->params['currency'])?Yii::$app->params['currency']->symbol:''?><?= Yii::$app->user->identity->point / 100 ?></span>
                </div>
                
                <div>
                    <span id='point-form'>
                        Use points this time <input type='text' id='point_used' style="margin-left:4px;">
                    </span>
                    <span class='btn_1_small' id='point-submit'>Confirm</span>
                </div>
            </div>
           
            <div class='dashedcartlist' style='margin:20px 0px;'></div>
            
            <div class="payment_select">
                <label class="">
                    <div class="iradio_square-grey" style="position: relative;">
                        <input type="radio" value="1"  id='payment_methodv' name="payment_methodv" class="icheck" style="position: absolute; opacity: 0;" checked>
                        <ins name="payment_method_ins" value="2" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                    </div>Pay with cash
                </label>
                <i class="icon_wallet"></i>
            </div>

            <div class="payment_select">
                <label class="">
                    <div class="iradio_square-grey" style="position: relative;">
                        <input type="radio" value="2"  id='payment_methodv'  name="payment_methodv" class="icheck" style="position: absolute; opacity: 0;">
                        <ins  name="payment_method_ins"  value="1" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                    </div>Pay with paypal
                </label>
            </div>
            
            <div class="payment_select">
                <label class="">
                    <div class="iradio_square-grey " style="position: relative;">
                        <input type="radio" value="4" id='payment_methodv' name="payment_methodv" class="icheck" style="position: absolute; opacity: 0;">
                        <ins  name="payment_method_ins" value="1" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                    </div>Credit card
                </label>
                <i class="icon_creditcard"></i>
            </div>
            
            <div  style="margin:0px;padding:0px;display:none;" id='creditPaymentDetail'>
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
            </div>

            <div class='dashedcartlist' style='margin:20px 0px;'></div>
            
            <?= Html::activeHiddenInput($model, 'shipment_id', ['value' => 2]) ?>
            
            <div class="row" id="delivery_options">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6" style="margin-top:5px;">
                    <label>
                        <div class="iradio_square-grey" style="position: relative;">
                            <input type="radio" class="icheck"  name="option_2" style='position: absolute; opacity: 0;'>  
                            <ins id='deliverymethod1' value='1' class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>                                    
                        </div>
                        Delivery<span style='font-size:0.9rem;margin-left: 2px;'>(Min Order:<?=$minorder?>
                            Free from <?=$freedeliverymin?>)</span><br/>
                    </label>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6"  style="margin-top:5px;">
                    <label>
                        <div class="iradio_square-grey" style="position: relative;">
                            <input type="radio" class="icheck" checked name="option_2" style='position: absolute; opacity: 0;'>  
                            <ins id='deliverymethod2' value='2'  class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>                                    
                        </div>
                        Collect
                    </label>
                </div>
            </div>

            <div class='dashedcartlist' style='margin:20px 0px;'></div>
            <input type="hidden" value="0" id="deliveryfee">

            <div class="box_style_2">
                <h2 class="inner">Order Summary</h2>
                <table class="table table_summary">
                    <tbody>
                        <tr>
                            <td>
                                Product price:<span class="pull-right" id="totalpricecheckout"><?=number_format($totalprice,2)?></span>
                                <span class="pull-right">£</span>
                            </td>
                        </tr>
                        
                        <tr style="display:none;" id="tr_deliveryCharge">
                            <td>
                                Delivery Charge:<span class="pull-right" id="totalDeliveryCharge">0.00</span>
                                <span class="pull-right"><?=$symbol?></span>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                Point Claimed:<span class="pull-right" id="pointClaimed">0.00</span>
                                <span class="pull-right"><?=$symbol?></span>
                            </td>
                        </tr>      
                        
                        <tr style="display:none;" id="tr_distance">
                            <td>
                                Distance ( <?=$distanceUint?> ):<span class="pull-right" id="Distance">
                                    <?php 
                                    if($distanceUint == 'Mile'){
                                        if(($distance - 0) > 0.1){
                                            echo number_format($distance, 2);
                                        }else{
                                            echo number_format(0,2);
                                        }
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>                         
                        
                        <tr>
                            <td>
                                Total To Pay:<span class="pull-right" id="totalpay"><?=number_format($totalprice,2)?></span>
                                <span class="pull-right"><?=$symbol?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
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

            <div class='dashedcartlist' style='margin:20px 0px;'></div>
            
            <?= Html::submitButton( Yii::t('app', 'Submit'), ['class' => 'btn_full', 'name' => 'submit']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<?php
$urlHelpCoupon = Yii::$app->urlManager->createAbsoluteUrl(['/cms/default/page', 'id' => 14, 'surname' => 'coupon']);
$urlCoupon = Yii::$app->urlManager->createAbsoluteUrl(['cart/json-coupon']);
$urlCouponCode = Yii::$app->urlManager->createAbsoluteUrl(['cart/ajax-coupon-code']);

$js = <<<JS
    var jsDistance = $distance;
    var jsDeliveryCharge = $distanceCharge;
    var jsDefaultAddressId = $defaultAddressId;
    jQuery('#addresses ins').click(function(){
        var link = $(this).attr('link');
        var clickedObject = $("#div_" + $(this).attr("id"));
        var oldObject = $('#div_' + jsDefaultAddressId);
        var nextAddressId = $(this).attr("id");
        $.get(link, function(ret) {
            if (ret.status == "success") {
                var distance = ret.distance;
                
                if(distance > $maxdeliverydistance){
                    alert('It is out of our delivery distance!');
                    oldObject.children().first().addClass("checked");
                    clickedObject.children().first().removeClass("checked");
                    clickedObject.removeClass("checked");
                    event.stopPropagation();
                    return;              
                }
        
                $("#Distance").html(distance.toFixed(1));
                jsDefaultAddressId = nextAddressId;
        
                //handle based on distance 
                $('#totalDeliveryCharge').html(ret.deliverycharge.toFixed(2));
                $('#totalpay').html((ret.deliverycharge + parseFloat($('#totalpricecheckout').html())).toFixed(2));
                jsDeliveryCharge = ret.deliverycharge.toFixed(2);
                jsDistance = ret.distance;

                if($("#order-shipment_id").val() == 1 && $distanceBased == 1){
                    $('#Distance').parent().parent().show();
                    $('#totalDeliveryCharge').parent().parent().show();
                }
                else{
                    $('#Distance').parent().parent().hide();
                    $('#totalDeliveryCharge').parent().parent().hide();
                }
            }else{
                alert('Can not find delivery distance of this address, please call us');
                oldObject.children().first().addClass("checked");
                clickedObject.children().first().removeClass("checked");
                clickedObject.removeClass("checked");
                event.stopPropagation();
                return;
            }
        });
        });
    
    jQuery('#delivery_options ins').click(function(){
        if($(this).attr("value") == 2)
        {
            var fee = 0;
            $('#totalDeliveryCharge').html(fee.toFixed(2));
            $("#totalpay").html($('#totalprice').html());
            $("#order-shipment_id").val(2);
            $('#tr_deliveryCharge').hide();
            $('#tr_distance').hide();
        } 
        else
        {
            if(jsDistance > $maxdeliverydistance)
            {
                alert('It is out of our delivery distance!');
                $(this).removeClass("checked");
                $('#deliverymethod2').addClass("checked");
                $("#order-shipment_id").val(2);
                event.stopPropagation();
                return;
            }
        
            if($distanceBased){
                var distanceFee = $distanceCharge;
                $("#totalDeliveryCharge").html(distanceFee.toFixed(2));
                $("#totalpay").html(($distanceCharge + parseFloat($('#totalpricecheckout').html())).toFixed(2));        
                $("#order-shipment_id").val(1);
                $('#tr_deliveryCharge').show();
                $('#tr_distance').show();
            }
            else{
                if($('#totalpricecheckout').html()< $minorder)
                {
                    alert("Order must be over $minorder to have delivery option"); 
                    $(this).removeClass("checked");
                    $('#deliverymethod2').addClass("checked");
                    $("#order-shipment_id").val(2);
                    event.stopPropagation();
                    return;
                }
                else if($('#totalpricecheckout').html() >= $freedeliverymin)
                {
                    var fee = 0;
                    $('#deliveryfee').val(fee.toFixed(2));
                    $("#totalDeliveryCharge").html(fee.toFixed(2));
                } 
                else
                {
                    var fee = $deliveryfee;
                    $('#deliveryfee').val(fee.toFixed(2));
                    $("#totalDeliveryCharge").html(fee.toFixed(2));
                    $("#totalpay").html(($deliveryfee + parseFloat($('#totalpricecheckout').html())).toFixed(2));
                }
                $("#order-shipment_id").val(1);
                $('#tr_deliveryCharge').show();
                $('#tr_distance').show();        
            }
        }
    }
);
        
jQuery('[name="payment_method_ins"]').click(function(){
        if($(this).attr("value") == 4)
        {
            $("#creditPaymentDetail").css("display", "block");
        } else
        {
            $("#creditPaymentDetail").css("display", "none");
        }
        
        $("#order-payment_method").val($(this).attr("value"));
   }
);        

jQuery("#btnCheckout").css("display", "none");
        
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


//因为css的效果，其实逻辑上是反过来的???
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
    
        if(usePointYuan > parseFloat($("#totalpay").html()))
        {
            alert("You can only use points valued less or equal than $symbol" + $("#totalpay").html() + ".");
            return;
        }
    
        $("#point-form").html("You saved " + usePointYuan + "" + '<input type="hidden" name="point" value="' + usePoint +'" />');
        $("#pointClaimed").html(0 - usePointYuan);
        $("#totalpay").html(parseFloat($("#totalpay").html()) - usePointYuan);
        $('#point-submit').hide();
    }
});
    

JS;

$this->registerJs($js);
