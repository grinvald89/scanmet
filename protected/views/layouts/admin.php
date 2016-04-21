<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-3.3.2-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />

	<?php
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-2.2.0.min.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/css/bootstrap-3.3.2-dist/js/bootstrap.min.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile('//ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/app.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/controllers/AdminController.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/services/CreateMenuService.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/directives/pagination.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/main.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.tinycarousel.js', CClientScript::POS_END);
	?>
</head>

<body ng-app="app" ng-controller="AdminController">
	<div class="contaner" id="page">
		<div class="wrap container">
			<ul class="nav nav-pills">
				<li role="presentation"><a href="/">На сайт</a></li>
			  <li role="presentation" class="dropdown">
			    <a class="dropdown-toggle" data-toggle="dropdown"role="button" aria-haspopup="true" aria-expanded="false">
			      Категории <span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu">
			    	<li role="presentation"><a href="/admin/categories">Категории</a></li>
			    	<li role="presentation"><a href="/admin/subCategories">Подкатегории</a></li>
			    	<li role="presentation"><a href="/admin/requestsCategories">Заявки на категории</a></li>
			    </ul>
			  </li>

			  <li role="presentation" class="dropdown">
			     <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			       Товары <span class="caret"></span>
			     </a>
			     <ul class="dropdown-menu">
			       <li role="presentation"><a href="/admin/goods">Опубликованные товары</a></li>
			       <li role="presentation"><a href="/admin/requestsGoods">Заявки на товары</a></li>
			     </ul>
			   </li>

			   <li role="presentation" class="dropdown">
			      <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			        Пользователи <span class="caret"></span>
			      </a>
			      <ul class="dropdown-menu">
			        <li role="presentation"><a href="/admin/users">Зарегистрированные пользователи</a></li>
			        <li role="presentation"><a href="/admin/requestsRegistration">Заявки на регистрацию</a></li>
			      </ul>
			    </li>

			    <li role="presentation" class="dropdown">
			       <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			         Настройки <span class="caret"></span>
			       </a>
			       <ul class="dropdown-menu">
			         <li role="presentation"><a href="/admin/types">Редактор типов</a></li>
			         <li role="presentation"><a href="/admin/about">Редактор раздела "О портале"</a></li>
			         <li role="presentation"><a  ng-click="createMenu()">Сгенерировать меню</a></li>
			       </ul>
			     </li>

			     <li role="presentation"><a href="/admin/news">Новости</a></li>
			</ul>
			<?php echo $content; ?>
		</div>
		<div class="clear"></div>
	</div><!-- page -->

</body>
</html>
