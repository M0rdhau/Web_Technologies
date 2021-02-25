<?php
error_reporting(-1);
const KM_TO_MILE = 1.60934;


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
  array_push($arrDistances, rand(1, 100));
}

print_r($arrDistances);


sort($arrDistances, SORT_REGULAR);
print_r($arrDistances);

$arrMiles = array();

for($i = 0; $i < count($arrDistances); $i++)
{
  $mileKey = getKey($arrDistances[$i], $arrMiles);
  $arrMiles[$mileKey] = $arrDistances[$i] * KM_TO_MILE;
}

print_r($arrMiles);

print("_________________\n");
print("|  Km |  Miles  |\n");

foreach($arrMiles as $km => $mile)
{
  printf("|%4d |%8.3f |\n", $km, $mile);
}
print("|_____|_________|\n");


echo "\n"
?>