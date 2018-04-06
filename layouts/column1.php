<?php
    $this->beginContent('@frontend/web/template/quickfood/layouts/main.php');
?>
<?php 
    echo \frontend\web\template\quickfood\widgets\BreadcrumbsEx::widget();
?>

<div class="container margin_60_35">
    <div class="row">
		<div class="col-md-offset-3 col-md-6">
            <?=$content?>
        </div>
    </div>
</div>        
<?php
    $this->endContent();
?>