<?php
require_once('lib/tpl.class.php');
require_once("CoursesClass.php");
const TEMPLATE_PATH = "templates";

$t = new Template(TEMPLATE_PATH . "/index_tpl.php");

$tableHead = ["code", "name", "points", "semester"];


$form = "";

// Assign values
$t->assign("title", "Courses");
$t->assign("form", $form);
$t->assignTable("table", "", $tableHead);

// Render content
echo $t->render();
?>