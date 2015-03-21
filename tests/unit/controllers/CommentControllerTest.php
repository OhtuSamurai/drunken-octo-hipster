<?php 
	class CommentControllerTest extends TestCase {
		public function testStoreTallentaaAsiatTietokantaan() {
			$control = new CommentController;
			Request::replace($input=['poll_id'=>1,'commenttext'=>"Ebin juttu!"]);
			$kayttaja = $this->mockUser();
			$kayttaja->save();
			$this->be($kayttaja);
			$control->store();
			$luotuKommentti = Comment::all();
			$testi = true;
			foreach($luotuKommentti as $kommentti) {
				if ($kommentti->user_id !=42)
					$testi=false;
				if ($kommentti->poll_id != 1)
					$testi=false;
				if ($kommentti->commenttext != "Ebin juttu!")
					$testi=false;
			}
			$this->assertTrue($testi);	
		} 
	}
