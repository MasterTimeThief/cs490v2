<?php
class Includes_Requests_Questions extends Includes_Requests_Abstract
{
	public function __construct($options=array())
	{
		parent::__construct($options);
	}
	
	public function process($options=array())
	{
	
	}
	
	public function getQuestions()
	{
		$url = ENDPOINT . '/get_questions';
		$response = parent::request($url, '','GET', null);
		return $response;
	}
	
	public function getQuestionById($id)
	{
		$url = ENDPOINT . '/get_question_by_id/' . $id;
		$response = parent::request($url, '','GET', null);
		return $response;
	}
	
	public function getQuestionsByExamId($id)
	{
		$url = ENDPOINT . '/get_questions_by_exam_id/' . $id;
		$response = parent::request($url, '','GET', null);
		return $response;
	}
	
	public function addQuestion($data)
	{
		$url = ENDPOINT . '/add_question';
		$response = parent::request($url, '','POST', $data);
		return $response;
	}
}