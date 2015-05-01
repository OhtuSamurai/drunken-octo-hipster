<?php
return array(

	/*
	|--------------------------------------------------------------------------
	| Default (production)
	|--------------------------------------------------------------------------
	|
	| Database connection used by the production environment. That is, Heroku
	| or the final deployment environment.
	|
	*/

	'fetch' => PDO::FETCH_CLASS,
	'default' => 'pgsql',
	'connections' => array(
		'pgsql' => array(
			'driver'   => 'pgsql',
			'host'     => 'ec2-23-21-183-70.compute-1.amazonaws.com',
			'database' => 'd1l6ermr789lku',
			'username' => 'ijyhbeywureirl',
			'password' => 'Cm09RG3noSDhrrFcAoEWIG1skS',
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
		),

		'homestead-mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'homestead',
			'username'  => 'homestead',
			'password'  => 'secret',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

		'mlpalvelin' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'oona_dev',
			'username'  => 'oona',
			'password'  => 'oona_00na',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Migration Repository Table
	|--------------------------------------------------------------------------
	|
	| This table keeps track of all the migrations that have already run for
	| your application. Using this information, we can determine which of
	| the migrations on disk haven't actually been run in the database.
	|
	*/

	'migrations' => 'migrations',

	/*
	|--------------------------------------------------------------------------
	| Redis Databases
	|--------------------------------------------------------------------------
	|
	| Redis is an open source, fast, and advanced key-value store that also
	| provides a richer set of commands than a typical key-value systems
	| such as APC or Memcached. Laravel makes it easy to dig right in.
	|
	*/

	'redis' => array(

		'cluster' => false,

		'default' => array(
			'host'     => '127.0.0.1',
			'port'     => 6379,
			'database' => 0,
		),

	),

);
