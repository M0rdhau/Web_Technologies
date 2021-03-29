<?php
class Person
{
  public $name;
  public $age;
  public $location;

  function __construct($name, $age, $location)
  {
    $this->name = $name;
    $this->age = $age;
    $this->location = $location;
  }
}
