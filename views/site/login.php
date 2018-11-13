<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

//$this->registerCssFile('@web/css/login.css', ['depends' => [\frontend\assets\UikitAsset::className(), \yii\authclient\widgets\AuthChoiceAsset::className()]]);

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container">
    <div class="row" style="margin-top:100px; margin-bottom: 100px;">
        <div class="col-md-4 col-md-offset-4 col-xs-12 col-sm-8 col-md-offset-4 col-sm-offset-2">
            <div class="" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
                    <div class="modal-content modal-popup">
                        <?php $form = ActiveForm::begin(['id' => 'myLogin', 'options' => ['class'=> 'popup-form']]); ?>
                            <div class="login_icon"><i class="icon_lock_alt"></i></div>
                            <?= Html::activeTextInput($model, 'username', ['class' => 'form-control form-white', 'placeholder' => "Username"]) ?>

                            <?= Html::activePasswordInput($model, 'password', ['class' => 'form-control form-white', 'placeholder' => "Password"]) ?>
                            <div class="text-left">
                                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['site/requestpasswordreset'])?>">Forgot Password?</a>  
                                <?= Html::activeCheckbox($model, 'rememberMe', []) ?>
                            </div>

                            <?= $form->field($model, 'verifyCode', ['options'=>['class'=>''], ])->label(false)->widget(\yii\captcha\Captcha::className(),
                                [
                                    'captchaAction'=>'site/captcha',
                                    'template' => '<div style="margin-bottom:3px;margin-right:0px;padding:0px;margin-left:0px;text-align:left;">{image}{input}</div>',
                                    'options' => ['class'=>'','style'=>'display:inline;'],
                                    'imageOptions' => [
                                        'title'=>'Regenerate', 'alt'=>'Regenerate',
                                        'style'=>'cursor:pointer;margin-right:10px;'
                                    ]
                                ])
                            ?>
                            
                            <?php if($error){ ?>
                                <p style="color:#a94442"><?=$error?></p>
                            <?php } ?>
                                
                            <?= Html::submitButton( Yii::t('app', 'Login'), ['class' => 'btn btn-submit', 'name' => 'login-button']) ?>
                            <?= Html::a(Yii::t('app', 'Sign Up'),Yii::$app->urlManager->createAbsoluteUrl(['site/signup']), ['class' =>'btn btn-submit']) ?>
                        <!--/form-->
                        <?php ActiveForm::end(); ?>
                    </div>
            </div><!-- End modal -->   
        </div>
    </div>
</div>


<?php
$js = <<<JS
jQuery('.weixin-mp').parent().hide();

JS;

$this->registerJs($js);