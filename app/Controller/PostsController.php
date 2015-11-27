<?php 
class PostsController extends AppController {
	public $helpers = array('Html','Form');
	public $uses = array('Post','User','Review');

	public function index(){
		$this->set('posts',$this->Post->find('all'));
		
	}

	public function search(){
		App::uses('Xml','Utility');
		$url = 'https://app.rakuten.co.jp/services/api/BooksBook/Search/20130522?';
		$data = array(
			'applicationId' => '1020646643727437143',
			'format' => 'xml',
			'title' =>$this->request->data['Post']['title']
		);
		$query = http_build_query($data);
		$url = $url.$query;
		$response = file_get_contents($url);
		$parser = xml_parser_create('UTF-8');
		//$test=Xml::toArray($response);
		//$this->set('test',$test);
		xml_parse_into_struct($parser,$response,$results,$index);
		xml_parser_free($parser);
		$this->set('response',$results);


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
	$this->set('items',$item_array);
		
		
	}
}
