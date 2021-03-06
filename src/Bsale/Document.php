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
		$this->data = $data;
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
			$ts = strtotime($ts);
		}
		$this->data['emissionDate'] = $ts;
		return $this;
	}

	function setExpirationDate($ts){
		if(!is_numeric($ts)){
			$ts = strtotime($ts);
		}
		$this->data['expirationDate'] = $ts;
		return $this;
	}

	function addDetail($detail){
		$this->data['details'][] = $detail;
		return $this;
	}

	function getData(){
		return $this->data;
	}

	function generate(){
		$url = $this->_url('/v1/documents.json');
		$data = json_encode($this->data);

		$request = \Requests::post($url, $this->_prepareHeaders(), $data);
		if($request->body){
			$this->response = json_decode($request->body, true);
		}
		return $this;
	}

	function load($id){
		$url = $this->_url('/v1/documents/' . $id . '.json');
		$request = \Requests::get($url, $this->_prepareHeaders(), $get);
		if($request->body){
			$this->response = json_decode($request->body, true);
		} else {
			$this->response = null;
		}
		return $this;
	}

	function getDocument(){
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

