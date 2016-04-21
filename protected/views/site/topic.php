<div class="bgContent">
	<div class="container">
		<div class="row topics panel panel-primary">
			<div class="topic">
				<div class="col-md-12">
					<div class="header"><?php echo $topic->header; ?></div>
					<div class="text"><?php echo $topic->text; ?></div>
					<div class="author"><?php echo 'Автор: '.$topic->user_name.'('.$topic->user_role.')'; ?></div>
					<div class="date"><?php echo $topic->date; ?></div>
				</div>
			</div>
		</div>

		<div class="row topics one">
			<?php foreach ($comments as $comment){ ?>
				<div class="topic">
					<div class="col-md-12">
						<div class="text"><?php echo $comment->text; ?></div>
						<div class="author"><?php echo 'Автор: '.$comment->user_name.'('.$comment->user_role.')'; ?></div>
						<div class="date"><?php echo $comment->date; ?></div>
					</div>
				</div>
			<?php }?>
		</div>


		<div class="row">
			<div class="form-horizontal"><?php echo CHtml::beginForm(); ?><!-- Создаем топик (BEGIN) -->
			  <div class="form-group">
			    <label class="col-sm-2 control-label">Комментарий</label>
			    <div class="col-sm-10">
			    	<?php echo CHtml::activeTextArea($model,'text',array('class'=>'form-control', 'rows'=>'5')); ?>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <?php if(Yii::app()->session['user_id'])
			      				echo CHtml::submitButton('Добавить комментарий', array('class'=>'btn btn-default', 'name'=>'newComment'));
			      			else echo "Для добавления комментариев необходима авторизация!";?>
			    </div>
			  </div>
			<?php echo CHtml::endForm(); ?></div><!-- Создаем топик (END) -->
		</div>
	</div>
</div>