<?php
	error_reporting(E_ALL);

	require_once 'lib/limonade.php';
	require_once 'lib/user.php';

	User::login( 'iusername', 'ipassword' );

//	User::logout();

	if( User::isLoggedIn() )
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
