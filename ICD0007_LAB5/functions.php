<?php
const ARRIVAL_FILE = "data/arrivals.dfile";

function showData($toDisplayArray)
{
  echo "<table id=\"infoTable\">";
  echo"<tr>";
  echo "<th>Salutation</th>";
  echo "<th>First Name</th>";
  echo "<th>Middle Name</th>";
  echo "<th>Last Name</th>";
  echo "<th>Age</th>";
  echo "<th>Email</th>";
  echo "<th>Phone</th>";
  echo "<th>Arrival</th>";
  echo "</tr>";
  echo"<tr>";
  foreach ($toDisplayArray as $datlet) {
    // foreach($datlet as $elem){
      echo "<td>{$datlet}</td>";
    // }
  }
  echo "</tr>";
  "</table>";
}

function countLines($filename)
{
  $numLines = 0;
  if (file_exists(ARRIVAL_FILE)) {
    $handle = fopen($filename, "r");
    while (!feof($handle)) {
      fgets($handle);
      $numLines++;
    }
    fclose($filename);
  }
  return $numLines;
}

function getContentFromLine($line)
{
  $pipePos = strpos($line, '|');
  $dataArr = array();
  while ($pipePos !== false) {
    $strtopush = urldecode(substr($line, 0, $pipePos));
    array_push($dataArr, $strtopush);
    $line = substr($line, $pipePos + 1);
    $pipePos = strpos($line, '|');
  }
  return $dataArr;
}

function readData()
{
  if (file_exists(ARRIVAL_FILE)) {
    $arrivalArray = array();
    $handle = fopen(ARRIVAL_FILE, 'r');
    while (!feof($handle)) {
      array_push($arrivalArray, getContentFromLine(fgets($handle)));
    }
    return $arrivalArray;
  }
}
