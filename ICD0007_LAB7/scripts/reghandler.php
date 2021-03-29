<?php

const FILE_NAME = './data/registrar.csv';

session_start();

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
  if(file_put_contents(FILE_NAME, $regString, FILE_APPEND)){
    return $pin;
  }else{
    return false;
  }
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
  $pin = false;
  if($name && $age && $location){
    $pin = writeRegistered($name, $age, $location);
  }
  if($pin){
    $_SESSION["pin"] = $pin;
    header("Location: ./index.php", true, 303);
  }else{
    $_SESSION["error"] = true;
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
  }
}

if(!$_POST && $_SESSION){
  if(isset($_SESSION['error'])){
    echo "<h1>User creation unsuccessful</h1>";
  }
  session_unset();
}