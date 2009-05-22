<?php
	session_start();
	/**
	 *
	 */
	class User
	{
		/**
		 *
		 */
		static $user_logged_in = false;

		/**
		 *
		 */
		static $user = NULL;

		/**
		 *
		 */
		public function __construct()
		{
			
		}

		/**
		 *
		 */
		public function init()
		{
		}
		
		/**
		 *
		 */
		public static function isLoggedIn()
		{
			self::$user_logged_in = false;

			if( isset( $_SESSION[ 'username' ] ) &&  isset( $_SESSION[ 'password' ] ) )
			{
				self::athenticate( $_SESSION[ 'username' ], $_SESSION[ 'password'] );
			}

			return self::$user_logged_in;
		}

		/**
		 *
		 */
		public static function login( $username, $password, $pass_hashed = true )
		{
			self::authenticate( $username, $password, $pass_hashed );
		}
	
		public static function logout()
		{
			session_destroy();
			self::$user = NULL;
		}

		/**
		 *
		 */
		public static function authenticate( $username, $password, $pass_hashed = true )
		{
			if( $username == 'iusername' && $password == 'ipassword' )
			{
				if( ! isset($_SESSION[ 'username' ]) )
				{
//					$_SESSION[ 'username' ] = 'iusername';
//					$_SESSION[ 'password' ] = 'ipassword';
				}

				self::$user -> username = $username;
				self::$user -> password = $password;

				self::$user_logged_in = true;
			}
		}

		/**
		 *
		 */
		public static function getIdentity()
		{
			return self::$user;
		}
	}

