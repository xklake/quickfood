<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/23/16
 * Time: 5:02 PM
 */
?>

<!-- Article main content -->
<article class="col-md-8 maincontent">
<!--/.blog-item-->

    <header class="page-header">
        <h3 class="page-title">Blog Center -- Xu Huaiwen's Badminton Club</h3>
    </header>

    <?php foreach($posts as $item){?>
        <div class="blog-item">
            <div class="row">
                <div class="col-xs-12 col-sm-2">
                    <div class="entry-meta">
                        <span id="publish_date">07  JUNY</span>
                        <span><i class="fa fa-user"></i> <a href="#">Xuhuai Wen</a></span>
                        <!--span><i class="fa fa-comment"></i> <a href="#">2 Comments</a></span>
                        <!--span><i class="fa fa-heart"></i><a href="#">56 Likes</a></span-->
                    </div>
                </div>


                <div class="col-xs-12 col-sm-10">

                    <a href="#"><img class="img-responsive img-blog" src="<?=$item->banner?>" /></a>
                    <h3><?=$item->title?></h3>
                    <div>
                        <?=$item->brief?> <a class=" readmore" style="margin-left:20px;">  Read More <i class="fa fa-angle-right"></i></a>
                    </div>

                </div>
            </div>
        </div><!--/.blog-item-->
        <div style="height: 20px;"></div>
    <?php } ?>


</article>
<!-- /Article -->