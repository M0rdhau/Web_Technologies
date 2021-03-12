<?php
  include "incl/phonics.php";
  $file = "data/text.txt";

  function hasValue($value, &$array){
    for($i = 0; $i < count($array); $i++)
    {
      if($array[$i] === $value)
      {
        return true;
      }
    }
    return false;
  }

  function countLines($filename)
  {
    if(!file_exists($filename)){
      echo "<h1> error - File not found </h1>";
      return;
    }
    $handle = fopen($filename, "r");
    $numLines = 0;
    while(!feof($handle))
    {
      fgets($handle);
      $numLines++;
    }
    fclose($filename);
    return $numLines;
  }


  function countNonWhitespace($filename)
  {
    if(!file_exists($filename)){
      echo "<h1> error - File not found </h1>";
      return;
    }
    $handle = fopen($filename, "r");
    $numChars = 0;
    while(!feof($handle))
    {
      $currchar = fgetc($handle);
      //can also be ord($currchar) > 40 && ord($currchar) < 177
      if(!ctype_space($currchar) && ord($currchar) !== 0)
      {
        $numChars++;
      }
    }
    return $numChars;
  }

  function phonicsCount($filename){
    if(!file_exists($filename)){
      echo "<h1> error - File not found </h1>";
      return;
    }
    global $vowels;
    $handle = fopen($filename, "r");
    $numVowels = ["A" => 0, "E" => 0, "I" => 0, "O" => 0, "U" => 0];
    while(!feof($handle))
    {
      $charToCheck = fgetc($handle);
      if(hasValue(strtoupper($charToCheck), $vowels))
      {
        $numVowels[strtoupper($charToCheck)]++;
      }
    }
    return $numVowels;
  }


  echo "Number of Vowels: " . "\n";
  print_r(phonicsCount($file));
  echo "Number of Non-Whitespace Characters: " . countNonWhitespace($file) . "\n";
  echo "Number of Lines: " . countLines($file) . "\n";
?>