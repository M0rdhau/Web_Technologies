<?php
require_once('connect.db.php');
require_once('course.class.php');
require_once('semester.class.php');

function sanitizeInput($input){
  $input = stripslashes($input);
  $input = htmlentities($input);
  $input = strip_tags($input);
  return $input;
}

function listCourses($semester = "", $keyword = "")
{
  try {
    $courses = array();
    $pdo = new PDO('mysql:host=' . SERVER_ADDRESS . ';dbname=' . DATABASE_NAME, USER_NAME, USER_PASSORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "PDO: Connected to db successfully \n";
    if ($semester === "" && $keyword === "") {
      $query = $pdo->prepare("SELECT C.course_code, C.course_name, C.ects_credits, N.semester_name
      FROM courses_201818 C INNER JOIN semesters_201818 N ON N.ID=C.Semesters_ID
      ORDER BY C.ects_credits DESC");
    } else if (
      $semester === "1" ||
      $semester === "2" ||
      $semester === "3"
    ) {
      $query = $pdo->prepare(
        "SELECT C.course_code, C.course_name, C.ects_credits, N.semester_name
        FROM courses_201818 C INNER JOIN semesters_201818 N ON N.ID=C.Semesters_ID
        WHERE C.Semesters_ID = {$semester}
        ORDER BY C.ects_credits DESC"
      );
    }else{
      $keyword = $pdo->quote("%" . sanitizeInput($keyword) . "%");
      $query = $pdo->prepare(
        "SELECT C.course_code, C.course_name, C.ects_credits, N.semester_name
        FROM courses_201818 C INNER JOIN semesters_201818 N ON N.ID=C.Semesters_ID
        WHERE C.course_code LIKE {$keyword} OR
        C.course_name LIKE {$keyword}
        ORDER BY C.ects_credits DESC"
      );
    }
    $query->execute();
    $query->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $query->fetch()) {
      array_push($courses, new Course($row["course_code"], $row["course_name"], $row["ects_credits"], $row["semester_name"]));
    }
    return $courses;
  } catch (PDOException $e) {
    echo "Connection to databste failed: " . $e->getMessage();
  }

  $pdo = null;
}

function listSemesters()
{
  try {
    $semesters = array();
    $pdo = new PDO('mysql:host=' . SERVER_ADDRESS . ';dbname=' . DATABASE_NAME, USER_NAME, USER_PASSORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "PDO: Connected to db successfully \n";
    $query = $pdo->prepare("SELECT ID, semester_name FROM semesters_201818");
    $query->execute();
    $query->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $query->fetch()) {
      array_push($semesters, new Semester($row["ID"], $row["semester_name"]));
    }
    return $semesters;
  } catch (PDOException $e) {
    echo "Connection to databste failed: " . $e->getMessage();
  }

  $pdo = null;
}
