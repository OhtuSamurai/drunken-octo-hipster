<?php
return array(

	/*
	|--------------------------------------------------------------------------
	| Travis
	|--------------------------------------------------------------------------
	|
	| Database connection currently used by Travis CI environment.
	|
	*/

	'fetch' => PDO::FETCH_CLASS,
	'default' => 'travis-pgsql',
	'connections' => array(
		'travis-pgsql' => array(
			'driver'   => 'pgsql',
			'host'     => 'localhost',
			'database' => 'travis_ci_test',
			'username' => 'postgres',
			'password' => '',
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
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
