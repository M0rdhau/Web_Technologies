<?php
require_once('./scripts/cookiehandler.php');
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
  if($signup){
    require_once('./static/regform.html');
  }else{
    require_once('./static/loginform.html');
  }
  ?>
</body>

</html>