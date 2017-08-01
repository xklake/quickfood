<?php
    $this->beginContent('@frontend/web/template/quickfood/layouts/main.php');
?>
<div id="position">
    <div class="container">
        <ul>
            <li><a href="#0">Home</a></li>
            <li><a href="#0">Category</a></li>
            <li>Page active</li>
        </ul>
        <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
    </div>
</div>

<div class="container margin_60_35">
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('@frontend/web/template/quickfood/layouts/leftside.php') ?>
        </div>

        <div class="col-md-6">
            <?=$content?>
        </div>

        <div class="col-md-3">
            <?= $this->render('@frontend/web/template/quickfood/layouts/rightside.php') ?>
        </div>            
    </div>
</div>        
<?php
    $this->endContent();
?>