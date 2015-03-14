<?php

return array(
	/*
	|--------------------------------------------------------------------------
	| Local
	|--------------------------------------------------------------------------
	|
	| Database connection used by local development environment 
	| (ie. Laravel homestead)
	|
	*/
 	'default' => 'mysql',
	'connections' => array(
		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'homestead',
			'username'  => 'homestead',
			'password'  => 'secret',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),
	),

);
