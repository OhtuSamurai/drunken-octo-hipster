<?php

class Lurker extends Eloquent {

	/**
 	* The database table used by the model.
 	*
 	* @var string
 	*/
	protected $table = 'lurkers';

  	protected $fillable = ['name'];

  	public function poll() { return $this->belongsTo('Poll'); }
	
	public function answers() { return $this->hasMany('Answer'); }
}
