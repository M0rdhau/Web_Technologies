<?php
error_reporting(-1);
const KM_TO_MILE = 1.60934;

function make_random($each)
{
  return ($each*rand(1, 100));
}

function from_km_to_mile($each)
{
  return ($each*KM_TO_MILE);
}

function getKey($testKey, &$arr)
{
  $keyCount = 0;
  foreach($arr as $key=>$value)
  {
    $hayInt = intval($key);
    if($testKey === $hayInt)
    {
      $keyCount ++;
    }
  }
  $appendKey = ($keyCount > 0) ? chr(ord('A') + $keyCount - 1) : "";
  return $testKey . $appendKey;
}


$numOfDistances = rand(5, 20);

$arrDistances = array();

for($i = 0; $i < $numOfDistances; $i++)
{
  array_push($arrDistances, make_random(1));
}

// I wanted to use functional programming but I'm not allowed to, makes me sad
// $distance_array = array_map('make_random', array_fill(0, $len_array, 1));

print_r($arrDistances);


sort($arrDistances, SORT_REGULAR);
print_r($arrDistances);

$arrMiles = array();

for($i = 0; $i < count($arrDistances); $i++)
{
  $mileKey = getKey($arrDistances[$i], $arrMiles);
  $arrMiles[$mileKey] = from_km_to_mile($arrDistances[$i]);
}
print("______________\n");
print("| Km | Miles |\n");

foreach($arrMiles as $km => $mile)
{
  $formattedMile = number_format($mile, 3);
  $spaceOne = ($km < 100) ? ($km < 10) ? "  " : " " : "";
  $spaceTwo = (intval($km) === $km) ? " ": "";
  $spaceThree = ($formattedMile < 100) ? ($formattedMile < 10) ? "  " : " " : "";
  printf("|%s%s%s|%s%s|\n", $spaceOne, $km, $spaceTwo, $spaceThree, $formattedMile);
  
}
print("|____________|\n");


echo "\n"
?>