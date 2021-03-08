<?php
const ARRIVAL_FILE = "data/arrivals.dfile";

function showData()
{
  $toDisplayArray = readData();
  echo "<table id=\"infoTable\">";
  foreach ($toDisplayArray as $datlet) {
    echo"<tr>";
    foreach($datlet as $elem){
      echo "<td>{$elem}</td>";
    }
    echo "</tr>";
  }
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
?>