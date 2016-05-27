<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/23/16
 * Time: 3:43 PM
 */

?>

<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\SportsAssets::register($this);


if(!isset(Yii::$app->params['keywords'])){
    Yii::$app->params['keywords'] = Yii::$app->setting->get('siteName');
}

if(!isset(Yii::$app->params['description'])){
    Yii::$app->params['description'] = Yii::$app->setting->get('siteName');
}

if(!isset(Yii::$app->params['title'])){
    Yii::$app->params['title'] = Yii::$app->setting->get('siteName');
}

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="language" content="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Robots" Content="All">
    <meta name="googlebot" content="All">
    <meta name="keywords" content="<?= Html::encode(Yii::$app->params['keywords']) ?>" />
    <meta name="description" content="<?= Html::encode(Yii::$app->params['description']) ?>" />
    <meta name="author" content="Panda blog Team" />
    <meta name="Copyright" content="Panda blog" />

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->params['title']) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render('header.php') ?>


<div class="container">

    <div class="row">

        <!-- Article main content -->
            <?=$content?>
        <!-- /Article -->

        <!-- Sidebar -->
        <aside class="col-md-4 sidebar sidebar-right">
            <div class="widget categories">
                <h3>Recent Posts</h3>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="single_comments">
                            <img src="images/blog/avatar3.png" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                            <div class="entry-meta small muted">
                                <span>By <a href="#">Alex</a></span>
                            </div>
                        </div>
                        <div class="single_comments">
                            <img src="images/blog/avatar3.png" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                            <div class="entry-meta small muted">
                                <span>By <a href="#">Alex</a></span>
                            </div>
                        </div>
                        <div class="single_comments">
                            <img src="images/blog/avatar3.png" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                            <div class="entry-meta small muted">
                                <span>By <a href="#">Alex</a></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="widget categories">
                <h3>Recent Comments</h3>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="single_comments">
                            <img src="images/blog/avatar3.png" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                            <div class="entry-meta small muted">
                                <span>By <a href="#">Alex</a></span>
                            </div>
                        </div>
                        <div class="single_comments">
                            <img src="images/blog/avatar3.png" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                            <div class="entry-meta small muted">
                                <span>By <a href="#">Alex</a></span>
                            </div>
                        </div>
                        <div class="single_comments">
                            <img src="images/blog/avatar3.png" alt="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                            <div class="entry-meta small muted">
                                <span>By <a href="#">Alex</a></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="widget archieve">
                <h3>Archieve</h3>
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="blog_archieve">
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> December 2015 <span class="pull-right">(97)</span></a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> November 2015 <span class="pull-right">(32)</span></a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> October 2015 <span class="pull-right">(19)</span></a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> September 2015 <span class="pull-right">(08)</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--div class="row widget">
                <div class="col-xs-12">
                    <h4>Lorem ipsum dolor sit</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, ratione delectus reiciendis nulla nisi pariatur molestias animi eos repellat? Vel.</p>
                </div>
            </div>
            <div class="row widget">
                <div class="col-xs-12">
                    <h4>Lorem ipsum dolor sit</h4>
                    <p><img src="assets/images/1.jpg" alt=""></p>
                </div>
            </div>
            <div class="row widget">
                <div class="col-xs-12">
                    <h4>Lorem ipsum dolor sit</h4>
                    <p><img src="assets/images/2.jpg" alt=""></p>
                    <p>Qui, debitis, ad, neque reprehenderit laborum soluta dolor voluptate eligendi enim consequuntur eveniet recusandae rerum? Atque eos corporis provident tenetur.</p>
                </div>
            </div-->

        </aside>
        <!-- /Sidebar -->

    </div>
</div>	<!-- /container -->


<?= $this->render('footer.php') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


