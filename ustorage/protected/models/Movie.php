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
		die( 'stopped harvesting for now' );
	  Yii::import('application.extensions.imdb.imdb');
          Yii::import('application.extensions.imdb.imdbsearch');
          $imdb = new imdbsearch();
          $imdb -> setsearchname ( $name );
          $results = $imdb -> results ();

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
   	    }
	  }
	}
}
