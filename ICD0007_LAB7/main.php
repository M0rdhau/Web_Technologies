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
          $_SESSION['location']
        )) {
          if(isset($_GET['reset'])){
            $_SESSION['requestcount'] = 0;
          }else if(isset($_GET['logout'])){
            session_destroy();
            session_unset();
            header("Location: ./index.php", true, 303);
          }
          $_SESSION['requestcount'] = (!$_SESSION['requestcount']) ? 1 : intval($_SESSION['requestcount']) + 1;
          echo "Name: " . urldecode($_SESSION['name']) . "<br>";
          echo "Age: " . urldecode($_SESSION['age']) . " <br>";
          echo "Location: " . urldecode($_SESSION['location']) .  "<br>";
          echo "Request count: " . $_SESSION['requestcount'] . "<br>";
        }else{
          echo "No valid user session found, please <a href='./index.php'>Log in</a>";
          if(isset($_GET['logout'])){
            header("Location: ./index.php", true, 303);
          }
        }
        ?>
      </p>
      <div id="formfields">
        <form id="resetform" action="main.php" method="GET">
          <input id="reset" name="reset" type="submit" value="Reset">
        </form>
        <form id="logoutform" action="main.php" method="GET">
          <input id="logout" name="logout" type="submit" value="Log Out">
        </form>
        <form id="cookies" action="cookieinfo.php" method="GET">
          <input id="cookies" name="cookies" type="submit" value="Show Cookies">
        </form>
      </div>
    </div>
  </div>
</body>

</html>