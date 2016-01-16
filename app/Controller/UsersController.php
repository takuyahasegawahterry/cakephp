<?php
class UsersController extends AppController {
	public $components = array(
                'Paginator' => array(),	
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'loginRedirect' => array(
				'controller' => 'posts',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'posts',
				'action' => 'index',
				'home'
			),
			'authenticate' => array(
				'Form' => array(
				'userModel' => 'User',
				'fields' => array('username' =>'email',
				'password'=>'password'),
				'passwordHasher' => 'Blowfish'
				)
			)
			),
				'RequestHandler');
	public $uses = array('Post','User','Review');
	public function index(){

	}

	public function register(){
		if($this->request->is('post') && $this->User->save($this->request->data)){
			$this->log($this->request->data,'debug');
			$this->Auth->login();
			$this->redirect('/posts/index');
		}
	}

	public function login(){
		if($this->request->is('post')){
			$this->log(AuthComponent::password($this->request->data['User']['password']),'debug');
			if($this->Auth->login()){
				$this->redirect('/users/mypage/'.$this->Auth->user()['id']);
			}else{
				$this->Session->setFlash('ログイン失敗');
			}
		}
	}
		
	public function logout(){
		$this->Auth->logout();
		$this->redirect('/posts/index');
	}
	
	public function mypage(){
		 $id = $this->request->params['id'];
		$posts = $this->Review->find('all',array(
			'conditions' => array('Review.user_id' => $id),
		 	'limit' => 10,	 
			'order' => array('id DESC')));
		$ids = array();
		foreach($posts as $post){
			$ids[] = $post['Review']['post_id'];
		}
		$posts = array();
		$count = count($ids);
		for($i =0;$i < $count;$i++){
			$posts[] = $this->Post->find('first',
				array('conditions' => array('Post.id' => $ids[$i]))
			);
		}
		$this->set('posts',$posts);
	        //レビュー	
		$options['conditions'] = array(
		'Review.user_id' =>$id,
		'AND' => array(
		'NOT' => array('Review.body' =>null)
		)
		);
		$options['limit'] = 10;
		$options['order'] = array('id DESC');
		$reviews = $this->Review->find('all',$options);
		$ids = array();
		foreach($reviews as $review){
			$ids[] = $review['Review']['post_id'];
		}
		$tmpposts = array();
		$res = count($ids);
		for($i=0;$i<$res;$i++){
			$tmpposts[] = $this->Post->find('first',
				array('conditions' =>array('Post.id' => $ids[$i])));
		}
		$this->set('tmpposts',$tmpposts);
		$this->set('reviews',$reviews);
		$this->set('count',$res);
		
		
		$user = $this->User->findById($id);
		$this->set('user',$user);
	}

	public function books(){
		$id =  $this->request->params['pass']['0'];
		$this->Paginator->settings = array(
			'Review' => array(
				'conditions' => array('Review.user_id' => $this->request->params['pass']['0']),
				'limit' => 25,
				'order' => array(
					'Review.id' =>  'desc'),
			)
		);
		$reviews = $this->Paginator->paginate('Review');
		$ids = array();
		foreach($reviews as $review){
			$ids[] = $review['Review']['post_id'];
		}
		$res = count($ids);
		$posts = array();
		for($i =0;$i<$res;$i++){
			$posts[] = $this->Post->find('first',
				array(
				'conditions' => array('Post.id' => $ids[$i])));
		}
		$this->set('posts',$posts);
		 $user = $this->User->findById($id);
		 $this->set('user',$user);
}
	public function reviews(){
		$id = $this->request->params['pass']['0'];
		 $this->Paginator->settings = array(
		         'Review' => array(
			 	'conditions' => array('Review.user_id' => $id,'NOT' => array('Review.body' => null)),
			        'limit' => 25,
				'order' => array(
					'Review.id' => 'desc'),
			)
		);
		$reviews = $this->Paginator->paginate('Review');
		$ids = array();
		foreach ($reviews as $review){
			$ids[] = $review['Review']['post_id'];
		}
		$res = count($ids);
		$posts = array();
		for($i=0;$i<$res;$i++){
			$posts[] = $this->Post->find('first',
				array(
				'conditions' => array('Post.id' => $ids[$i])));
		}
		$this->set('count',$res);
		$this->set('reviews',$reviews);
		$this->set('posts',$posts);
		$user = $this->User->findById($id);
		$this->set('user',$user);
}

}
