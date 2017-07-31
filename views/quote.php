<?php
use yii\helpers\Html;

$service = [
    'Certified Translation'=>'Certified Translation', 
    'Document Translation' => 'Document Translation',
    'Transcription' => 'Transcription ', 
    'Proofreading and Editing' => 'Proofreading and Editing', 
    'Interpretation' => 'Interpretation'];
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/10/16
 * Time: 2:18 PM
 */
?>

<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle">FREE ONLINE QUOTATION</h2>
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div>
                    <?php  
                        $quote_intro = Yii::$app->getTextBlock( 'quote-intro');
                        if($quote_intro != null)
                        {
                            echo($quote_intro->content);
                        }
                    ?>
                </div>
                
                <?php 
                    $quote_desc = Yii::$app->getTextBlock('quote_desc');
                    if($quote_desc != null){
                ?>
                    <br/>
                    <div>
                        <strong><?=$quote_desc->content?></strong>
                    </div>
                    <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?php $form = yii\widgets\ActiveForm::begin(['id' => 'quote-form', 'options' => ['enctype'=>'multipart/form-data']]); ?>
                    <h3>Quotation Form</h3>
                    <div class="form-group">
                        Name:<?= Html::activeTextInput($model, 'name', ['class' => 'form-control', 'placeholder' => ""]) ?>
                    </div>
                    <br/>
                    <div class="form-group">
                        Phone
                        <?= Html::activeTextInput($model, 'phone', ['class' => 'form-control', 'placeholder' => ""]) ?>
                    </div>
                    
                    <br/>
                    <div class="form-group">
                        Email
                        <?= Html::activeTextInput($model, 'email', ['class' => 'form-control', 'placeholder' => ""]) ?>
                    </div>
                    <br/>
               
                    <div class="form-group">
                        Source Language
                        <?= Html::activeTextInput($model, 'from', ['class' => 'form-control', 'placeholder' => ""]) ?>
                    </div>
                    <br/>
                    
                    <div class="form-group">
                        Target Language
                        <?= Html::activeTextInput($model, 'to', ['class' => 'form-control', 'placeholder' => ""]) ?>
                    </div>
                    <br/>
                    
                    <div class="form-group">
                        Service
                        <?= Html::activeDropDownList($model, 'service', $service, ['class' => 'form-control', 'placeholder' => ""]) ?>
                    </div>
                    <br/>
                    
                    <div class="form-group">
                        Delivery Date(YYYY-MM-DD)
                        <?= Html::activeTextInput($model, 'deliverydate', ['class' => 'form-control', 'placeholder' => ""]) ?>
                    </div>
                    <br/>

                    <div class="form-group">
                        File (Please attach the document to be translated, or a sample of the document plus the estimated word count for the project)
                        <?= Html::activeFileInput($model, 'attachment', ['class' => 'form-control']) ?>
                    </div>
                    <br/>

                    <div class="form-group">
                        Describe Request
                        <?= Html::activeTextarea($model, 'body', ['class' => 'form-control', 'placeholder' => "", 'rows'=>5]) ?>
                    </div>
                    <br/>

                    <div class="form-group" style="color:#F00">
                        <em>
                            <?= Yii::$app->session->getFlash('success') ?>
                        </em>
                    </div>
                    
                    <div class="form-group">
                        <?= Html::submitButton( Yii::t('app', 'Submit Quotation Request'), ['class' => 'btn btn-primary', 'name' => 'quote-button']) ?>
                    </div>
                <?php yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
