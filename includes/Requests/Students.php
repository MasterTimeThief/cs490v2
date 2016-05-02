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
		$response = parent::request($url, '','GET', null);
		return $response;
	}

	public function addStudent($data)
	{
		$url = ENDPOINT . '/add_student';
		$response = parent::request($url, array() ,'POST', $data);
		return $response;
	}

	public function updateStudent($data)
	{
		$url = ENDPOINT . '/update_student';
		$response = parent::request($url, '','POST', $data);
		return $response;
	}
	
	public function getStudentById($id)
	{
		$url = ENDPOINT . "/get_student_by_id/$id";
		$response = parent::request($url, '','GET', null);
		return $response;
	}
	
	public function deleteStudentById($id)
	{
		$url = ENDPOINT . "/delete_student_by_id/$id";
		$response = parent::request($url, '','POST', null);
		return $response;
	}
	
	public function getGradedExamsByStudentId($id)
	{
		$url = ENDPOINT . "/get_graded_exams_by_student_id/$id";
		$response = parent::request($url, '','GET', null);
		return $response;
	}
}
