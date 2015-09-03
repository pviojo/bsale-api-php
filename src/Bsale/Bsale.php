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
	
	function setToken($token){
		$this->token = $token;
		return $this;
	}

	function getToken(){
		return $this->token;
	}

}
