<?php
	// error_reporting( E_ALL );
	include_once 'lib/limonade.php';

	dispatch( '/', 'menu_show' );

	dispatch( '/country/list', 'country_list' );

	dispatch( '/country/search', 'country_search' );
	dispatch_post( '/country/search', 'country_search' );

	run();
?>
