<?php

abstract class Includes_Requests_Abstract
{
	protected $_config;
	protected $_logger;
	protected $_requestHeader;
	protected $_tokenId;
	protected $_response;

	/**
	 * Constructor
	 * @param array $options
	 */
	public function __construct($options = array())
	{

	}
	/**
	 * @param array $header
	 */
	public function setRequestHeader($header)
	{
		$this->_requestHeader = $header;
	}

	/**
	 * @param string $tokenId
	 */
	public function setAccessTokenId($tokenId)
	{
		$this->_tokenId = $tokenId;
	}

	/**
	 * @return array
	 */
	public function getRequestHeader()
	{
		return $this->_requestHeader;
	}

	/**
	 * @return string tokenId
	 */
	public function getAcessTokenId()
	{
		return $this->_tokenId;
	}

	/**
	 * @return array<"header","body"> response
	 */
	public function getResponse()
	{
		return $this->_response;
	}

	/**
	 * @abstract function
	 * @param array $option
	 */
	abstract function process($option);

	/**
	 * send request
	 * @param string $url
	 * @param array  $header
	 * @param string $methodType
	 * @param array  $param
	 * @param array  $option
	 * @return array $this->_response
	 */
	public function request($url = "", $header = array() , $methodType = 'GET', $param = array(), $option = array())
	{
		$curl = curl_init();

		// Request Header
		if (empty($header)){
			$header = $this->getRequestHeader();
		}

		// Options
		curl_setopt($curl, CURLOPT_URL, $url); // URL
		curl_setopt($curl, CURLOPT_HEADER, TRUE);
		//curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // HEADER
		curl_setopt($curl, CURLOPT_HTTP_VERSION, 1.1); // HTTP Version
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE);
		 
		// Post
		if ($methodType == 'POST') {
			curl_setopt($curl, CURLOPT_POST, TRUE);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
		}
		 
		// PUT
		if ($methodType == 'PUT') {
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
			if(!empty($param)){
				curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
			}
		}

		// More Options
		if (!empty($option['file']) && !empty($option['filesSize'])) {
			curl_setopt($curl, CURLOPT_UPLOAD, TRUE);
			curl_setopt($curl, CURLOPT_INFILE, $option['file']);
			curl_setopt($curl, CURLOPT_INFILESIZE, $option['filesSize']);
		}
		 
		// Execute & Response
		$response = curl_exec($curl);
		$headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		curl_close($curl);
		$this->_response['header'] = substr($response, 0, $headerSize);
		$this->_response['body'] = substr($response, $headerSize);
		return $this->_response;
	}

	/**
	 * @link https://developer.jet.com/data-flow-documentation#jet-access
	 * @return array $header
	 */
	protected function _generateRequestHeader()
	{
		$header = array();
		if (!empty($this->_tokenId)) {
			$header[] = 'Content-type: application/json';
			$header[] = 'Authorization: Bearer '.$this->_tokenId;
		}
		return $header;
	}
}
