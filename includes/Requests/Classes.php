<?php
class Includes_Requests_Classes extends Includes_Requests_Abstract
{
	public function __construct($options=array())
	{
		parent::__construct($options);
	}
	
	public function process($options=array())
	{
		
	}
	
	public function getClasses()
	{
		$url = ENDPOINT . '/get_classes';
		$response = parent::request($url, '','GET, null');
		return $response;
	}
	
	public function getClassById($id)
	{
		$url = ENDPOINT . '/get_class_by_id/'. $id;
		$response = parent::request($url, '','GET', null);
		return $response;
	}
	
	public function updateClass($data)
	{
		$url = ENDPOINT . '/update_class';
		$response = parent::request($url, array() ,'POST', $data);
		return $response;
	}
	
	public function deleteClassById($id)
	{
		$url = ENDPOINT . '/delete_class';
		$response = parent::request($url, array() ,'POST', array('id'=>$id));
		return $response;
	}
}