<?php
use yii\helpers\Html;
use \common\models\Profile;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'My Comments');
$this->params['breadcrumbs'][] = $this->title;
$i = 0;
?>


<ul class="list-group">
    <li class="list-group-item">
        <div class="form-horizontal">
            <div class="form-group">
                <h3 style="width: 100%;text-align: center;font-size:2.3rem;" >我的评论记录</h3>
            </div>

            <div class="form-group" style="padding:0px 17px;">
                <div id='allcomments'>

                </div>
            </div>
        </div>
    </li>
</ul>

<?php
$urlComment = Yii::$app->urlManager->createUrl(['blog/default/comment']);
$urlNewComment = Yii::$app->urlManager->createUrl(['blog/default/newcomment']);
$csrfcode = Yii::$app->request->getCsrfToken();
$urlDeleteComment = Yii::$app->urlManager->createUrl(['blog/default/deletecomment']);
$urlActivateComment = Yii::$app->urlManager->createUrl(['blog/default/activatecomment']);


$userid = Yii::$app->user->id;
$js = <<<JS

    $('#allcomments').on('click', '.pagination a', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: "GET",
            dataType: "html",
            success: function(data){
                $('#allcomments').html(data);
            }

        }).fail(function(){
                alert("Error");
        });

    });

    $.ajax({
        url: "{$urlComment}?postid=&userid="+{$userid},
        type: "GET",
        dataType: "html",
        success: function(data){
            $('#allcomments').html(data);
        }
    }).fail(function(){
            alert("Error");
    });

    $("#allcomments").on('click', '.modifyinusercentre', function(e){
        param = {
            content:$(this).parent().find('textarea').val(),
            commentid:$(this).parent().attr("id"),
            _csrf: "{$csrfcode}"
        };

        $.post("{$urlNewComment}", param, function(data) {

            if (data.status < 0) {
                alert('评论失败');
            } else {
                location.reload();
            }
        }, "json");
    });

    $('#allcomments').on('click','.delete', function(e){

        var id = $(this).parent().attr('id');
        param = {
            id:id,
            _csrf: "{$csrfcode}"
        };

        $.post("{$urlDeleteComment}", param, function(data) {
            if (data.status < 0) {
                alert('删除评论失败');
            } else {
                location.reload();
            }
        }, "json");
    });

    $('#allcomments').on('click','.activate', function(e){

        var id = $(this).parent().attr('id');
        param = {
            id:id,
            _csrf: "{$csrfcode}"
        };

        $.post("{$urlActivateComment}", param, function(data) {
            if (data.status < 0) {
                alert('删除评论失败');
            } else {
                location.reload();
            }
        }, "json");
    });


JS;

$this->registerJs($js);
?>
