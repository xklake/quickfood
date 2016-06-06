<style>
	.carousel-inner > .item > img,
	.carousel-inner > .item > a > img {
		width: 100%;
		margin: 0px;
	}
</style>
<!-- for prev and next button -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


	<div class="container-full text-center">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<?php
				$banners = Yii::$app->getBannerByGroup(1);
			?>

			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php
				$index = 0;

				foreach($banners as $item) {
					if ($index == 0) { ?>
						<li data-target="#myCarousel" data-slide-to="<?= $index ?>" class="active"></li>
					<?php } else { ?>
						<li data-target="#myCarousel" data-slide-to="<?= $index ?>"></li>
					<?php }
					$index = $index + 1;
				}
				?>
			</ol>



			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<?php
				$index = 0;
				foreach($banners as $item) {
					if ($index == 0) { ?>
						<div class="item active">
							<img src="<?= '/' . $item->image ?>" alt="<?= $item->keywords ?>">

							<div class="carousel-caption">
								<h3><?= $item->keywords ?></h3>

								<p><?= $item->description ?></p>
							</div>
						</div>
					<?php } else { ?>
						<div class="item">
							<img src="<?= '/' . $item->image ?>" alt="<?= $item->keywords ?>">

							<div class="carousel-caption">
								<h3><?= $item->keywords ?></h3>

								<p><?= $item->description ?></p>
							</div>
						</div>
						<?php
					}
					$index++;
				}
				?>
			</div>

			<!-- Left and right controls -->
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>

	<!-- Intro -->
	<div class="container text-center">
		<br> <br>

		<?=Yii::$app->getHtmlBlock('index-joinustoday')->content;?>
	</div>

	<!-- Highlights - jumbotron -->
	<div class="jumbotron top-space" style="margin-bottom:0px;">
		<div class="container">

			<h3 class="text-center thin"><strong><?=Yii::$app->getTextBlock('home-coaching-title')->content?></strong></h3>

			<div class="row">
				<?php $coaching = Yii::$app->controller->getCoaching(16, 3);
					foreach($coaching as $item) { ?>
						<div class="col-md-4 col-sm-12 highlight">
							<div class="h-caption">
								<h4>
									<?php if($item->thumb != null) {?>
										<a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/product', 'id'=>$item->id])?>" target="_self">
											<img src="<?=$item->thumb?>" alt='<?=$item->name?>'>
										</a>
									<?php } else { ?>
									<a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/product', 'id'=>$item->id])?>" target="_self">
										<img src="/images/noimage.png" alt='<?=$item->name?>'>
									</a>
									<?php } ?>
								</h4>
							</div>

							<div class="h-body text-center">
								<p><strong><?=$item->name?></strong></p>
								<p style="font-size: 1.4rem;">
									<?=$item->brief?>
								</p>
							</div>
						</div>
				<?php } ?>
			</div> <!-- /row  -->

		</div>
	</div>
	<!-- /Highlights -->

	<!-- container -->
	<div class="container">

		<h3 class="text-center top-space">Latest posts, keep updated</h3>
		<br/>

		<?php
		$posts = Yii::$app->controller->getRecentPosts();

		foreach($posts as $item){?>
			<div class="blog-item">
				<div class="row">
					<div class="col-xs-12 col-sm-3">

						<a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/view', 'id'=> $item->id])?>">
							<img class="img-responsive  img-thumbnail" src="<?='/'.$item->banner?>" /></a>

					</div>


					<div class="col-xs-12 col-sm-9">
						<div style="margin:0px 0px 10px 0px;">
							<a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/view', 'id'=> $item->id])?>"> <h4 style="margin-top:0px;"><?=$item->title?></h4></a>
						</div>

						<div class="entry-meta">
							<span id="publish_date"><i class="fa fa-calendar"></i><?= ' '.Yii::$app->formatter->asDate($item->created_at); ?></span>
							<span><i class="fa fa-user"></i> <a href="#">Xuhuai Wen</a></span>
							<!--span><i class="fa fa-comment"></i> <a href="#">2 Comments</a></span>
                            <!--span><i class="fa fa-heart"></i><a href="#">56 Likes</a></span-->
						</div>

						<div>
							<blockquote>
								<?=$item->brief?>
							</blockquote>
							<!--a class="readmore" style="margin-left:20px;" href="<?=Yii::$app->urlManager->createAbsoluteUrl(['blog/default/view', 'id'=> $item->id])?>">  Read More <i class="fa fa-angle-right"></i></a-->
						</div>

						<div style="border-top:1px dashed #C0C0C0; margin-top:4px;"></div>
					</div>

				</div>
			</div><!--/.blog-item-->

			<div style="height: 20px;"></div>
		<?php } ?>

	</div>	<!-- /container -->
