<?php

class Committee extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'committees';

  protected $fillable = ['name', 'time'];

  public function users(){
    return $this->belongsToMany('User', 'committee_participants')->withTimestamps();
  }

  
}
