<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>				

<div class="box_style_2">
    <h4 class="nomargin_top">Opening time <i class="icon_clock_alt pull-right"></i></h4>
    <ul class="opening_list">
        <?php
        $openinghour = Yii::$app->getHtmlBlock('openinghour');
        if ($openinghour != null) {
            echo($openinghour->content);
        }
        ?>
    </ul>
</div>