<?php

class Review extends AppModel {
	public $belongsTo = array(
		'User'=>array(
			'className' =>'User',
			'foreignKey' =>'id',
		),
		'Post'=>array(
			'className' =>'Post',
			'foreignKey' =>'id',
		),
	);
