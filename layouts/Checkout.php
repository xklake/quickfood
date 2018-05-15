<?php
    $this->beginContent('@frontend/web/template/quickfood/layouts/main.php');
    echo \frontend\web\template\quickfood\widgets\BreadcrumbsEx::widget();
?>

<div class="container margin_60_35">
    <div class="row">

        <div class="col-md-8">
            <?=$content?>
        </div>

        <div class="col-md-4" id="cart">
            <?php
                echo frontend\web\template\quickfood\widgets\FixedCart::widget();
            ?>
        </div>            
    </div>
</div>        
<?php
    $this->endContent();
?>