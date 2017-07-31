<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/10/16
 * Time: 11:55 AM
 */
?>

<div class="blog-item">
    <div class="row">
        <div class="col-xs-12 col-sm-2 text-center">
            <div class="entry-meta">
                <span id="publish_date"><?=substr(date('Y', $post->created_at), 2).'/'.date('m', $post->created_at)?></span>
                <span><i class="fa fa-user"></i> <a href="#"><?=$post->user->username?></a></span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-10 blog-content">
            <h2><?=$post->title?></h2>
            <?=$post->content?>
            <div class="post-tags">
                <strong>Tags:</strong>

                <?php
                    $tags = $post->getTagLinks();
                    foreach($tags as $item){
                        echo ($item .'  ');
                    }
                ?>
            </div>
        </div>
    </div>
</div><!--/.blog-item-->


<div id="allcomments">
    <h1 id="comments_title"><span id='comment_count'></span>Comments</h1>
</div>


<div id="contact-page clearfix">
    <div class="status alert alert-success" style="display: none"></div>
    <div class="message_heading">
        <h4><span class="fa fa-comment"></span>Add Comment</h4>
        <p>Required(*), No HTML code</p>
    </div>

    <?php
        $isGuest = Yii::$app->user->isGuest;
    ?>

    <form role="form" class='contact-form'>
        <div class="row">
            <div class="col-sm-5">
                <div class="form-group">
                    <label>Nickname *</label>
                    <?php
                    if($isGuest) {  ?>
                        <input type='text'  id='author' class='form-control' placeholder='Nickname'>
                    <?php } else { ?>
                        <input type='text'  id='author' class='form-control' placeholder='Nickname' disabled='disabled' value="<?=Yii::$app->user->identity->profile->surname?>">
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label>Email *</label>
                    <?php
                    if($isGuest) {  ?>
                        <input type='text'  id='email' class='form-control' placeholder='Email'>
                    <?php } else { ?>
                        <input type='text'  id='email' class='form-control' placeholder='Email' disabled='disabled' value="<?=Yii::$app->user->identity->email?>">
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label>URL</label>
                    <?php
                    if($isGuest) {  ?>
                        <input type='text'  id='url' class='form-control' placeholder='URL'>
                    <?php } else { ?>
                        <input type='text'  id='url' class='form-control' placeholder='URL' disabled='disabled'>
                    <?php } ?>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="form-group">
                    <label>Content *</label>
                    <?php
                    if($isGuest) {  ?>
                        <textarea  id='content' class='form-control' placeholder='Comment content' rows='8'></textarea>
                    <?php } else { ?>
                        <textarea id='content' class='form-control' placeholder='Comment content' rows='8'></textarea>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <div id="addcomment" class="btn btn-success" > Submit </div>
                </div>
            </div>
        </div>
    </form>
</div><!--/#contact-page-->


<?php
$urlNewComment = Yii::$app->urlManager->createUrl(['blog/default/newcomment']);
$urlModifyComment = Yii::$app->urlManager->createUrl(['blog/default/modifycomment']);
$urlDeleteComment = Yii::$app->urlManager->createUrl(['blog/default/deletecomment']);

$csrfcode = Yii::$app->request->getCsrfToken();
$urlComment = Yii::$app->urlManager->createUrl(['blog/default/comment']);


$this->registerJs('
    var urlNewComment = "' . $urlNewComment . '";
    var csrfcode = "'. $csrfcode .'";
    var postid = "'. $post->id .'";
');


$js = <<<JS

    $.ajax({
        url: "{$urlComment}?postid=" + postid + "&userid=",
        type: "GET",
        dataType: "html",
        success: function(data){
            $('#allcomments').html(data);
            //$('#comment_count').text(count(data));
        }
    }).fail(function(){
            alert("Error");
    });

    $('#allcomments').on('click','.delete', function(e){

        var id = $(this).parent().attr('id');
        param = {
            id:id,
            _csrf: csrfcode
        };

        $.post("{$urlDeleteComment}", param, function(data) {
            if (data.status < 0) {
                alert('删除评论失败');
            } else {
                location.reload();
            }
        }, "json");
    });


    $('#allcomments').on('click','.modify', function(e){

       $('#content').val($(this).parent().children('#comment_content').text());

       $('#content').attr('commentid', $(this).parent().attr('id'));

        //scroll down
       $('html, body').animate(
        {
            scrollTop: $("#content").offset().top
        }, 2000);

       //stay focus
       var input_content = document.getElementById('content');
       if(input_content){
        input_content.focus();
        input_content.setSelectionRange(0,0);
       }
    });


    $('#allcomments').on('click','.reply', function(e){
       var author = "  //@" + $(this).parent().children('#comment_author').text();
       var content = ":" + $(this).parent().children('#comment_content').text();
       $('#content').val(author + content);

       $('html, body').animate(
        {
            scrollTop: $("#content").offset().top
        }, 2000);


       var input_content = document.getElementById('content');
       if(input_content){
        input_content.focus();
        input_content.setSelectionRange(0,0);
       }
    });


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


    $("#addcomment").click(function(e){
    param = {
        author:$('#author').val(),
        email:$('#email').val(),
        content:$(this).parent().parent().find('#content').val(),
        commentid:$(this).parent().parent().find('#content').attr("commentid"),
        url:$('#url').val(),
        postid:postid,
        _csrf: csrfcode
    };

    $.post("{$urlNewComment}", param, function(data) {

        if (data.status < 0) {
            alert('评论失败');
        } else {
            location.reload();
        }
    }, "json");
});
JS;

$this->registerJs($js);
?>