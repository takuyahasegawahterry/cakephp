<?php
class Review extends AppModel{
	public $belognsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
	);
	public $validate = array(
		'reading' => array(
			'rule' => 'notEmpty',
			'message' => '読書状況をチェックしてください'
		),
		'body' => array(
			array(
				'rule' => 'notEmpty',
				'message' => '入力してください'
			),
				'rule' => array('between',2,100),
				'message'=>'レビュは100文字以内です'
		),
	);

}
