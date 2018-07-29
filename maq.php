<?php

include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'httpful.phar';

class Maq{
	// url, datatype==json:text, baseurl, data, 
	//DEPRECATED type,
	private $mUrl;
	private $mDatatype="json";
	private $mData;
	private $mType;
	private $mBaseurl;
	private $mError;
	private $mErrorCode;
	private $mJsonResult;
	private $mSuccCallback;
	private $mErrCallback;
	private $mlastRetrofit=array();

	function post($jsonData){
		$this->parseParam($jsonData);
		$data=$this->getMData();

		if($this->isJson()){
	    	$rt=Httpful\Request::post($this->getApiHome())
				->method(Httpful\Http::POST)
				->withoutStrictSsl()
				->sendsType(Httpful\Mime::FORM)
				->expectsJson()
				->body($data)
				->sendIt();
		}else{
	    	$rt=Httpful\Request::post($this->getApiHome())
				->method(Httpful\Http::POST)
				->withoutStrictSsl()
				->sendsType(Httpful\Mime::FORM)
				->body($data)
				->sendIt();
		}
		$this->setMlastRetrofit($rt);
		return $rt;
    }

	function get($jsonData){
		$this->parseParam($jsonData);
		$data=$this->getMData();

		if($this->isJson()){
	    	$rt=Httpful\Request::get($this->getApiHome())
				->withoutStrictSsl()
				->expectsJson()
				->body($data)
				->sendIt();
		}else{
	    	$rt=Httpful\Request::get($this->getApiHome())
				->withoutStrictSsl()
				->body($data)
				->sendIt();
		}

		$this->setMlastRetrofit($rt);
		return $rt;
    }

    function isJson(){
    	if($this->getMDatatype()=="json"){
    		return true;
    	}
    	return false;
    }

    function getApiHome(){
    	return $this->getMBaseurl().$this->getMUrl();
    }

	function parseParam($jsonData){
		if(!is_array($jsonData)){
			$array = json_decode($jsonData);
		}else{
			$array=$jsonData;
		}
		if(!is_null($array)){
			foreach ($array as $key => $value) {
				$key=strtolower(trim($key));
				$value=strtolower(trim($value));
				/*if($key=="type"){
					$this->setMType($value);
				}else */
				if($key=="url"){
					$this->setMUrl($value);
				}else if($key=="datatype"){
					$this->setMDatatype($value);
				}else if($key=="baseurl"){
					$this->setMBaseurl($value);
				}else if($key=="data"){
					$this->setMData($value);
				}
			}
		}
	}

	function setMlastRetrofit($mlastRetrofit) { $this->mlastRetrofit = $mlastRetrofit; }
	function getMlastRetrofit() { return $this->mlastRetrofit;}
	function getHttpJunk() { return $this->getMlastRetrofit();}
	function getHttpResponse() { return $this->getMlastRetrofit()->body;}
	function setMUrl($mUrl) { $this->mUrl = $mUrl; }
	function getMUrl() { return $this->mUrl; }
	function setMDatatype($mDatatype) { $this->mDatatype = $mDatatype; }
	function getMDatatype() { return $this->mDatatype; }
	function setMData($mData) { $this->mData = $mData; }
	function getMData() { return $this->mData; }
	function setMType($mType) { $this->mType = $mType; }
	function getMType() { return $this->mType; }
	function setMBaseurl($mBaseurl) { $this->mBaseurl = $mBaseurl; }
	function getMBaseurl() { return $this->mBaseurl; }
	function setMError($mError) { $this->mError = $mError; }
	function getMError() { return $this->mError; }
	function setMErrorCode($mErrorCode) { $this->mErrorCode = $mErrorCode; }
	function getMErrorCode() { return $this->mErrorCode; }
	function setMJsonResult($mJsonResult) { $this->mJsonResult = $mJsonResult; }
	function getMJsonResult() { return $this->mJsonResult; }
	function setMSuccCallback($mSuccCallback) { $this->mSuccCallback = $mSuccCallback; }
	function getMSuccCallback() { return $this->mSuccCallback; }
	function setMErrCallback($mErrCallback) { $this->mErrCallback = $mErrCallback; }
	function getMErrCallback() { return $this->mErrCallback; }

}
?>
