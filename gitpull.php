<?php

  if(isset($_GET['pull'])){
    $res = shell_exec('git pull 2>&1');
    echo $res;
    echo "\n";
  }