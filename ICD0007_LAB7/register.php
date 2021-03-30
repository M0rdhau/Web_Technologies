<?php
require_once('./scripts/reghandler.php');
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
  if ($_SESSION && isset(
    $_SESSION['name'],
    $_SESSION['age'],
    $_SESSION['location']
  )){
    header("Location: ./main.php", true, 303);
  }
  require_once('./static/regform.html');
  ?>
</body>

</html>