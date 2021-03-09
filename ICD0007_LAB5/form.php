<div>
		<form id="arrivalform" action="index.php" method="post">
			<label for="salutation">Salutation: </label>
			<select id="salutation" name="salutation">
				<option value="">None</option>
				<option value="Prof.">Prof.</option>
				<option value="Sir">Sir</option>
				<option value="Dr.">Dr.</option>
				<option value="Ms.">Ms.</option>
				<option value="Mr.">Mr.</option>
				<option value="Mrs.">Mrs.</option>
			</select><br>
			<label for="firstename">First Name: </label><br>
			<input id="firstname" type="text" name="firstname" placeholder="First Name" size="12" required ><br>
			<label for="middlename">Middle Name: </label><br>
			<input id="middlename" type="text" name="middlename" placeholder="Middle Name" size="12"><br>
			<label for="lastname">Last Name: </label><br>
			<input id="lastname" type="text" name="lastname" placeholder="Last Name" size="12" required><br>
			<label for="age">Age: </label><br>
			<input id="age" type="number" name="age" size="6" min="17" value="21" required><br>
			<label for="email">Email: </label><br>
			<input id="email" type="email" name="email" placeholder="Enter a valid Email address" required><br>
			<label for="phone">Phone: </label><br>
			<input id="phone" type="tel" name="phone" pattern="[0-9]{4}[0-9]{4}" size="24" placeholder="12345678"><br>
			<label for="arrival">Arrival Date: </label><br>
			<input id="arrival" name="arrival" type="date" min="<?php echo date('Y-m-d');?>"
				max="<?php echo date('Y-m-d', time() + (30*24*60*60));?>"><br>
			<input type="submit" value="Submit">
		</form>
	</div>