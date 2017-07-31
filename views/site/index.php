<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->setting->get('siteTitle');
$this->registerMetaTag(['name' => 'keywords', 'content' => Yii::$app->setting->get('siteKeywords')]);
$this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->setting->get('siteDescription')]);
//$this->registerCssFile('@web/css/index.css', ['depends' => \frontend\assets\AppAsset::className()]);
//$this->registerJsFile('@web/js/switchable.js', ['depends' => \frontend\assets\AppAsset::className()]);
//this is
?>

<!-- brand big images area -->
<div class="uk-grid uk-margin-bottom"  >
	<div class="uk-width-1-1" id="index_brandshow" >
		<div class='uk-grid uk-margin-bottom' >
			<?php foreach($brandHome as $item) { ?>
				<div class='uk-width-medium-1-2 uk-margin-bottom'>
					<a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['brand/view', 'id' => $item->id]) ?>" target="_self">
						<img src="<?=$item->middleimage?>"  alt="<?=$item->name?>" style='border:1px solid #cccccc;'></img>
					</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<!-- end of brand area -->


<!-- speical price daily -->
<div class="uk-grid uk-margin-top"  >
	<div class="uk-width-1-1 uk-vertical-align-middle" id="index_brandshow"  >
		<span style='font-size:2rem;'> 每日特价 </span>
		<span class='uk-text-muted' style='padding-left:10px;font-size:1.2rem;'>价格触目惊心!</span>

		<span class='uk-text-muted uk-hidden-small' style='padding-left:10px;font-size:1.2rem;'>忍无可忍，无需再忍！</span>
	</div>
</div>

<div class='uk-grid-divider uk-margin-bottom-remove uk-margin-small-top'></div>

<br/>

<!-- daily special price product list -->
<div class="uk-grid"  >
	<div class="uk-width-1-1" id="index_brandshow" >
		<div class='uk-grid uk-grid-medium' data-uk-grid-match="{target:'> div > .uk-panel'}">
			<?php
				foreach ($dailySpecialProducts as $item) {
					echo($this->render('@frontend/views/sections/productSection', ['item'=>$item, 'maxline'=>4]));
				}
			?>
		</div>
	</div>
</div>
<!-- end of daily special price product list -->
<!-- end of daily special price section -->


<!-- best seller section -->
<div class="uk-grid uk-margin-top"  >
	<div class="uk-width-1-1 uk-vertical-align-middle" id="index_brandshow"  >
		<span style='font-size:2rem;'> 人气爆款 </span>
		<span class='uk-text-muted' style='padding-left:10px;font-size:1.2rem;'>100%信赖，100%正品</span>

		<span class='uk-text-muted uk-hidden-small' style='padding-left:10px;font-size:1.2rem;'>，100%低价</span>
	</div>
</div>


<div class='uk-grid-divider uk-margin-bottom-remove uk-margin-small-top'></div>

<br/>
<!-- best seller product list -->
<!-- daily special price product list -->
<div class="uk-grid"  >
	<div class="uk-width-1-1" id="index_brandshow" >
		<div class='uk-grid uk-grid-medium' data-uk-grid-match="{target:'> div > .uk-panel'}">
			<?php
			foreach ($hotProducts as $item) {
				echo($this->render('@frontend/views/sections/productSection', ['item'=>$item, 'maxline'=>4]));
			}
			?>
		</div>
	</div>
</div>
<!-- end of best seller product list -->
<!-- end of best seller section -->



<!-- new product section -->
<div class="uk-grid uk-margin-top"  >
	<div class="uk-width-1-1 uk-vertical-align-middle" id="index_brandshow"  >
		<span style='font-size:2rem;'> 新品上架 </span>
		<span class='uk-text-muted' style='padding-left:10px;font-size:1.2rem;'>最新上架，试一试？</span>

		<span class='uk-text-muted uk-hidden-small' style='padding-left:10px;font-size:1.2rem;'>，100%低价</span>
	</div>
</div>

<div class='uk-grid-divider uk-margin-bottom-remove uk-margin-small-top'></div>

<br/>

<!-- new product product list -->
<!-- new product list -->
<div class="uk-grid">
	<div class="uk-width-1-1" id="index_brandshow" >
		<div class='uk-grid uk-grid-medium' data-uk-grid-match="{target:'> div > .uk-panel'}">
			<?php
			foreach ($newProducts as $item) {
				echo($this->render('@frontend/views/sections/productSection', ['item'=>$item, 'maxline'=>4]));
			}
			?>
		</div>
	</div>
</div>
<!-- end of new product list -->
<!-- end of new product section -->


<!-- start each category -->
<?php
	$allCategory = \common\models\Category::get(0, \common\models\Category::find()->asArray()->all());
	foreach ($allCategory as $category) {
		if ($category["parent_id"] == 0) {
?>

			<div class="uk-grid uk-margin-top"  >
				<div class="uk-width-1-1 uk-vertical-align-middle"  >
					<span style='font-size:2rem;'> <?=$category['name']?> </span>
					<?php
						$soncats = \common\models\Category::getSonCatalog($category['id'], $allCategory);

						foreach($soncats as $item){
							$arrSubCat = \common\models\Category::getArraySubCatalogId($item['id'], $allCategory);
							//$products =  \console\models\Product::find()->where(['category_id' => $arrSubCat, 'status' => \common\models\Status::STATUS_ACTIVE])->andWhere(['&', 'type', 8])->orderBy(['sales' => SORT_DESC])->limit(8)->all();
					?>
						<a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['category/view', 'id' => $item['id']]) ?>">
							<span class='uk-text-muted uk-visible-large' style='padding-left:10px;font-size:1.2rem;'><?=$item['name']?></span>
						</a>
					<?php } ?>
				</div>
			</div>

			<div class='uk-grid-divider uk-margin-bottom-remove uk-margin-small-top'></div>
			<br/>

			<!-- category recomme product list -->
			<div class="uk-grid"  >
				<div class="uk-width-1-1"  >
					<div class='uk-grid uk-grid-medium' data-uk-grid-match="{target:'> div > .uk-panel'}">
						<?php
								$allsonscats = \common\models\Category::getArraySubCatalogId($category['id'], $allCategory);
								$products = \console\models\Product::find()->where(['category_id' => $allsonscats, 'status' => \common\models\Status::STATUS_ACTIVE])->andWhere(['&', 'type', 8])->orderBy(['sales' => SORT_DESC])->limit(8)->all();

								foreach ($products as $product) {
									echo($this->render('@frontend/views/sections/productSection', ['item' => $product, 'maxline'=>4 ]));
								}
						?>
					</div>
				</div>
			</div>
			<!-- end of each category -->
<?php }
}
?>
