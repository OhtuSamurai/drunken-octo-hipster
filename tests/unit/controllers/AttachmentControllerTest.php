<?php

class AttachmentControllerTest extends TestCase {
	public function testDestroy() {
		$this->fakeLoginAdmin();			
		$attachment = $this->mockAttachment();
		$attachment->save();
		$this->assertTrue(Attachment::find($attachment->id)->filename==$attachment->filename);
		$this->action('delete','AttachmentController@destroy',['id'=>$attachment->id,'committee_id'=>1]);	
		$this->assertTrue(Attachment::find($attachment->id)==NULL);
	}

	public function testDestroyEiToimiJosEiOleAdmin() {
		$this->fakeLoginUser();
		$attachment = $this->mockAttachment();
		$attachment->save();
		$this->assertTrue(Attachment::find($attachment->id)->filename==$attachment->filename);
		$this->action('delete','AttachmentController@destroy',['id'=>$attachment->id,'committee_id'=>1]);	
		$this->assertTrue(!(Attachment::find($attachment->id)==NULL));
	}

}
