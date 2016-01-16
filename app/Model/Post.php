<?php
class Post extends AppModel{

	public $hasMany = array(
                'Review' => array(
    	            'className' => 'Review',
                    'foreignKey' => 'post_id'
                )
        );
}
