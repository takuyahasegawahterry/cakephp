<?php

App::uses('AppController', 'Controller');
class BooksController extends AppController {
	public $helpers = array('Html','Form');
	public $uses = array('Post','User','Review','Register');

	public function searchbooks(){
		if($this->request->is('post')){
			if(empty($this->request->data)){
				$this->redirect('/posts/index');
				$this->Session->setFlash('formを入力してください');
			}
			$title = $this->request->data['Book']['title'];
			$author = $this->request->data['Book']['author'];
			if( mb_ereg_match("^(\s|　)+$", $title) ){
			   	if( mb_ereg_match("^(\s|　)+$", $author) ){
					$this->Session->setFlash("ちゃんと入力してください");
					$this->redirect('/posts/index');
				}
			}
			$title  = preg_replace("/( |　)/", "", $title);
			$author =preg_replace("/( |　)/", "", $author);
			if (!empty($title) && !empty($author)){
				$data = array(
					'applicationId' => '1020646643727437143',
	                		'format' => 'xml',
        	        		'title' => $title,   
			     		'author' =>$author,
					'hits' => 25,
					'page' =>1
				);
			}else if(!empty($title)){
				$data = array(
					'applicationId' => '1020646643727437143',
					'format' => 'xml',
					'title' => $title,
					'hits' => 25,
					'page' =>1 
				);
			}else if(!empty($author)){
				$data = array(
					'applicationId' => '1020646643727437143',
					'format' => 'xml',
					'author' => $author,
					'hits' => 25,
					'page' =>1
				);
			}else{
				$this->Session->setFlash('ちゃんと入力してください');
				$this->redirect('/posts/index');
			}
		$items = parent::search($data);
		if(empty($items)){
			$this->Session->setFlash("該当する本が見つかりませんでした");
			$this->redirect('/posts/index');
		}
		if($items['count'] == 0){
			$this->Session->setFlash('該当する本が見つかりませんでした');
			$this->redirect($this->referer());
		}
		$count = $items['count'];
		$page = $items['page'];
		$hits = $items['hits'];
		$first = $items['first'];
		$tmppage = ceil($count/25);
		$items['count'] = null;
		$items['page'] = null;
		$items['hits'] = null;
		$items['first'] = null;
		$this->set('data',$data);
		$this->set('items',$items);
		$this->set('count',$count);
		$this->set('tmppage',$tmppage);
		$this->set('page',$page);
		$this->set('hits',$hits);
		$this->set('first',$first);
	}	
}	
	public function searchbookspage(){
		if (!empty($this->request->params['named']['title']) && !empty($this->request->params['named']['author'])){
                        $data = array(
			'applicationId' => '1020646643727437143',
			'format' => 'xml',
			'title' => $this->request->params['named']['title'],
			'author' =>$this->request->params['named']['author'],
			'hits' => 25,
			'page' =>$this->request->params['named']['page']
		);
		}else if(!empty($this->request->params['named']['title'])){
			$data = array(
				'applicationId' => '1020646643727437143',
				'format' => 'xml',
				'title' => $this->request->params['named']['title'],
				'hits' => 25,
				'page' =>$this->request->params['named']['page']
		);
		}else if(!empty($this->request->params['named']['author'])){
			$data = array(
				'applicationId' => '1020646643727437143',
				'format' => 'xml',
				'author' => $this->request->params['named']['author'],
				'hits' => 25,
				'page' =>$this->request->params['named']['page']
			);
		}
		$items = parent::search($data);
		if(empty($items)){
			$this->Session->setFlash('該当する本が見つかりませんでした');
		}
		$this->log($items,'debug');
		$count = $items['count'];
		$page = $items['page'];
		$hits = $items['hits'];
		$first = $items['first'];
		$tmppage = ceil($count / 25);
		$items['count'] = null;
		$items['page'] = null;
		$items['hits'] = null;
		$items['first'] = null;
		$hits = $hits + $first -1;
		$this->set('data',$data);
		$this->set('items',$items);
		$this->set('count',$count);
		$this->set('page',$page);
		$this->set('tmppage',$tmppage);
		$this->set('hits',$hits);
		$this->set('first',$first);

}
	public function view($isbn=null){
		
		$isbn = $this->request->params['pass']['0'];
		$tmp = $this->Post->find('first',
			array(
			'conditions' => array('Post.isbn' => $isbn)
			)
		);
		if(!empty($tmp)){
			$this->redirect(array('controller' => 'posts','action' =>'view',$tmp['Post']['id']));
		}
		$data = array(
			'applicationId' => '1020646643727437143',
			'format' => 'xml',
			'isbn' =>$isbn
		);
		$items =parent::search($data);
		$tmpPost = $this->Post->find('first',array('conditions' => array('Post.isbn' => $isbn)));
		if(!empty($tmpPost)){
			$this->set('tmpPost',$tmpPost);
			$tmpReview = $this->Review->find('first',array('conditions' => array('Review.post_id' => $tmpPost['Post']['id'],'Review.user_id' => $this->Auth->user('id'))));
		}
		if(!empty($tmpReview)){
			$this->set('tmpReview',$tmpReview);
		}
		$this->set('items',$items);
		$this->set('isbn',$isbn);

	}	
	public function author($author=null){
		$author = $this->request->params['pass']['0'];
		$data = array(
			'applicationId' => '1020646643727437143',
			'format' => 'xml',
			'author' => $author,
			'hits' => 25,
			'page' => 1
		);
		$items=parent::search($data);
		$count = $items['count'];
		$tmppage = ceil($count/25);
		$page = $items['page'];
		$hits = $items['hits'];
		$first = $items['first'];
		$hits = $hits + $first -1;
		$items['page'] = null;
		$items['hits'] = null;
		$items['first'] = null;
		$items['count'] = null;
		$this->set('items',$items);
		$this->set('data',$data);
		$this->set('count',$count);
		$this->set('page',$page);
		$this->set('tmppage',$tmppage);
		$this->set('hits',$hits);
		$this->set('first',$first);
	}

