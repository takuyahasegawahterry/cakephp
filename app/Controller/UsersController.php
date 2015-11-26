<?php
class UsersController extends AppController {
	public $components = array('Session','Auth');
	public $uses = array('Post','User','Review');


	public function index(){

	}

	public function register(){
		if($this->request->is('post') && $this->User->save($this->request->data)){
			$this->Auth->login();
			$this->redirect('mypage/'.$this->Auth->user('id'));
		}
	}

	public function login(){
		if($this->request->is('post')){
			if($this->Auth->login()){
				$this->redirect('mypage/'.$this->Auth->user()['User']['id']);
			}else{
				$this->Session->setFlash('ログイン失敗');
			}
		}
	}
		
	public function logout(){
		$this->Auth->logout();
		$this->redirect('login');
	}
	
	public function mypage(){
		$id = $this->request->params['id'];
		$this->log($id,'debug');
		$this->set('id',$id);
	}
}


