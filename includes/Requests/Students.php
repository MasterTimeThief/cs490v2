<?php
class Includes_Requests_Students extends Includes_Requests_Abstract
{
	public function __construct($options=array())
	{
		parent::__construct($options);
	}
	
	public function process($options=array())
	{
	
	}
	
	public function getStudents()
	{
		$url = ENDPOINT . '/get_students';
		$response = parent::request($url, '','GET, null');
		return $response;
	}
}
