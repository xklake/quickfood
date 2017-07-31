<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/9/16
 * Time: 5:32 PM
 */
    $banners = Yii::$app->getImageByGroup('banner1');
?>

<section id="banner">
<!-- Slider -->
    <div id="main-slider" class="flexslider">
        <ul class="slides">
          <?php foreach($banners as $item) { ?>
            <li>
              <img src="<?=Yii::$app->urlManager->getHostInfo().'/'.$item->image?>" alt="$item->keywords">
              <div class="flex-caption">
                  <h3><?=$item->keywords?></h3> 
                  <p><?=$item->description?></p> 
              </div>
            </li>
          <?php } ?>
        </ul>
    </div>
<!-- end slider -->
</section> 

<section id="call-to-action-2">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-9">
                <h3>
                    <?php 
                        $serivice1= Yii::$app->getTextBlock('home-service-1');
                        if($serivice1 != null)
                        {
                            echo($serivice1->content);
                        }
                    ?>
                </h3>
                <p>
                    <?php 
                        $serivice2= Yii::$app->getTextBlock('home-service-2');
                        if($serivice2 != null)
                        {
                            echo($serivice2->content);
                        }
                    ?>
                </p>
            </div>
            <div class="col-md-2 col-sm-3">
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id'=>58])?>" class="btn btn-primary">Read More</a>
            </div>
        </div>
    </div>
</section>

<section id="content">
	<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aligncenter">
                    <h2 class="aligncenter">Our Services</h2>
                    <?php 
                        $serivice_slogan= Yii::$app->getTextBlock('home-trans-slogan');
                        if($serivice_slogan != null)
                        {
                            echo($serivice_slogan->content);
                        }
                    ?>                    
                </div>
                <br/>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 info-blocks">
                <i class="icon-info-blocks fa fa-bell-o"></i>
                <div class="info-blocks-in">
                    <h3>Languages we cover</h3>
                    <p>
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id'=>58])?>">
                        <?php 
                            $home_service_language= Yii::$app->getTextBlock('home-service-language');
                            if($home_service_language != null)
                            {
                                echo($home_service_language->content);
                            }
                        ?>  
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-sm-4 info-blocks">
                <i class="icon-info-blocks fa fa-hdd-o"></i>
                <div class="info-blocks-in">
                    <h3>Certified Translation</h3>
                    <p>
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id'=>53])?>">                        
                        <?php 
                            $home_service_certified_t = Yii::$app->getTextBlock('home-service-certified-t');
                            if($home_service_certified_t != null)
                            {
                                echo($home_service_certified_t->content);
                            }
                        ?>  
                        </a>
                    </p>
                </div>
            </div>
            
            <div class="col-sm-4 info-blocks">
                <i class="icon-info-blocks fa fa-lightbulb-o"></i>
                <div class="info-blocks-in">
                    <h3>Document Translation </h3>
                    <p>
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id'=>54])?>">
                        <?php 
                            $document_translation = Yii::$app->getTextBlock('home-service-document-t');
                            if($document_translation != null)
                            {
                                echo($document_translation->content);
                            }
                        ?>  
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-4 info-blocks">
                <i class="icon-info-blocks fa fa-code"></i>
                <div class="info-blocks-in">
                    <h3>Proofreading & Editing</h3>
                    <p>
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id'=>56])?>">
                        <?php 
                            $proof = Yii::$app->getTextBlock('home-service-proof');
                            if($proof != null)
                            {
                                echo($proof->content);
                            }
                        ?>     
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-sm-4 info-blocks">
                <i class="icon-info-blocks fa fa-compress"></i>
                <div class="info-blocks-in">
                    <h3>Interpretation</h3>
                    <p>
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id'=>57])?>">
                        <?php 
                            $Interpretation = Yii::$app->getTextBlock('home-service-interpretation');
                            if($Interpretation != null)
                            {
                                echo($Interpretation->content);
                            }
                        ?>
                        </a>                         
                    </p>
                </div>
            </div>
            <div class="col-sm-4 info-blocks">
                <i class="icon-info-blocks fa fa-html5"></i>
                <div class="info-blocks-in">
                    
                    <h3>Transcription</h3>
                    <p>
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/catalog', 'id'=>55])?>">
                        <?php 
                            $transcription = Yii::$app->getTextBlock('home-service-transcription');
                            if($transcription != null)
                            {
                                echo($transcription->content);
                            }
                        ?>   
                        </a>
                    </p>
                </div>
            </div>
        </div>
	</div>
</section>

<section class="section-padding gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h2>Free Online Quotation</h2>
                    <p>
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/quote'])?>" class="btn btn-primary">Quote Now</a>
                    </p>
                    <h4>
                        We will try to get back to you with an hour
                    </h4>
                </div>
            </div>
        </div>
    </div>
</section>	  