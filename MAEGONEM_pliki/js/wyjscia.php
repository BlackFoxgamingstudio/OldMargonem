<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

while($mp = mysql_fetch_array($mapa_przenies)){
$tpx = (($mp['x'] - $postac['x']) * 32) + 240;
$tpy = (($mp['y'] - $postac['y']) * 32) + 240;

$mapka = mysql_fetch_array(mysql_query("select * from mapa where id = ".$mp['do_mapa']." limit 1"));

$ajax_txt .= "
<style>
#mp_".$mp['id']." {
	position:absolute;
	z-index:390;
	display:none;
	padding:3px;
}
</style>

<div onmouseover=pokaz_npc('mp_".$mp['id']."'); onmouseout=schowaj_npc('mp_".$mp['id']."'); style='background-image: url(game_data/obrazki/interface/exit.png); display: block;
width: 32px; height: 32px; position: absolute; left: ".$tpx."px; top: ".$tpy."px; z-index: 29;' id=wyjscie></div>

<div style='display: none; top: ".($tpy + 20)."px; left: ".($tpx + 20)."px;' class='ctip tip' id=mp_".$mp['id'].">
".$mapka['nazwa']."</div>
";

}



$npcall = mysql_query("select * from npc where mapa = ".$postac['mapa']." ");
while($npc = mysql_fetch_array($npcall)){
$tpx = (($npc['x'] - $postac['x']) * 32) + 240;
$tpy = (($npc['y'] - $postac['y']) * 32) + 240;

$dodatkowykod = "";
if($npc['shop'] > 0) $dodatkowykod .= "onclick=sklep_pokaz(".$npc['shop'].");";
$ajax_txt .= "

<style>
#npc_".$npc['id']." {
	position:absolute;
	z-index:390;
	display:none;
	padding:3px;
}
#npc_".$npc['id']." B.att {
	color:#ec0;
	display:inline;
}
#npc_".$npc['id']." B.att2 {
	color:red;
	display:inline;
}
#npc_".$npc['id']." B.upgraded {
	color:#FD0;
}
#npc_".$npc['id']." B.unique {
	color:#DAA520;
}
#npc_".$npc['id']." B.heroic {
	color:#2090FE;
}
#npc_".$npc['id']." B.legendary {
	color:#FA9A20;
}
#npc_".$npc['id']." B.artefact {
	color:#f0032a;
}
#npc_".$npc['id']." B.expires {
	display:block;
	color:red;
}
</style>

<a href=# onmouseover=pokaz_npc('npc_".$npc['id']."'); onmouseout=schowaj_npc('npc_".$npc['id']."'); ".$dodatkowykod."><div style='background-image: url(".$npc['obrazek']."); display: block;
 position: absolute; width: ".$npc['szerokosc']."px; height: ".$npc['dlugosc']."px; left: ".$tpx."px; top: ".$tpy."px; z-index: 29;'></div></a>

<div style='display: none; top: ".($tpy + 15)."px; left: ".($tpx + 15)."px;' class='ctip tip_npc' id=npc_".$npc['id'].">
<b>".$npc['nazwa']."</b>
<span>Lvl: ".$npc['poziom']."</span>";
if($npc['typ'] == 0) $ajax_txt .= "";
if($npc['typ'] == 1) $ajax_txt .= "<i>elita</i>";
if($npc['typ'] == 2) $ajax_txt .= "<i>elita II</i>";
if($npc['typ'] == 3) $ajax_txt .= "<i>elita III</i>";
if($npc['typ'] == 4) $ajax_txt .= "<i>heros</i>";
$ajax_txt .= "</div>";

}

