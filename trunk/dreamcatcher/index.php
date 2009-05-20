<?php
	require_once 'lib/limonade.php';

	dispatch( '/hello', 'hello_world' );

	function hello_world()
	{
		return '<h1>hellow, Orld!</h1>';
	}

	run();
?>
