<?php

const FILE_NAME = '/home/kvartzweiss/Documents/2_Semester/Web_Tech/Labs/ICD0007_LAB7/data/registrar.csv';

function simplecheck($str, $pat)
{
  if (preg_match($pat, $str)) {
    return urlencode($str);
  }
  return false;
}

function getPins()
{
  $pins = array();
  if(file_exists(FILE_NAME)){
    $handle = fopen(FILE_NAME, 'rb');
    while (!feof($handle)) {
      $line = fgets($handle);
      $pin = substr($line, 0, strpos($line, '|') + 1);
      array_push($pins, $pin);
    }
    fclose($handle);
  }
  return $pins;
}

function generatePin()
{
  $pinlength = rand(4, 8);
  $pins = getPins();
  $pin = "";
  do {
    for ($i = 0; $i < $pinlength; $i++) {
      $pin .= strval(rand(0, 8));
    }
  } while (array_search($pin, $pins));
  return $pin;
}

function writeRegistered($name, $age, $location){
  $pin = generatePin();
  $regString =  $pin . "|" . $name . "|" . $age . "|" . $location . "\n";
  echo "<h1>Your pin is: {$pin}</h1>";
  echo file_put_contents(FILE_NAME, $regString, FILE_APPEND);
}

$unicodePattern = "/^[^@ \t\r\n0-9]+$/";
$agePattern = "/^1?[0-9]{0,2}$/";

if ($_POST && isset(
  $_POST['name'],
  $_POST['age'],
  $_POST['location']
)) {
  $name = simplecheck($_POST['name'], $unicodePattern);
  $age = simplecheck($_POST['age'], $agePattern);
  $location = simplecheck($_POST['location'], $unicodePattern);
  echo "something happened";
  writeRegistered($name, $age, $location);
}

