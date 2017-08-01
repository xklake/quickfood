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
            <p>
                <?=$menu->content?>
            </p>    
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
                    <td class="options">
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <hr/>
    <?php }} ?>        
</div><!-- End box_style_1 -->