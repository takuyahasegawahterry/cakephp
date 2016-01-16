<?php
class ReviewsController extends AppController {
	public $helpers = array('Html','Form');
	public $uses = array('Review','Post','User');
	public $paginate = array(
		'Review' => array(
			'limit' => 25,
			'order' => array('id' => 'desc'),
			'conditions' => array('NOT'=> array('Review.body' =>null))
		)
	);
		
	public function index(){
		$reviews = $this->Review->find('all');
		$this->set('reviews',$reviews);
		$ids = array();
		foreach($reviews as $review){
			$ids[] = $review['Review']['post_id'];
		}
		$this->log($ids,'debug');
		$posts = $this->Post->findAllById($ids);
		$this->set('posts',$posts);
	}
	
	public function review($id =null){
        	$tmp = $this->Review->find('first',array('conditions' => array('Review.post_id' => $this->request->params['pass']['0'],'Review.user_id' => $this->Auth->user('id'))));
		$id = $tmp['Review']['id'];
		$post = $this->Post->find('first',array('conditions' => array('Post.id' => $this->request->params['pass']['0'])));
		$this->set('post',$post);
		$this->Review->id = $id;
		if($this->request->is('get')){ 
			$this->request->data = $this->Review->read();
                 }else{
			if($this->Review->save($this->request->data)){
				$this->redirect('/posts/view/'.$this->request->data['Review']['post_id']);
				$this->Session->setFlash('Success');
			}else{
				$this->Session->setFlash('100文字以内でお願いします');
				$this->redirect($this->referer());
			       
			 }
		}	
	}
	public function allreviews(){
		$reviews = $this->paginate();
		$this->log($reviews,'debug');
		$ids = array();
		foreach($reviews as $review){
			$ids[] = $review['Review']['post_id'];
		}
		$this->log($ids,'debug');
		$res = count($ids);
		$posts = array();
		for($i = 0;$i<$res;$i++){
			$posts[] = $this->Post->find('first',
				array('conditions' => array('Post.id' => $ids[$i])));
		}
		$this->set('count',$res);
		$this->set('reviews',$reviews);
		$this->set('posts',$posts);
	}
	
}
