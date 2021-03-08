<?php
require_once("submissionsScript.php");
require_once("functions.php");
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
	<div>
		<?php
		require("form.php");
		?>
	</div>
	
		<?php
		if ($dataTransferred === 1) {
			echo "<div id=\"display\">";
			echo "<h1>Data Transfer Successful!</h1>";
			showData(getContentFromLine($arrivalstring));
			echo "</div>";
		} else if ($dataTransferred === 2) {
			echo "<div id=\"display\">";
			echo "<h1>Data Transfer Unsuccessful, please check input</h1>";
			echo "</div>";
		}
		?>
	
</body>

</html>