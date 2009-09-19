<?php

class Movie extends CActiveRecord
{
	/**
     * The followings are the available columns in table 'Movie':
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Movies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
		);
	}

	/**
	 *
	 */
	public function harvestImdb( $name )
	{
	      $movie = new Movie();
	      $movie -> title = 'testtitle';
	      $movie -> imdbID = '0133093';
	      $movie -> year = '1978';
	      $movie -> created = time();
	      $movie -> updated = time();
	      $movie -> save();

		die( 'stopped harvesting for now' );
		/*
	  Yii::import('application.extensions.imdb.imdb');
          Yii::import('application.extensions.imdb.imdbsearch');
          $imdb = new imdbsearch();
          $imdb -> setsearchname ( $name );
          $results = $imdb -> results ();
	  $retval = array();

	  if( sizeof( $results ) > 0 )
	  {
	    $now = time();

	    foreach( $results as $movie_from_imdb )
	    {
	      $movie = new Movie();
	      $movie -> title = $movie_from_imdb -> main_title;
	      $movie -> imdbID = $movie_from_imdb -> imdbID;
	      $movie -> year = $movie_from_imdb -> main_year;
	      $movie -> created = $now;
	      $movie -> updated = $now;
	      $movie -> save();

	      // since we already have the data, we just
	      // gonna fill up an array with the results
	      // so we don't do extra SQL calls
	      $retval[] = $movie; 
   	    }
	  }

	  return $retval; */
	}

	/**
	 *
	 *
	 */
	public function fetchMovieFromImdb()
	{
		// here we already should have an ImdbID,
		// if not, we abort
		if( $this->imdbID )
		{
	  		Yii::import('application.extensions.imdb.imdbclass');
			$movie_from_imdb 	= new imdbclass( $this->imdbID );

			// in some cases we might need this ...
			$this -> cast 		= '';
			$this -> genre 		= '';
			$this -> director 	= '';

			// getting the genres
			$cnt = 0;
			$comma = ', ';
			if( is_array( $movie_from_imdb -> genres() ) )
			{
				foreach( $movie_from_imdb -> genres() as $genre )
				{
					if( $cnt == sizeof( $movie_from_imdb -> genres() ) - 1 )
					{
						$comma = '';
					}

					$this -> genre .= $genre . $comma;
					$cnt++;
				}
			}
			else
			{
				$this -> genre 		= $movie_from_imdb -> genres();
			}

			// getting the cast members
			$cnt = 0;
			$comma = ', ';
			if( is_array( $movie_from_imdb -> cast() ) )
			{
				foreach( $movie_from_imdb -> cast() as $member )
				{
					if( $cnt == sizeof( $movie_from_imdb -> cast() ) - 1 )
					{
						$comma = '';
					}

					$this -> cast .= $member['name'] . $comma;
					$cnt++;
				}
			}
			else
			{
				$this -> cast 		= $movie_from_imdb -> cast();
			}
			
			$cnt = 0;
			$comma = ', ';

			if( is_array( $movie_from_imdb -> director() ) )
			{
				foreach( $movie_from_imdb -> director() as $director )
				{
					if( $cnt == sizeof( $movie_from_imdb -> director() ) - 1 )
					{
						$comma = '';
					}
					$this -> director .= $director['name'] . $comma;
					$cnt++;
				}
			}
			else
			{
				$this -> director 	= $movie_from_imdb -> director();
			}

			$this -> runtime 	= $movie_from_imdb -> runtime();
			$this -> summary	= $movie_from_imdb -> plotoutline();
			$this -> updated    = time();
			$this -> save();
			return true;
		}

		return false;
	}
}
