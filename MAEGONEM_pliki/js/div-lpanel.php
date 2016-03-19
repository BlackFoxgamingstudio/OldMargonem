<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

$ajax_txt .= "
<div tip=£owca id=lp_nick>".$postac['nazwa']." (".$postac['poziom'].")</div>
<div style='background-position: 0pt 0px;' id=stat2><div id=stat2but onclick='lpanel();'></div>
<div id=stat2in>".$atak_fiz." ±".$atak_fiz2."<br>~".$heroatak_mag."<br>".$herosa."<br>".$heroac."<br>".$heroacm."<br></div>
</div>";

echo $ajax_txt;
exit;
?>