	public function register(){
		$data = array(
			'applicationId' => '1020646643727437143',
			'format' => 'xml',
			'isbn' => $this->request->params['pass']['0']
		);
		$items = parent::search($data);	
		if($this->request->is('post')){
			$tmp = NULL;
			$tmp = $this->Post->find('first',array('conditions' => array('Post.isbn' => $items['0']['ISBN'])));
			
			if(!empty($tmp)){
				$tmpReview['Review']['reading'] = $this->request->data['Review']['reading'];
				$tmpReview['Review']['value']  = $this->request->data['Review']['value'];
				$tmpReview['Review']['username'] = $this->Auth->user('username');
				$tmpReview['Review']['post_id'] = $tmp['Post']['id'];
				$tmpReview['Review']['user_id'] = $this->Auth->user('id');
				if($this->Review->save($tmpReview)){
					$this->redirect('/posts/view/'.$tmp['Post']['id']);
				}
			}
			$tmpsave['Post']['title'] = $items['0']['TITLE'];
			if(!empty($items['0']['AUTHOR'])){
				$tmpsave['Post']['author'] = $items['0']['AUTHOR'];
        		}        
			if(!empty($items['0']['SALESDATE'])){
				$tmpsave['Post']['salesdate'] = $items['0']['SALESDATE'];
			}
               	 	$tmpsave['Post']['thumbnail'] = $items['0']['LARGEIMAGEURL'];
                	$tmpsave['Post']['isbn'] = $items['0']['ISBN'];
			$this->Post->save($tmpsave);	
			
			$tmpReview['Review']['reading'] = $this->request->data['Review']['reading'];
			$tmpReview['Review']['value'] = $this->request->data['Review']['value'];
			$tmpReview['Review']['username'] = $this->Auth->user('username');
			$tmpReview['Review']['post_id'] = $this->Post->getLastInsertId();
			$tmpReview['Review']['user_id'] = $this->Auth->user('id');
			if($this->Review->save($tmpReview)){
				$this->redirect('/posts/view/'.$this->Post->getLastInsertId());
				$this->Session->setFlash('Success');
			}

			

		}
	}
}
