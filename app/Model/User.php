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
