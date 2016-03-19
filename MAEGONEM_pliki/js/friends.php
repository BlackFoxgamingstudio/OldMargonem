<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

if(empty($_POST['nazwa'])){
$przyjaciele = mysql_query("select * from przyjaciele where postac = ".$postac['id']." or przyjaciel = ".$postac['id']." order by przyjaciel asc");

$ajax_txt .= "<div class=frbox>";

while($lista = mysql_fetch_array($przyjaciele)){
if($lista['przyjaciel'] != $postac['id']) $fr = mysql_fetch_array(mysql_query("select * from postac where id = ".$lista['przyjaciel']." limit 1"));
elseif($lista['postac'] != $postac['id']) $fr = mysql_fetch_array(mysql_query("select * from postac where id = ".$lista['postac']." limit 1"));
$dod_kod = "";
$fr_map = mysql_fetch_array(mysql_query("select * from mapa where id = ".$fr['mapa']." limit 1"));
if($fr['zalogowany'] == 0) $dod_kod = "<small style='color: rgb(159, 159, 159);'>(offline)</small>";
if($fr['zalogowany'] == 1) $dod_kod = "<small style='color: rgb(0, 255, 0);'>(online)</small>"; 
$ajax_txt .= "
<div class=frchar style='background-image: url(".$fr['obrazek'].");'></div>
<div class=delfr rollover=22></div>
<div class=chatfr rollover=22></div>
<b>".$fr['nazwa']."(".$fr['poziom'].")</b><br>
".$dod_kod."<br>
<span class=frloc>".$fr_map['nazwa']."(".$fr['x'].",".$fr['y'].")</span></div>";
}
$ajax_txt .= "</div>";
} else {
         mysql_query("insert into zapro_przyjaciel (postac_id,postac2_id) values ('".$postac['id']."','".$zaproszony['id']."')");
}
echo $ajax_txt;

?>