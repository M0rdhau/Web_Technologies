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
    $handle = fopen($filename, "r");
    $numLines = 0;
    while(!feof($handle))
    {
      fgets($handle);
      $numLines++;
    }
    return $numLines;
  }

  function countNonWhitespace($filename)
  {
    $handle = fopen($filename, "r");
    $numChars = 0;
    while(!feof($handle))
    {
      if(!ctype_space(fgetc($handle)))
      {
        $numChars++;
      }
    }
    return $numChars;
  }

  function phonicsCount($filename){
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