<?php
if($_SESSION && isset($_SESSION['name'])){
  $myName = $_SESSION['name'];
  setCookie('ctransient', $myName, 0, '/~damshv/');
}
$shortTimeCookie = 1;
$longTimeCookie = 1;
if (isset($_COOKIE['ShortTimeCount'])) {
  $shortTimeCookie = $_COOKIE['ShortTimeCount'] + 1;
}
if (isset($_COOKIE['LongTimeCount'])) {
  $longTimeCookie = $_COOKIE['LongTimeCount'] + 1;
}
setCookie('ShortTimeCount', $shortTimeCookie, time() + 120, '/~damshv/');
setCookie('LongTimeCount', $longTimeCookie, time() + 3600, '/~damshv/');



