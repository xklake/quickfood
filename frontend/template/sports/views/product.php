<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/23/16
 * Time: 5:02 PM
 */

$this->title = ' Blog Center - ' . Yii::$app->setting->get('siteName');

?>

<!-- Article main content -->
<article class="col-md-8 maincontent">
    <!--/.blog-item-->

    <header class="page-header">
        <h3 class="page-title"><?=$catalog->title?> - Xu Huaiwen's Badminton Club</h3>
    </header>

    <?php foreach($products as $item){?>
        <div class="blog-item">
            <div class="row">
                <div class="col-xs-12 col-sm-3">
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/product', 'id'=> $item->id])?>">
                        <img class="img-responsive  img-thumbnail" src="<?='/'.$item->thumb?>" />
                    </a>
                </div>


                <div class="col-xs-12 col-sm-9">
                    <div style="margin:0px 0px 10px 0px;">
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/product', 'id'=> $item->id])?>">
                            <h4 style="margin-top:0px;"><?=$item->name?></h4>
                        </a>
                    </div>

                    <!--a href="<?='/product/'.$item->id?>">
                            <h4 style="margin-top:0px;"><?=$item->name?></h4>
                        </a-->

                    <div class="entry-meta">
                        <span id="publish_date" ><i class="fa fa-calendar"></i><?= 'Start Time: '.Yii::$app->formatter->asDate($item->created_at); ?></span>
                        <span style="margin-left:10px;"><i class="fa fa-user"></i>Coach: Xu Huaiwen</span>
                        <span style="margin-left:10px;">Price: <i class="fa fa-gbp"></i><?=$item->price?></span>

                        <!--span id="publish_date"><i class="fa fa-calendar"></i><?= ' '.Yii::$app->formatter->asDate($item->created_at); ?></span>
                        <span><i class="fa fa-user"></i> <a href="#">Xuhuai Wen</a></span-->
                        <!--span><i class="fa fa-comment"></i> <a href="#">2 Comments</a></span>
                        <!--span><i class="fa fa-heart"></i><a href="#">56 Likes</a></span-->
                    </div>

                    <div>
                            <?=$item->brief?>
                        <!--a class="readmore" style="margin-left:20px;" href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/product', 'id'=> $item->id])?>">  Read More <i class="fa fa-angle-right"></i></a-->
                    </div>

                    <div style="border-top:1px dashed #C0C0C0; margin-top:4px;"></div>
                </div>

            </div>
        </div><!--/.blog-item-->

        <div style="height: 20px;"></div>
    <?php } ?>


    <!-- pagination 分页 -->
    <div class="uk-margin" >
        <?= \yii\widgets\LinkPager::widget(['pagination' => $pagination, 'options'=>['class'=>'pagination'], 'activePageCssClass' => 'active']) ?>
    </div>
    <!-- end of 分页  -->

</article>
<!-- /Article -->