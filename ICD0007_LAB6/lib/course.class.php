<?php
require_once("courseactions.class.php");
class Course
{
  public $code;
  public $name;
  public $ects;
  public $term;

  private function getContentFromLine($line)
  {
    $pipePos = strpos($line, ';');
    $dataArr = array();
    while ($pipePos !== false) {
      $strtopush = substr($line, 0, $pipePos);
      array_push($dataArr, $strtopush);
      $line = substr($line, $pipePos + 1);
      $pipePos = strpos($line, ';');
    }
    array_push($dataArr, $line);
    return $dataArr;
  }

  function __construct($line)
  {
    $values = $this->getContentFromLine($line);
    $this->code = $values[0];
    $this->name = $values[1];
    $this->ects = $values[2];
    $this->term = $values[3];
  }
}
?>