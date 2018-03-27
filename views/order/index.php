<?php
/* @var $this yii\web\View */
$this->title = Yii::t('app', 'My') . Yii::t('app', 'Order');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='uk-width-1-1'>
    <div class="uk-width-1-1  uk-margin-bottom  uk-clearfix">
        <div class='uk-grid'>
            <div class='uk-width-1-1'>
                <div class=' uk-panel uk-panel-box uk-panel-box-secondary'>
                    <ul class='uk-subnav uk-subnav-line'>
                        <li class="uk-vertical-align"> 
                            <span class='uk-text-large uk-vertical-align-middle'><strong>我的订单</strong></span>
                        </li>
                        
                        <li class="uk-vertical-align">
                            <a class="uk-vertical-align-middle"  href="<?= Yii::$app->urlManager->createAbsoluteUrl(['order/index', 'status' => \common\models\Order::PAYMENT_STATUS_UNPAID]) ?>">待付款</a>
                        </li>
                        
                        <li class="uk-vertical-align">
                            <a class="uk-vertical-align-middle" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['order/index']) . '?status=' . \common\models\Order::PAYMENT_STATUS_COD . ',' . \common\models\Order::PAYMENT_STATUS_PAID ?>">待发货</a>
                        </li>
                        
                        <li class="uk-vertical-align">
                            <a class="uk-vertical-align-middle" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['order/index', 'status' => \common\models\Order::SHIPMENT_STATUS_SHIPPED]) ?>">待收货</a>
                        </li>
                        
                        <li class="uk-vertical-align">
                            <a class="uk-vertical-align-middle" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['order/index', 'status' => \common\models\Order::SHIPMENT_STATUS_RECEIVED]) ?>">待评价</a>
                        </li>
                        
                        <li class="uk-vertical-align">
                            <a class="uk-vertical-align-middle" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['order']) ?>">所有订单</a>
                        </li>                 
                    </ul>
                </div>
            </div>    

            <div class="uk-width-1-1">
                <?php if (count($orders)) { ?>
                        <?php foreach ($orders as $item) { ?>
                            <div class='uk-panel uk-panel-box uk-margin-top uk-panel-box-secondary'>
                            <table id="trade-list" class="uk-table">
                            <tbody>
                            <tr>
                                <th class='uk-width-1-1' style='border-bottom: 1px #ddd dashed;'>
                                    <div >
                                        订单编号：<a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['order/view', 'id' => $item->id]) ?>" target="_self"><?= $item->sn ?></a>
                                    </div> 

                                    <div>
                                        下单时间：<?= Yii::$app->formatter->asDatetime($item->created_at) ?>
                                    </div>

                                    <div> 
                                        订单状态：<span class='uk-text-success'><?= \common\models\Order::getStatusLabels($item->status) ?></span>
                                    </div>

                                    <div>
                                        订单金额：￥<span class='uk-text-danger'> <?= $item->amount ?> </span>
                                    </div>
                                </th>
                            </tr>

                            <tr >
                                <td class="uk-width-1-1" colspan="3" style='border-bottom: 1px #ddd dashed;'>
                                    <div class='uk-grid'>
                                        <div class='uk-width-1-1'>
                                            <div class='uk-grid uk-grid-margin'>
                                                <?php foreach ($item->orderProducts as $product) { ?>
                                                    <div class='uk-width-1-1 uk-width-medium-2-10 uk-vertical-align uk-margin-bottom'>
                                                        <a target="_self" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['product/view', 'id' => $product->product_id]) ?>">
                                                            <img src="<?= $product->thumb ?>" class='uk-vertical-align-middle' style="border:1px #ccc solid;">
                                                        </a>
                                                    </div>                                                                

                                                    <div class="uk-width-1-1  uk-width-medium-6-10  uk-vertical-align uk-margin-bottom">
                                                        <a target="_self" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['product/view', 'id' => $product->product_id]) ?>" class='uk-vertical-align-middle'>
                                                            <span class='uk-text-muted uk-vertical-align-middle'> <?= $product->name ?> </span>
                                                        </a>
                                                    </div>

                                                    <div class='uk-width-1-1 uk-width-medium-2-10  uk-vertical-align uk-margin-bottom'>
                                                        <span class='uk-text-muted uk-vertical-align-middle uk-text-danger'> ￥<?= $product->price ?> x <?= $product->number ?></span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>                               

                        <div class='uk-width-1-1'>
                            <ul class='uk-subnav uk-margin-bottom-remove'>
                                <li>
                                   <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['order/view', 'id' => $item->id]) ?>" class="uk-button uk-button-primary  uk-button-small" target="_self">查看详情</a>
                                </li>
                                <li>
                                    <?php if ($item->payment_method == \common\models\Order::PAYMENT_METHOD_PAY && $item->payment_status == \common\models\Order::PAYMENT_STATUS_UNPAID) { ?>
                                        <a class="uk-button uk-button-success uk-button-small" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['cart/pay', 'sn' => $item->sn]) ?>" target="_self">我要付款</a>
                                    <?php } ?>       
                                    <input type="hidden" name="order_id" value="<?= $item->id ?>">

                                </li>
                                <li>


                                <?php if ($item->status >= \common\models\Order::PAYMENT_STATUS_UNPAID) { ?>
                                        <a href="javascript:;" class="uk-button uk-button-danger  uk-button-small" order-cancel='1'  data-link="<?= Yii::$app->urlManager->createAbsoluteUrl(['order/ajax-status', 'id' => $item->id, 'status' => \common\models\Order::STATUS_CANCEL]) ?>">取消订单</a>
                                    <?php } elseif ($item->status != \common\models\Order::STATUS_DELETED) { ?>
                                        <a class="uk-button uk-button-success  uk-button-small" order-delete='1' data-link="<?= Yii::$app->urlManager->createAbsoluteUrl(['order/ajax-status', 'id' => $item->id, 'status' => \common\models\Order::STATUS_DELETED]) ?>" href="javascript:;">删除订单</a>
                                <?php }?>  


                                 <?php if ($item->status >= \common\models\Order::PAYMENT_STATUS_PAID) { 
                                    if($refund = common\models\Refund::find()->where(['order_id'=> $item->id])->one()){?>
                                    <a class='uk-button uk-button-success  uk-button-small' href="<?= Yii::$app->urlManager->createAbsoluteUrl(['refund/update', 'id' => $refund->id]) ?>" href="javascript:;">退款查看</a>
                                <?php } else { ?>
                                    <a class="uk-button uk-button-danger  uk-button-small" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['refund/create', 'sn' => $item->sn]) ?>" href="javascript:;">退款申请</a>
                                <?php }} ?>                                                      
                                </li>
                            </ul>
                        </div>                                        

                    </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="uk-text-danger uk-margin-large-top">您还没有订单，马上去挑选心仪的商品吧~</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS

jQuery("[order-cancel='1']").click(function(){
    var link = $(this).data('link');
    $.get(link, function(data, status) {
        if (status == "success") {
            location.reload()
        }
    });
});

jQuery("[order-delete='1']").click(function(){
    var link = $(this).data('link');
    $.get(link, function(data, status) {
        if (status == "success") {
            alert('成功删除订单');
            location.reload()
        }
    });
});
JS;
$this->registerJs($js);


