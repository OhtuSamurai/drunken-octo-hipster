<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

  protected $fillable = ['first_name', 'last_name', 'department', 'position', 'username', 'is_admin'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');

  public function polls(){
    return $this->belongsToMany('Poll', 'participants')->withTimestamps();
  }

  public function committees(){
    return $this->belongsToMany('Committee', 'committee_participants')->withTimestamps();
  }

}
