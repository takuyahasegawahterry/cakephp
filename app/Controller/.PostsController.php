<?php 
class PostsController extends AppController {
	public $helpers = array('Html','Form');
	public $uses = array('Post','User','Review');

	public function index(){
		$this->set('posts',$this->Post->find('all'));
		
	}

	public function search(){
		App::uses('Xml','Utility');
		$url = 'https://app.rakuten.co.jp/services/api/BooksBook/Search/20130522?';
		$data = array(
			'applicationId' => '1020646643727437143',
			'format' => 'xml',
			'title' =>$this->request->data['Post']['title']
		);
		$query = http_build_query($data);
		$url = $url.$query;
		$response = Xml::toArray(Xml::build($url));
		$this->set('response',$response);
		
		
	}
}
