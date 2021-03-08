<?php
require_once("functions.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="Tallinn University of Technology – Web Technologies - Learning PHP">
  <meta name="keywords" content="ICD0007, LAB05, CSS">
  <title>LAB05 - PHP form handling</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <a href="index.php">Home</a>
    <a href="submissions.php">To Submissions</a>
  </header>
  <h1>Number of submissions: <?php echo countLines(ARRIVAL_FILE) ?></h1>
  <form method="get" target="_self" action="submissionsdownload.php">
    <button type="submit">Download Arrvials</button>
  </form>
</body>

</html>