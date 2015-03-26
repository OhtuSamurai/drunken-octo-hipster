<?php

use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Comment extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

  protected $fillable = ['commenttext'];


	public function poll() {
		return $this->belongsTo('Poll');
	}
	public function user() {
		return $this->belongsTo('User');
	}

	public function validator() {
		return Validator::make(
			$this->getAttributes(),
			array('commenttext'=>'required'),
			array('commenttext.required'=>'Anna kommentti!')
			);
	}
}
