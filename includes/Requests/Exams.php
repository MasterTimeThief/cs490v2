<?php
class Includes_Requests_Exams extends Includes_Requests_Abstract
{
	public function __construct($options=array())
	{
		parent::__construct($options);
	}

	public function process($options=array())
	{

	}

	public function getExams()
	{
		$url = ENDPOINT . '/get_exams';
		$response = parent::request($url, '','GET', null);
		return $response;
	}

	public function getExamsByProfessorId($id)
	{
		$url = ENDPOINT . '/get_exams_by_professor_id/' . $id;
		$response = parent::request($url, '','GET', null);
		return $response;
	}

	public function getExamById($id)
	{
		$url = ENDPOINT . '/get_exam_by_id/'. $id;
		$response = parent::request($url, '','GET', null);
		return $response;
	}

	public function addExam($data)
	{
		$url = ENDPOINT . '/add_exam';
		$response = parent::request($url, '','POST', $data);
		return $response;
	}
	
	public function addQuestionsToExam($data)
	{
		$url = ENDPOINT . '/add_questions_to_exam';
		$response = parent::request($url, '','POST', $data);
		return $response;
	}
	
	public function updateExam($data)
	{
		$url = ENDPOINT . '/update_exam';
		$response = parent::request($url, '','POST', $data);
		return $response;
	}
}