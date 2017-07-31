<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 7/28/16
 * Time: 2:49 PM
 */
?>

<div class="widget categories">
    <h3>Blog Catalog</h3>
    <div class="row">
        <div class="col-sm-11">
            <ul class="blog_category">
                <?php
                    $allCatalog = \funson86\blog\models\BlogCatalog::find()->where(['status' => \funson86\blog\models\Status::STATUS_ACTIVE])->andwhere(
                        ['parent_id' => 17] )->orderby(['sort_order' => SORT_ASC])->all();

                    foreach($allCatalog as $item) {
                        if ($item->template == \funson86\blog\models\BlogCatalog::TEMPLATE_MULTIPLY) {
                            ?>
                            <li>
                                <a href="<?=Yii::$app->getUrlManager()->createUrl(['/blog/default/catalog/','id'=>$item->id])?>">
                                    <?=$item->surname?>
                                    <span class="badge"><?=$item->getPostsCount()?></span>
                                </a>
                            </li>
                <?php
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</div><!--/.categories-->

<div class="widget tags">
    <h3>Hot Tags</h3>
    <ul class="tag-cloud">
        <?php $tags = array_reverse(\funson86\blog\models\BlogTag::findTagWeights(20));
            foreach($tags as $key => $val){
        ?>
            <li><a class="btn btn-xs btn-primary" href="<?=Yii::$app->getUrlManager()->createAbsoluteUrl(['/blog/default/catalog/','tag'=>$key])?>"><?=$key?> (<?=$val?>)</a></li>
        <?php } ?>
    </ul>
</div><!--/.tags-->
