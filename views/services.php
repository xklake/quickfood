<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/10/16
 * Time: 2:14 PM
 */
?>


<section id="feature" class="transparent-bg">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>服务项目</h2>
            <?= Yii::$app->getHtmlBlock('services-lead')->content?>
        </div>

        <div class="row">
            <div class="features">
                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <?= Yii::$app->getHtmlBlock('service-website')?>

                    <div class="feature-wrap">
                        <i class="fa fa-internet-explorer"></i>
                        <h2>网站开发</h2>
                        <h3>基于html5，css3的个人，企业网站设计，网站研发</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-apple"></i>
                        <h2>App开发</h2>
                        <h3>iOS，Android app程序设计研发</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-weixin"></i>
                        <h2>微信整合</h2>
                        <h3>基于微信平台的微网站，微商城的研发和微信推广</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-google"></i>
                        <h2>网站推广营销</h2>
                        <h3>谷歌，百度SEO服务，社交网络推广，微信推广</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-cloud"></i>
                        <h2>虚拟空间和云服务</h2>
                        <h3>提供高质量虚拟空间和云服务</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-server"></i>
                        <h2>维护运营</h2>
                        <h3>服务的运营和维护，监控，安全与升级</h3>
                    </div>
                </div><!--/.col-md-4-->
            </div><!--/.services-->
        </div><!--/.row-->


        <div class="get-started center wow fadeInDown">
            <h2>这不是一次性的开发，而是长久的承诺</h2>
            <p class="lead">
                软件和网站虽然是一次性的完成，可是不同专业程度完成的质量参差不齐，
                <br>选择一个稳定的，长期，可靠，安全的团队来执行是至关紧要的。
            </p>

            <div class="request">
                <h4><a href="tel:<?=Yii::$app->setting->get('phone')?>">打个电话免费咨询一下</a></h4>
            </div>
        </div><!--/.get-started-->

        <div class="clients-area center wow fadeInDown">
            <h2>我们客户怎么说</h2>
            <p class="lead">
                客户的反馈帮助我们不断改进我们的服务和技术，
            </p>
        </div>

        <div class="row">
            <?php
                $clients = Yii::$app->getImageByGroup('clients');
                foreach($clients as $item){
                    ?>
                    <div class="col-md-4 wow fadeInDown">
                        <div class="clients-comments text-center">
                            <img src="<?='/'.$item->image?>" class="img-circle" alt="">
                            <h3>
                                <?=$item->description?>
                            </h3>
                            <h4><span>-<?=$item->name?></span></h4>
                        </div>
                    </div>
                <?php } ?>
        </div>

    </div><!--/.container-->
</section><!--/#feature-->


