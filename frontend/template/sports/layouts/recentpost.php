<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/1/16
 * Time: 3:54 PM
 */

$posts = Yii::$app->controller->getRecentPosts();
//$coaching = Yii::$app->params['coaching'];
$coaching = Yii::$app->controller->getCoaching(16);
?>

<aside class="col-md-4 sidebar sidebar-right">
    <div class="panel-group"  style="margin-top:20px;">
        <div class="panel panel-default">
            <div class="panel-heading"><b>Coaching Sessions</b></div>
            <div class="panel-body">
                <?php foreach($coaching as $item){ ?>
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-md-3" style="vertical-align:middle;">
                            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/product', 'id'=> $item->id])?>">
                                <?php if($item->thumb != null){?>
                                    <img src="<?='/'.$item->thumb?>" class="img-responsive ">
                                <?php }else {?>
                                    <img src="/images/noimage.png" class="img-responsive ">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="col-md-9" style="vertical-align:middle;">
                            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/product', 'id'=> $item->id])?>">
                                <span><?=$item->name?></span>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>


        <div class="panel panel-default" style="margin-top:20px;">
            <div class="panel-heading"><b>Recent Posts</b></div>
            <div class="panel-body">

                <?php foreach($posts as $item){ ?>
                        <div class="row" style="margin-bottom:20px;">
                            <div class="col-md-3">
                                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/view', 'id'=> $item->id])?>">
                                    <?php if($item->banner != null ) { ?>
                                        <img src="<?='/'.$item->banner?>" class="img-responsive ">
                                    <?php } else { ?>
                                        <img src="/images/noimage.png" class="img-responsive">
                                    <?php } ?>
                                </a>
                            </div>
                            <div class="col-md-9">
                                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/view', 'id'=> $item->id])?>">
                                    <?=$item->title?>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </div>
</aside>

