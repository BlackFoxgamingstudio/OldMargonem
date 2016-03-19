<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 and typ = '".$_POST['typ']."' limit 1"));
$przedmiotow = mysql_num_rows(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 0"));

if($przedmiotow < 42){
if(!empty($dane)){
mysql_query("update przedmiot_postac set zalozony = 0 where id = ".$dane['id']." limit 1");
}
echo $dane['nazwa'];
} else echo "Masz pelny Plecak";
exit;

?>