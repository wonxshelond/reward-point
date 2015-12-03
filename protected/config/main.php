<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>':: Lumiere Club Lippo Mall Kemang ::',
	'defaultController'=>'app',

    'aliases'=>array(
    	'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'),
    	 'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'),
     ),
	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'bootstrap.helpers.TbHtml',
		'bootstrap.helpers.TbArray',
		'bootstrap.widgets.*',
        'application.extensions.fpdf.*',
        'bootstrap.behaviors.TbWidget',
		'application.components.*',
    
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'master','transaction','report',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'generatorPaths'=>array('bootstrap.gii'),
			'password'=>false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('app/login'),
		),
		
		'bootstrap'=>array(  
			'class'=>'bootstrap.components.TbApi',
		),
		'yiiwheels'=>array(  
			'class'=>'yiiwheels.YiiWheels',
		),
    'fontawesome'=>array(
      'class'=>'ext.fontawesome.components.FontAwesome',
    ),
    
		
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=lippokemang',
			'emulatePrepare' => true,
			'enableParamLogging'=>true,
			'enableProfiling'=>true,
			'username' => 'root',
			'password' => '10081993',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'app/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
					'levels'=>'error, warning, info',
				),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);