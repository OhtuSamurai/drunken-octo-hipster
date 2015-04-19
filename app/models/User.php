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

 	protected $fillable = ['first_name', 'last_name', 'department', 'position', 'username', 'is_admin', 'is_active', 'description'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');

  	public function polls() {
		return $this->belongsToMany('Poll', 'participants')->withTimestamps();
  	}

  	public function committees() {
		return $this->belongsToMany('Committee', 'committee_participants')->withTimestamps();
  	}

	public function validator() {
		return Validator::make(
			$this->getAttributes(),
			array('username' => 'required|unique:users,username,'.$this->id,
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'email',
			'department' => 'required',
			'position' => 'required'), 
			array('username.required' => 'Anna käyttäjätunnus.',
			'first_name.required' => 'Anna etunimi.',
			'last_name.required' => 'Anna sukunimi.',
			'email.email' => 'Sähköpostiosoitteen täytyy olla kelvollinen.',
			'department.required' => 'Anna laitos.',
			'position.required' => 'Anna asema.',
			'username.unique' => 'Käyttäjätunnus löytyy jo järjestelmästä.'
		));
  	}

  	//returns users polls which are open
  	public function curr_polls() {
  		return $this->polls->filter(function($poll) { 
  			return $poll->is_open;
  		});
  	}

  	//returns users committees which are open
  	public function curr_committees() {
  		return $this->committees->filter(function($com) { 
  			return $com->is_open;
  		});
  	}


	public function n_committee() {
		return $this->committees->count();
	}
	
	public function n_poll() {
		return $this->polls->count();
	}
}
