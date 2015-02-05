<?php
var_dump($_POST);
echo "<br>";
var_dump($_GET);
?>
<br><p>
<form method = "POST" action="
<?php  echo $_SERVER['PHP_SELF']."?id=12";
?>
 ">
  <label for="male">Male</label>
  <input type="radio" name="sex" id="male" value="male"><br>
  <label for="female">Female</label>
  <input type="radio" name="sex" id="female" value="female"><br><br>
  <input type="submit" value="Submit">
</form>


