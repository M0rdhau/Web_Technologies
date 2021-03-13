<?php
require_once('lib/tpl.class.php');
require_once("lib/course.class.php");
require_once("lib/courseactions.class.php");
const DATA_FILE = "data/courses.csv";
const TEMPLATE_PATH = "templates";
$t = new Template(TEMPLATE_PATH . "/index_tpl.php");

$tableHead = ["code", "name", "ECTS", "semester"];


$form = file_get_contents("static/form.html");

$courseCode = "";
$spring = false;
$autumn = false;

if ($_POST && isset($_POST['code'])) {
  session_start();
  $_SESSION["courseCode"] = $_POST['code'];
  $_SESSION["spring"] = isset($_POST['spring']);
  $_SESSION["autumn"] = isset($_POST['autumn']);
  header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
}

session_start();
$courseCode = $_SESSION["courseCode"];
$spring = $_SESSION["spring"];
$autumn = $_SESSION["autumn"];

// Assign values
$t->assign("title", "Courses");
$t->assign("form", $form);
$t->assignTable("table", CourseActions::courses(DATA_FILE, $courseCode, $spring, $autumn), $tableHead);
if(!$_POST){
  session_unset();
}

// Render content
echo $t->render();


