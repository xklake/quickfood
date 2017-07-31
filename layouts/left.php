<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 8/1/16
 * Time: 2:18 PM
 */
$this->beginContent('@frontend/web/template/acura/layouts/main.php');
?>


<section id="blog" class="container">
    <div class="row">
        <aside class="col-md-3">
            <?= $this->render('/leftnav.php', [])?>
        </aside>

        <div class="col-md-9">
            <?= $content ?>
        </div><!--/.col-md-8-->
    </div><!--/.row-->
</section><!--/#blog-->


<?php
$this->endContent();
?>



