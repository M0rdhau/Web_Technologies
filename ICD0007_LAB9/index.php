<?php
session_start();
require_once('lib/tpl.class.php');
require_once('lib/dbhandler.php');
const TEMPLATE_PATH = "templates";
$t = new Template(TEMPLATE_PATH . "/index_tpl.php");

$tableHead = ["Code", "Name", "ECTS", "Semester"];


$form = file_get_contents("static/form.php");


$courseCode = "";
$semester = "";
$sort = 0;
$ascDesc = true;

if ($_POST) {
  $courseCode = (isset($_POST['code'])) ? $_POST['code'] : "";
  $courseCode = sanitizeInput($courseCode);
  if (isset($_POST['autumn']) && isset($_POST['spring'])) {
    $semester = 3;
  } else if (isset($_POST['autumn'])) {
    $semester = 1;
  } else if (isset($_POST['spring'])) {
    $semester = 2;
  }
  $_SESSION['courseCode'] = $courseCode;
  $_SESSION['semester'] = $semester;
}



if ($_GET) {
  $sort = array_search(array_keys($_GET)[0], $tableHead);
  if(array_keys($_GET)[0] !== false){
    $courseCode = $_SESSION['courseCode'];
    $semester = $_SESSION['semester'];
    if(isset($_SESSION['sort']) && $sort === $_SESSION['sort']){
      $ascDesc = !$_SESSION['ascdesc'];
    }
    $_SESSION['ascdesc'] = $ascDesc;
    $_SESSION['sort'] = $sort;
  }
}

$courses = listCourses($semester, $courseCode, $sort, $ascDesc);

// Assign values
$t->assign("title", "Courses");
$t->assign("form", $form);
$t->assignTable("table", $courses, $tableHead);

// Render content
echo $t->render();
