<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Profile;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->registerCssFile('', ['depends' => \frontend\assets\UikitAsset::className()]);
$this->title = Yii::t('app', 'My Profile');
$this->params['breadcrumbs'][] = $this->title;
?>



<div class='uk-width-1-1'>
    <div class="uk-panel uk-panel-box uk-width-1-1  uk-margin-bottom  uk-clearfix">
        <div><span class='uk-text-large'><?= $this->title ?></span></div>

        <div class='uk-grid-divider'></div>

        <div class='uk-form-row'>
            <div class='uk-panel uk-panel-box uk-panel-box-secondary'>
            <?php $form = ActiveForm::begin(['id' => '']); ?>
            <?= Html::activeHiddenInput($model, 'user_id', ['value' => Yii::$app->user->id]) ?>
                <div class='uk-form'>
                    <div class='uk-form-row uk-text-muted'>
                        <label>帐号:</label>
                        <span class='uk-margin-left'> 
                            <?= Yii::$app->user->identity->username ?>
                        </span>
                    </div>

                    <div class='uk-form-row uk-text-muted'>
                        <label>邮箱:</label>
                        <span class='uk-margin-left'>
                            <?= Yii::$app->user->identity->email ?>
                        </span>
                    </div>

                    <div class='uk-form-row uk-margin-top uk-text-muted'>
                        <label>昵称:</label>
                        <span class='uk-margin-left'> 
                            <?= Html::activeTextInput($model, 'surname', ['class' => 'txt']) ?>
                        </span>
                    </div>

                     <div class='uk-form-row uk-margin-top uk-text-muted'>
                        <label>性别:</label>
                        <span class='uk-margin-left'> 
                            <?= Html::activeRadioList($model, 'sex', [1 => '男', 2 => '女'], ['tag' => 'span']) ?>
                        </span>
                    </div>
                    
                     <div class='uk-form-row uk-margin-top uk-text-muted'>
                        <label>生日:</label>
                        <span class='uk-margin-left'>
                            <?= Html::activeDropDownList($model, 'year', Profile::getYears(), ['prompt' => '--年--']) ?>
                            <?= Html::activeDropDownList($model, 'month', Profile::getMonths(), ['prompt' => '--月--']) ?>
                            <?= Html::activeDropDownList($model, 'day', Profile::getDays(), ['prompt' => '--日--']) ?>
                        </span>
                     </div>

                     <!--div class='uk-form-row uk-margin-top uk-text-muted'>
                        <label>所在地区</label>

                        <span class='uk-margin-left'>
                        <?php
                         echo Html::activeDropDownList($model, 'country', ArrayHelper::map(\common\models\Region::find()->where(['parent_id' => 0])->all(), 'id', 'name'), [
                            'prompt'=> Yii::t('app','Please Select'),
                            'onchange'=> '
                            $.post( "'.Yii::$app->urlManager->createUrl('region/ajax-list-child?id=').'"+$(this).val(), function( data ) {
                              $( "select#profile-province" ).html( data );
                            });',
                        ]);
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo Html::activeDropDownList($model, 'province',
                            $model->province ? ArrayHelper::map(\common\models\Region::find()->where(['parent_id' => $model->country])->all(), 'id', 'name') : ['' => Yii::t('app', 'Please Select')],
                            [
                                'onchange'=> '
                            $.post( "'.Yii::$app->urlManager->createUrl('region/ajax-list-child?id=').'"+$(this).val(), function( data ) {
                              $( "select#profile-city" ).html( data );
                            });'
                            ]);
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo Html::activeDropDownList($model, 'city',
                            $model->city ? ArrayHelper::map(\common\models\Region::find()->where(['parent_id' => $model->province])->all(), 'id', 'name') : ['' => Yii::t('app', 'Please Select')],
                            [
                                'onchange'=> '
                            $.post( "'.Yii::$app->urlManager->createUrl('region/ajax-list-child?id=').'"+$(this).val(), function( data ) {
                              $( "select#profile-district" ).html( data );
                            });'
                            ]);
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo Html::activeDropDownList($model, 'district', $model->district ? ArrayHelper::map(\common\models\Region::find()->where(['parent_id' => $model->city])->all(), 'id', 'name') : ['' => Yii::t('app', 'Please Select')]);
                       ?>
                    </span>
                    </div-->
                    
                    <div class='uk-form-row uk-margin-large-top uk-text-muted'>
                        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'uk-button uk-button-danger  uk-button-small',]) ?>
                        <!--a href="<?= Yii::$app->urlManager->createUrl('/cart') ?>" hidefocus="true" class="uk-button-danger uk-button uk-margin-large-left">取 消</a--> 
                        <a href="<?= Yii::$app->request->referrer ?>" hidefocus="true" class="uk-button uk-button-primary uk-margin-left  uk-button-small">返 回</a>
                    </div>                                          

                </div>
            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>