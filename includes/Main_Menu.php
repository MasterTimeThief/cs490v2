<?php
class Main_Menu
{
	private $_ProfessorsMenu = array();
	private $_StudentsMenu = array();
	
	public function __construct()
	{
		$this->_ProfessorsMenu = array(
				'index' => array(
						'name'=>'Index',
						'url'=>'/~wad3/p/index.php',
						'links'=>array(
								array(
										'name'=>'Home',
										'url'=>'/~wad3/p/index/index.php'
								),
								array(
										'name'=>'Settings',
										'url'=>'/~wad3/p/index/settings.php'
								),
								array(
										'name'=>'Users',
										'url'=>'/~wad3/p/index/users.php'
								),
								array(
										'name'=>'Categories',
										'url'=>'/~wad3/p/index/categories.php'
								),
						)
				),
				'classes' => array(
						'name'=>'Classes',
						'url'=>'/~wad3/p/classes/classes.php',
						'links'=>array(
								array(
										'name'=>'Classes',
										'url'=>'/~wad3/p/classes/classes.php'
								),
								array(
										'name'=>'Add Class',
										'url'=>'/~wad3/p/classes/add_class.php'
								),
								array(
										'name'=>'Cancelled Class',
										'url'=>'/~wad3/p/classes/cancelled_classes.php'
								),
								
						)
				),
				

				'students' => array(
						'name'=>'Students',
						'url'=>'/~wad3/p/students/students.php',
						'links'=>array(
								array(
										'name'=>'Students',
										'url'=>'/~wad3/p/students/students.php'
								),
								array(
										'name'=>'Add Student',
										'url'=>'/~wad3/p/students/add_student.php'
								),
						)
				),
				'exams' => array(
						'name'=>'Exams',
						'url'=>'/~wad3/p/exams/exams.php',
						'links'=>array(
								array(
										'name'=>'Exams',
										'url'=>'/~wad3/p/exams/exams.php'
								),
								array(
										'name'=>'Add Exam',
										'url'=>'/~wad3/p/exams/add_exam.php'
								),
						)
				),
				
				'questions' => array(
						'name'=>'Questions',
						'url'=>'/~wad3/p/questions/questions.php',
						'links'=>array(
								array(
										'name'=>'Questions',
										'url'=>'/~wad3/p/questions/questions.php'
								),
								array(
										'name'=>'True or False',
										'url'=>'/~wad3/p/questions/true_or_false.php'
								),
								
								array(
										'name'=>'Multiple Choice',
										'url'=>'/~wad3/p/questions/multiple_choice.php'
								),
								
								array(
										'name'=>'Fill in the Blanks',
										'url'=>'/~wad3/p/questions/fill_in_the_blanks.php'
								),
								
								array(
										'name'=>'Short Answer',
										'url'=>'/~wad3/p/questions/short_answer.php'
								),
						)
				),
		);
	}

	function get_menu()
	{
		return $this->_ProfessorsMenu;
	}
	
	public function get_parent($child)
	{
		$parent='none';
		foreach($this->_ProfessorsMenu  as $index=>$item){
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
} // Main Menu
