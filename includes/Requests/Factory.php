<?php

class Includes_Requests_Factory
{
	public function __construct()
	{
		// Nothing here
	}
	
	public static function create($request_type, $options=array())
	{
		$request_type = strtolower($request_type);
		$request = null;
		switch($request_type)
		{
			case 'exams':
				$request = new Includes_Requests_Exams($options);
				break;
			case 'students':
				$request = new Includes_Requests_Students($options);
				break;
			case 'classes':
				$request = new Includes_Requests_Classes($options);
				break;
			case 'questions':
				$request = new Includes_Requests_Questions($options);
				break;
			case 'index':
				$request = new Includes_Requests_Index($options);
				break;
			case 'categories':
				$request = new Includes_Requests_Categories($options);
				break;
			case 'users':
				$request = new Includes_Requests_Users($options);
				break;
			default:
				break;
		}
		return  $request;
	}
}