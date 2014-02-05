<?php

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Session Storage',
	'description' => 'Session storage implementation for frontend and backend environment. Inspired from http://blog.schreibersebastian.de/2012/02/sessionhandling-in-extbase/',
	'category' => 'plugin',
	'author' => 'Julian Kleinhans',
	'author_email' => 'julian.kleinhans@aijko.com',
	'author_company' => 'AIJKO GmbH',
	'shy' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '1.0.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.0.0-0.0.0'
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);

?>