<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="description" content="<?php echo CHtml::encode($this->pageTitle); ?>">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!-- <link href="favicon.ico" rel="icon" type="image/x-icon" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-3.3.2-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
    <?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-2.2.0.min.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/css/bootstrap-3.3.2-dist/js/bootstrap.min.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile('//ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/app.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/controllers/SiteController.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/services/SaveMenuService.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/directives/checkboxes.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/main.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.tinycarousel.js', CClientScript::POS_END);
    ?>
    <base href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>/">
</head>
<body ng-app="app" ng-controller="SiteController">

    <header>
        <div class="headerLayout"><!-- BEGIN .header -->
            <div class="wrap"><!-- BEGIN .wrap -->
                <div class="logo"><img src="images/logo.png" alt="" width="375px"></div>
                <div class="search"><!-- BEGIN .search -->
                    <img src="images/search.png" alt="">
                    <input type="text" placeholder="Поиск товаров в каталоге" ng-model="filter">
                    <div class="button">Поиск</div>
                    <h1>МОНИТОРИНГ ЦЕН СТРОИТЕЛЬНЫХ МАТЕРИАЛОВ</h1>
                </div><!-- END .search -->
                <div class='buttons'><!-- BEGIN .buttons -->
                    <?php if(Yii::app()->session['user_id'] == '')
                    echo 
                    "<div class='enter'>Вход</div>
                    <div class='registration'>Регистрация</div>"; 
                    else echo 
                        "<div>
                    <a href='site/exit'>".Yii::app()->session['login']." (выйти)</a>
                    </div>
                    <div>
                    <a href='/cabinet'>Личный кабинет</a>
                    </div>";?>
                </div><!-- END .buttons -->
            </div><!-- END .wrap -->
        </div><!-- END .header -->

        <div class="bgContent">
            <div class="wrap">
                <ul class="nav_bar">
                    <li><a href="/site/about"><span>О ПОРТАЛЕ</span></a></li>
                    <li><a href="/site/map"><span>КАРТА МЕТАЛЛОБАЗ</span></a></li>
                    <li><a href="/site/providers"><span>ПОСТАВЩИКИ</span></a></li>
                    <li><a href="/site/help"><span>ПОМОЩЬ</span></a></li>
                    <li><a href="/site/news"><span>НОВОСТИ</span></a></li>
                    <li><a href="/site/blacklist"><span>ЧЕРНЫЙ СПИСОК</span></a></li>
                    <li><a href="/site/reviews"><span>ОТЗЫВ О ЦЕНЕ</span></a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="contaner"><?php echo $content; ?></div>

    <div class="footerNav"><!-- BEGIN .footerNav -->
        <div class="wrap">
            <ul class="downNav">
                <li><a href="#">Автоперевозки</a></li>
                <li><a href="#">Автоперевозки</a></li>
                <li><a href="#">Автоперевозки</a></li>
                <li><a href="#">Автоперевозки</a></li>
                <li><a href="#">Металлопрокат</a></li>
                <li><a href="#">Металлопрокат</a></li>
                <li><a href="#">Металлопрокат</a></li>
                <li><a href="#">Металлопрокат</a></li>
                <li><a href="#">Рельсы</a></li>
                <li id="current"><a href="#">Рельсы</a></li>
                <li><a href="#">Рельсы</a></li>
                <li><a href="#">Рельсы</a></li>
            </ul>
        </div>
    </div><!-- END .footerNav -->

    <div class="footerLayout"><!-- BEGIN .footerLayout -->
        <div class="wrap">
            <div class="logo"><img src="images/logo.png" alt="" width="375px"></div>

            <div class="text">МОНИТОРИНГ ЦЕН СТРОИТЕЛЬНЫХ МАТЕРИАЛОВ</div>

            <div class='buttons'><!-- BEGIN .buttons -->
                <?php if(Yii::app()->session['user_id'] == '')
                echo 
                "<div class='enter'>Вход</div>
                <div class='registration'>Регистрация</div>"; 
                else echo 
                    "<div>
                <a href='/site/exit'>".Yii::app()->session['login']." (выйти)</a>
                </div>
                <div>
                <a href='/cabinet'>Личный кабинет</a>
                </div>";?>
            </div><!-- END .buttons -->
        </div>
    </div><!-- END .footerLayout -->
</body>
</html>
