<?php
$this->title = Yii::t('app', 'My') . Yii::t('app', 'Favorite');
$this->params['breadcrumbs'][] = $this->title;

/* @var $this yii\web\View */
$this->registerCssFile('', ['depends' => \frontend\assets\UikitAsset::className()]);
//$this->registerCssFile('@web/css/favorite.css', ['depends' => \frontend\assets\AppAsset::className()]);

?>
<div class='uk-width-1-1'>
    <div class="uk-panel uk-panel-box uk-width-1-1  uk-margin-bottom  uk-clearfix">
        <div><span class='uk-text-large'><?= $this->title ?></span></div>

        <div class='uk-grid-divider'></div>

         <div class='uk-grid uk-grid-medium'  data-uk-grid-margin data-uk-grid-match="{target:'> div > .uk-panel'}">
            <?php
            foreach ($products as $item) {
                echo($this->render('@frontend/views/sections/productSection', ['item'=>$item, 'maxline'=>3, 'add'=>'1', 'addtocart'=>'1']));
            }
            ?>
        </div>

        <!-- pagination 分页 -->
        <?php if(isset($pagination)) { ?>
            <div class="uk-margin" >
                <?= \frontend\widgets\LinkPagerUikit::widget(['pagination' => $pagination, 'options'=>['class'=>'uk-pagination'], 'activePageCssClass' => 'uk-active', 'prevPageCssClass' =>'prev uk-margin-small-bottom']) ?>
            </div>           
        <?php } ?>
    </div>
</div>

 
<?php
$urlCartAdd = Yii::$app->urlManager->createUrl(['cart/ajax-add']);
$this->registerJs('
var product = {csrf:"' . Yii::$app->request->getCsrfToken() . '"};
');

$js = <<<JS
jQuery(".delete").click(function(){
    var link = $(this).data('link');
    $.get(link, function(data, status) {
        if (status == "success") {
            location.reload();
        }
    });
});

jQuery(".addCart").click(function(){
    var id = $(this).data('id');
    param = {
        productId : id,
        number : 1,
        type:1,
        _csrf : product.csrf
    };

    $.post("{$urlCartAdd}?id=" + id, param, function(data) {
        if (data.status > 0) {
            alert('成功添加到购物车');
        } else {
            alert('添加到购物车失败，可能由于库存不足或其他原因');
        }
    }, "json");
});
JS;

$this->registerJs($js);
