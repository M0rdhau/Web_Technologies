<?php

class Course
{
  public $code;
  public $name;
  public $credits;
  public $semester;

  function __construct($code, $name, $credits, $semester){
    $this->code = $code;
    $this->name = $name;
    $this->credits = $credits;
    $this->semester = $semester;
  }
}
