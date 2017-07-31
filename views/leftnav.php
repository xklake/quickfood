<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 8/1/16
 * Time: 2:18 PM
 */
?>


<div class="list-group">
    <a href="#" class="list-group-item active">
        用户中心
    </a>

    <a href="<?= Yii::$app->urlManager->createUrl(['blog/default/myposts']) ?>" class="list-group-item">我的文章</a>
    <a href="<?= Yii::$app->urlManager->createUrl(['blog/default/mycomments']) ?>" class="list-group-item">我的评论</a>
    <a href="<?= Yii::$app->urlManager->createUrl(['blog/default/logout']) ?>" class="list-group-item">退出</a>
</div>
