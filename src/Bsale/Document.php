<?php

namespace Bsale;


class Document extends Bsale{

	private $data;

	private $response = null;

	function __construct($token = null){
		parent::__construct($token);
		$data = array(
			'client'=>null,
			'details'=>array(),
			'emissionDate'=>time(),
			'expirationDate'=>time(),
			'declareSii'=>1
		);
		return $this;
	}

	function setClient($client){
//		$client = new Client($client)->get();
		$this->data['client'] = $client;
		return $this;
	}

	function setDocumentType($documentType){
		$this->data['documentTypeId'] = $documentType;
		return $this;
	}

	function setDeclareSII($declare){
		$this->data['declareSii'] = $declare;
		return $this;
	}

	function setEmissionDate($ts){
		if(!is_numeric($ts)){
			$ts = strtotime($date);
		}
		$this->data['emissionDate'] = $date;
		return $this;
	}

	function setExpirationDate($ts){
		if(!is_numeric($ts)){
			$ts = strtotime($date);
		}
		$this->data['expirationDate'] = $date;
		return $this;
	}

	function addDetail($detail){
		$this->data['details'][] = $detail;
		return $this;
	}

	function get(){
		return $this->data;
	}

	function generate(){
		$url = $this->baseUrl . '/v1/documents.json';
		$data = json_encode($this->data);

		$headers = array(
			'access_token' => $this->getToken(),
			'Accept' => 'application/json',
			'Content-Type' => 'application/json'
		);

		$request = \Requests::post($url, $headers, $data);
		if($request->body){
			$this->response = json_decode($request->body, true);
		}
		return $this;
	}

	function getGeneratedDocument(){
		return $this->response;
	}

	function getGeneratedPdf(){
		if(empty($this->response['urlPdfOriginal'])){
			return null;
		}
		$url =  $this->response['urlPdfOriginal'];
		if(empty($url)){
			return null;
		}
		$cnt = \Requests::get($url);
		return $cnt->body;
	}

}

