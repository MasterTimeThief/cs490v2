<?php
class Includes_Requests_Users extends Includes_Requests_Abstract
{
	public function __construct($options=array())
	{
		parent::__construct($options);
	}

	public function process($options=array())
	{
	
	}

	public function login($email,$password)
	{
		$url = ENDPOINT . "/login/email/{$email}/password/$password";
		$response = parent::request($url, '','GET', null);
		return $response;
	}
}
