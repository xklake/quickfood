<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="box_style_2" id="help">
    <i class="icon_lifesaver"></i>
    <h4><span>Contact Us</span></h4>
    <?php
    $phone = Yii::$app->setting->get('phone');
    if ($phone != null) {
        ?>
        <a href="<?= 'tel:' . $phone ?>" class="phone">
            <?= $phone ?>
        </a>
    <?php } ?>

    <?php
    $mobile = Yii::$app->setting->get('mobile');
    if ($mobile != null) {
        ?>
        <a href="<?= 'tel:' . $mobile ?>" class="phone">
            <?= $mobile ?>
        </a>
    <?php } ?>    

    <?php
    $email = Yii::$app->setting->get('email');
    if ($email != null) {
        ?>
        <a href="<?= 'tel:' . $email ?>" class="email">
            <?= $email ?>
        </a>
    <?php } ?>
</div>
