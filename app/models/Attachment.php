<?php

class Attachment extends Eloquent {

 	protected $table = 'attachments';

 	protected $fillable = ['file'];

  	public function committee() {
    	return $this->belongsTo('Committee');
  	}
	
	public function users() {
		return $this->belongsToMany('User');
	}

	public function getUserIDs()
	{
		$userids = array();
		foreach($this->users as $user) {
			array_push($userids,$user->id);
		}
		return $userids;
	}

	public function getSize() {
		return filesize($this->file);
	}
}
