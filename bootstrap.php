<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'includes/Main_Menu.php';
require_once 'includes/FlashMessages.php';
require_once 'includes/custom_functions.php';

require_once 'includes/Requests/Abstract.php';
require_once 'includes/Requests/Classes.php';
require_once 'includes/Requests/Exams.php';
require_once 'includes/Requests/Questions.php';
require_once 'includes/Requests/Students.php';
require_once 'includes/Requests/Factory.php';








$menuObject = new Main_Menu();
$menu = $menuObject->get_menu();
$msg = new FlashMessages();
