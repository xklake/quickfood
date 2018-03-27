<?php
use common\models\Region;

$this->title = Yii::t('app', 'My') . Yii::t('app', 'Order');
$this->params['breadcrumbs'][] = $this->title;

/* @var $this yii\web\View */
\frontend\assets\UikitAsset::register($this);

$totalNumber = $totalPrice = 0;
?>
<div class='uk-width-1-1'>
    <div class="uk-panel uk-panel-box uk-width-1-1  uk-margin-bottom  uk-panel-box-secondary">
        <div class='uk-width-1-1 uk-margin-top'>
            <span class='uk-text-large'>订单号：<?= $model->sn ?></span>
            <span class='uk-margin-left uk-text-warning'>
                <?= \common\models\Order::getStatusLabels($model->status) ?> 
            </span> 
        </div>

        <div class='uk-grid-divider'></div>

        <div class='uk-width-1-1'>
            <div> 收货人信息</div>

            <div class='uk-margin-left uk-margin-small-top uk-text-small'> 
                <?= $model->consignee ?>，<?= $model->mobile ?>, <?= $model->country ? Region::findOne($model->country)->name : '' ?> <?= $model->province ? Region::findOne($model->province)->name : '' ?> <?= $model->city ? Region::findOne($model->city)->name : '' ?> <?= $model->district ? Region::findOne($model->district)->name : '' ?> <?= $model->address ?>
            </div>

            <div class=" uk-margin-top">快递跟踪</div>
            <div class='uk-margin-left  uk-margin-small-top  uk-text-small '> 
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['site/parceltrack', 'id'=> $model->shipment_name])?>" target="_blank">
                    <?=$model->shipment_name?>
                </a>
            </div>
            
            <div class="uk-margin-top"><strong>产品列表</strong> </div>    
            <div class='uk-width-1-1 uk-margin-top'>
                <div class='uk-grid uk-width-1-1 uk-grid-medium'>
                <?php foreach ($model->orderProducts as $product) { 
                    $url = "";
                    if($product->source == 1){
                        $url = Yii::$app->urlManager->createAbsoluteUrl(['product/view', 'id' => $product->product_id]);
                    } 
                    else if($product->source == 2){
                        $url = Yii::$app->urlManager->createAbsoluteUrl(['blog/default/view', 'id' => $product->product_id]); 
                    } else if($product->source == 3){
                        $url = Yii::$app->urlManager->createAbsoluteUrl(['courier/courier-fee/view', 'id' => $product->product_id]);
                    }
                ?>
                    <div class='uk-width-1-6 uk-width-medium-1-10 uk-hidden-small  uk-vertical-align'>
                        <a target="_blank" href="<?= $url ?>">
                            <img src="<?= strlen($product->thumb)> 0? $product->thumb:'/images/noimage.png' ?>" style='width:40px; height:40px;'class="uk-vertical-align-middle">
                        </a>
                    </div>                                                                

                    <div class="uk-width-3-6 uk-width-medium-7-10  uk-vertical-align">
                        <a target="_self" href="<?= $url ?>">
                            <span class='uk-text-muted uk-vertical-align-middle'> <?= $product->name ?> </span>
                        </a>
                    </div>

                    <div class='uk-width-3-6  uk-width-medium-2-10 uk-vertical-align uk-text-right'>
                        <span class='uk-text-muted uk-vertical-align-middle  '> ￥<?= $product->price ?> x <?= $product->number ?></span>
                    </div>  

                    <?php $totalNumber += $product->number; $totalPrice += $product->price * $product->number;} ?>   
                </div> 
            </div>

            <div class='uk-grid-divider uk-margin-top'></div>
            <div class='uk-width-1-1 uk-text-right '>
                 <em><?= $totalNumber ?></em>件商品，
                总价：<span class="red uk-margin-right">￥<em><?= $totalPrice ?></em></span> 
            </div>

            <div class='uk-width-1-1 uk-text-right'>
                <span class=' uk-margin-right' >邮费：￥&nbsp; <?= $model->shipment_fee; ?> </span>
            </div>
            
            <div class='uk-width-1-1 uk-text-right'>
                总金额：<span class="red">￥<em id="total-price" class='uk-margin-right'><?= $model->amount ?></em></span>
            </div>

            <div class='uk-width-1-1 uk-text-right uk-margin-top '>
                <ul class='uk-subnav uk-margin-bottom-remove uk-float-right'>
                    <li>
                        <a class="uk-button uk-button-danger  uk-button-small" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['order/print', 'id' => $model->id]) ?>" target='_blank'>打印订单</a>
                    </li>                    
                    <li>
                        <?php if ($model->payment_method == \common\models\Order::PAYMENT_METHOD_PAY && $model->payment_status == \common\models\Order::PAYMENT_STATUS_UNPAID) { ?>
                            <a class="uk-button uk-button-success uk-button-small" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['cart/pay', 'sn' => $model->sn]) ?>" target="_self">我要付款</a>
                        <?php } ?>       
                        <input type="hidden" name="order_id" value="<?= $model->id ?>">
                    </li>
                    <li>
                        <?php if ($model->status >= \common\models\Order::PAYMENT_STATUS_UNPAID) { ?>
                                <a href="javascript:;" class="uk-button uk-button-danger  uk-button-small" order-cancel='1'  data-link="<?= Yii::$app->urlManager->createAbsoluteUrl(['order/ajax-status', 'id' => $model->id, 'status' => \common\models\Order::STATUS_CANCEL]) ?>">取消订单</a>
                            <?php } elseif ($model->status != \common\models\Order::STATUS_DELETED) { ?>
                                <a class="uk-button uk-button-success  uk-button-small" order-delete='1' data-link="<?= Yii::$app->urlManager->createAbsoluteUrl(['order/ajax-status', 'id' => $model->id, 'status' => \common\models\Order::STATUS_DELETED]) ?>" href="javascript:;">删除订单</a>
                        <?php }?>  
                    </li>

                    <li>    
                        <?php if ($model->status >= \common\models\Order::PAYMENT_STATUS_PAID) { 
                            if($refund = common\models\Refund::find()->where(['order_id'=> $model->id])->one()){?>
                            <a class='uk-button uk-button-success  uk-button-small' href="<?= Yii::$app->urlManager->createAbsoluteUrl(['refund/update', 'id' => $refund->id]) ?>" href="javascript:;">退款查看</a>
                        <?php } else { ?>
                            <a class="uk-button uk-button-danger  uk-button-small" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['refund/create', 'sn' => $model->sn]) ?>" href="javascript:;">退款申请</a>
                        <?php }} ?>                                                      
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
jQuery("#order-cancel").click(function(){
    var link = $(this).data('link');
    $.get(link, function(data, status) {
        if (status == "success") {
            location.reload()
        }
    });
});
JS;

$this->registerJs($js);
