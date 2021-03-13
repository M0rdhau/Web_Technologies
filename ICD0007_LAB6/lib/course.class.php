<?php
require_once("courseactions.class.php");
class Course
{
  public $code;
  public $name;
  public $ects;
  public $term;

  function __construct($line)
  {
    $values = CourseActions::getContentFromLine($line);
    $this->code = $values[0];
    $this->name = $values[1];
    $this->ects = $values[2];
    $this->term = $values[3];
  }
}
?>