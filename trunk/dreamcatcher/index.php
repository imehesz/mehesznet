<?php
	require_once 'lib/limonade.php';

	$user = new stdClass();

	$user -> logged_in = false;

	if( $user -> logged_in )
	{
		dispatch( '/', 'hello_world' );
	}
	else
	{
		dispatch( '/', 'login' );
	}

	dispatch( '/hello', 'hello_world' );
	dispatch( '/user/login', 'login' );

	run();
?>
