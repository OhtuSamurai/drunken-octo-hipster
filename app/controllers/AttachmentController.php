<?php

class AttachmentController extends \BaseController {
	
	/**
	*  Adds attachment in serverside fs
	*
	*  @return string server fs's path to attachment
	*/
	private function stashAttachment($file, $committee_id) {
		$destinationpath = storage_path().'/attachments/'.$committee_id;
		$file->move($destinationpath, $file->getClientOriginalName());
		return $destinationpath .'/'. $file->getClientOriginalName();
	}

	/**
	*  Stores attachment type in db
	*/
	private function storeAttachment($path, $committee_id, $filename) {
		$liite = new Attachment;
		$liite->file = $path;
		$liite->committee_id = $committee_id;
		$liite->filename = $filename;
		$liite->save();
	}

	/**
	*  Stores info about attachment in db and adds it to servers fs.
	*  Only admin allowed to store attachments.
	*/
	public function store() {
		if (!(Auth::check() AND Auth::user()->is_admin))
			return Redirect::to('/')->withError('Et voi lisätä liitettä, koska et ole admin!');
		$committee = Committee::find(Input::get('committee_id'));	
		if (!Input::hasFile('tiedosto'))
			return Redirect::action('CommitteeController@show', ['id' => $committee->id])->withErrors('Anna lisättävä tiedosto!');
		$file = Input::file('tiedosto');
		$path = $this->stashAttachment($file, $committee->id);
		$this->storeAttachment($path, $committee->id, $file->getClientOriginalName());
		return Redirect::action('CommitteeController@show', ['id' => $committee->id])->with('success','Tiedoston lisääminen onnistui');
	}
	
	/**
	*  Checks if loggedin user has rights for the attachment.
	*  If user is admin or belongs to the attachments committee, 
	*  user has rights for the attachment.
	*
	*  @return boolean
	*/
	private function rights($committee_id) {
		if (!Auth::user())
			return false;
		if (Auth::user()->is_admin) 
			return true;
		foreach (Committee::find($committee_id)->users as $user) 
			if ($user->id==Auth::user()->id)
				return true;
		return false;
	}

	/**
	*  Checks if Attachment::users list contains given user
	*
	* @return boolean
	*/
	private function addUserInAttachmentsUserTable($user_id,$attachment_id){
		foreach (Attachment::find($attachment_id)->users as $user) 
			if ($user->id==$user_id)
				return true;
			return false;	
	}

	/**
	*  Enables committee users to read attachments.
	*  If users hasn't read the file previously, adds users in the AttachmentUsers table.
	*/
	public function download($committee_id,$id) {
		if (!($this->rights($committee_id)))
			return Redirect::to('/')->withErrors('Sinulla ei ole oikeutta ladata tiedostoa!');
		if (!$this->addUserInAttachmentsUserTable(Auth::user()->id,$id))
			Attachment::find($id)->users()->attach(Auth::user()->id);
		return Response::download(Attachment::find($id)->file);
	}
	
	/**
	*  Deletes given file in a committee
	*/
	public function destroy($committee_id, $id) {
		if (!(Auth::user()&&Auth::user()->is_admin))
			return Redirect::to('/')->withErrors('Sinulla ei ole oikeutta poistaa tiedostoa!'); 
		$destroyable = Attachment::find($id);
		File::delete($destroyable->file);
		$destroyable->users()->detach();
		$destroyable->delete();
		return Redirect::action('CommitteeController@show', ['id' => $committee_id])->with('success','Liite poistettiin onnistuneesti!');
	}
} 
