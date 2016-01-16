<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
		'Session' => array(),
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
				'controller' => 'pages',
				'action' => 'display',
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
        
	public $paginate = array('limit' => 1000);

        public function beforeFilter() {
	       $this->Auth->allow('index','searchbooksPage','allbooks','allreviews','mypage','books','reviews','register','login','author','searchbooks','view');
                $this->set('auth',$this->Auth);
        }
	public function search($data){
		App::uses('Xml','Utility');
		$url = 'https://app.rakuten.co.jp/services/api/BooksBook/Search/20130522?';
		$query = http_build_query($data);
		$url = $url.$query;
		$response = file_get_contents($url);
		$parser = xml_parser_create('UTF-8');
		xml_parse_into_struct($parser,$response,$results,$index);
		xml_parser_free($parser);

		$item_array = array();
		if($results){
			$item_temp = null;
			foreach ($results as $data){
				if(isset($data['tag'])){
					switch($data['tag']){
						case'STATUS':
							if(isset($data['value'])){
								$status = $data['value'];
							}
							break;
						case'FIRST':
							if(isset($data['value'])){
								$first = $data['value'];
							}
							break;
						case'HITS':
							if(isset($data['value'])){
								$hits = $data['value'];
							}
							break;
						case'STATUSMSG':
							if(isset($data['value'])){
								$statusmsg = $data['value'];
							}
							break;
						case 'COUNT':
                        				if(isset($data['value'])){
                           					 $count  = $data['value'];
                     					}
                        				break;
                    				case 'PAGE':
							if(isset($data['value'])){
								$page = $data['value'];
							}
							break;
						case 'ITEM':
                        				if($data['type'] == 'open'){
                            					$item_temp = array();
                        				}else if($data['type'] == 'close'){
                            					array_push($item_array,$item_temp);
                            					$item_temp = null;
                        				}
                        				break;
                    				default:
                        				if(is_array($item_temp)){
                            					if(isset($data['value'])){
                                					$item_temp[$data['tag']] = $data['value'];
                            					}
                        				}
                        			break;
                			}
				}

			}

		}
		if(empty($count)){
			$this->Session->setFlash("一件もヒットしませんでした");
			$this->redirect('/posts/index');
		}
		$item_array['count'] = $count;
		$item_array['page'] = $page;
		$item_array['first'] = $first;
		$item_array['hits'] = $hits;
		if(empty($item_array)){
			$this->redirect('/posts/index');
			$this->Session->setFlash("一件もヒットしませんでした");
		}
		return $item_array;
	}

}


