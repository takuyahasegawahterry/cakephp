<?php

class User extends AppModel {
	public $hasMany = array(
		'Post'=>array(
			'className' =>'Post',
			'foreignKey' =>'user_id'
		),
		'Review'=>array(
			'className' =>'Review',
			'foreignKey' =>'user_id'
		),
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
			)
		),
		'password' =>array(
			array(
			'rule'=>'alphaNumeric',
			'message'=>'パスワードは半角英数字にしてください'
			)
		),
		'mail' =>array(
			array(
			'rule'=>'alphaNumeric',
			'message'=>'半角英数字で入力してください'
			),
			array(
			'rule'=>'isUnique',
			'message'=>'すでに使用されています'
			)
		),
	);

	public function beforeSave($options = array()){
		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		return true;
	}
}





