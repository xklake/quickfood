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
                        <strong><?=$product['number']?>x</strong><?=str_replace("]]", "", str_replace("[[", " - ", $product['name']))?>
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
                	<strong>
                    Subtotal:<span class="pull-right" id='totalprice'><?=(number_format($total,2))?></span>
                    <span class='pull-right'><?=$symbol?></span>
                   </strong>
                </td>
            </tr>
        </tbody>
    </table>
        
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
  
JS;

$this->registerJs($js);
?>