<?php
$myName = "Dachi Mshvidobadze";
setCookie('ctransient', $myName);
$shortTimeCookie = 1;
$longTimeCookie = 1;
if (isset($_COOKIE['ShortTimeCount'])) {
  $shortTimeCookie = $_COOKIE['ShortTimeCount'] + 1;
}
if (isset($_COOKIE['LongTimeCount'])) {
  $longTimeCookie = $_COOKIE['LongTimeCount'] + 1;
}
setCookie('ShortTimeCount', $shortTimeCookie, time() + 120);
setCookie('LongTimeCount', $longTimeCookie, time() + 3600);


if ($_POST && isset($_POST['signup'])) {
  session_start();
  $_SESSION["signup"] = $_POST['signup'];
  header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
}

session_start();
$signup = $_SESSION["signup"];

