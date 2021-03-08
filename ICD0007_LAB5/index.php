<?php
require_once("submissionsScript.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="description" content="Tallinn University of Technology – Web Technologies - Learning PHP">
	<meta name="keywords" content="ICD0007, LAB05, CSS">
	<title>LAB05 - PHP form handling</title>

<body>
	<div>
		<?php
		require_once("form.html");
		?>
	</div>
	<div>
		<?php
		showData();
		?>
	</div>
</body>

</html>