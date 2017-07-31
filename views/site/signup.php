<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->registerCssFile('', ['depends' => \frontend\assets\UikitAsset::className()]);

$this->title = Yii::t('app', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>


<div id='main' class='uk-grid uk-grid-margin'>
    <div class="uk-vertical-align uk-text-center uk-height-1-1 uk-container-center">
        <div class="uk-vertical-align-middle uk-align-center uk-margin-large-top" style="width: 260px;">
            <?php $form = ActiveForm::begin(['id' => 'login-nala-form', 'options' => ['class'=> 'uk-panel uk-panel-box uk-form']]); ?>
                <div class='uk-form-row'>
                    <span class='uk-text-primary uk-text-large uk-text-center'> 账号注册
                    </span>
                </div>

                <div class='uk-form-row'>
                    <i class='uk-icon-justify uk-icon-user uk-icon-small uk-text-muted uk-margin-small-right'></i><?= Html::activeTextInput($model, 'username', ['class' => 'text', 'placeholder' => "用户名"]) ?>
                </div>    

                <div class="uk-form-row">
                    <i class='uk-icon-justify uk-icon-envelope uk-icon-small uk-text-muted uk-margin-small-right'></i><?= Html::activeTextInput($model, 'email', ['class' => 'text', 'placeholder' => "邮箱"]) ?>
                </div>

                <div class="uk-form-row">
                    <i class='uk-icon-justify uk-icon-lock uk-icon-small uk-text-muted uk-margin-small-right'></i><?= Html::activePasswordInput($model, 'password', ['class' => 'text', 'placeholder' => "密码"]) ?>
                </div>

                <?php if (Yii::$app->request->get('code') && $recommend = \common\models\User::findOne(\common\components\CommonHelper::decode(Yii::$app->request->get('code')))) { ?>
                    <div class="uk-form-row">
                        <i class='uk-icon-justify uk-icon-thumbs-up uk-icon-small uk-text-muted uk-margin-small-right'></i><?= Html::activeHiddenInput($model, 'recommendedName', ['value' => $recommend->username]); ?>
                    </div>
                <?php } else { ?>
                    <div class="uk-form-row">
                        <i class='uk-icon-justify uk-icon-thumbs-up uk-icon-small uk-text-muted uk-margin-small-right'></i><?= Html::activeTextInput($model, 'recommendedName', ['class' => 'text', 'placeholder' => "推荐人"]) ?>
                    </div>
                <?php } ?>            

                <div class='uk-form-row'>
                    <label>
                        <input type="checkbox" checked="checked" name="accept_lizi_law" tabindex="5">
                        我已阅读并接受<a href="#" target="_blank">《商城服务协议》</a> 
                    </label>
                </div>

                <div class="uk-form-row">
                    <?= Html::submitButton( Yii::t('app', 'Signup'), ['class' => 'uk-button uk-button-danger', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>



<!--div id="main" class="cle">
    <div class="box-pic" id="login-pic">
        <div class="img">
            <img src="/images/login-box-bg.jpg" width="500" height="450" /> </div>
    </div>
    <div class="g_box">
        <div id="login-box">
            <h2>
                <div class="trig">没有帐号？<a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>" class="trigger-box">点击登录</a></div>
                注册
            </h2>
            <div class="form-bd-signup">
                <div class="form_box cle"  id="login-nala">
                    <div class="login_box">
                        <?php $form = ActiveForm::begin(['id' => 'login-nala-form']); ?>
                        <ul class="form">
                            <li class="text_input"><span class="error_icon"></span><span class="iconfont glyphicon glyphicon-user"></span>
                                <?= Html::activeTextInput($model, 'username', ['class' => 'text', 'placeholder' => "用户名"]) ?>
                            </li>
                            <li class="text_input"><span class="error_icon"></span><span class="iconfont glyphicon glyphicon-envelope"></span>
                                <?= Html::activeTextInput($model, 'email', ['class' => 'text', 'placeholder' => "邮箱"]) ?>
                            </li>
                            <li class="text_input"><span class="error_icon"></span><span class="iconfont glyphicon glyphicon-lock"></span>
                                <?= Html::activePasswordInput($model, 'password', ['class' => 'text', 'placeholder' => "密码"]) ?>
                            </li>
                            <?php if (Yii::$app->request->get('code') && $recommend = \common\models\User::findOne(\common\components\CommonHelper::decode(Yii::$app->request->get('code')))) { ?>
                                <?= Html::activeHiddenInput($model, 'recommendedName', ['value' => $recommend->username]); ?>
                            <?php } else { ?>
                            <li class="text_input"><span class="error_icon"></span><span class="iconfont glyphicon glyphicon-thumbs-up"></span>
                                <?= Html::activeTextInput($model, 'recommendedName', ['class' => 'text', 'placeholder' => "推荐人"]) ?>
                            </li>
                            <?php } ?>
                            <div class="error_box" style="color:#F00"><em><?= Html::error($model, 'username'); ?><?= Html::error($model, 'email'); ?><?= Html::error($model, 'password'); ?></em></div>
                            <li class="lizi_law">
                                <label>
                                    <input type="checkbox" checked="checked" name="accept_lizi_law" tabindex="5">
                                    我已阅读并接受<a href="#" target="_blank">《商城服务协议》</a> </label>
                            </li>
                            <li class="last">
                                <?= Html::submitButton( Yii::t('app', 'Signup'), ['class' => 'btn', 'name' => 'login-button']) ?>
                            </li>
                        </ul>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <!--ul class="form other-form">
                <li>
                    <h5>使用第三方帐号登录</h5>
                </li>
                <li class="other-login"> <a class="sina" target="_blank" href="https://api.weibo.com/oauth2/authorize?client_id=1062800511&response_type=code&redirect_uri=http://www.mayicun.com/user/sinaLogin" onClick="ga('send','event','reg','click','sinaReg_');"></a> <a class="qq"  target="_blank" href="https://graph.qq.com/oauth2.0/authorize?response_type=code&amp;client_id=100224827&amp;state=1&amp;redirect_uri=www.mayicun.com/user/qqLoginCallback" onClick="ga('send','event','reg','click','qqReg_');"></a> <a class="alipay" target="_blank"  href="http://www.mayicun.com/user/alipayLogin" onClick="ga('send','event','reg','click','alipayReg_');"></a> <a class="taobao tb-link"target="_blank"  href="http://www.mayicun.com/user/taobaoLogin" onClick="ga('send','event','reg','click','taobaoReg_');"></a> <a class="baidu" target="_blank" href="http://www.mayicun.com/user/baiduLogin?login=baidu" onClick="ga('send','event','reg','click','baiduReg_');"></a> <a class="qihoo360" target="_blank" href="https://openapi.360.cn/oauth2/authorize?client_id=6550d4a07c17ee81e0737a4203d5848c&response_type=code&redirect_uri=http://www.mayicun.com/user/qihooCallBack&scope=basic&display=default" onClick="ga('send','event','reg','click','qihoo360Reg_');"></a> </li>
            </ul-->
        </div>
    </div>
</div-->
