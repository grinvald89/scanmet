<?php /* @var $this CabinetController */ ?>

<div class="wrap">

	<?php include_once "menu_provider.php"; ?>

	<a href="/upload/example.xls">Скачать образец</a>

	<br><br>

	<?php echo CHtml::form('','POST', array('enctype'=>'multipart/form-data')); ?>

	<div class="hidee"> <?php echo CHtml::activeFileField($model_excell, 'file_excell'); ?></div>

	<div class="buttons provider upload">
		<?php echo CHtml::submitButton('upload', array('name'=>'upload', 'class'=>'upload')); ?>
	</div>

	<?php echo CHtml::endForm(); ?>

</div>