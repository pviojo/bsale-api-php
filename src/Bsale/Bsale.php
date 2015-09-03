<?php

namespace Bsale;

class Bsale{

	private $token;

	protected $baseUrl = 'https://api.bsale.cl';

	function __construct($token = null){
		if(!empty($token)){
			$this->setToken($token);
		}
	}
	
	protected function setToken($token){
		$this->token = $token;
		return $this;
	}

	protected	function getToken(){
		return $this->token;
	}

	protected function _prepareHeaders(){
		return array(
			'access_token' => $this->getToken(),
			'Accept' => 'application/json',
			'Content-Type' => 'application/json'
		);
	}
	protected function _url($endpoint){
		return $this->baseUrl . $endpoint;
	}

	


}
