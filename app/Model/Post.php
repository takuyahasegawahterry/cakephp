<?php
class Post extends AppModel{
	public $hasMany = 'Review';

	public $belongsTo = 'User';


