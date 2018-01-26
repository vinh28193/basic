<?php
/* @var $this yii\web\View */
/* @var $files array */
?>
<div class="row">
	<div class="col-md-8">
		<div class="row">
			<?php 
				foreach ($files as $key => $file) {
					 echo $file;
				}
			 ?>
		</div>
	</div>
</div>