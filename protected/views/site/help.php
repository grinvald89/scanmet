<div class="bgContent">
	<div class="container">
		<div class="row topics">
			<?php foreach ($topics as $topic){ ?>
				<a href="/site/help?topic=<?php echo $topic->id.'&'.$topic->header; ?>">
					<div class="topic">
						<div class="col-md-12">
							<div class="header"><?php echo $topic->header; ?></div>
							<div class="text"><?php echo $topic->text; ?></div>
							<div class="author"><?php echo 'Автор: '.$topic->user_name.'('.$topic->user_role.')'; ?></div>
							<div class="date"><?php echo $topic->date; ?></div>
						</div>
					</div>
				</a>
			<?php }?>
		</div>

		<div class="row">
			<div class="form-horizontal"><?php echo CHtml::beginForm(); ?><!-- Создаем топик (BEGIN) -->
			  <div class="form-group">
			    <label class="col-sm-2 control-label">Заголовок</label>
			    <div class="col-sm-10">
			    	<?php echo CHtml::activeTextField($model,'header', array('class'=>'form-control','name'=>'header')); ?>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-2 control-label">Текст</label>
			    <div class="col-sm-10">
			    	<?php echo CHtml::activeTextArea($model,'text',array('class'=>'form-control', 'rows'=>'6')); ?>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <?php if(Yii::app()->session['user_id'])
			      				echo CHtml::submitButton('Создать топик', array('class'=>'btn btn-default', 'name'=>'newTopic'));
			      			else echo "Для созлания топиков необходима авторизация!";?>
			    </div>
			  </div>
			<?php echo CHtml::endForm(); ?></div><!-- Создаем топик (END) -->
		</div>
	</div>
</div>