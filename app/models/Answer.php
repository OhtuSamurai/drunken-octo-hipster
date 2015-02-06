<?php

class Answer extends Eloquent {

  protected $table = 'answers';

  protected $fillable = ['sopivuus'];

  public function timeidea() {
    return $this->belongsTo('Timeidea');
  }
}
