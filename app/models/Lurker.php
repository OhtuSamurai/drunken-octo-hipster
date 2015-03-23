<?php

class Lurker extends Eloquent {

	/**
 	* The database table used by the model.
 	*
 	* @var string
 	*/
	protected $table = 'lurkers';

  	protected $fillable = ['name'];

  	public function polls()
  	{
  		return $this->belongsToMany('Poll', 'poll_lurkers')->withTimestamps();
  	}

}
