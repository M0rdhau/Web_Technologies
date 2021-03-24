<?php

const FILE_NAME = '../data/registrar.csv';

function simplecheck($str, $pat)
{
  if (preg_match($pat, $str)) {
    return urlencode($str);
  }
  return false;
}

function getPins()
{
  $handle = fopen(FILE_NAME, 'rb');
  $pins = array();
  while (!feof($handle)) {
    $line = fgets($handle);
    $pin = substr($line, 0, strpos($line, '|') + 1);
    array_push($pins, $pin);
  }
  fclose($handle);
  return $pins;
}

function generatePin()
{
  $pinlength = rand(4, 8);
  $pins = getPins();
  $pin = "";
  do {
    for ($i = 0; $i < $pinlength; $i++) {
      $pin .= strval(rand(8));
    }
  } while (array_search($pin, $pins));
  return $pin;
}

$unicodePattern = "/^[^@ \t\r\n0-9]+$/";
$agePattern = "/^1?[0-9]{0,2}$/";

if ($_POST && isset(
  $_POST['name'],
  $_POST['age'],
  $_POST['city']
)) {
  session_unset('signup');
  session_start();
  $_SESSION["name"] = simplecheck($_POST['name'], $unicodePattern);
  $_SESSION["age"] = simplecheck($_POST['age'], $agePattern);
  $_SESSION["city"] = simplecheck($_POST['city'], $unicodePattern);
  header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
}

if ($_SESSION && isset(
  $_SESSION["name"],
  $_SESSION["age"],
  $_SESSION["city"]
)){
  $name = $_SESSION["name"];
  $age = $_SESSION["age"];
  $city = $_SESSION["city"];
  echo "something happened";
    $pin = generatePin();
    $regString =  $pin . "|" . $name . "|" . $age . "|" . $city;
    echo "<h1>Your pin is: {$pin}</h1>";
    file_put_contents(FILE_NAME, $regString, FILE_APPEND);
}

