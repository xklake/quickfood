<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/9/16
 * Time: 5:43 PM
 */

$cats = Yii::$app->params['mainMenu'];
?>

<ul>
<?php foreach($cats as $item) {?>
    <li>
        <a href="<?=$item['url']?>">
            <?=$item['label']?>
        </a>
    </li>
<?php } ?>
</ul>

<div style="margin-top:50px; text-align: center; width:300px;">
    <div style="text-align: center;"><h2>FREE CONSULTATION</h2></div>
    <div style="width:300px; text-align: center;">
        <h2><?=Yii::$app->setting->get('mobile')?></h2>
    </div>
</div>


<div style="margin-top:50px; text-align: center; width:300px;">
    <div style="text-align: center;"><h2>We are members of</h2></div>
    <div style="width:300px; text-align: center;">
        <img src="/pandacms/frontend/web/images/health/member.png" id="memberimg" style="text-align:center; margin:0 auto;display:block;padding:0px;float:none;">
    </div>
</div>