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
	$name = Yii::app()->request->getParam( 'name', NULL );
       
       	// let's see first if we have any cached information in the DB
	$movies = Movie::model()->
			findAll( 
			  sprintf(
			    '`title` LIKE "%%%s%%" AND `updated`>%s', 
			    strip_tags($name),
			    (time()-CACHING_FOR)
			  ) 
			);

	// if NOT we're gonna try to fetch the info from IMDB
	if( ! sizeof( $movies ) )
	{
	  // let's try to find the movies from IMDB then
	  $movies = Movie::model()->harvestImdb( $name );	  
	}

        $this -> render( 'list', array( 'movies' => $movies ) );
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
				$movie -> fetchMovieFromImdb();
			}

			echo json_encode( $movie->attributes );
		}
		else
		{
			echo 'fail';
		}

		exit();
	}
}
