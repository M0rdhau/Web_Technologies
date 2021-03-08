
<?php
require_once("functions.php");

function checkAge($str)
{
  $intvalue = intval($str);
  if ($intvalue === 0 || $intvalue < 17) {
    return false;
  }
  return $intvalue;
}

function simplecheck($str, $pat, $notempty)
{
  if (preg_match($pat, $str) || ($notempty && $str === "")) {
    return $str;
  }
  return false;
}
$dataTransferred = 0;
$unicodePattern = "/^([A-Za-z]|[\u00c0-\uffff]){3,}$/";
$salutePattern = "/^(Mr.|Mrs.|Prof.|Dr.|Mrs.|Sir)$/";
$datePattern = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/";
$emailPattern = "/^[\u0021-\u007a]+@[a-z]+\.[a-z]+$/";
$phonePattern = "/^[0-9]{8}$/";

if ($_POST && isset(
  $_POST['firstname'],
  $_POST['lastname'],
  $_POST['age'],
  $_POST['email'],
  $_POST['arrival']
)) {
  if (!is_dir("data")) {
    mkdir("data");
  }
  $salutation = simplecheck($_POST['salutation'], $salutePattern, true);
  $middlename = simplecheck($_POST['middlename'], $unicodePattern, true);
  $phone = simplecheck($_POST['phone'], $phonePattern, true);
  $firstname = simplecheck($_POST['firstname'], $unicodePattern, false);
  $lastname = simplecheck($_POST['lastname'], $unicodePattern, false);
  $age = checkAge($_POST['age']);
  $email = simplecheck($_POST['email'], $emailPattern, false);
  $arrival = simplecheck($_POST['arrival'], $datePattern, false);
  $arrivalstring = $salutation . "|" . $firstname . "|"
    . $middlename . "|" . $lastname . "|" . $age . "|"
    . $email . "|" .  $phone . "|" . $arrival . "|\n";
  if (
    $salutation !== false
    && $firstname !== false
    && $middlename !== false
    && $lastname !== false
    && $age !== false
    && $email !== false
    && $phone !== false
    && $arrival !== false
  ) {
    file_put_contents(ARRIVAL_FILE, $arrivalstring, FILE_APPEND);
    $dataTransferred = 1;
  } else {
    $dataTransferred = 2;
  }
}
?>