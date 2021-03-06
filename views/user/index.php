<?php

use yii\helpers\Html;
use \common\models\Profile;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'User Center');
$this->params['breadcrumbs'][] = $this->title;
$i = 0;


$currency = Yii::$app->params['currency']; 
if($currency){
    $symbol = $currency->symbol;
}
?>
<div class="content">
    <section id="section-3">
        <div class="row">
            <div class="col-md-8 col-sm-8 add_bottom_15">
                <input type ="hidden" name="userid" value="<?=$user->id?>">
                <input type="hidden" name="csrf" id="csrf"
                          value="<?=Yii::$app->request->csrfToken?>"/>
                <div class="indent_title_in">
                    <i class="icon_lock_alt"></i>
                    <h3>Change your password</h3>
                </div>

                <div class="wrapper_indent">
                    <div class="form-group">
                        <label>New password</label>
                        <input class="form-control" name="new_password" id="new_password" type="password">
                    </div>
                    <div class="form-group">
                        <label>Confirm new password</label>
                        <input class="form-control" name="re_password" id="re_password" type="password">
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-sm-8 add_bottom_15">
                <div class="indent_title_in">
                    <i class="icon_mail_alt"></i>
                    <h3>Change your email</h3>
                </div>

                <div class="wrapper_indent">
                    <div class="form-group">
                        <label>New email</label>
                        <input class="form-control" name="new_email" id="new_email" placeholder="<?=$user->email?>">
                    </div>
                </div><!-- End wrapper_indent -->
            </div>

            <div class="col-md-8 col-sm-8 add_bottom_15">
                <div class="indent_title_in">
                    <i class="icon_contacts_alt"></i>
                    <h3>Change your profile</h3>
                </div>

                <div class="wrapper_indent">
                    <div class="form-group">
                        <label>Nickname</label>
                        <input class="form-control" name="surname" id="surname" placeholder="<?=isset($user->profile)? $user->profile->surname:$user->username?>">
                    </div>
                </div><!-- End wrapper_indent -->
            </div>     

            <div class="col-md-8 col-sm-8 add_bottom_15 text-center text-danger text-bold" style="display: none;">
                <span id="msg"></span>
            </div>

            <div class="col-md-8 col-sm-8 add_bottom_15">
                <button type="submit" class="btn_full" id="btn_profile">Submit Now</button>
            </div>

            <div class="col-md-8 col-sm-8 add_bottom_15">
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['site/logout'])?>" target="_blank" class="btn_full">Logout</a>
            </div>
        </div><!-- End row -->
        <hr class="styled_2">
    </section><!-- End section 3 -->    
    
    <section id="section-2">
        <div class="indent_title_in">
            <i class="icon_document_alt"></i>
            <h3>Your order history</h3>
            
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Order#</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($orders as $order){ ?>
                    <tr>
                        <td><?=$order->sn?></td>
                        <td class="small">
                            <?php 
                                foreach($order->orderProducts as $product){
                            ?>        
                                <?= $product->name .'x'.$product->number?><br/>
                            <?php }    
                            ?>
                            Total Price:<?=$symbol.$order->amount?>    
                            Paid:<?=$symbol.$order->payment_fee?>
                           	Points earned:<?=number_format($order->payment_fee,0)?>
                        </td>
                        <td>Payment Status:<?= common\models\Order::getStatusLabels($order->payment_status)?><br/>
                            Order Status:<?= common\models\Order::getStatusLabels($order->status)?>
                        </td>
                        <td>
                            <?php 
                                echo(\Yii::$app->formatter->asDatetime($order->created_at, "php:d-m-Y H:i:s"));
                            ?>
                        </td>
                      </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section><!-- End section 2 -->


</div><!-- End content -->

<?php 
    $userSaveUrl = Yii::$app->urlManager->createAbsoluteUrl(["user/save"]);

$js = <<<JS
   $('#btn_profile').click(
       function(){
        if($('#new_password').val() != $('#re_password').val())
        {
            $('#msg').html("Password do not match, please retype");
            $('#msg').parent().css('display', 'block');
            return false; 
        }
        
        var data = {
                password:$('#new_password').val(),
                repassword:$('#re_password').val(),
                nickname:$('#surname').val(),
                email:$('#new_email').val(), 
                userid:"$user->id",
                _csrf:$('#csrf').val()
            };
        
        $.post("$userSaveUrl",data, function(ret)
        {
            $('#msg').html(ret.msg);
            $('#msg').parent().css('display', 'block');
            return true;
        });
    }
);
JS;

$this->registerJs($js);
?>