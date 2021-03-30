<?php
session_start();
require_once('./scripts/cookiehandler.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Lab 7</title>
  <link rel="stylesheet" href="styles/forms.css">
</head>

<body>
  <div id="formparent">
    <h1>Citizen Info</h1>
    <div id="citizenform">
      <p>
        <?php
        if ($_SESSION && isset(
          $_SESSION['name'],
          $_SESSION['age'],
          $_SESSION['location'],
          $_GET['cookies']
        )) {
          $_SESSION['requestcount'] = (!$_SESSION['requestcount']) ? 1 : intval($_SESSION['requestcount']) + 1;
          echo "Name: " . urldecode($_COOKIE['ctransient']) . "<br>";
          echo "Short time count: " . $shortTimeCookie . "<br>";
          echo "Long time count: " . $longTimeCookie . "<br>";
        }else{
          echo "No valid user session found, please <a href='./index.php'>Log in</a>";
        }
        ?>
      </p>
      <div id="formfields">
        <form id="goback" action="main.php" method="GET">
          <input type="submit" value="Back">
        </form>
      </div>
    </div>
  </div>
</body>

</html>