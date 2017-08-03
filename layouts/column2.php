<?php
    $this->beginContent('@frontend/web/template/quickfood/layouts/main.php');
/*    $cataurl = null;
    $cataname = null;
    if($catalog != null){
        $cataurl = Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id'=>$catalog->id]);
        $cataname = $catalog->surname;
    }    */
?>
<?php 
    echo \frontend\web\template\quickfood\widgets\BreadcrumbsEx::widget();
?>

<div class="container margin_60_35">
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('@frontend/web/template/quickfood/layouts/leftside.php') ?>
        </div>

        <div class="col-md-9">
            <?=$content?>
        </div>
    </div>
</div>        
<?php
    $this->endContent();
?>