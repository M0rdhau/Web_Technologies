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

function sanitizeSemester($sem){
  $sem = sanitizeInput($sem);
  $sem = (preg_match("/^[1-3]$/", $sem)) ? $sem : "";
  return $sem;
}

function listCourses($semester = "", $keyword = "", $sort=0, $ascending=true)
{
  $sortKeyWords = [ "course_code", "course_name", "ects_credits", "semester_name" ];
  $ascDesc = ($ascending) ? "ASC" : "DESC";
  $semester = sanitizeSemester($semester);
  $semesterQuery = ($semester === "") ? "" : "AND C.Semesters_ID = {$semester}";
  try {
    $courses = array();
    $pdo = new PDO('mysql:host=' . SERVER_ADDRESS . ';dbname=' . DATABASE_NAME, USER_NAME, USER_PASSORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($semester === "" && $keyword === "") {
      $query = $pdo->prepare("SELECT C.course_code, C.course_name, C.ects_credits, N.semester_name
      FROM courses_201818 C INNER JOIN semesters_201818 N ON N.ID=C.Semesters_ID
      ORDER BY {$sortKeyWords[$sort]} {$ascDesc}");
    } else{
      $keyword = $pdo->quote("%" . sanitizeInput($keyword) . "%");
      $query = $pdo->prepare(
        "SELECT C.course_code, C.course_name, C.ects_credits, N.semester_name
        FROM courses_201818 C INNER JOIN semesters_201818 N ON N.ID=C.Semesters_ID
        WHERE C.course_code LIKE {$keyword} {$semesterQuery}

        UNION

        SELECT C.course_code, C.course_name, C.ects_credits, N.semester_name
        FROM courses_201818 C INNER JOIN semesters_201818 N ON N.ID=C.Semesters_ID
        WHERE C.course_name LIKE {$keyword} {$semesterQuery}
        AND NOT EXISTS(
          SELECT C.course_code, C.course_name, C.ects_credits, N.semester_name
          FROM courses_201818 C INNER JOIN semesters_201818 N ON N.ID=C.Semesters_ID
          WHERE C.course_code LIKE {$keyword} {$semesterQuery}
        )
        ORDER BY {$sortKeyWords[$sort]} {$ascDesc}
        "
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
