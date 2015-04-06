<?php

class AttachmentController extends \BaseController {
	public function store() {
		$committee = Committee::find(Input::get('committee_id'));
		$destinationpath = storage_path().'/attachments/'.$committee->id;
		$tiedosto = Input::file('tiedosto');		
		$tiedostonimi = $tiedosto->getClientOriginalName();
		$tiedosto->move($destinationpath,$tiedostonimi);
		$kokopolku = $destinationpath .'/'. $tiedostonimi;
		$liite = new Attachment;
		$liite->file=$kokopolku;
		$liite->committee_id=$committee->id;
		$liite->filename=$tiedosto->getClientOriginalName();
		$liite->save();
		return Redirect::route('committee.show',$committee->id)->with('success','Tiedoston lisääminen onnistui');
	}
	


	private function oikeudet($committee_id) {
		if (!Auth::user())
			return false;
		if (Auth::user()->is_admin) 
			return true;
		foreach (Committee::find($committee_id)->users as $user) 
			if ($user->id==Auth::user()->id)
				return true;
		return false;
	}
	private function ollaankosJoAiemminLadattu($user_id,$attachment_id) {
		foreach (Attachment::find($attachment_id)->users as $user) 
			if ($user->id==$user_id)
				return true;
			return false;	
	}

	public function download($committee_id,$id) {
		if (!($this->oikeudet($committee_id)))
			return Redirect::to('/')->withErrors('Sinulla ei ole oikeutta ladata tiedostoa!');
		if (!$this->ollaankosJoAiemminLadattu(Auth::user()->id,$id))
			Attachment::find($id)->users()->attach(Auth::user()->id);
		return Response::download(Attachment::find($id)->file);
	}
	
	public function destroy($committee_id,$id) {
		if (!(Auth::user()&&Auth::user()->is_admin))
			return Redirect::to('/')->withErrors('Sinulla ei ole oikeutta poistaa tiedostoa!'); 
		Attachment::find($id)->users()->detach();
		Attachment::find($id)->delete();
		return Redirect::route('committee.show',$committee_id)->with('success','Liite poistettiin onnistuneesti!');
	}
} 
