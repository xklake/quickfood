<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $catalog = Yii::$app->params['catalog'];
    $cataurl = null;
    $cataname = null;
    
    if($catalog != null){
        $cataurl = Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id'=>$catalog->id]);
        $cataname = $catalog->surname;
    }    
?>

<div id="position">
    <div class="container">
        <ul>
            <?php 
                echo \yii\widgets\Breadcrumbs::widget([
                    'itemTemplate' => "<li>{link}</li>", // template for all links
                    'links' => [
                        [
                            'label' => $cataname, 
                            'url' => $cataurl
                        ],
                    ],
                ]);
            ?>
        </ul>
    </div>
</div>
