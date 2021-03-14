<?php
require_once("course.class.php");
class CourseActions
{
  public static function sortCourses($a, $b)
  {
    $aEcts = intval($a->ects);
    $bEcts = intval($b->ects);
    if ($aEcts > $bEcts) {
      return -1;
    } else if ($aEcts < $bEcts) {
      return 1;
    } else {
      return 0;
    }
  }

  public static function courses($filename, $filter, $spring, $autumn)
  {
    $dummyCourse = new Course(";No courses found;;");
    $handle = fopen($filename, 'r');
    $courses = array();
    $line = fgets($handle);
    while (!feof($handle) && $line !== "") {
      array_push($courses, new Course($line));
      $line = fgets($handle);
    }
    fclose($handle);
    $filtered = self::checkCourseCode($filter, $courses);
    if ($spring) {
      $filtered = array_filter($filtered, 'self::filterSpring');
    }
    if ($autumn) {
      $filtered = array_filter($filtered, 'self::filterAutumn');
    }
    uasort($filtered, 'self::sortCourses');
    if (count($filtered) == 0) {
      return [$dummyCourse];
    }
    return $filtered;
  }



  public static function filterSmall($course)
  {
    return preg_match("/I[0-9]{3}/", $course->code);
  }

  public static function filterAutumn($course)
  {
    return preg_match("/autumn/", $course->term);
  }

  public static function filterSpring($course)
  {
    return preg_match("/spring/", $course->term);
  }

  public static function checkCourseCode($code, &$array)
  {
    if (preg_match("/I00/i", $code)) {
      return array_filter($array, 'self::filterSmall');
    } else if(preg_match("/^[A-Z][0-9]{2}$/i", $code)){
      $filtered = array();
      foreach ($array as $course) {
        if (preg_match("/" . $code . "[0-9]/i", $course->code)) {
          array_push($filtered, $course);
        }
      }
      return $filtered;
    }else if (preg_match("/^[A-Z]{3}$/i", $code)) {
      $filtered = array();
      foreach ($array as $course) {
        if (preg_match("/" . $code . "[0-9]{4}/i", $course->code)) {
          array_push($filtered, $course);
        }
      }
      return $filtered;
    }else if(preg_match("/^$/", $code)){
      return $array;
    }
  }
}
