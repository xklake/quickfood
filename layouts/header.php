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
?>


<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col--md-4 col-sm-4 col-xs-4">
                <a href="index.html" id="logo">
                    <img src="<?=$logo?>" width="190" height="23" alt="" data-retina="true" class="hidden-xs">
                    <img src="<?=$logo_mobile?>" width="59" height="23" alt="" data-retina="true" class="hidden-lg hidden-md hidden-sm">
                </a>
            </div>    
            
            <nav class="col--md-8 col-sm-8 col-xs-8">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="<?=$logo?>" width="190" height="23" alt="" data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                    <ul>
                        <li><a href="<?=Yii::$app->urlManager->baseUrl?>">Home</a></li>
                    
                    <?php 
                        foreach(Yii::$app->params['mainMenu'] as $item) {
                        $sons = \funson86\blog\models\BlogCatalog::find()->where(['parent_id' =>$item['id']])->andWhere(['status'=> \funson86\blog\models\Status::STATUS_ACTIVE])->all();
                        if(count($sons) == 0){
                    ?>
                        <li>
                            <a href="<?=Yii::$app->urlManager->getHostInfo().$item['url']?>">
                                <?=$item['surname']?>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="show-submenu"><?=$item['surname']?><i class="icon-down-open-mini"></i></a>
                            <ul>
                               <?php foreach ($sons as $subcata){ ?>
                                    <li>
                                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id' => $subcata->id])?>"><?=$subcata['surname']?></a>
                                    </li>
                               <?php } ?>
                           </ul>
                        </li>                        
                    <?php } ?>
                    <?php } ?>
                    <li>
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/quote'])?>">ONLINE QUOTE</a>
                    </li>                             
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
