<?php
// Your own custom routes
// ...


// Default routes distributed with Alloy
$router->route('clean', '/clean')
	->defaults(array(
		'module' => 'motion',
		'action' => 'clean'
	));
$router->route('disarm', '/disarm/<:camera>')
	->defaults(array(
		'module' => 'motion',
		'action' => 'disarm',
		'format' => 'html'
	));
$router->route('arm', '/arm/<:camera>')
	->defaults(array(
		'module' => 'motion',
		'action' => 'arm',
		'format' => 'html'
	));
$router->route('motionEventDelete', '/event/delete/<:stamp>')
	->defaults(array(
		'module' => 'motion',
		'action' => 'eventDelete',
		'format' => 'html'
	));

$router->route('motionEvent', '/event/<:camera>/<:stamp>')
	->defaults(array(
		'module' => 'motion',
		'action' => 'event',
		'format' => 'html'
	));
$router->route('motionEvents', '/events')
	->defaults(array(
		'module' => 'motion',
		'action' => 'events',
		'format' => 'html'
	));
$router->route('motionEventsByCamera', '/eventsByCamera/<:camera>')
	->defaults(array(
		'module' => 'motion',
		'action' => 'eventsByCamera',
		'format' => 'html'
	));
require $kernel->config('alloy.path.config') . '/routes.php';

$router->route('default', '/')
	->defaults(array(
		'module' => 'motion',
		'action' => 'index',
		'format' => 'html'
	));

//$router->route('motion_event', '/event/<:stamp>');
