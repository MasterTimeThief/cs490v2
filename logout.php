<?php session_start();
require_once 'bootstrap.php';
session_destroy();
header('Location: ' . BASE_URL . '/login.php');
exit;