<?php

namespace Bsale;

class Client extends Common\Entity{

	private $data;
	function __construct($client = null){
		$this->data = array(
			'code'=>'', 
			'city'=>'',
			'company'=>'',
			'municipality'=>'',
			'activity'=>'',
			'address'=>''
		);
		if(!empty($client)){
			$this->set($client);
		}
		return $this;
	}

	function set($client){
		foreach($this->data as $k=>$v){ 
			$this->data[$k] = $client[$k];
		}
	}

	function get(){
		return $this->data;
	}


}
