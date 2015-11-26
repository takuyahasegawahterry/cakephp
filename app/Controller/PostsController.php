<?php 
class PostsController extends AppController {
	public $helpers = array('Html','Form');
	public $uses = array('Post','User','Review');

	public function index(){
		$this->set('posts',$this->Post->find('all'));
		

	}

	public function search(){
		App::uses('Xml','Utility');
		$id = $this->request->params['id'];
		$this->log($this->request->data,'debug');
		$this->log($this->request->data['Post']['title or author'],'debug');
		$url = 'https://app.rakuten.co.jp/services/api/BooksBook/Search/20130522?';
		$data = array(
			'applicationId' = '1020646643727437143',
			'format' = 'xml',
			'title' =$request['Post']['title']
		);
		$query = http_build_query($data);
		$this->log($query,'debug');
		$url = $url.$query;
		$this->log($url,'debug');
		$response = Xml::toArray(Xml::build($url));
		$this->log($response,'debug');
		$this->set('response',$response);
		
		
	}
}
