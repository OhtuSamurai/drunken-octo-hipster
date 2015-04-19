<?php

class AttachmentController extends \BaseController {
	
	/**
	*  Adds attachment in serverside fs
	*
	*  @return string server fs's path to attachment
	*/
	private function stashAttachment($file, $committee_id,$filename) {
		$destinationpath = storage_path().'/attachments/'.$committee_id;
		$file->move($destinationpath, $filename);
		return $destinationpath .'/'. $filename;
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
* Checks if there already is a file with the same name in the committee's attachments. If there is, function will generate a name like "somename.txt(1)". If that also exists, it will go on untill finding n < 99 such that no file with the name exists. PHP will allows recursion to the depth of 100, so after 99 a random suffix is generated. That is expected to never happen.
*/
	private function generateProperFilename($filename,$suffix, $committee,$i) {
		if ($i==99)
			return $filename.rand(1,999999);
		$existsAnotherWithSameName=false;
		foreach($committee->attachments as $attachment) 
			if ($attachment->filename==$filename.$suffix)
				$existsAnotherWithSameName=true;
		if (!$existsAnotherWithSameName && $i==0)
			return $filename;
		if (!$existsAnotherWithSameName) 
			return $filename.$suffix;
		return $this->generateProperFilename($filename,"(".$i.")",$committee,$i+1);
	}

/**
* Makes sure that the filename is no longer that MAXLENGTH.
*/
	private function cutFilenameToReasonableLength($filename) {
		$MAXLENGTH=25;
		if (strlen($filename)>$MAXLENGTH) {
			return substr($filename,0,$MAXLENGTH);
		}
		return $filename;

	}

	/**
	*  Stores info about attachment in db and adds it to servers fs.
	*  Only admin allowed to store attachments.
	*/
	public function store() {
		if (!(Auth::check() AND Auth::user()->is_admin))
			return Redirect::to('/')->withError('Et voi lisätä liitettä, koska et ole admin!');
		$committee = Committee::find(Input::get('committee_id'));
		try {
			if (!Input::hasFile('tiedosto'))
				return Redirect::action('CommitteeController@show', ['id' => $committee->id])->withErrors('Anna lisättävä tiedosto!');
			$file = Input::file('tiedosto');
			if (filesize($file) > 1000000)
				return Redirect::action('CommitteeController@show',['id'=>$committee->id])->withError('Tiedoston maksimikoko on 1 MB');
		} catch (Exception $e) {
			return Redirect::action('CommitteeController@show',['id'=>$committee->id])->withError('Tiedoston maksimikoko on 1 MB');
		}
		$filename = $this->generateProperFilename($this->cutFilenametoReasonableLength($file->getClientOriginalName()),"",$committee,1);
		$path = $this->stashAttachment($file, $committee->id,$filename);
		$this->storeAttachment($path, $committee->id, $filename);
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
