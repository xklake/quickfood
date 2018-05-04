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
    <h2 class='inner'>Your Cart<i class="icon_cart_alt pull-right"></i></h2>
    <table class="table table_summary">
        <tbody>
            <?php foreach($data as $product){ 
                $total = $total + $product->price * $product->number;
            ?>
                <tr class="dashedcartlist">
                    <td class="">
                        <strong><?=$product['number']?>x</strong> <?=str_replace("]]", "", str_replace("[[", " - ", $product['name']))?>
                        <br/>
                        <a class="delete_item">
                            <i class="icon_close_alt2" name="<?=$product['product_id']?>" count="<?=0 - $product['number']?>"></i>
                        </a> 
                        <a class="minus_item">
                            <i class="icon_minus_alt" name="<?=$product['product_id']?>"  count="-1"></i>
                        </a> 
                        <a class="add_item">
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
                <td >
                    <strong>
	                    Product price:<span class="pull-right" id='totalpricecart' name='totalpricecart'><?=$symbol.(number_format($total,2))?></span>
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>
    
    <hr>
    <a class="btn_full" href="<?=Yii::$app->urlManager->createAbsoluteUrl('cart/checkout')?>" id='btnCheckout'>Check Out</a>
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
            var ele = $(this);
            var oldclass = ele.attr("class");
            
            ele.removeClass(oldclass).addClass("icon-spin6 animate-spin");
            
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
                        ele.removeClass("icon-spin6 animate-spin").addClass(oldclass);
                    }else{
                        ele.removeClass("icon-spin6 animate-spin").addClass(oldclass);
                    }
                },'json');
        }

        jQuery(document).on('click', ".icon_plus_alt2", cartops);
        jQuery(document).on('click', ".icon_minus_alt", cartops);
        jQuery(document).on('click', ".icon_close_alt2", cartops);
JS;

$this->registerJs($js);
?>