<?php

class AnswerController extends \BaseController {
	
	/**
	*   Updates one users answers for selected timeideas.
	*/
	public function updateSopivuus() {
		$answers = array_except(Input::all(), ['_method','_token', 'poll_id']);
		if(empty($answers)) return Redirect::action('PollController@show', ['id' => Input::get('poll_id')])->withErrors('Ruutua klikkaamalla voit muuttaa valintojasi');
		foreach($answers as $answer_id => $answer_sopivuus) {
			$answer = Answer::find($answer_id);
			$answer->sopivuus = $answer_sopivuus;
			$answer->save();
		}
		return Redirect::action('PollController@show', ['id' => Input::get('poll_id')])->with('success', 'Vastaukset tallennettu!');
	}

	/**
	*   Creates new answer for a Poll.
	*/
	public static function createAnswer($uid, $timeideaid, $column) {
		$answer = new Answer;
		$answer->$column = $uid;
		$answer->timeidea_id = $timeideaid;
		$answer->sopivuus = 'eivastattu';
		$answer->save();
	}
}
