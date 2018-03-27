<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
$this->registerCssFile('', ['depends' => \frontend\assets\UikitAsset::className()]);
$this->title = 'Order Address';
?>

<div id="main" class='uk-grid uk-grid-margin'>
    <div class='uk-form uk-width-1-1 uk-text-muted'>

       
        <div class='uk-form-row'>
            <div class='uk-panel uk-panel-box uk-panel-box-secondary'>
            <?php $form = ActiveForm::begin(['id' => '']); ?>

                <div class='uk-form'>
                    <div class='uk-form-row'>
                        <span class='uk-text-large uk-text-muted'>
                            确认收货人信息
                        </span>
                    </div>

                    <div class='uk-form-row'>
                        <span class='uk-text-muted'>
                            请填写你的第一个地址！商城会对您填写的内容进行加密，以保障您个人信息的安全
                        </span>
                    </div>

                    <div class='uk-form-row uk-margin-top uk-text-muted'>
                        地址标注<?= Html::activeTextInput($model, 'name', ['class' => 'uk-form-success uk-margin-large-left uk-form-small']) ?>
                    </div>

                     <div class='uk-form-row uk-margin-top uk-text-muted'>
                        收货姓名<?= Html::activeTextInput($model, 'consignee', ['class' => 'uk-form-success uk-margin-large-left uk-form-small']) ?>
                    </div>
                    

                     <div class='uk-form-row uk-margin-top uk-text-muted'>
                        所在地区

                        <?php
                        echo Html::activeDropDownList($model, 'country', ArrayHelper::map(\common\models\Region::find()->where(['parent_id' => 0])->all(), 'id', 'name'), [
                                'class'=>' uk-margin-large-left ',
                                'prompt'=> Yii::t('app','Please Select'),
                                'onchange'=> '
                                $.post( "'.Yii::$app->urlManager->createAbsoluteUrl('region/ajax-list-child').'?id="+$(this).val(), function( data ) {
                                  $( "select#address-province" ).html( data );
                                });',
                            ]);
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo Html::activeDropDownList($model, 'province',
                            $model->province ? ArrayHelper::map(\common\models\Region::find()->where(['parent_id' => $model->country])->all(), 'id', 'name') : ['' => Yii::t('app', 'Please Select')],
                            [
                                'onchange'=> '
                                $.post( "'.Yii::$app->urlManager->createAbsoluteUrl('region/ajax-list-child').'?id="+$(this).val(), function( data ) {
                                  $( "select#address-city" ).html( data );
                                });', 
                                'class' => 'uk-form-controls'
                            ]);
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo Html::activeDropDownList($model, 'city',
                            $model->city ? ArrayHelper::map(\common\models\Region::find()->where(['parent_id' => $model->province])->all(), 'id', 'name') : ['' => Yii::t('app', 'Please Select')],
                            [
                                'onchange'=> '
                                $.post( "'.Yii::$app->urlManager->createAbsoluteUrl('region/ajax-list-child').'?id="+$(this).val(), function( data ) {
                                  $( "select#address-district" ).html( data );
                                });'
                            ]);
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                        echo Html::activeDropDownList($model, 'district', $model->district ? ArrayHelper::map(\common\models\Region::find()->where(['parent_id' => $model->city])->all(), 'id', 'name') : ['' => Yii::t('app', 'Please Select')]);
                        ?>

                        <!--?= Html::activeTextInput($model, 'address', ['class' => 'uk-form-success uk-margin-large-left uk-form-small']) ?-->
                    </div>
                    
                    <div class='uk-form-row uk-margin-top uk-text-muted'>
                        街道地址<?= Html::activeTextInput($model, 'address', ['class' => 'uk-form-success uk-margin-large-left uk-form-small']) ?>
                    </div>

                    <div class='uk-form-row uk-margin-top uk-text-muted'>
                        地址邮编<?= Html::activeTextInput($model, 'zipcode', ['class' => 'uk-form-success uk-margin-large-left uk-form-small']) ?>
                    </div>

                    <div class='uk-form-row uk-margin-top uk-text-muted'>
                        联系电话<?= Html::activeTextInput($model, 'mobile', ['class' => 'uk-form-success uk-margin-large-left uk-form-small']) ?>
                    </div>

                    <div class='uk-form-row uk-margin-large-top uk-text-muted'>
                        <?= Html::submitButton(Yii::t('app', '提交'), ['class' => 'uk-button uk-button-success',]) ?>
                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/cart') ?>" hidefocus="true" class="uk-button-danger uk-button uk-margin-large-left">取 消</a>
                    </div>                                          

                </div>
            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

