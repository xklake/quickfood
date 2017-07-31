<!-- top bar -->
<div class="topbar">
  <div class="container">
    <div class="row">
      <div class="col-md-12"> 	  
        <p class="pull-left"><i class="fa fa-globe"></i><span>Lingua Chinese Translation</span></p>
        <p class="pull-right">
            <a href="http://cn.lctranslate.co.uk">
                <img src="/images/china.png">
            </a>
        </p>
      </div>
    </div>
  </div>
</div>

<!-- start header -->
<header>
    <div class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=Yii::$app->urlManager->getHostInfo().Yii::$app->homeUrl?>">
                    <img src="<?=Yii::$app->urlManager->getHostInfo().'/'.Yii::$app->getImages('logo')->image?>" alt="<?=Yii::$app->setting->get('siteName')?>"/>
                </a>
            </div>
            
            <div class="navbar-collapse collapse ">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="<?=Yii::$app->urlManager->getHostInfo().Yii::$app->homeUrl?>">Home</a>
                    </li> 
                    
                    <?php foreach(Yii::$app->params['mainMenu'] as $item) {
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
                               <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?=$item['surname']?> <b class="caret"></b></a>
                               <ul class="dropdown-menu">
                                   <?php                                       
                                        foreach ($sons as $subcata){ 
                                    ?>
                                   <li><a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id' => $subcata->id])?>"><?=$subcata['surname']?></a></li>
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
