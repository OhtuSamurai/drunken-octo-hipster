<?php
 
return array(
 
	/*
	|--------------------------------------------------------------------------
	| Testing
	|--------------------------------------------------------------------------
	|
	| Database connection used by automated tests.
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