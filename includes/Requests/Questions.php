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
	
	public function deleteQuestionById($id)
	{
		$url = ENDPOINT . "/delete_question_by_id";
		$response = parent::request($url, '','POST', array('id'=>$id));
		return $response;
	}
	
	public function updateQuestion($data)
	{
		$url = ENDPOINT . "/update_question";
		$response = parent::request($url, '','POST', $data);
		return $response;
	}

	public function insertStudentAnswer($data)
	{
		$url = ENDPOINT . "/insert_student_answer";
		$response = parent::request($url, '','POST', $data);
		return $response;
	}
	
	public function getStudentAnswers($examId,$studentId)
	{
		$url = ENDPOINT . "/get_student_answers/exam_id/{$examId}/student_id/{$studentId}";
		$response = parent::request($url, '','GET', null);
		return $response;
	}
	
	public function addStudentGrade($data)
	{
		$url = ENDPOINT . "/add_student_grade";
		$response = parent::request($url, '','POST', $data);
		return $response;
	}
	
	public function getStudentGrade($examId,$studentId)
	{
		$url = ENDPOINT . "/get_student_grade/exam_id/{$examId}/student_id/{$studentId}";
		$response = parent::request($url, '','GET', null);
		return $response;
	}
}