<?php
return array(
	'modules' => array(
		'ATPAdmin' => array(
			'version' => '0.9.0',
		),
	),
    'service_manager' => array(
        'factories' => array(
			'DataSourceFactory' => 'ATPViz\DataSource\DataSourceFactory',
        ),
    ),
);
