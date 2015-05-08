<?php

class Committee extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'committees';

  	protected $fillable = ['name', 'time', 'is_open'];

  	public function users() {
    	return $this->belongsToMany('User', 'committee_participants')->withTimestamps();
	}

	public function attachments() {
		return $this->hasMany('Attachment');
	}

	public function comments() {
		return $this->hasMany('Comment')->orderBy('created_at','desc');
	}
}
