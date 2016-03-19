<?php
require_once('../php/mysql-connect.php');

$l = mysql_query("select * from postac order by id asc");
?>

<center>
<form action='logowanie.php'>
<select name="postac">
<?php
while($m = mysql_fetch_array($l)){
echo "<option value='".$m['id']."'>";
}
?>
</select><br>
Haslo<br>
<input type='submit' value='Zaloguj'><br>
</form>
</center>