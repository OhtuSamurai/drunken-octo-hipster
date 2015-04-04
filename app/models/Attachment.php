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
}
