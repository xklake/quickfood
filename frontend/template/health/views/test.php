<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 5/10/16
 * Time: 2:16 PM
 */

Yii::$app->controller->layout = 'test';

?>

<?php if(count($posts) == 1) { ?>
    <div>
        <?= $posts[0]->content ?>
    </div>
<?php }?>