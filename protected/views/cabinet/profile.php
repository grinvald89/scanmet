<?php /* @var $this CabinetController */ ?>

<div class="wrap">
	<div class="profile photo">
		<img src="upload/photo/users/<?php echo $user_id; ?>.jpg" alt="">

		<?php echo CHtml::form('','POST', array('enctype'=>'multipart/form-data')); ?>

		<div class="hidee"> <?php echo CHtml::activeFileField($model_photo, 'file_photo'); ?></div>

		<div class="buttons provider upload">
			<?php echo CHtml::submitButton('upload', array('name'=>'upload', 'class'=>'upload')); ?>
		</div>

		<?php echo CHtml::endForm(); ?>
	</div>

	<div class="profile data">
		<table class="profile">
			<tr>
				<td class="header">Имя: </td>
				<td class="data_input name"><input type="text" value=<?php echo $name; ?>></td>
			</tr>
			<tr>
				<td class="header">Почта: </td>
				<td class="data_input email"><input type="text" value=<?php echo $email; ?>></td>
			</tr>
			<tr>
				<td class="header">Телефон: </td>
				<td class="data_input phone"><input type="text" value=<?php echo $phone; ?>></td>
			</tr>
			<tr>
				<td class="header">Компания: </td>
				<td class="data_input company"><input type="text" value=<?php echo $company; ?>></td>
			</tr>
		</table>

		<div class="buttons"><div class="profile button admin" ng-click="saveProfile()">Сохранить изменения</div></div>
	</div>
</div>