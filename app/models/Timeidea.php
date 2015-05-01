<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Timeidea extends Eloquent {

  protected $table = 'timeideas';

  protected $fillable = ['description'];

  public function poll() { return $this->belongsTo('Poll'); }

  public function answers() { return $this->hasMany('Answer'); }

  public function validator() {
    return Validator::make(
      $this->getAttributes(),
      ['description' => 'required'],
      ['description.required' => 'Yritit lisätä tyhjän ajankohdan']);}
}
