<?php
require_once('../php/mysql-connect.php');
require_once('../php/load-data.php');
require_once('../php/skills-data.php');

$ajax_txt = "";

if($postac['um'] < $max_um){
   if($_POST['id'] == 1){
     if($u['u1'] < 10){
        if($poziom >= $skil[1][poziom]){
                $ajax_txt .= "Nauczyles sie Umiejetnosci.";
                mysql_query("update umiejetnosci set u1 = u1 + 1 where postac_id = ".$postac['id']." limit 1");
                mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
        } else $ajax_txt .= "Nie posiadasz odpowiedniego poziomu";
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
   
   if($_POST['id'] == 2){
     if($u['u2'] < 3){
        if($poziom >= $skil[2][poziom]){
           if($postac['profesja'] == $skil[2][prof1] || $postac['profesja'] == $skil[2][prof2]){
                $ajax_txt .= "Nauczyles sie Umiejetnosci.";
                mysql_query("update umiejetnosci set u2 = u2 + 1 where postac_id = ".$postac['id']." limit 1");
                mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
           } else $ajax_txt .= "Nie posiadasz odpowiedniej profesji";
        } else $ajax_txt .= "Nie posiadasz odpowiedniego poziomu";
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
   
   if($_POST['id'] == 3){
     if($u['u3'] < 5){
        if($poziom >= $skil[3][poziom]){
           if($postac['profesja'] == $skil[3][prof1] || $postac['profesja'] == $skil[3][prof2]){
                $ajax_txt .= "Nauczyles sie Umiejetnosci.";
                mysql_query("update umiejetnosci set u3 = u3 + 1 where postac_id = ".$postac['id']." limit 1");
                mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
           } else $ajax_txt .= "Nie posiadasz odpowiedniej profesji";
        } else $ajax_txt .= "Nie posiadasz odpowiedniego poziomu";
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
   
   if($_POST['id'] == 4){
     if($u['u4'] < 20){
          $ajax_txt .= "Nauczyles sie Umiejetnosci.";
          mysql_query("update umiejetnosci set u4 = u4 + 1 where postac_id = ".$postac['id']." limit 1");
          mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
   
   if($_POST['id'] == 5){
     if($u['u5'] < 3){
        if($poziom >= $skil[5][poziom]){
                $ajax_txt .= "Nauczyles sie Umiejetnosci.";
                mysql_query("update umiejetnosci set u5 = u5 + 1 where postac_id = ".$postac['id']." limit 1");
                mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
        } else $ajax_txt .= "Nie posiadasz odpowiedniego poziomu";
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
   if($_POST['id'] == 6){
     if($u['u6'] < 6){
        if($poziom >= $skil[6][poziom]){
                $ajax_txt .= "Nauczyles sie Umiejetnosci.";
                mysql_query("update umiejetnosci set u6 = u6 + 1 where postac_id = ".$postac['id']." limit 1");
                mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
        } else $ajax_txt .= "Nie posiadasz odpowiedniego poziomu";
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
   
    if($_POST['id'] == 7){
     if($u['u7'] < 20){
          $ajax_txt .= "Nauczyles sie Umiejetnosci.";
          mysql_query("update umiejetnosci set u7 = u7 + 1 where postac_id = ".$postac['id']." limit 1");
          mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
   
   if($_POST['id'] == 8){
     if($u['u8'] < 8){
        if($poziom >= $skil[8][poziom]){
                $ajax_txt .= "Nauczyles sie Umiejetnosci.";
                mysql_query("update umiejetnosci set u8 = u8 + 1 where postac_id = ".$postac['id']." limit 1");
                mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
        } else $ajax_txt .= "Nie posiadasz odpowiedniego poziomu";
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
   
   if($_POST['id'] == 9){
     if($u['u9'] < 8){
        if($poziom >= $skil[9][poziom]){
                $ajax_txt .= "Nauczyles sie Umiejetnosci.";
                mysql_query("update umiejetnosci set u9 = u9 + 1 where postac_id = ".$postac['id']." limit 1");
                mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
        } else $ajax_txt .= "Nie posiadasz odpowiedniego poziomu";
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
   
   if($_POST['id'] == 10){
     if($u['u10'] < 5){
        if($poziom >= $skil[10][poziom]){
           if($postac['profesja'] == 'Wojownik'){
                $ajax_txt .= "Nauczyles sie Umiejetnosci.";
                mysql_query("update umiejetnosci set u10 = u10 + 1 where postac_id = ".$postac['id']." limit 1");
                mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
           } else $ajax_txt .= "Nie posiadasz odpowiedniej profesji";
        } else $ajax_txt .= "Nie posiadasz odpowiedniego poziomu";
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
   
   if($_POST['id'] == 11){
     if($u['u11'] < 5){
        if($poziom >= $skil[11][poziom]){
           if($postac['profesja'] == 'Wojownik' || $postac['profesja'] == 'Paladyn' || $postac['profesja'] == 'Tancerz Ostrzy'){
                $ajax_txt .= "Nauczyles sie Umiejetnosci.";
                mysql_query("update umiejetnosci set u11 = u11 + 1 where postac_id = ".$postac['id']." limit 1");
                mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
           } else $ajax_txt .= "Nie posiadasz odpowiedniej profesji";
        } else $ajax_txt .= "Nie posiadasz odpowiedniego poziomu";
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
   
   if($_POST['id'] == 12){
     if($u['u12'] < 5){
        if($poziom >= $skil[12][poziom]){
           if($postac['profesja'] == 'Lowca' || $postac['profesja'] == 'Tropiciel'){
                $ajax_txt .= "Nauczyles sie Umiejetnosci.";
                mysql_query("update umiejetnosci set u12 = u12 + 1 where postac_id = ".$postac['id']." limit 1");
                mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
           } else $ajax_txt .= "Nie posiadasz odpowiedniej profesji";
        } else $ajax_txt .= "Nie posiadasz odpowiedniego poziomu";
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
   
   if($_POST['id'] == 13){
     if($u['u13'] < 8){
        if($poziom >= $skil[13][poziom]){
           if($postac['profesja'] == 'Mag'){
                $ajax_txt .= "Nauczyles sie Umiejetnosci.";
                mysql_query("update umiejetnosci set u13 = u13 + 1 where postac_id = ".$postac['id']." limit 1");
                mysql_query("update postac set um = um + 1 where id = ".$postac['id']." limit 1");
           } else $ajax_txt .= "Nie posiadasz odpowiedniej profesji";
        } else $ajax_txt .= "Nie posiadasz odpowiedniego poziomu";
     } else $ajax_txt .= "Nauczyles sie maksymalnego poziomu Umiejetnosci";
   }
} else $ajax_txt .= "Brakuje ci punktów Umiejetnosci.";

echo $ajax_txt;
exit;
?>