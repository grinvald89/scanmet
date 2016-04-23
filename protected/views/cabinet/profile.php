<?php /* @var $this CabinetController */ ?>

<div class="wrap">
	<div class="profile photo"><!-- Загрузчики изображений (BEGIN) -->
		<div class="logo uploaderBlock">
			<?php if(file_exists('upload/photo/users/'.$user_id.'.jpg')){ ?>
				<?php echo '<img src="upload/photo/users/'.$user_id.'.jpg" alt="">';} ?>
			<?php echo CHtml::form('','POST', array('enctype'=>'multipart/form-data')); ?>
			<div class="uploader logo">
				<?php echo CHtml::activeFileField($model_photo, 'file_photo'); ?>
				<button type="button" class="btn btn-success logo">Загрузить  логотип</button>
				<?php echo CHtml::submitButton('upload', array('name'=>'upload_logo', 'class'=>'hide upload')); ?>
			</div>
			<?php echo CHtml::endForm(); ?>
		</div>

		<div class="img1 uploaderBlock">
			<?php if(file_exists('upload/photo/users/'.$user_id.'_1.jpg')){ ?>
				<?php echo '<img src="upload/photo/users/'.$user_id.'_1.jpg" alt="">';} ?>
			<?php echo CHtml::form('','POST', array('enctype'=>'multipart/form-data')); ?>
			<div class="uploader img1">
				<?php echo CHtml::activeFileField($model_photo, 'file_photo'); ?>
				<!-- Если файл уже есть меняем кнопку -->
				<?php if(file_exists('upload/photo/users/'.$user_id.'_1.jpg')){ echo '<button type="button" class="btn btn-success img1">Загрузить  фото</button>'; }
							else echo '<button type="button" class="btn btn-success img1">Добавить  фото</button>'; ?>
				<?php echo CHtml::submitButton('upload', array('name'=>'upload_img1', 'class'=>'hide upload')); ?>
			</div>
			<?php echo CHtml::endForm(); ?>
		</div>

		<div class="img2 uploaderBlock">
			<?php if(file_exists('upload/photo/users/'.$user_id.'_2.jpg')){ ?>
				<?php echo '<img src="upload/photo/users/'.$user_id.'_2.jpg" alt="">';} ?>
			<?php echo CHtml::form('','POST', array('enctype'=>'multipart/form-data')); ?>
			<div class="uploader img2">
				<?php echo CHtml::activeFileField($model_photo, 'file_photo'); ?>
				<!-- Если файл уже есть меняем кнопку -->
				<?php if(file_exists('upload/photo/users/'.$user_id.'_2.jpg')){ echo '<button type="button" class="btn btn-success img2">Загрузить  фото</button>'; }
							else echo '<button type="button" class="btn btn-success img2">Добавить  фото</button>'; ?>
				<?php echo CHtml::submitButton('upload', array('name'=>'upload_img2', 'class'=>'hide upload')); ?>
			</div>
			<?php echo CHtml::endForm(); ?>
		</div>

		<div class="img3 uploaderBlock">
			<?php if(file_exists('upload/photo/users/'.$user_id.'_3.jpg')){ ?>
				<?php echo '<img src="upload/photo/users/'.$user_id.'_3.jpg" alt="">';} ?>
			<?php echo CHtml::form('','POST', array('enctype'=>'multipart/form-data')); ?>
			<div class="uploader img3">
				<?php echo CHtml::activeFileField($model_photo, 'file_photo'); ?>
				<!-- Если файл уже есть меняем кнопку -->
				<?php if(file_exists('upload/photo/users/'.$user_id.'_3.jpg')){ echo '<button type="button" class="btn btn-success img3">Загрузить  фото</button>'; }
							else echo '<button type="button" class="btn btn-success img3">Добавить  фото</button>'; ?>
				<?php echo CHtml::submitButton('upload', array('name'=>'upload_img3', 'class'=>'hide upload')); ?>
			</div>
			<?php echo CHtml::endForm(); ?>
		</div>

		<div class="img4 uploaderBlock">
			<?php if(file_exists('upload/photo/users/'.$user_id.'_4.jpg')){ ?>
				<?php echo '<img src="upload/photo/users/'.$user_id.'_4.jpg" alt="">';} ?>
			<?php echo CHtml::form('','POST', array('enctype'=>'multipart/form-data')); ?>
			<div class="uploader img4">
				<?php echo CHtml::activeFileField($model_photo, 'file_photo'); ?>
				<!-- Если файл уже есть меняем кнопку -->
				<?php if(file_exists('upload/photo/users/'.$user_id.'_4.jpg')){ echo '<button type="button" class="btn btn-success img4">Загрузить  фото</button>'; }
							else echo '<button type="button" class="btn btn-success img4">Добавить  фото</button>'; ?>
				<?php echo CHtml::submitButton('upload', array('name'=>'upload_img4', 'class'=>'hide upload')); ?>
			</div>
			<?php echo CHtml::endForm(); ?>
		</div>

		<div class="img5 uploaderBlock">
			<?php if(file_exists('upload/photo/users/'.$user_id.'_5.jpg')){ ?>
				<?php echo '<img src="upload/photo/users/'.$user_id.'_5.jpg" alt="">';} ?>
			<?php echo CHtml::form('','POST', array('enctype'=>'multipart/form-data')); ?>
			<div class="uploader img5">
				<?php echo CHtml::activeFileField($model_photo, 'file_photo'); ?>
				<!-- Если файл уже есть меняем кнопку -->
				<?php if(file_exists('upload/photo/users/'.$user_id.'_5.jpg')){ echo '<button type="button" class="btn btn-success img5">Загрузить  фото</button>'; }
							else echo '<button type="button" class="btn btn-success img5">Добавить  фото</button>'; ?>
				<?php echo CHtml::submitButton('upload', array('name'=>'upload_img5', 'class'=>'hide upload')); ?>
			</div>
			<?php echo CHtml::endForm(); ?>
		</div>

	</div><!-- Загрузчики изображений (END) -->

	<div class="profile data">
		<div class="block">
			<div class="left">
				<div class="header">Контактное лицо: </div>
			</div>
			<div class="right">
				<input class="data_input form-control name" type="text" value=<?php echo $name; ?>>
			</div>
		</div>

		<div class="block">
			<div class="left">
				<div class="header">E-mail: </div>
			</div>
			<div class="right">
				<input class="data_input form-control email" type="text" value=<?php echo $email; ?>>
			</div>
		</div>

		<div class="block">
			<div class="left">
				<div class="header">Телефон: </div>
			</div>
			<div class="right">
				<input class="data_input form-control phone" type="text" value=<?php echo $phone; ?>>
			</div>
		</div>

		<div class="block">
			<div class="left">
				<div class="header">Компания: </div>
			</div>
			<div class="right">
				<input class="data_input form-control company" type="text" value=<?php echo $company; ?>>
			</div>
		</div>

		<div class="block"><div class="header">Специализация: </div></div>

		<div class="block">
			<div class="left"><input class="data_input form-control spec spec1" type="text" maxlength="50" value=<?php echo $spec1; ?>></div>
			<div class="right"><p class="info"> - *Укажите какую продукцию реализует ваша компания (например "Арматура") не более 50 символов!</p></div>
		</div>
		<div class="block">
			<div class="left"><input class="data_input form-control spec spec2" type="text" maxlength="50" value=<?php echo $spec2; ?>></div>
			<div class="right"><p class="info"> - *Укажите какую продукцию реализует ваша компания (например "Арматура") не более 50 символов!</p></div>
		</div>
		<div class="block">
			<div class="left"><input class="data_input form-control spec spec3" type="text" maxlength="50" value=<?php echo $spec3; ?>></div>
			<div class="right"><p class="info"> - *Укажите какую продукцию реализует ваша компания (например "Арматура") не более 50 символов!</p></div>
		</div>
		<div class="block">
			<div class="left"><input class="data_input form-control spec spec4" type="text" maxlength="50" value=<?php echo $spec4; ?>></div>
			<div class="right"><p class="info"> - *Укажите какую продукцию реализует ваша компания (например "Арматура") не более 50 символов!</p></div>
		</div>
		<div class="block">
			<div class="left"><input class="data_input form-control spec spec5" type="text" maxlength="50" value=<?php echo $spec5; ?>></div>
			<div class="right"><p class="info"> - *Укажите какую продукцию реализует ваша компания (например "Арматура") не более 50 символов!</p></div>
		</div>

		<div class="header">Опишите вашу компанию (не более 1000 символов): </div>
		<div class="block"><textarea class="form-control about" rows="5"  maxlength="1000"><?php echo $about;?></textarea></div>

		<button type="button" ng-click="saveProfile()" class="btn btn-success saveProfile">Сохранить изменения</button>
	</div>
</div>