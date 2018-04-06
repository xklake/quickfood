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
    
    <table class="table table_summary">
        <tbody>
            <tr>
                <td>
                    Product price:<span class="pull-right" id='totalpricecart' name='totalpricecart'><?=$symbol.$total?></span>
                </td>
            </tr>
        </tbody>
    </table>
    
    <hr>
        <a class="btn_full" href="<?=Yii::$app->urlManager->createAbsoluteUrl('cart/checkout')?>" id='btnCheckout'>Check Out</a>
        
    <div id='cartloading' style="display:none;text-align: center;">
        <i class="icon-spin6 animate-spin"></i>
    </div>
</div>

<?php
$urlUpdateCart = Yii::$app->urlManager->createAbsoluteUrl(['cart/updatecart']);

$this->registerJs('
    var product = {' . 'csrf:"' . Yii::$app->request->getCsrfToken() . '"};
    var user = {id:' . (Yii::$app->user->isGuest ? 0 : Yii::$app->user->id) . ', ' . '};
    var urlUpdateCart = "'.$urlUpdateCart.'";
    var urlCartAdd = "' . Yii::$app->urlManager->createAbsoluteUrl(['cart/ajax-add']) . '";');
    
    $js = <<<JS

        function cartops()
        {
            param = {
                productId : $(this).attr('name'),
                number : $(this).attr('count'),
                _csrf : product.csrf
            };
            $("#cartloading").css("display","block");

            $.post(urlCartAdd, param, function(data) 
                {
                    if (data.status > 0) 
                    {
                        var cartparam = {
                            _csrf : product.csrf
                        }; 
            
                        $.post(urlUpdateCart,cartparam, function(carthtml)
                            {
                                jQuery('#cart').html(carthtml);
                            }
                        )
                        $("#cartloading").css("display","none");
                    }else{
                        $("#cartloading").css("display","none");
                    }
                },'json');
        }

        jQuery(document).on('click', ".icon_plus_alt2", cartops);
        jQuery(document).on('click', ".icon_minus_alt", cartops);
        jQuery(document).on('click', ".icon_close_alt2", cartops);
JS;

$this->registerJs($js);
?>