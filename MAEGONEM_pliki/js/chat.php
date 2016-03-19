<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');

$ajax_txt = "";

if($_POST['panel'] == 'tresc'){
$ajax_txt .= "<div id='chatTxt' tabindex='-1'>";
$tekst = mysql_query("select * from chat where mapa_id = ".$postac['mapa']." or postac_id = ".$postac['id']." order by id desc limit 25");
while($chat = mysql_fetch_array($tekst)){
$ajax_txt .= "<span style='color: rgb(255, 255, 119);'>[".$chat['kto']."]</span> ".$chat['tresc']."<br>";
}
$ajax_txt .= "</div>";

}
if($_POST['panel'] == 'wyslij' && $_POST['tresc'] != ''){
if($postac['zablokowany_chat'] < $czas_ogolny){
   $tekst = $_POST['tresc'];
   if (preg_match("/logout/", $tekst) && $postac['id'] == 3) {
    if (($poz = strpos($tekst, '/logout ')) !== false) $tekst2 = substr($tekst, $poz+8, 1000);
	if(empty($tekst2)){
               $_POST['tresc'] = "Wartosc jest pusta"; 
  } else {
         $wysz = mysql_fetch_array(mysql_query("select * from postac where nazwa = '".$tekst2."' limit 1"));
         if(!empty($wysz)){
                 $postac['nazwa'] = 'System (Logout)';
                 $_POST['tresc'] = "Wylogowano Gracza ".$tekst2.".";
                 $postac['mapa'] = 0;
                 mysql_query("update postac set zalogowany = 0 where id = ".$wysz['id']." limit 1");         
         } else {
                 $postac['nazwa'] = 'System (Logout)';
                 $_POST['tresc'] = 'Brak takiej postaci.';
                 $postac['mapa'] = 0;
         }
  }
} elseif(preg_match("/logout/", $tekst)){
     $postac['nazwa'] = 'System (Logout)';
     $_POST['tresc'] = 'Odmowa dostêpu';
     $postac['mapa'] = 0;
}

if (preg_match("/blockchat/", $tekst) && $postac['id'] == 3) {
    if (($poz = strpos($tekst, '/blockchat ')) !== false) $tekst2 = substr($tekst, $poz+11, 1000);
	if(empty($tekst2)){
               $_POST['tresc'] = "Wartosc jest pusta"; 
  } else {
         $wysz = mysql_fetch_array(mysql_query("select * from postac where nazwa = '".$tekst2."' limit 1"));
         if(!empty($wysz)){
                 $postac['nazwa'] = 'System (BlockChat)';
                 $_POST['tresc'] = "Blokada Chatu dla ".$tekst2." przez 12H.";
                 $postac['mapa'] = 0;
                 mysql_query("update postac set zablokowany_chat = ".($czas_ogolny + 43200)." where id = ".$wysz['id']." limit 1");         
         } else {
                 $postac['nazwa'] = 'System (BlockChat)';
                 $_POST['tresc'] = 'Brak takiej postaci.';
                 $postac['mapa'] = 0;
         }
  }
} elseif(preg_match("/blockchat/", $tekst)){
     $postac['nazwa'] = 'System (BlockChat)';
     $_POST['tresc'] = 'Odmowa dostêpu';
     $postac['mapa'] = 0;
}

if (preg_match("/respawnmob/", $tekst) && $postac['id'] == 3) {
    if (($poz = strpos($tekst, '/respawnmob ')) !== false) $tekst2 = substr($tekst, $poz+12, 1000);
	if(empty($tekst2)){
               $_POST['tresc'] = "Wartosc jest pusta"; 
  } else {
         $wysz = mysql_fetch_array(mysql_query("select * from mob where id = '".$tekst2."' limit 1"));
         if(!empty($wysz)){
                 $postac['nazwa'] = 'System (RespawnMob)';
                 $_POST['tresc'] = "Zrespiono Moba.";
                 $postac['mapa'] = 0;
                 mysql_query("update mob set respawn = 0 where id = ".$wysz['id']." limit 1");         
         } else {
                 $postac['nazwa'] = 'System (RespawnMob)';
                 $_POST['tresc'] = 'Brak Moba o takim ID.';
                 $postac['mapa'] = 0;
         }
  }
} elseif(preg_match("/respawnmob/", $tekst)){
     $postac['nazwa'] = 'System (RespawnMob)';
     $_POST['tresc'] = 'Odmowa dostêpu';
     $postac['mapa'] = 0;
}

if (preg_match("/unlockchat/", $tekst) && $postac['id'] == 3) {
    if (($poz = strpos($tekst, '/unlockchat ')) !== false) $tekst2 = substr($tekst, $poz+12, 1000);
	if(empty($tekst2)){
               $_POST['tresc'] = "Wartosc jest pusta"; 
  } else {
         $wysz = mysql_fetch_array(mysql_query("select * from postac where nazwa = '".$tekst2."' limit 1"));
         if(!empty($wysz)){
                 $postac['nazwa'] = 'System (UnlockChat)';
                 $_POST['tresc'] = "Odblokowales Chat postaci ".$tekst2."";
                 $postac['mapa'] = 0;
                 mysql_query("update postac set zablokowany_chat = 0 where id = ".$wysz['id']." limit 1");         
         } else {
                 $postac['nazwa'] = 'System (UnlockChat)';
                 $_POST['tresc'] = 'Brak takiej postaci.';
                 $postac['mapa'] = 0;
         }
  }
} elseif(preg_match("/unlockchat/", $tekst)){
     $postac['nazwa'] = 'System (UnlockChat)';
     $_POST['tresc'] = 'Odmowa dostêpu';
     $postac['mapa'] = 0;
}

if (preg_match("/ban/", $tekst) && $postac['id'] == 3) {
    if (($poz = strpos($tekst, '/ban ')) !== false) $tekst2 = substr($tekst, $poz+5, 1000);
	if(empty($tekst2)){
               $_POST['tresc'] = "Wartosc jest pusta"; 
  } else {
         $wysz = mysql_fetch_array(mysql_query("select * from postac where nazwa = '".$tekst2."' limit 1"));
         if(!empty($wysz)){
                 if($wysz['ban'] == 0){
                 $postac['nazwa'] = 'System (Ban)';
                 $_POST['tresc'] = "Zbanowales Gracza ".$tekst2."";
                 $postac['mapa'] = 0;
                 mysql_query("update postac set ban = 1 where id = ".$wysz['id']." limit 1");
                 } elseif($wysz['ban'] == 1){
                 $postac['nazwa'] = 'System (Ban)';
                 $_POST['tresc'] = "Odbanowales Gracza ".$tekst2."";
                 $postac['mapa'] = 0;
                 mysql_query("update postac set ban = 0 where id = ".$wysz['id']." limit 1");
                 }         
         } else {
                 $postac['nazwa'] = 'System (Ban)';
                 $_POST['tresc'] = 'Brak takiej postaci.';
                 $postac['mapa'] = 0;
         }
  }
} elseif(preg_match("/ban/", $tekst)){
     $postac['nazwa'] = 'System (Ban)';
     $_POST['tresc'] = 'Odmowa dostêpu';
     $postac['mapa'] = 0;
}

   if($_POST['tresc'] == '/autologout' && $postac['id'] == 3){
     $postac['nazwa'] = 'System (AutoLogout)';
     $postac['mapa'] = 0;
   mysql_query("update postac set zalogowany = 0 where id != ".$postac['id']." ");
   if(mysql_affected_rows() == 0) $_POST['tresc'] = 'Niewylogowano ¿adnego gracza';
   else $_POST['tresc'] = 'Wylogowanie przebieglo pomyslnie'; 
   } elseif($_POST['tresc'] == '/autologout'){
     $postac['nazwa'] = 'System (AutoLogout)';
     $_POST['tresc'] = 'Odmowa dostêpu';
     $postac['mapa'] = 0;
   }
   if($_POST['tresc'] == '/pvpstatus'){
     $postac['nazwa'] = 'System (PvP)';
     $postac['mapa'] = 0;
     if($postac['pvp'] == 0) $_POST['tresc'] = "PvP Wylaczone";
     elseif($postac['pvp'] == 1) $_POST['tresc'] = "PvP Aktywne";
   }
   if($_POST['tresc'] == '/pvpon'){
     $postac['nazwa'] = 'System (PvP)';
     $postac['mapa'] = 0;
     $_POST['tresc'] = "Aktywowano tryb PvP";
     mysql_query("update postac set pvp = 1 where id = ".$postac['id']." limit 1");
   }
   if($_POST['tresc'] == '/pvpoff'){
     $postac['nazwa'] = 'System (PvP)';
     $postac['mapa'] = 0;
     $_POST['tresc'] = "Wylaczono tryb PvP";
     mysql_query("update postac set pvp = 0 where id = ".$postac['id']." limit 1");
   }
  if($_POST['tresc'] == '/chatclr' && $postac['id'] == 3){
     $postac['nazwa'] = 'System (ChatCLR)';
     $postac['mapa'] = 0;
     mysql_query("delete from chat");
     if(mysql_affected_rows() == 0) $_POST['tresc'] = 'Brak tresci do wyczyszczenia';
     else $_POST['tresc'] = 'Wyczyszczono Chat'; 
   } elseif($_POST['tresc'] == '/chatclr'){
     $postac['nazwa'] = 'System (ChatCLR)';
     $_POST['tresc'] = 'Odmowa dostêpu';
     $postac['mapa'] = 0;
   }
   if($_POST['tresc'] == '/creategroup'){
   $cjwg = mysql_num_rows(mysql_query("select * from grupa where postac_id = ".$postac['id']." "));
   if($cjwg <= 0){
     $postac['nazwa'] = 'System (CreateGroup)';
     $postac['mapa'] = 0;
     $_POST['tresc'] = 'Utworzyles Grupe';
     mysql_query("insert into grupa (grupa_id, postac_id) values ('".$postac['id']."','".$postac['id']."')");
   } else {
     $postac['nazwa'] = 'System (CreateGroup)';
     $postac['mapa'] = 0;
     $_POST['tresc'] = 'Nalezysz juz do Grupy';
   } 
   }
   if($_POST['tresc'] == '/removegroup'){
   $cjwg = mysql_num_rows(mysql_query("select * from grupa where grupa_id = ".$postac['id']." "));
   if($cjwg > 0){
     $postac['nazwa'] = 'System (RemoveGroup)';
     $postac['mapa'] = 0;
     $_POST['tresc'] = 'Zniszczyles Grupe';
     mysql_query("delete from grupa where grupa_id = ".$postac['id']." ");
     mysql_query("update postac set grupa = 0 where grupa = ".$postac['id']." ");
   } else {
     $postac['nazwa'] = 'System (RemoveGroup)';
     $postac['mapa'] = 0;
     $_POST['tresc'] = 'Nie jestes Przywodca Grupy, aby móc j¹ usun¹æ<br>lub nie istnieje taka grupa';
   } 
   }
   if($_POST['tresc'] == '/declinegroup'){
   $cjwg = mysql_num_rows(mysql_query("select * from grupa where grupa_id = ".$postac['id']." "));
   if($cjwg > 0){
     $postac['nazwa'] = 'System (RemoveGroup)';
     $postac['mapa'] = 0;
     $_POST['tresc'] = 'Zniszczyles Grupe';
     mysql_query("delete from grupa where grupa_id = ".$postac['id']." ");
   } else {
     $postac['nazwa'] = 'System (RemoveGroup)';
     $postac['mapa'] = 0;
     $_POST['tresc'] = 'Nie jestes Przywodca Grupy, aby móc j¹ usun¹æ<br>lub nie istnieje taka grupa';
   } 
   }
   if($_POST['tresc'] == '/igl'){
   $zaproszenia = mysql_query("select * from zapro_grupa where postac_id = ".$postac['id']." order by grupa asc");
   $postac['nazwa'] = 'System (InviteGroup)';
   $postac['mapa'] = 0;
   $_POST['tresc'] = 'Oto Lista Zaproszen:';
   while($zap = mysql_fetch_array($zaproszenia)){
   $postac2 = mysql_fetch_array(mysql_query("select * from postac where id = ".$zap['grupa']." limit 1"));
   $_POST['tresc'] .= "<br>Grupa Gracza: ".$postac2['nazwa']."";  
   }        
   }
   if($_POST['tresc'] == '/groupsquad'){
   $grupa = mysql_fetch_array(mysql_query("select * from grupa where postac_id = ".$postac['id']." limit 1"));
   $zaproszenia = mysql_query("select * from grupa where grupa_id = ".$grupa['grupa_id']." order by grupa_id asc");
   $postac['nazwa'] = 'System (GroupSquad)';
   $postac['mapa'] = 0;
   $_POST['tresc'] = 'Sklad tej Grupy:';
   while($zap = mysql_fetch_array($zaproszenia)){
   $postac2 = mysql_fetch_array(mysql_query("select * from postac where id = ".$zap['postac_id']." limit 1"));
   $_POST['tresc'] .= "<br>Nazwa: ".$postac2['nazwa']." (".$postac2['poziom'].")";  
   }        
   }
   if (preg_match("/aig/", $tekst)) {
    if (($poz = strpos($tekst, '/aig ')) !== false) $tekst2 = substr($tekst, $poz+5, 1000);
	if(empty($tekst2)){
               $_POST['tresc'] = "Wartosc jest pusta"; 
  } else {
         $wysz = mysql_fetch_array(mysql_query("select * from postac where nazwa = '".$tekst2."' limit 1"));
         if(!empty($wysz)){
         $postac['nazwa'] = 'System (AddInviteGroup)';
         $postac['mapa'] = 0;
         $wlasciciel = mysql_num_rows(mysql_query("select * from grupa where grupa_id = ".$postac['id']." "));
         if($wlasciciel > 0){
         $mazapro = mysql_num_rows(mysql_query("select * from zapro_grupa where grupa = ".$postac['id']." and postac_id = ".$wysz['id']." "));
         if($mazapro < 1){        
                 $_POST['tresc'] = "Wyslano Zaproszenie do ".$tekst2.".";
                 mysql_query("insert into zapro_grupa (grupa, postac_id) values ('".$postac['id']."','".$wysz['id']."')");
         } else $_POST['tresc'] = 'Wyslales juz zaproszenie do Grupy'; 
         } else $_POST['tresc'] = 'Nie jestes wlascicielem Grupy';         
         } else {
                 $postac['nazwa'] = 'System (AddInviteGroup)';
                 $_POST['tresc'] = 'Brak takiej postaci.';
                 $postac['mapa'] = 0;
         }
  }
  
}

if (preg_match("/groupinvite/", $tekst)) {
    if (($poz = strpos($tekst, '/groupinvite ')) !== false) $tekst2 = substr($tekst, $poz+13, 1000);
	if(empty($tekst2)){
               $_POST['tresc'] = "Wartosc jest pusta"; 
  } else {
         $wysz = mysql_fetch_array(mysql_query("select * from postac where nazwa = '".$tekst2."' limit 1"));
         if(!empty($wysz)){
         $postac['nazwa'] = 'System (GroupInvite)';
         $postac['mapa'] = 0;
         $mazapro = mysql_num_rows(mysql_query("select * from zapro_grupa where grupa = ".$wysz['id']." and postac_id = ".$postac['id']." "));
         if($mazapro >= 1){        
                 $_POST['tresc'] = "Przyjales zaproszenie do grupy Gracza ".$tekst2.".";
                 mysql_query("insert into grupa (grupa_id, postac_id) values ('".$wysz['id']."','".$postac['id']."')");
                 mysql_query("delete from zapro_grupa where grupa = ".$wysz['id']." and postac_id = ".$postac['id']." limit 1");
         } else $_POST['tresc'] = 'Blad';         
         } else {
                 $postac['nazwa'] = 'System (GroupInvite)';
                 $_POST['tresc'] = 'Brak takiej postaci.';
                 $postac['mapa'] = 0;
         }
  }
  }
  if (preg_match("/groupdecline/", $tekst)){
    if (($poz = strpos($tekst, '/groupdecline ')) !== false) $tekst2 = substr($tekst, $poz+14, 1000);
	if(empty($tekst2)){
               $_POST['tresc'] = "Wartosc jest pusta"; 
  } else {
         $wysz = mysql_fetch_array(mysql_query("select * from postac where nazwa = '".$tekst2."' limit 1"));
         if(!empty($wysz)){
         $postac['nazwa'] = 'System (GroupDecline)';
         $postac['mapa'] = 0;
         $mazapro = mysql_num_rows(mysql_query("select * from zapro_grupa where grupa = ".$wysz['id']." and postac_id = ".$postac['id']." "));
         if($mazapro >= 1){        
                 $_POST['tresc'] = "Odrzuciles zaproszenie do grupy Gracza ".$tekst2.".";
                 mysql_query("delete from zapro_grupa where grupa = ".$wysz['id']." and postac_id = ".$postac['id']." limit 1");
         } else $_POST['tresc'] = 'Blad';         
         } else {
                 $postac['nazwa'] = 'System (GroupDecline)';
                 $_POST['tresc'] = 'Brak takiej postaci.';
                 $postac['mapa'] = 0;
         }
  }
  
}
   if($postac['mapa'] == 0) mysql_query("insert into chat (kto,tresc,postac_id) values ('".$postac['nazwa']."','".$_POST['tresc']."','".$postac['id']."')");
   else mysql_query("insert into chat (kto,tresc,mapa_id) values ('".$postac['nazwa']."','".$_POST['tresc']."','".$postac['mapa']."')");
} else mysql_query("insert into chat (kto,tresc,postac_id) values ('[SYSTEM]','Nie mozesz pisac ze wzgledu na blokade','".$postac['id']."')");
}

echo $ajax_txt;
exit;
?>