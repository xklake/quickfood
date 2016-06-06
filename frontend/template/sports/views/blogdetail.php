<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/23/16
 * Time: 5:02 PM
 */


$item = $post;

$this->title = $item->title . ' - ' . Yii::$app->setting->get('siteName');

Yii::$app->params['keywords'] = $item->keywords != null? $item->keywords . ' - ' . Yii::$app->setting->get('siteName'):Yii::$app->setting->get('siteName');
Yii::$app->params['description'] = $item->keywords != null? $item->description . ' - ' . Yii::$app->setting->get('siteName'):Yii::$app->setting->get('description');

?>

<!-- Article main content -->
<article class="col-md-8 maincontent">
    <!--/.blog-item-->

    <header class="page-header">
        <h3 class="page-title">
            <?=$item->title?>
        </h3>

        <div class="entry-meta">
            <span id="publish_date"><i class="fa fa-calendar"></i><?= ' '.Yii::$app->formatter->asDate($item->created_at); ?></span>
            <span><i class="fa fa-user"></i> <a href="#">Xuhuai Wen</a></span>
            <!--span><i class="fa fa-comment"></i> <a href="#">2 Comments</a></span>
            <!--span><i class="fa fa-heart"></i><a href="#">56 Likes</a></span-->
        </div>
    </header>


        <?=$item->content?>

</article>
<!-- /Article -->