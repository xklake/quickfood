<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/24/16
 * Time: 12:01 PM
 */

Yii::$app->controller->layout = 'single';

$this->title = $catalog->title . ' - ' .Yii::$app->setting->get('siteName');
Yii::$app->params['keywords'] = $catalog->keywords != null? $catalog->keywords . ' - ' . Yii::$app->setting->get('siteName'):Yii::$app->setting->get('siteName');

Yii::$app->params['description'] = $catalog->keywords != null? $catalog->description . ' - ' . Yii::$app->setting->get('siteName'):Yii::$app->setting->get('description');

?>


<header class="page-header">
    <h1 class="page-title">
        <?php if($catalog != null){
            echo ($catalog->title);
        }
        ?>
    </h1>
</header>

<?php
if($catalog != null) {
    echo($catalog->content);
}
?>
