<?php
require_once('lib/tpl.class.php');
require_once('lib/dbhandler.php');
const TEMPLATE_PATH = "templates";
$t = new Template(TEMPLATE_PATH . "/index_tpl.php");

$tableHead = ["code", "name", "ECTS", "semester"];


$form = file_get_contents("static/form.html");

$courseCode = "";
$spring = false;
$autumn = false;

if ($_POST && isset($_POST['code'])) {
  $courseCode = $_POST['code'];
  $spring = isset($_POST['spring']);
  $autumn = isset($_POST['autumn']);
}

$courses = listCourses();

// Assign values
$t->assign("title", "Courses");
$t->assign("form", $form);
$t->assignTable("table", $courses, $tableHead);

// Render content
echo $t->render();