<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/10/16
 * Time: 3:30 PM
 */
?>

<section id="portfolio">
    <div class="container">
        <div class="center">
            <h2>近期作品</h2>
            <p class="lead">
                以下是我们的近期作品，后续我们会定期更新我们的作品。
                <br>
                请多关注我们的博客，以获得最新的开发动态。
            </p>
        </div>


        <ul class="portfolio-filter text-center">
            <li><a class="btn btn-default active" href="#" data-filter="*">所有作品</a></li>
            <li><a class="btn btn-default" href="#" data-filter=".ent">企业网站</a></li>
            <li><a class="btn btn-default" href="#" data-filter=".ecom">电商网站</a></li>
            <li><a class="btn btn-default" href="#" data-filter=".blog">Blog网站</a></li>
            <li><a class="btn btn-default" href="#" data-filter=".app">App程序</a></li>
            <!--li><a class="btn btn-default" href="#" data-filter=".wordpress">app软件</a></li-->
        </ul><!--/#portfolio-filter-->

        <div class="row">
            <div class="portfolio-items">
                <?php $banners = Yii::$app->getImageByGroup(2);
                foreach($banners as $item){?>
                    <div class="portfolio-item <?=$item->keywords?> col-xs-12 col-sm-4 col-md-3">
                        <div class="recent-work-wrap">
                            <img class="img-responsive" src="<?='/'.$item->image?>" alt="<?=$item->name?>">
                            <div class="overlay">
                                <div class="recent-work-inner">
                                    <h3><a href="<?=$item->url?>"><?=$item->name?></a></h3>
                                    <p><?=$item->description?></p>
                                    <a class='preview' href="<?=$item->url?>" target="_blank" ref="nofollow">
                                        <i class="fa fa-eye"></i>查看
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section><!--/#portfolio-item-->

