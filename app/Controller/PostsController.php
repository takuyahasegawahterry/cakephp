<?php 
class PostsController extends AppController {
	public $components = array('Session','Paginator');
	public $helpers = array('Html','Form');
	public $uses = array('Post','User','Register','Review');
	
	public function index(){
		$users = $this->Review->find('all',array(
			'limit' => 10,
			'order' => array('id DESC')));
		$ids = array();
		foreach($users as $user){
			$ids[] = $user['Review']['post_id'];
		}
		$posts = array();
		for($i =0;$i < 10;$i++){
			$posts[] = $this->Post->find('first',
				array('conditions' => array('Post.id' => $ids[$i]))
			);
		}
		$this->set('posts',$posts);
		$this->set('users',$users);
		//ここからレビュー
		$reviews = $this->Review->find('all',
			array(
			'conditions' => array('NOT' => array('Review.body' => null)),
			'limit' =>10,
			'order' => array('id DESC')
			)
		);
		$tmpids = array();
		foreach($reviews as $review){
			$tmpids[] = $review['Review']['post_id'];
		}
		for($i = 0;$i < 10; $i++){
			$tmpposts [] = $this->Post->find('first',
				array('conditions' => array('Post.id' => $tmpids[$i]))
			);
		}
		$this->set('reviews',$reviews);
		$this->set('tmpposts',$tmpposts);
	}
	
	public function view($id=null){
	$tmpPost = $this->Post->find('first',array('conditions' => array('Post.id' => $this->request->params['id'])));
	$this->set('tmpPost',$tmpPost);
	$data = array(
                        'applicationId' => '1020646643727437143',
                        'format' => 'xml',
                        'isbn' =>$tmpPost['Post']['isbn']
        );
 	$items = parent::search($data);
	$this->set('items',$items);
	$tmp = $this->Review->find('all',array('conditions' => array('Review.post_id' => $tmpPost['Post']['id'],'Review.user_id' => $this->Auth->user('id'))));
	if(!empty($tmp)){
		$this->set('tmp',$tmp);	
	}
	$tmpReviews = $this->Review->find('all',array('conditions' => array('Review.post_id' => $tmpPost['Post']['id'])));
	if(!empty($tmpReviews)){
		$this->set('tmpReviews',$tmpReviews);

	}
}	
	
	public function allbooks(){
		$this->Paginator->settings = array(
			'Review' => array(
				'limit' => 25,
				'order' => array(
					'Review.id' =>  'desc')
			)
		);
		$reviews = $this->Paginator->paginate('Review');
		$ids = array();
		
		foreach($reviews as $review){
			$ids[] = $review['Review']['post_id'];
		}
		$posts = array();
		$res = count($ids);
		for($i=0;$i<$res;$i++){
			$posts[] = $this->Post->find('first',
				array('conditions' => array('Post.id' => $ids[$i])));
			
		}
		$this->set('count',$res);
		$this->set('users',$reviews);
		$this->set('posts',$posts);	

}
}
