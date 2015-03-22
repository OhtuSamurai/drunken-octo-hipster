<?php

class AnswerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	public function updateSopivuus()
	{
		$answers = array_except(Input::all(), ['_token', 'poll_id']);
		if(empty($answers)) return Redirect::action('PollController@show', ['id' => Input::get('poll_id')])->withErrors('Ruutua klikkaamalla voit muuttaa valintojasi');
		foreach($answers as $answer_id => $answer_sopivuus) {
			$answer = Answer::find($answer_id);
			$answer->sopivuus = $answer_sopivuus;
			$answer->save();
		}
		return Redirect::action('PollController@show', ['id' => Input::get('poll_id')]);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
