<?php
class Includes_Requests_Categories extends Includes_Requests_Abstract
{
	public function __construct($options=array())
	{
		parent::__construct($options);
	}
	
	public function process($options=array())
	{
		
	}
	
	public function getCategories()
	{
		$url = ENDPOINT . '/get_categories';
		$response = parent::request($url, '','GET, null');
		return $response;
	}
}