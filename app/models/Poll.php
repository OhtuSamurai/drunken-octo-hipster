<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Reminders\RemindableTrait;

class Poll extends Eloquent {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'polls';

  protected $fillable = ['toimikunta', 'is_open'];

  public function users(){
    return $this->belongsToMany('User', 'participants')->withTimestamps();
  }

  public function timeideas(){
    return $this->hasMany('Timeidea');
  }

  public function answers() {
    return $this->hasManyThrough('Answer', 'Timeidea');
  }
	
	public function comments() {
		return $this->hasMany('Comment')->orderBy('created_at');
	}
}
