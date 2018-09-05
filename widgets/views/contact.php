<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $storeaddress = null;
    if(isset(Yii::$app->params['storeaddress'])){
        $storeaddress = Yii::$app->params['storeaddress'];
    }
    else{
        $storeaddress = common\models\Address::find()->where(['=', 'user_id', 1])->andWhere(['=', 'default', 1])->one();
        Yii::$app->params['storeaddress'] = $storeaddress;
    }
?>

<div class="box_style_2" id="help">
    <i class="icon_lifesaver"></i>
    <h4><span>Contact Us</span></h4>
    <a href="<?= 'tel:' . $storeaddress->phone ?>" class="phone">
        <?= $storeaddress->phone ?>
    </a>

    <a href="<?= 'tel:' . $storeaddress->mobile ?>" class="phone">
        <?= $storeaddress->mobile ?>
    </a>
    <a href="<?= 'mailto:' . $storeaddress->email ?>" class="phone">
        <?= $storeaddress->email ?>
    </a>
</div>
