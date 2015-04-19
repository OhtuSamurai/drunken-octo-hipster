<?php
class StatsController extends BaseController {
	/*
	* Siitä vaan pojat refaktoroimaan
	*
	*/
	public function index() {
		if (!Auth::user() || !Auth::user()->is_admin)
			return Redirect::to('/')->withErrors('Toiminto evätty');
		$tilasto = (object) array(
			'n_pooli'=>DB::select( DB::raw('select count(*) as n_pooli from users') )[0]->n_pooli,
			'n_users'=>User::all()->count(),
			'n_kyselyissa'=>DB::select(DB::raw('select count(*) as n_kyselyissa from (select count(*) from participants group by user_id) as whatevs'))[0]->n_kyselyissa,
			'n_komiteoissa'=>DB::select(DB::raw('select count(*) as n_komiteoissa from (select count(*) from committee_participants group by user_id) as whevers'))[0]->n_komiteoissa,
			'eikoskaankys'=>$this->getEikoskaan('participants'),
			'eikoskaantk'=>$this->getEikoskaan('committee_participants'),
			'n_polls'=>DB::select( DB::raw('SELECT count(*) as n_polls FROM polls') )[0]->n_polls,
			'n_committees'=>DB::select(DB::raw('SELECT count(*) as n_committees FROM committees'))[0]->n_committees,
			'n_openpolls'=>DB::select( DB::raw('SELECT count(*) as n_openpolls FROM polls WHERE is_open = 1'))[0]->n_openpolls,
			'n_opencommittees'=>DB::select( DB::raw('SELECT count(*) as n_opencommittees FROM  committees WHERE is_open = 1'))[0]->n_opencommittees,
			'n_attachments'=>Attachment::all()->count(),
			'attachmentsize'=>$this->getSumAttachmentSize()
			);
			return View::make('stats.index')->with(['tilasto'=>$tilasto,'users'=>User::all()]);
	}

	private function getEikoskaan($tablename) {
		$res = DB::select(DB::raw('select id from users where id not in (select user_id from '.$tablename.') order by created_at'));
		$users = array();
		foreach ($res as $obj)
			array_push($users,User::find($obj->id));
		return $users;
	}

	private function getSumAttachmentSize() {
		$attachments = Attachment::all();
		$sum = 0;
		foreach($attachments as $attachment)
			$sum=$sum+$attachment->getSize();
		return round($sum/1000000,2);
	}
}
