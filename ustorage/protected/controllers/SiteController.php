<?php

class SiteController extends CController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image
			// this is used by the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xEBF4FB,
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$contact=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$contact->attributes=$_POST['ContactForm'];
			if($contact->validate())
			{
				$headers="From: {$contact->email}\r\nReply-To: {$contact->email}";
				mail(Yii::app()->params['adminEmail'],$contact->subject,$contact->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('contact'=>$contact));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$form=new LoginForm;
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$form->attributes=$_POST['LoginForm'];
			// validate user input and redirect to previous page if valid
			if($form->validate())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('form'=>$form));
	}

	/**
	 * Logout the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionSearch()
    {
        $this -> render( 'search' );
    }

    public function actionList()
    {
//        Yii::import('application.extensions.imdb.imdb');
//        Yii::import('application.extensions.imdb.imdbsearch');
//        $imdb = new imdbsearch();
//        $imdb -> setsearchname ('terminator');
//        $results = $imdb -> results ();
	$name   = Yii::app()->request->getParam( 'name', NULL );

    $moboco = Yii::app()->request->getParam( 'moboco', NULL );

    switch( $moboco )
    {
        case 'movie':
                    $movies = Movie::model()->harvestTmdb( $name );
                    $this -> render( 'list', array( 'movies' => $movies ) );
                    break;
    }

//  TODO revise this and maybe remove
//
//   	// let's see first if we have any cached information in the DB
//	$movies = Movie::model()->
//			findAll(
//			  sprintf(
//			    '`title` LIKE "%%%s%%" AND `updated`>%s',
//			    strip_tags($name),
//			    (time()-CACHING_FOR)
//			  )
//			);
    }

	/**
	 * @name actionLoadMovieInfo
	 * @param parameters
	 * @return return_value
	 */
	public function actionLoadMovieInfo()
	{
		// first let's find this movie in our DB, because
		// at this point, we have to have it ...

		$imdbID = Yii::app()->request->getParam( 'id', NULL );

		$movie = Movie::model()->findByAttributes( array( 'imdbID' => $imdbID ) );

		if( $movie )
		{
			if( ! $movie -> runtime )
			{
				$movie -> fetchMovieFromTmdb();
			}

			echo json_encode( $movie->attributes );
		}
		else
		{
			echo 'fail';
		}

		exit();
	}

	public function actionEmail()
	{
		$imdbID = Yii::app()->request->getParam( 'id', NULL );
		$movie = Movie::model()->findByAttributes( array( 'imdbID' => $imdbID ) );
		$form = new Email();

		$form->setAttributes( 
			array( 
				'subject'   => $movie->title . ' (' . $movie->year . ')',
				'body' 		=> 'Title: ' . $movie -> title . "\r\n" .
								'Year: ' . $movie -> year . "\r\n" . 
								'Link: http://www.imdb.com/title/' . $movie -> imdbID . "\r\n". 
								'Director: ' . $movie -> director . "\r\n\r\n" . 
								'Summary: ' . $movie -> summary . "\r\n\r\n" . 
								'Cast: ' . $movie -> cast . "\r\n\r\n" .
                                'Genre: ' . $movie -> genre
			) 
		);

		if( $_POST )
		{
			if( $_POST['Email']['remember_me'] )
			{
				setcookie('mehesznet_storedbyu_email', $_POST['Email']['email_address'], 2592000 + time() );
			}

			$to 		= $_POST['Email']['email_address'];
			$subject 	= $_POST['Email']['subject'];
			$message    = $_POST['Email']['body'] . "\r\n\r\n" . '--' . "\r\n" . 'stored by U | info [ at ] mehesz.net';
			
			$headers 	= 'From: noreply-dvd-stored-by-u@mehesz.net' . "\r\n" .
						'Reply-to: noreply-dvd-stored-by-u@mehesz.net'. "\r\n" .
						'X-Mailer: PHP/' . phpversion();


			$session = new CHttpSession;
			$session -> open();
			if( mail( $to, $subject, $message, $headers ) )
			{
				$session['mehesznet_storedbyu_flash_message'] = 'email has been sent ...';
			}
			else
			{
				$session['mehesznet_storedbyu_flash_message'] = 'errr, please try again ...';
			}

			$this->redirect( $this->createUrl('site/search') );
		}

		if( $movie )
		{
		}
		else
		{
			die( 'could not find this movie!? please try again l8r' );
		}

		$this -> render( 'email', array( 'form' => $form ) );
	}
}
