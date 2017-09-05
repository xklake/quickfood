<?php
    $this->beginContent('@frontend/web/template/quickfood/layouts/main.php');
    echo \frontend\web\template\quickfood\widgets\BreadcrumbsEx::widget();
?>

<div class="container margin_60_35">
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('@frontend/web/template/quickfood/layouts/leftside.php') ?>
        </div>

        <div class="col-md-6">
            <?=$content?>
        </div>

        <div class="col-md-3" id="cart">
            <?php
                echo frontend\web\template\quickfood\widgets\Cart::widget();
                //    $this->render('@frontend/web/template/quickfood/layouts/rightside.php') 
            ?>
        </div>            
    </div>
</div>        
<?php
    $this->endContent();
?>