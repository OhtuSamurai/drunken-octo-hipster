<?php
 
return array(
 
	/*
	|--------------------------------------------------------------------------
	| Testing
	|--------------------------------------------------------------------------
	|
	| Database connection used by automated tests. It is not currently known
	| whether this database connection is in use by tests at all.
	|
	*/

    'default' => 'sqlite',
 
    'connections' => array(
        'sqlite' => array(
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => ''
        ),
    )
);