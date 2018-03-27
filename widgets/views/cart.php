<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$currency = Yii::$app->params['currency']; 
if($currency){
    $symbol = $currency->symbol;
}

$total = 0; 
$deliveryfee = Yii::$app->setting->get('deliveryfee');
$minorder = Yii::$app->setting->get('minorder');
$freedeliverymin = Yii::$app->setting->get('freedeliverymin');

$realdelieveryfee = 0;
?>
<div class='box_style_2'>
    <h2 class='inner'>Your Cart <i class="icon_cart_alt pull-right"></i></h2>
    <table class="table table_summary">
        <tbody>
            <?php foreach($data as $product){ 
                $total = $total + $product->price * $product->number;
            ?>
                <tr class="dashedcartlist">
                    <td class="">
                        <strong><?=$product['number']?>x</strong> <?=$product['name']?>
                        <br/>
                        <a href="#" class="delete_item">
                            <i class="icon_close_alt2" name="<?=$product['product_id']?>" count="<?=0 - $product['number']?>"></i>
                        </a> 
                        <a href="#" class="minus_item">
                            <i class="icon_minus_alt" name="<?=$product['product_id']?>"  count="-1"></i>
                        </a> 
                        <a href="#0" class="add_item">
                            <i class="icon_plus_alt2" name="<?=$product['product_id']?>" count='1'></i>
                        </a>                     
                    </td>

                    <td>
                        <strong class="pull-right"><?=$symbol?><?=$product['price']?></strong>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <hr>
    
    <?php if ($total > $minorder) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                <label><input type="radio" value="" checked name="option_2"> Delivery </label>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                <label><input type="radio" value="" name="option_2"> Collect</label>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                <label><input type="radio" value="" checked name="option_2" ><?= $minorder ?><?= $symbol ?> Min order</label>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                <label><input type="radio" value="" name="option_2" > Collect</label>
            </div>
        </div>
    <?php } ?>
  
    <hr>
    <table class="table table_summary">
        <tbody>
            <tr>
                <td>
                    Subtotal <span class="pull-right"><?=$total?></span>
                </td>
            </tr>
            <tr>
                <td>
                    Delivery Fee 
                    <span class="pull-right">
                        <?php 
                            if($total > $freedeliverymin){
                                $realdelieveryfee = 0;
                            } else {
                                $realdelieveryfee = $deliveryfee;
                            }
                            echo($realdelieveryfee);
                        ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="total">
                    TOTAL <span class="pull-right"><?=$total + $realdelieveryfee?></span>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <a class="btn_full" href="<?=Yii::$app->urlManager->createAbsoluteUrl('cart/checkout')?>">Check Out</a>
</div>