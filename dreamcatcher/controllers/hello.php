<?php
function hello_world()
	{
		return '<h1>hellow, Orld! ' . User::getIdentity() -> username . '</h1>';
	}

?>
