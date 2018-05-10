<?php
use common\models\Region;
use yii\widgets\ActiveForm;

$query = new \yii\db\Query();
$result = $query->select('sum(number) as number')->from('order_product')->where(['order_id' => $model->id])->createCommand()->queryOne();
$totalNumber = $result['number'];
?>

<?php
/* @var $this yii\web\View */
?>
<div class="container margin_60_35">
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<div class="box_style_2">
				<h2 class="inner" style="background: #ec008c;">Warning</h2>
				<h3>This is demo website, you will need apply for payment gateway to receive payment from client, please call us for more details. 
		</h3>
			</div>
		</div>
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