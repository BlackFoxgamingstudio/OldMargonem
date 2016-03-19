<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$grupa = mysql_fetch_array(mysql_query("select * from grupa where postac_id = ".$postac['id']." limit 1"));

if(!empty($grupa)){
if($_POST['id2'] <= 0) require_once('walka-pojedyncza-grupa.php');
else require_once('walka-grupowa-grupa.php');
} else {
if($_POST['id2'] <= 0) require_once('walka-pojedyncza.php');
else require_once('walka-grupowa.php');
}
?>