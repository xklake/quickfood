<?php 
        Yii::$app->session['step'] = 1;
?>

<div class="box_style_2" id="main_menu">
<?php
    $mainMenu = Yii::$app->params['mainMenu'];
    $allMenu = Yii::$app->params['allMenu'];

    $index = 1;
    foreach ($mainMenu as $mainMenuItem) {
        if (!key_exists('template', $mainMenuItem) || $mainMenuItem['template'] != funson86\blog\models\BlogCatalog::TEMPLATE_PRODUCT) {
            continue;
        }
        
        echo('<h2 class="inner">'.$mainMenuItem["surname"].'</h2>');
        
        //find all submenu
        foreach ($allMenu as $menu) {
            if ($menu->parent_id != $mainMenuItem['id']) {
                continue;
            }
        ?>
    
        <h3 class="nomargin_top" id="<?='nav_'.$index?>"><?=$menu->surname?></h3>
        <?php if($menu->content != null){?>
            <?=$menu->content?>
        <?php } ?>

        <table class="table table-striped cart-list">
            <thead>
                <tr>
                    <th>
                        Item
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Order
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $index = $index + 1;
                    $products = common\models\Product::find()->where(['catalog_id'=> $menu->id])->andWhere(['status'=> \funson86\blog\models\Status::STATUS_ACTIVE])->orderBy(['sort_order' => SORT_ASC])->all();
                    foreach ($products as $item){
                ?>
                <tr>
                    <td>
                        <figure class="thumb_menu_list"><img src="<?='/'.$item->thumb?>" alt="thumb"></figure>
                        <h5><?=$item->name?></h5>
                        <p>
                            <?=$item->content?>
                        </p>
                    </td>
                    <td>
                        <strong><?=$item->price?></strong>
                    </td>
                    <td class="options text-left">
                        <a href="#" class="addproduct">
                            <i class="icon_plus_alt2" id="<?=$item->id?>"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <hr/>
    <?php }} ?>        
</div><!-- End box_style_1 -->


<?php
$urlAddToCart = Yii::$app->urlManager->createAbsoluteUrl(['cart/add-to-cart']);
$urlLogin = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);

$this->registerJs('
var product = {' . 'csrf:"' . Yii::$app->request->getCsrfToken() . '"};
var user = {id:' . (Yii::$app->user->isGuest ? 0 : Yii::$app->user->id) . ', ' . '};
var urlCartAdd = "' . Yii::$app->urlManager->createAbsoluteUrl(['cart/ajax-add']) . '";');

$js = <<<JS
jQuery(".icon_plus_alt2").click(function(){
    var number = 1;

        
    param = {
        productId : $(this).attr('id'),
        number : number,
        _csrf : product.csrf
    };

    $.post(urlCartAdd, param, function(data) {
        if (data.status > 0) {
            $(this).removeClass("icon_plus_alt2");
            $(this).addClass("icon_check_alt2");
        }
    }, "json");
});
JS;

$this->registerJs($js);
?>