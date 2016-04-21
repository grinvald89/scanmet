<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SCANMET',
    'language'=>'ru',

    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/yiistrap'), // change this if necessary
    ),

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'bootstrap.helpers.TbHtml',
	),

    'homeUrl'=>array('site/login'),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'12345',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('*.*.*.*','::*'),
            'generatorPaths' => array('bootstrap.gii'),
        ),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'yexcel' => array(
			'class' => 'ext.yexcel.Yexcel'
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
									// 'enablePrettyUrl'=>true,
			            'showScriptName'=>false,
			            // 'enableStrictParsing'=>true,
			'rules'=>array(
   //              // // REST patterns
   //              // array('x_data/list', 'pattern'=>'api/x_data', 'verb'=>'GET'),
								'<controller:\w+>/<id:\d+>' => '<controller>/view',
								'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
								'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),

		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=grinvald9_scanmet',
			'emulatePrepare' => true,
			'username' => 'grinvald9',
			'password' => 'bobahbes2008',
			'charset' => 'utf8',
		),
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
        ),
        'clientScript'=>array(
            'packages'=>array(
                'jquery'=>array(
                    'baseUrl'=>'//ajax.googleapis.com/ajax/libs/jquery/',
                    'js'=>array('1.10.2/jquery.min.js'),
                )
            ),
        ),
        'messages'=>array(
            'class'=>'PhpMessageSource',
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'',
	),
);