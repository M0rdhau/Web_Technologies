
<?php
require_once("functions.php");

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
  $salutation = urlencode($_POST['salutation']);
  $firstname = urlencode($_POST['firstname']);
  $middlename = urlencode($_POST['middlename']);
  $lastname = urlencode($_POST['lastname']);
  $age = urlencode($_POST['age']);
  $email = urlencode($_POST['email']);
  if ($_POST['phone']) {
    $phone = urlencode($_POST['phone']);
  } else {
    $phone = "";
  }
  $arrival = urlencode($_POST['arrival']);
  $arrivalstring = $salutation . "|" . $firstname . "|"
    . $middlename . "|" . $lastname . "|" . $age . "|"
    . $email . "|" .  $phone . "|" . $arrival . "\n";
  file_put_contents(ARRIVAL_FILE, $arrivalstring, FILE_APPEND);
}
?>