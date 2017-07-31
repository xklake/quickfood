<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/10/16
 * Time: 11:52 AM
 */
?>
<?php foreach($posts as $item){?>
    <div class="blog-item">
        <div class="row">
            <div class="col-xs-12 col-sm-2 text-center">
                <div class="entry-meta">
                    <span id="publish_date"><?=substr(date('Y', $item->created_at), 2).'/'.date('m', $item->created_at)?></span>
                    <span><i class="fa fa-user"></i> <a href="#"><?=$item->user->username?></a></span>
                    <span><i class="fa fa-comment"></i> <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/view', 'id'=> $item->id])?>"><?=$item->getCommentsCount()?> Comments</a></span>
                    <!--span><i class="fa fa-heart"></i><a href="#">56 Likes</a></span-->
                </div>
            </div>

            <div class="col-xs-12 col-sm-10 blog-content">
                <?php if($item->banner !=null && $item->banner != ""){?>
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/view', 'id'=> $item->id])?>">
                        <img class="img-responsive img-blog" src="<?=Yii::$app->urlManager->getHostInfo().'/'.$item->banner?>" width="100%" alt="" />
                    </a>
                <?php } ?>

                <h2>
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/view', 'id'=> $item->id])?>">
                        <?=$item->title?>
                    </a>
                </h2>

                <h3>
                    <?=$item->brief?>
                </h3>

                <a class="btn btn-primary readmore" href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/view', 'id'=> $item->id])?>">
                    Read All  <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div><!--/.blog-item-->
<?php } ?>

<!-- pagination 分页 -->
<div class="uk-margin" >
    <?= \yii\widgets\LinkPager::widget(['pagination' => $pagination, 'options'=>['class'=>'pagination'], 'activePageCssClass' => 'active']) ?>
</div>
<!-- end of 分页  -->
