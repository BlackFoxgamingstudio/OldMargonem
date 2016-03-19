<?php
$u = mysql_fetch_array(mysql_query("select * from umiejetnosci where postac_id = ".$postac['id']." limit 1"));
if(!empty($u)){
if($u['u1'] == 1) $skil[1] = array(ilosc => 356);
elseif($u['u1'] == 2) $skil[1] = array(ilosc => 523);
elseif($u['u1'] == 3) $skil[1] = array(ilosc => 791);
elseif($u['u1'] == 4) $skil[1] = array(ilosc => 1026);
elseif($u['u1'] == 5) $skil[1] = array(ilosc => 1368);
elseif($u['u1'] == 6) $skil[1] = array(ilosc => 1733);
elseif($u['u1'] == 7) $skil[1] = array(ilosc => 2108);
elseif($u['u1'] == 8) $skil[1] = array(ilosc => 2514);
elseif($u['u1'] == 9) $skil[1] = array(ilosc => 2969);
elseif($u['u1'] == 10) $skil[1] = array(ilosc => 3413);
//$postac['zycie_max'] += $skil[1][ilosc];

if($u['u2'] == 1) $skil[2] = array(ilosc => 0.05);
elseif($u['u2'] == 2) $skil[2] = array(ilosc => 0.10);
elseif($u['u2'] == 3) $skil[2] = array(ilosc => 0.15);
//$postac['obrazenia_min'] = (int)($postac['obrazenia_min'] * ($skil[2][ilosc] + 1));
//$postac['obrazenia_max'] = (int)($postac['obrazenia_max'] * ($skil[2][ilosc] + 1));

if($u['u3'] == 1) $skil[3] = array(ilosc => 0.1);
elseif($u['u3'] == 2) $skil[3] = array(ilosc => 0.2);
elseif($u['u3'] == 3) $skil[3] = array(ilosc => 0.3);
elseif($u['u3'] == 4) $skil[3] = array(ilosc => 0.4);
elseif($u['u3'] == 5) $skil[3] = array(ilosc => 0.5);
//$herosilazycie += $skil[3][ilosc];

$heromana += ($u['u4'] * 10);

if($u['u5'] == 1) $skil[5] = array(ilosc => 2);
elseif($u['u5'] == 2) $skil[5] = array(ilosc => 4);
elseif($u['u5'] == 3) $skil[5] = array(ilosc => 6);
//$herock += $skil[5][ilosc];

if($u['u6'] == 1) $skil[6] = array(poziom => 25, ilosc => 10);
elseif($u['u6'] == 2) $skil[6] = array(poziom => 30, ilosc => 20);
elseif($u['u6'] == 3) $skil[6] = array(poziom => 35, ilosc => 30);
elseif($u['u6'] == 4) $skil[6] = array(poziom => 40, ilosc => 40);
elseif($u['u6'] == 5) $skil[6] = array(poziom => 45, ilosc => 50);
elseif($u['u6'] == 6) $skil[6] = array(poziom => 50, ilosc => 60);
//$postac['sa'] += $skil[6][ilosc];

$heroenergy += ($u['u7'] * 10);

$postac['ckf'] += ($u['u8'] * 3);
$postac['ckm'] += ($u['u9'] * 3);

$heroogluszenie = ($u['u10'] * 5);
} else {
mysql_query("insert into umiejetnosci (postac_id) value ('".$postac['id']."')");
}
?>