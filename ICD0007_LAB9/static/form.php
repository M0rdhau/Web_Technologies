<form id="courseform" style="display:flex; flex-direction:row; align-items: center;" action="index.php" method="POST">
  <div>
  <label for="code">Course Code(first 3 digits or I00): </label><br>
	<input id="code" type="text" name="code" placeholder="I00 or ICA/ICD/etc.">
  </div>
  <fieldset>
    <legend>Choose semester</legend>
    <input type="checkbox" id="spring" name="spring">
    <label for="spring">Spring</label><br>
    <input type="checkbox" id="autumn" name="autumn">
    <label for="autumn">Autumn</label><br>
  </fieldset>
  <div style="display:flex; flex-direction:row; align-items: center;">
    <input type="submit" value="Search" >
  </div>
</form>
<form method="POST">
  <input type="submit" value="Reset" >
</form>
