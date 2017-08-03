<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="box_style_1">
    <ul id="cat_nav">
        <?php 
            $mainMenu = Yii::$app->params['mainMenu']; 
            $allMenu = Yii::$app->params['allMenu']; 

            $index = 1;
            foreach ($mainMenu as $mainMenuItem){
                if(!key_exists('template', $mainMenuItem) || $mainMenuItem['template']!= funson86\blog\models\BlogCatalog::TEMPLATE_PRODUCT){
                    continue;
                }

                //find all submenu
                foreach($allMenu as $menu){
                    if($menu->parent_id != $mainMenuItem['id']){
                        continue;
                    }

                    if($index == 1){
                        echo('<li><a href="#nav_'.$index. '" class="active">'.$menu->surname.'</a></li>');
                    }else{
                        echo('<li><a href="#nav_'.$index. '">'.$menu->surname.'</a></li>');
                    }
                    
                    $index = $index + 1;
                }
            }
        ?>
    </ul>
</div><!-- End box_style_1 -->

<?php 
    echo \frontend\web\template\quickfood\widgets\Contact::widget();
    echo \frontend\web\template\quickfood\widgets\OpeningHour::widget();
?>