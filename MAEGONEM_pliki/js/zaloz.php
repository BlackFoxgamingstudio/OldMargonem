<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$dane = mysql_fetch_array(mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and id = '".$_POST['id']."' limit 1"));
if($dane['prof1'] == 1 && $postac['profesja'] == 'Wojownik') $moze_zalozyc = 1;
elseif ($dane['prof2'] == 1 && $postac['profesja'] == 'Paladyn') $moze_zalozyc = 1;
elseif ($dane['prof3'] == 1 && $postac['profesja'] == 'Tancerz Ostrzy') $moze_zalozyc = 1;
elseif ($dane['prof4'] == 1 && $postac['profesja'] == 'Lowca') $moze_zalozyc = 1;
elseif ($dane['prof5'] == 1 && $postac['profesja'] == 'Tropiciel') $moze_zalozyc = 1;
elseif ($dane['prof6'] == 1 && $postac['profesja'] == 'Mag') $moze_zalozyc = 1;
elseif ($dane['prof1'] == 0 && $dane['prof2'] == 0 && $dane['prof3'] == 0 && $dane['prof4'] == 0 && $dane['prof5'] == 0 && $dane['prof6'] == 0) $moze_zalozyc = 1;
else $moze_zalozyc = 0;

if(!empty($dane)){
if($moze_zalozyc == 1){
if($poziom >= $dane['wym_poziom']){
$zalozony = 0;
  if($dane['typ'] == 'BronJednoreczna' || $dane['typ'] == 'BronDwureczna' || $dane['typ'] == 'BronPoltorareczna' || $dane['typ'] == 'BronDystansowa' || $dane['typ'] == 'Rozdzka' || $dane['typ'] == 'Laska'){
        $z = mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 ");
        while($w = mysql_fetch_array($z)){
            if($w['typ'] == 'BronJednoreczna' || $w['typ'] == 'BronDwureczna' || $w['typ'] == 'BronPoltorareczna' || $w['typ'] == 'BronDystansowa' || $w['typ'] == 'Rozdzka' || $w['typ'] == 'Laska') $zalozony = 1;
        }
        if($dane['typ'] == 'BronDwureczna' || $dane['typ'] == 'Laska'){
        $zt = mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 ");
        while($z_t = mysql_fetch_array($zt)){
            if($z_t['typ'] == 'Tarcza' || $z_t['typ'] == 'BronPomocnicza') $zalozona_tarcza = 1;
        }
        } else $zalozona_tarcza = 0;
        if($zalozony == 0 && $zalozona_tarcza == 0){ 
            mysql_query("update przedmiot_postac set zalozony = 1 where id = ".$dane['id']." limit 1");
            $ajax_txt = "Zalozyles ".$dane['nazwa'];
        } elseif($zalozona_tarcza == 1) $ajax_txt = "Nie mozesz nosic broni dwurecznej bo masz zalozona tarcze";
        else $ajax_txt = "Masz ju¿ zalozona bron";
  } elseif($dane['typ'] == 'BronPomocnicza' || $dane['typ'] == 'Tarcza' || $dane['typ'] == 'Strzaly'){
        $z = mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 ");
        while($w = mysql_fetch_array($z)){
            if($w['typ'] == 'Tarcza' || $w['typ'] == 'BronPomocnicza' || $w['typ'] == 'Strzaly') $zalozony = 1;
        }
        if($dane['typ'] == 'BronPomocnicza' || $dane['typ'] == 'Tarcza'){
        $zt = mysql_query("select * from przedmiot_postac where postac = ".$postac['id']." and zalozony = 1 ");
        while($z_t = mysql_fetch_array($zt)){
            if($z_t['typ'] == 'BronDwureczna' || $z_t['typ'] == 'Laska') $zalozona_tarcza = 1;
        }
        } else $zalozona_tarcza = 0;
        if($zalozony == 0 && $zalozona_tarcza == 0){ 
            mysql_query("update przedmiot_postac set zalozony = 1 where id = ".$dane['id']." limit 1");
            $ajax_txt = "Zalozyles ".$dane['nazwa'];
        } elseif($zalozona_tarcza == 1) $ajax_txt = "Nie mozesz nosic tarczy czy orbu bo masz zalozona bron dwureczna";
        else $ajax_txt = "Masz ju¿ zalozony przedmiot w Prawej Rêce";
  } elseif($dane['typ'] == 'Buty'){
        $zalozony = mysql_num_rows(mysql_query("select * from przedmiot_postac where postac = ".$dane['postac']." and zalozony = 1 and typ = 'Buty' "));
        if($zalozony == 0){ 
            mysql_query("update przedmiot_postac set zalozony = 1 where id = ".$dane['id']." limit 1");
            $ajax_txt = "Zalozyles ".$dane['nazwa'];
        } else {
            $ajax_txt = "Masz ju¿ zalozone Buty";
        }
  } elseif($dane['typ'] == 'Zbroja'){
        $zalozony = mysql_num_rows(mysql_query("select * from przedmiot_postac where postac = ".$dane['postac']." and zalozony = 1 and typ = 'Zbroja' "));
        if($zalozony == 0){ 
            mysql_query("update przedmiot_postac set zalozony = 1 where id = ".$dane['id']." limit 1");
            $ajax_txt = "Zalozyles ".$dane['nazwa'];
        } else {
            $ajax_txt = "Masz ju¿ zalozona zbroje";
        }
  } elseif($dane['typ'] == 'Pierscien'){
        $zalozony = mysql_num_rows(mysql_query("select * from przedmiot_postac where postac = ".$dane['postac']." and zalozony = 1 and typ = 'Pierscien' "));
        if($zalozony == 0){ 
            mysql_query("update przedmiot_postac set zalozony = 1 where id = ".$dane['id']." limit 1");
            $ajax_txt = "Zalozyles ".$dane['nazwa'];
        } else {
            $ajax_txt = "Masz ju¿ zalozony Pierscien";
        }
  } elseif($dane['typ'] == 'Naszyjnik'){
        $zalozony = mysql_num_rows(mysql_query("select * from przedmiot_postac where postac = ".$dane['postac']." and zalozony = 1 and typ = 'Naszyjnik' "));
        if($zalozony == 0){ 
            mysql_query("update przedmiot_postac set zalozony = 1 where id = ".$dane['id']." limit 1");
            $ajax_txt = "Zalozyles ".$dane['nazwa'];
        } else {
            $ajax_txt = "Masz ju¿ zalozony Naszyjnik";
        }
  } elseif($dane['typ'] == 'Rekawice'){
        $zalozony = mysql_num_rows(mysql_query("select * from przedmiot_postac where postac = ".$dane['postac']." and zalozony = 1 and typ = 'Rekawice' "));
        if($zalozony == 0){ 
            mysql_query("update przedmiot_postac set zalozony = 1 where id = ".$dane['id']." limit 1");
            $ajax_txt = "Zalozyles ".$dane['nazwa'];
        } else {
            $ajax_txt = "Masz ju¿ zalozone Rekawice";
        }
  } elseif($dane['typ'] == 'Helm'){
        $zalozony = mysql_num_rows(mysql_query("select * from przedmiot_postac where postac = ".$dane['postac']." and zalozony = 1 and typ = 'Helm' "));
        if($zalozony == 0){ 
            mysql_query("update przedmiot_postac set zalozony = 1 where id = ".$dane['id']." limit 1");
            $ajax_txt = "Zalozyles ".$dane['nazwa'];
        } else {
            $ajax_txt = "Masz ju¿ zalozony Helm";
        }
  } elseif($dane['typ'] == 'Talizman'){
        $zalozony = mysql_num_rows(mysql_query("select * from przedmiot_postac where postac = ".$dane['postac']." and zalozony = 1 and typ = 'Talizman' "));
        if($zalozony == 0){ 
            mysql_query("update przedmiot_postac set zalozony = 1 where id = ".$dane['id']." limit 1");
            $ajax_txt = "Zalozyles ".$dane['nazwa'];
        } else {
            $ajax_txt = "Masz ju¿ zalozony Talizman";
        }
  } elseif($dane['typ'] == 'Konsupcyjne'){
            if($dane['pelne_leczenie'] > 0){
            if(($postac['zycie'] + $dane['pelne_leczenie']) <= $postac['zycie_max']){
                   $postac['zycie'] += $dane['pelne_leczenie'];
                   $ulecz = $dane['pelne_leczenie'];
                   $dane['pelne_leczenie'] = 0;
            } else {
                   $do_uleczenia = $postac['zycie_max'] - $postac['zycie'];
                   $postac['zycie'] += $do_uleczenia;
                   $ulecz = $do_uleczenia;
                   $dane['pelne_leczenie'] -= $do_uleczenia;
                   mysql_query("update przedmiot_postac set pelne_leczenie = pelne_leczenie - ".$do_uleczenia." where id = ".$dane['id']." limit 1");
            }
            if($dane['pelne_leczenie'] <= 0) mysql_query("delete from przedmiot_postac where id = ".$dane['id']." limit 1");
            } elseif($dane['ilosc'] > 0){
                mysql_query("update przedmiot_postac set ilosc = ilosc - 1 where id = ".$dane['id']." and ilosc > 0 limit 1");
                $dane['ilosc'] -= 1;
            if($dane['ilosc'] <= 0) mysql_query("delete from przedmiot_postac where id = ".$dane['id']." limit 1");
            } else mysql_query("delete from przedmiot_postac where id = ".$dane['id']." limit 1");
            if($dane['mikstura_leczenie'] > 0) $ulecz = $dane['mikstura_leczenie'];
            mysql_query("update postac set zycie = zycie + ".$ulecz." where id = ".$postac['id']." limit 1");
            $ajax_txt = "Uleczyles sie";
  } else $ajax_txt = "Nieznany typ";
} else $ajax_txt = "Nie masz odpowiedniego poziomu";
} else $ajax_txt = "Nie posiadasz odpowiedniej profesji";
}
echo $ajax_txt;
exit;
?>