$npcall = mysql_query("select * from mob where mapa = ".$postac['mapa']." and zycie > 0 and respawn <= ".$czas_ogolny." ");
while($npc = mysql_fetch_array($npcall)){
$tpx = (($npc['x'] - $postac['x']) * 32) + 240;
$tpy = (($npc['y'] - $postac['y']) * 32) + 240;

if($npc['grupa'] == 0) $grupa = "";
elseif($npc['grupa'] > 0) $grupa = "(grp)";

$ajax_txt .= "

<style>
#mob_".$npc['id']." {
	position:absolute;
	z-index:390;
	display:none;
	padding:3px;
}
#mob_".$npc['id']." B.att {
	color:#ec0;
	display:inline;
}
#mob_".$npc['id']." B.att2 {
	color:red;
	display:inline;
}
#mob_".$npc['id']." B.upgraded {
	color:#FD0;
}
#mob_".$npc['id']." B.unique {
	color:#DAA520;
}
#mob_".$npc['id']." B.heroic {
	color:#2090FE;
}
#mob_".$npc['id']." B.legendary {
	color:#FA9A20;
}
#mob_".$npc['id']." B.artefact {
	color:#f0032a;
}
#mob_".$npc['id']." B.expires {
	display:block;
	color:red;
}
</style>

<a href=# onmouseover=pokaz_npc('mob_".$npc['id']."'); onmouseout=schowaj_npc('mob_".$npc['id']."'); onclick=walcz('".$npc['id']."','".$npc['grupa']."');><div style='background-image: url(".$npc['obrazek']."); display: block;
 position: absolute; width: ".$npc['szerokosc']."px; height: ".$npc['dlugosc']."px; left: ".$tpx."px; top: ".$tpy."px; z-index: 29;'></div></a>

<div style='display: none; top: ".($tpy + 15)."px; left: ".($tpx + 15)."px;' class='ctip tip_npc' id=mob_".$npc['id'].">
<b>".$npc['nazwa']."</b>
<span>Lvl: ".$npc['poziom']." ".$grupa."</span>";
if($npc['typ'] == 0) $ajax_txt .= "";
if($npc['typ'] == 1) $ajax_txt .= "<i>elita</i>";
if($npc['typ'] == 2) $ajax_txt .= "<i>elita II</i>";
if($npc['typ'] == 3) $ajax_txt .= "<i>elita III</i>";
if($npc['typ'] == 4) $ajax_txt .= "<i>heros</i>";
$ajax_txt .= "</div>";

}

$npcall = mysql_query("select * from postac where mapa = ".$postac['mapa']." and zalogowany = 1 and id != ".$postac['id']." ");
while($npc = mysql_fetch_array($npcall)){
$tpx = (($npc['x'] - $postac['x']) * 32) + 240;
$tpy = (($npc['y'] - $postac['y']) * 32) + 240;

$ajax_txt .= "

<style>
#postac_".$npc['id']." {
	position:absolute;
	z-index:390;
	display:none;
	padding:3px;
}
#postac_".$npc['id']." B.att {
	color:#ec0;
	display:inline;
}
#postac_".$npc['id']." B.att2 {
	color:red;
	display:inline;
}
#postac_".$npc['id']." B.upgraded {
	color:#FD0;
}
#postac_".$npc['id']." B.unique {
	color:#DAA520;
}
#postac_".$npc['id']." B.heroic {
	color:#2090FE;
}
#postac_".$npc['id']." B.legendary {
	color:#FA9A20;
}
#postac_".$npc['id']." B.artefact {
	color:#f0032a;
}
#postac_".$npc['id']." B.expires {
	display:block;
	color:red;
}
</style>

<a href=# onclick=pvp(".$npc['id'].",".$npc['grupa']."); onmouseover=pokaz_npc('postac_".$npc['id']."'); onmouseout=schowaj_npc('postac_".$npc['id']."');><div style='background-image: url(".$npc['obrazek']."); display: block;
 position: absolute; width: 32px; height: 48px; left: ".$tpx."px; top: ".$tpy."px; z-index: 29;'></div></a>

<div style='display: none; top: ".($tpy + 15)."px; left: ".($tpx + 15)."px;' class='ctip tip' id=postac_".$npc['id'].">
<b>".$npc['nazwa']."</b>
<span>Lvl: ".$npc['poziom']."</span>";
$ajax_txt .= "</div>";

}

echo $ajax_txt;
exit;
?>