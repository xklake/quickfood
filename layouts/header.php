<!-- start header -->
<?php 
    $logo = Yii::$app->getImages('logo'); 
    if($logo == null){
        $logo = "/images/logo.png";
    } else{
        $logo = $logo->image;
    }

    $logo_mobile = Yii::$app->getImages('logo_mobile'); 
    if($logo_mobile == null){
        $logo_mobile = "/images/logo.png";
    } else{
        $logo_mobile = $logo_mobile->image;
    }    
    
    if(!isset(Yii::$app->params['mainMenu'])){
        funson86\blog\controllers\frontend\DefaultController::updateMainMenu();
    }
?>

<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col--md-4 col-sm-4 col-xs-4">
                <a href="<?= Yii::$app->urlManager->getHostInfo() . Yii::$app->homeUrl?>" id="logo">
                    <img src="<?= Yii::$app->urlManager->getHostInfo() . '/' . $logo?>" width="190" height="23" alt="" data-retina="true" class="hidden-xs">
                    <img src="<?= Yii::$app->urlManager->getHostInfo() . '/' . $logo_mobile?>" width="59" height="23" alt="" data-retina="true" class="hidden-lg hidden-md hidden-sm">
                </a>    
            </div>    

            <nav class="col--md-8 col-sm-8 col-xs-8">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="<?= Yii::$app->urlManager->getHostInfo() .'/'.$logo ?>" width="190" height="23" alt="" data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                    <ul>
                        <li><a href="<?= Yii::$app->urlManager->getHostInfo() . Yii::$app->homeUrl ?>">Home</a></li>

                        <?php
                        foreach (Yii::$app->params['mainMenu'] as $item) {
                            $sons = \funson86\blog\models\BlogCatalog::find()->where(['parent_id' => $item['id']])->andWhere(['status' => \funson86\blog\models\Status::STATUS_ACTIVE])->all();
                            if (count($sons) == 0) {
                                ?>
                                <li>
                                    <a href="<?= Yii::$app->urlManager->getHostInfo() . $item['url'] ?>">
                                        <?= $item['surname'] ?>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li> 
                                    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id' => $item['id']]) ?>" class="show-submenu"><?= $item['surname'] ?>
                                    </a>
                                </li>                        
                            <?php } ?>
                        <?php } ?>
                                
                        <?php if(Yii::$app->user->isGuest){?>
                        <li>
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['site/login'])?>" target="_self">
                                <i class="fa fa-user"></i>Login
                            </a>
                        </li>
                        <li>
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['site/signup'])?>" target="_self">
                                <i class="fa fa-user"></i>Registry
                            </a>
                        </li>                        
                        <?php } else { ?>
                        <li>
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['site/logout'])?>" target="_self">
                                Logout
                            </a>
                        </li>
                        <li>
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['user'])?>" target="_self">
                                <i class='icon_profile'></i><?=Yii::$app->user->identity->profile->surname?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- end header -->
<section class="parallax-window" id="home" data-parallax="scroll" data-image-src="/images/sub_header_home.jpg" data-natural-width="1400" data-natural-height="550">
    <div id="subheader">
        <div id="sub_content">
            <h1>
                <?php 
                $homebannertitle = Yii::$app->getTextBlock('home-banner-title');
                if($homebannertitle != null){
                    echo($homebannertitle->content);
                }
                ?>
            </h1>
            <p>
                <?php 
                    $homebannercontent = Yii::$app->getTextBlock('home-banner-content'); 
                    if($homebannercontent != null){
                        echo($homebannercontent->content); 
                    }
                ?>
            </p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
    <div id="count" class="hidden-xs">
        <ul>
            <?php
                $welcome = Yii::$app->getTextBlock('home-welcome');
                if ($welcome != null) {
            ?>
                <li>
                    <?= $welcome->content ?>
                </li> 
            <?php } ?>     
        </ul>
    </div>
</section><!-- End section -->
