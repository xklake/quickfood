<?php
$cats = Yii::$app->params['mainMenu'];
?>

<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top headroom" >
    <div class="container">
        <div class="navbar-header">
            <!-- Button for smallest screens -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?=Yii::$app->homeUrl?>">
                <!--img src="/images/sports/logo.png" alt="Progressus HTML5 template"-->
                <span style="font-size: 2rem;"> Xu Huaiwen's Badminton Club </span>
            </a>
        </div>


        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right">
                <?php foreach($cats as $item) {?>
                    <li>
                        <a href="<?=$item['url']?>">
                            <?=$item['label']?>
                        </a>
                    </li>
                <?php } ?>

                <!--li class="active"><a href="#">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">More Pages <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="sidebar-left.html">Left Sidebar</a></li>
                        <li class="active"><a href="sidebar-right.html">Right Sidebar</a></li>
                    </ul>
                </li>
                <li><a href="contact.html">Contact</a></li-->

                <!--li><a class="btn" href="<?=Yii::$app->urlManager->createUrl(['/blog/default/signin', []])?>">SIGN IN / SIGN UP</a></li-->
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<!-- /.navbar -->


<header id="head" class="secondary"></header>
