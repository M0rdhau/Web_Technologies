<?php
require_once('./scripts/cookiehandler.php');
require_once('./scripts/loginhandler.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Lab 7</title>
  <link rel="stylesheet" href="styles/forms.css">
</head>

<body>
  <?php
  echo "Name: " . $_COOKIE['ctransient'] . "<br>";
  echo "Short time count: " . $shortTimeCookie . "<br>";
  echo "Long time count: " . $longTimeCookie . "<br>";
  require_once('./static/loginform.html');
  ?>
</body>

</html>