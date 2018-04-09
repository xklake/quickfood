<?php
    $this->beginContent('@frontend/web/template/quickfood/layouts/main.php');
?>
<?php 
    echo \frontend\web\template\quickfood\widgets\BreadcrumbsEx::widget();
?>

<div class="container">
    <div class="row">
		<div class="col-md-6">
            <?=$content?>
        </div>
    </div>
</div>        
<?php
    $this->endContent();
?>