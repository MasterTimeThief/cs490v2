<?php
class Main_Menu
{
	private $_ProfessorsMenu = array();
	private $_StudentsMenu = array();
	
	public function __construct()
	{
		$this->_ProfessorsMenu = array(
			/*	'index' => array(
						'name'=>'Index',
						'url'=> BASE_URL . '/p/index/index.php',
						'links'=>array(
								array(
										'name'=>'Home',
										'url'=>BASE_URL . '/p/index/index.php'
								),
								array(
										'name'=>'Settings',
										'url'=>BASE_URL . '/p/index/settings.php'
								),
								array(
										'name'=>'Users',
										'url'=>BASE_URL . '/p/index/users.php'
								),
								array(
										'name'=>'Categories',
										'url'=>BASE_URL . '/p/index/categories.php'
								),
						)
				),*/
				'classes' => array(
						'name'=>'Classes',
						'url'=>BASE_URL . '/p/classes/classes.php',
						'links'=>array(
								array(
										'name'=>'Classes',
										'url'=>BASE_URL . '/p/classes/classes.php'
								),
								array(
										'name'=>'Add Class',
										'url'=>BASE_URL . '/p/classes/add_class.php'
								),
								/*array(
										'name'=>'Cancelled Class',
										'url'=>BASE_URL . '/p/classes/cancelled_classes.php'
								),*/
								array(
										'name'=>'Edit Class',
										'url'=>BASE_URL . '/p/classes/edit_class.php',
										'auto_display'=>0
								),
						)
				),
				

				'students' => array(
						'name'=>'Students',
						'url'=>BASE_URL . '/p/students/students.php',
						'links'=>array(
								array(
										'name'=>'Students',
										'url'=>BASE_URL . '/p/students/students.php'
								),
								array(
										'name'=>'Add Student',
										'url'=>BASE_URL . '/p/students/add_student.php'
								),
								array(
										'name'=>'Registration',
										'url'=>BASE_URL . '/p/students/add_classes.php',
										'auto_display'=>0
								),
								array(
										'name'=>'Edit Student',
										'url'=>BASE_URL . '/p/students/edit_student.php',
										'auto_display'=>0
								),
						)
				),
				'exams' => array(
						'name'=>'Exams',
						'url'=>BASE_URL . '/p/exams/exams.php',
						'links'=>array(
								array(
										'name'=>'Exams',
										'url'=>BASE_URL . '/p/exams/exams.php'
								),
								array(
										'name'=>'Add Exam',
										'url'=>BASE_URL . '/p/exams/add_exam.php'
								),
								array(
										'name'=>'Exam Questions',
										'url'=>BASE_URL . '/p/exams/exam_questions.php'
								),
								array(
										'name'=>'View Taken Exams',
										'url'=>BASE_URL . '/p/exams/view_taken_exams.php'
								),
								array(
										'name'=>'Edit Exam',
										'url'=>BASE_URL . '/p/exams/edit_exam.php',
										'auto_display'=>0
								),
								array(
										'name'=>'Add Question',
										'url'=>BASE_URL . '/p/exams/add_questions.php',
										'auto_display'=>0
								),
								array(
										'name'=>'View Question',
										'url'=>BASE_URL . '/p/exams/view_questions.php',
										'auto_display'=>0
								),
						)
				),
				
				'questions' => array(
						'name'=>'Questions',
						'url'=>BASE_URL . '/p/questions/questions.php',
						'links'=>array(
								array(
										'name'=>'Questions',
										'url'=>BASE_URL . '/p/questions/questions.php'
								),
								array(
										'name'=>'True or False',
										'url'=>BASE_URL . '/p/questions/true_or_false.php'
								),
								
								array(
										'name'=>'Multiple Choice',
										'url'=>BASE_URL . '/p/questions/multiple_choice.php'
								),
								
								array(
										'name'=>'Fill in the Blanks',
										'url'=>BASE_URL . '/p/questions/fill_in_the_blanks.php'
								),
								
								array(
										'name'=>'Short Answer',
										'url'=>BASE_URL . '/p/questions/short_answer.php'
								),
								
								array(
										'name'=>'Edit Question',
										'url'=>BASE_URL . '/p/questions/edit_question.php',
										'auto_display'=>0
								),
						)
				),
		);
		
		//Student Menu
		$this->_StudentsMenu = array(
				'classes' => array(
						'name'=>'Classes',
						'url'=>BASE_URL . '/s/classes/classes.php',
						'links'=>array(
								array(
										'name'=>'Classes',
										'url'=>BASE_URL . '/s/classes/classes.php'
								),
								array(
										'name'=>'Class Details',
										'url'=>BASE_URL . '/s/classes/class_details.php'
								),
						)
				),
				'exams' => array(
						'name'=>'Exams',
						'url'=>BASE_URL . '/s/exams/exams.php',
						'links'=>array(
								array(
										'name'=>'View Exams',
										'url'=>BASE_URL . '/s/exams/exams.php'
								),
								array(
										'name'=>'View Grades',
										'url'=>BASE_URL . '/s/exams/add_exam.php'
								),
								array(
										'name'=>'View Results',
										'url'=>BASE_URL . '/s/exams/view_results.php',
										'auto_display'=>0
								),
						)
				),
		);
		
		
		
	}

	function get_menu()
	{
		return $this->_ProfessorsMenu;
		//Include function to send different menu after login
	}
	
	public function get_parent($child, $type='professor')
	{
		$parent='none';
		$target = ($type=='professor') ? $this->_ProfessorsMenu :  $this->_StudentsMenu;
		foreach($target  as $index=>$item){
			// If current item is index then its a parent
			if($child==$index){
				$parent=$child;
				break;
			}
			
			foreach($item['links'] as $item=>$sublink){
				$url =$sublink['url'];
				$link = substr($url, strrpos($url, '/') + 1);
				$sublink = substr($link, 0 , strpos($link,'.'));
				if($sublink==$child){
					$parent=$index;
				}
			}
			
			
		}
		return $parent;
	}
	
	public function get_student_menu()
	{
		return $this->_StudentsMenu;
	}
} // Main Menu
