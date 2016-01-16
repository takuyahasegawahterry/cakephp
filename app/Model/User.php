<?php
App::uses('BlowfishPasswordHasher','Controller/Component/Auth');
class User extends AppModel {
	public $hasMany = array(
		'Review' => array(
			'className' => 'Review',
			'foreignKey' => 'user_id'
		)
	);


	public $validate = array(
		'username' =>array(
			array(
			'rule'=>'isUnique',
			'message'=>'すでに使用されている名前です。'
			),
			array(
			'rule'=>array('between',2,32),
			'message'=>'名前は2文字以上32文字以内にしてください。'
			),
			array(
			'rule' => 'space_only',
			'message' =>'名前は空白以外も入力してください'
			)
		),
		'password' =>array(
			array(
			'rule'=>'alphaNumeric',
			'message'=>'パスワードは半角英数字にしてください'
			),
			array(
			'rule'=>array('between',8,32),
			'message'=>'パスワードは8文字以上32文字以内'
			)
		
		),
		'email' =>array(
			array(
			'rule'=>'email',
			'message'=>'正しくないメールアドレスです。'
			),
			array(
			'rule'=>'isUnique',
			'message'=>'すでに使用されています'
			)
		),
	);

	public function beforeSave($options = array()){
		$passwordHasher = new BlowfishPasswordHasher();
		$this->data['User']['password'] = $passwordHasher->hash($this->data['User']['password']);
		$this->log("beforesave".$this->data['User']['password'],'debug');
		return true;
}
}




