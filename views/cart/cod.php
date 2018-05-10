<?php
/* @var $this yii\web\View */

$currency = Yii::$app->params['currency']; 
if($currency){
    $symbol = $currency->symbol;
}

?>

<div class="container margin_60_35">
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<div class="box_style_2">
				<h2 class="inner">Order confirmed!</h2>
				<div id="confirm">
					<i class="icon_check_alt2"></i>
					<h3>Thank you!</h3>
					<p>
						You order has been confirmed, we will email the details. Your order is <?= $model->sn ?>, please go to user center to check the status of this order.We will dispatch your order asap. 
					</p>
				</div>
				<h4>Summary</h4>
				<table class="table table-striped nomargin">
				<tbody>
                    <?php foreach($model->orderProducts as $product) { ?>
                        <tr>
                            <td>
                                <strong><?=$product['number']?>x</strong> <?=str_replace("]]", "", str_replace("[[", " - ", $product['name']))?>
                            </td>
                            <td>
                                <strong class="pull-right"><?=$symbol?><?=$product['price']?></strong>
                            </td>
                        </tr>
                    <?php } ?>

                <tr>
					<td>
						 Points earned from this order
					</td>
					<td >
						<strong class="pull-right"><?= number_format($model->amount,0) ?></strong>
					</td>
				</tr>
				
				<tr>
					<td class="total_confirm">
						 TOTAL PAID
					</td>
					<td class="total_confirm">
						<span class="pull-right"><?=$symbol?><?= $model->amount ?></span>
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
	</div><!-- End row -->
</div>