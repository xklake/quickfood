<?php
/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 6/10/16
 * Time: 2:27 PM
 */
$this->beginContent('@frontend/web/template/quickfood/layouts/column3.php');
?>

<?=$content?>


<?php
    $this->endContent();
?>

<script>

$('#cat_nav a[href^="#"]').on('click', function (e) {
			e.preventDefault();
			var target = this.hash;
			var $target = $(target);
			$('html, body').stop().animate({
				'scrollTop': $target.offset().top - 70
			}, 900, 'swing', function () {
				window.location.hash = target;
			});
		});
</script>
