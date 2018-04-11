<?php
    $this->beginContent('@frontend/web/template/quickfood/layouts/main.php');
    $this->registerCssFile("/quickfood/assets/css/admin.css");
    $this->registerCssFile("/quickfood/assets/css/bootstrap3-wysihtml5.min.css");
    $this->registerCssFile("/quickfood/assets/css/dropzone.css");
    $this->registerJsFile("/quickfood/assets/js/tabs.js");
    $this->registerJsFile("/quickfood/assets/js/bootstrap3-wysihtml5.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
    
    $js = <<<JS
	new CBPFWTabs(document.getElementById('tabs'));
    $('.wysihtml5').wysihtml5({});
JS;

    $this->registerJs($js);    
    echo \frontend\web\template\quickfood\widgets\BreadcrumbsEx::widget();
?>

<div class="container margin_60">
    <div class="row">
        <div id="tabs" class="tabs">
			<nav>
				<ul>
					<!--li class="tab-current" id="tab-setting">
                        <a href="#section-1" class="icon-profile"><span>Main info</span>
                        </a>
					</li-->
					<li  class="tab-current"><a href="#section-3" class="icon-settings"><span>Settings</span></a>
					</li>
					<li id="tab-orders">
                        <a href="#section-2" class="icon-menut-items"><span>Orders</span>
                        </a>
					</li>
				</ul>
			</nav>
    
			<div class="content">
                <?=$content?>
			</div><!-- End content -->
		</div>
    </div>
</div>        
<?php
    $this->endContent();
?>