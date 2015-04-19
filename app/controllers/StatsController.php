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
			'n_pooli'=>DB::table('users')->where('is_active','=',1)->count(),
			'n_users'=>User::all()->count(),
			'n_kyselyissa'=>count(DB::table('polls')->where('is_open','=',1)->join('participants','polls.id','=','participants.poll_id')->select('participants.user_id')->distinct()->get()),
			'n_komiteoissa'=>count(DB::table('committees')->where('is_open','=',1)->join('committee_participants','committees.id','=','committee_participants.committee_id')->select('committee_participants.user_id')->distinct()->get()),
			'n_polls'=>Poll::all()->count(),
			'n_committees'=>Committee::all()->count(),
			'n_openpolls'=>DB::table('polls')->where('is_open','=',1)->count(),
			'n_opencommittees'=>DB::table('committees')->where('is_open','=',1)->count(),
			'n_attachments'=>Attachment::all()->count(),
			'attachmentsize'=>$this->getSumAttachmentSize()
			);
			return View::make('stats.index')->with(['tilasto'=>$tilasto,'users'=>User::all()]);
	}

	private function getSumAttachmentSize() {
		$attachments = Attachment::all();
		$sum = 0;
		foreach($attachments as $attachment)
			$sum=$sum+$attachment->getSize();
		return round($sum/1000000,2);
	}
}
