<style>
table td:first-child {
    width: 100%;
}
</style>

<?php 
    Yii::$app->session['step'] = 1;
    Yii::$app->params['checkout'] = false;        
    
	$currency = Yii::$app->params['currency']; 
	if($currency){
	    $symbol = $currency->symbol;
	}    
?>

<div class="box_style_2" id="main">
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

        <table class="table cart-list table-striped">
            <thead>
                <tr>
                    <th>
                        Item
                    </th>
                    <th>
                        Price(<?=$symbol?>)
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $index = $index + 1;
                    $products = common\models\Product::find()->where(['catalog_id'=> $menu->id])->andWhere(['status'=> \funson86\blog\models\Status::STATUS_ACTIVE])->orderBy(['sort_order' => SORT_ASC])->all();
                    
                    $LongName = "";
					$ShortName = "";
					
                    foreach ($products as $item){
                    	$names = $item->getCombinedNames();
                    	if(count ($names) > 1){
                    		$ShortName = $names[1];
                    		
	                    	if($LongName == $names[0]){ ?>
				                <tr>
				                    <td style="border-top: 0px;">
				                        <?=trim($ShortName)?>
				                    </td>
				                    <td style="border-top: 0px;">
				                        <strong><?=$symbol?><?=$item->price?></strong>
				                    </td>
				                    <td class="options text-left" style="border-top: 0px;">
				                        <a class="addproduct">
				                            <i class="icon_plus_alt2" name="<?=$item->id?>" count='1' ></i>
				                        </a>
				                    </td>
				                </tr>	                    		
						<?php				                    		
	                   		} 
	                    	else{  ?>
				                <tr>
				                    <td >
				                        <h5><?=trim($names[0])?></h5>
				                        <p>
				                            <?=trim($item->content)?>
				                        </p>
				                    </td>
				                    <td valign="align-bottom" >
				                    </td>
				                    <td class="options text-left">
				                    </td>
				                </tr>
				                
				                 <tr>
				                    <td style="border-top: 0px;">
				                        <?=trim($ShortName)?>
				                    </td>
				                    <td style="border-top: 0px;">
				                        <strong><?=$symbol?><?=$item->price?></strong>
				                    </td>
				                    <td class="options text-left" style="border-top: 0px;">
				                        <a class="addproduct">
				                            <i class="icon_plus_alt2" name="<?=$item->id?>" count='1' ></i>
				                        </a>
				                    </td>
				                </tr>	  
	                <?php    		$LongName = $names[0];
	                    	}
                    	}
                    	else{ ?>
			                <tr>
			                    <td>
			                        <h5 style="font:bold;"><?=trim($item->name)?></h5>
			                        <p>
			                            <?=trim($item->content)?>
			                        </p>
			                    </td>
			                    <td>
			                        <strong><?=$symbol?><?=$item->price?></strong>
			                    </td>
			                    <td class="options text-left">
			                        <a class="addproduct">
			                            <i class="icon_plus_alt2" name="<?=$item->id?>" count='1'></i>
			                        </a>
			                    </td>
			                </tr>                    		
			    <?php
                    	}
                ?>
                <?php } ?>
            </tbody>
        </table>
        <hr/>
    <?php }} ?>        
</div><!-- End box_style_1 -->
