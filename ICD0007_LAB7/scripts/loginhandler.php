<?php
session_start();
require_once('./scripts/person.class.php');

const FILE_NAME = './data/registrar.csv';

if(!$_POST && $_SESSION){
  if(isset($_SESSION['pin'])){
    echo "<h1>Your pin is {$_SESSION['pin']}</h1>";
  }
}

function getData(){
  if(file_exists(FILE_NAME)){
    $persons = array();
    $handle = fopen(FILE_NAME, 'rb');
    while(!feof($handle)){
      $line = fgetcsv($handle, 1000, '|');
      $person = new Person($line[1], $line[2], $line[3]);
      $persons[intval($line[0])] = $person;
    }
    fclose($handle);
    return $persons;
  }else{
    return false;
  }
}


if($_POST && isset($_POST['pin'])){
  $data = getData();
  if(!$data){
    echo "<h1>No entries in the database, please register!</h1>";
  }else{
    $pin = intval($_POST['pin']);
    if(array_key_exists($pin, $data)){
      $_SESSION['name'] = $data[$pin]->name;
      $_SESSION['age'] = $data[$pin]->age;
      $_SESSION['location'] = $data[$pin]->location;
    }else{
      echo "<h1>No matching pins in the database, please register!</h1>";
    }
  }
}