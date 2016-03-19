<?php
require_once('php/mysql-connect.php');
$hp_hud = ($postac['zycie'] / $postac['zycie_max']) * 107;
$poziom = $postac['poziom'];
$exp1 = ($poziom - 1) * ($poziom - 1) * ($poziom - 1) * ($poziom - 1);
if($exp1 > 0) $exp1 += 10;
$exp2 = ($poziom * $poziom * $poziom * $poziom) + 10;
$exp3 = $exp2 - $exp1;
$exp4 = $exp2 - $postac['exp'];
$exp_hud = ($exp4 / $exp3) * 107;
$exp_hud = 107 - $exp_hud;
if($hp_hud > 107) $hp_hud = 107;
if($exp_hud > 107) $exp_hud = 107;
if($postac['exp'] <= 999) $txt_exp1 = $postac['exp'];
if($postac['exp'] > 999) $txt_exp1 = "".($postac['exp'] / 1000)."k";
if($postac['exp'] > 999999) $txt_exp1 = "".($postac['exp'] / 1000000)."m";
if($postac['exp'] > 999999999) $txt_exp1 = "".($postac['exp'] / 1000000000)."g";
if($exp2 <= 999) $txt_exp2 = $exp2;
if($exp2 > 999) $txt_exp2 = "".($exp2 / 1000)."k";
if($exp2 > 999999) $txt_exp2 = "".($exp2 / 1000000)."m";
if($exp2 > 999999999) $txt_exp2 = "".($exp2 / 1000000000)."g";
$atak_fiz = ($postac['obrazenia_min'] + $postac['obrazenia_max']) / 2;
$atak_fiz2 = ($postac['obrazenia_max'] - $postac['obrazenia_min']) / 2;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>


<meta name="robots" content="none">
<meta http-equiv="content-type" content="text/html; charset=windows-1250">
<meta name="generator" content="PSPad editor, www.pspad.com">
<link rel="stylesheet" type="text/css" href="game_data/game.css">
<link rel="stylesheet" type="text/css" href="game_data/clanpage.css">

<script type='text/javascript'>
var pp = 0;
var shop = 0;
var chatmode = 0;
var x = <?php echo "".(($postac['x'] * -32) + 240).""; ?>;
var y = <?php echo "".(($postac['y'] * -32) + 240).""; ?>;
</script>
<script type='text/javascript' src='js/jquery.js'></script>
<?php require_once('php/load-data.php'); ?>
<script type='text/javascript' src='js/hud_1.js'></script>
<script type='text/javascript' src='js/klawiatura.js'></script>
<script type='text/javascript' src='js/lewy-panel.js'></script>

<title>Margonem</title>
</head><body tabindex="1">
<div style="display: block;" id="loading"><span>£adowanie gry<br></span></div>
<div id="mconsole"><div id="con1"><div id="consoleTxt"><div>Margonem 
MMORPG console</div><div>Engine started.</div><div>init() complete</div><div>Mozilla/5.0
 (Windows; U; Windows NT 5.1; pl; rv:1.9.2) Gecko/20100115 Firefox/3.6</div><div>Loading:
 http://game9.margonem.pl/obrazki/miasta/Ithan3.png</div><div>Map
 loaded</div></div></div>
<div id="con2"><input id="consoleIn" type="text"></div></div>
<div id="status"><?php echo "".$mapa['nazwa']." (".$postac['x'].",".$postac['y'].")"; ?></div>
<a href="#" onmouseover="pokaz_exp();" onmouseout="schowaj_exp();" id="exphud"><div id="exp1"><div style="width: <?php echo $exp_hud; ?>px; background-image: 
url(&quot;game_data/obrazki/interface/exp.png&quot;);" 
id="exp2"></div></div></a>
<div style="top: 80px; left: 500px;" class="ctip tip_" id="oTip3"><b>Doœwiadczenie:</b><?php echo $txt_exp1; ?>/<?php echo $txt_exp2; ?><b>Do <?php echo "".($poziom + 1).""; ?> poziomu:</b><?php echo $exp4; ?></div>
<a href="#" onmouseover="pokaz_hp();" onmouseout="schowaj_hp();" id="hphud"><div id="life1"><div style="width: <?php echo $hp_hud; ?>px;" id="life2"></div></div></a>
<div style="top: 50px; left: 500px;" class="ctip2" id="oTip2"><b>Punkty ¿ycia:</b><br/><?php echo "".$postac['zycie']."/".$postac['zycie_max'].""; ?></div>
<div id="gold"><?php echo $txt_gold; ?></div>
<img class="fixit" src="game_data/le-orn1.gif" id="leorn1">
<img class="fixit" src="game_data/le-orn2.gif" id="leorn2">
<div id="base3"><?php echo "".$postac['sila']."<br>".$postac['zrecznosc']."<br>".$postac['intelekt'].""; ?></div>
<div id="lpanel"><div tip="£owca" id="lp_nick"><?php echo $postac['nazwa']; ?> (<?php echo $postac['poziom']; ?>)</div>
<div style="background-position: 0pt 0px;" id="stat2"><div id="stat2but" onclick="lpanel()"></div>
<div id="stat2in"><?php echo $atak_fiz; ?> ±<?php echo $atak_fiz2; ?><br>~<?php echo $heroatak_mag; ?><br><?php echo $herosa; ?><br><?php echo $heroac; ?><br><?php echo $heroacm; ?><br></div>
</div>
</div>
<div id="bpanel"></div>
<div id="l"></div>
<div id="g"></div>
<div id="p"></div>
<div id="d"></div>
<?php if($mapa['pvp'] == 0){ ?> <div style="background-position: 0pt -51px;" id="pvpmode"></div> <?php } ?>
<?php if($mapa['pvp'] == 1){ ?> <div style="background-position: 0pt -34px;" id="pvpmode"></div> <?php } ?>
<?php if($mapa['pvp'] == 2){ ?> <div style="background-position: 0pt -17px;" id="pvpmode"></div> <?php } ?>
<?php if($mapa['pvp'] == 3){ ?> <div style="background-position: 0pt 0px;" id="pvpmode"></div> <?php } ?>
<div style="background-position: 0pt 0px;" id="lagometer"></div>
<div id="objects"><div style="background-position: <?php echo $poz_x; ?>px <?php echo $poz_y; ?>px; 
background-image: 
url('<?php echo $mapa['obrazek']; ?>');"
 id="oMap"></div>

<div style="background-image: 
url(<?php echo $postac['obrazek']; ?>);
 display: block; width: 32px; height: 48px; left: 240px; top: 240px; 
background-position: 0px 0px; z-index: 29;" id="oHero"></div>

<div><div
 style="background-image: 
url(&quot;game_data/obrazki/interface/m_lowce05.gif&quot;);
 width: 32px; height: 48px; display: none;" id="UID_cfa700" 
class="cItem"></div></div><div><div style="background-image: 
url(&quot;game_data/obrazki/interface/f_pal10.gif&quot;);
 width: 32px; height: 48px; left: 320px; top: 400px; 
background-position: 0px -48px; z-index: 31; display: none; visibility: 
hidden;" id="UID_6b19ab" class="cItem"></div></div><div><img 
style="display: none; visibility: hidden;" 
src="game_data/klan_wilk05.gif" id="UID_a603f7" class="cItem"></div><div><img
 style="display: none; visibility: hidden;" 
src="game_data/klan_wilk05.gif" id="UID_ef1fb9" class="cItem"></div><div><div
 style="background-image: 
url(&quot;game_data/obrazki/interface/m_bd28.gif&quot;);
 width: 32px; height: 48px; left: 0pt; top: 16px; background-position: 
0px -144px; z-index: 19; display: none;" id="UID_bd02fc" class="cItem"></div></div><div><div
 style="background-image: 
url(&quot;game_data/obrazki/interface/m_pal21.gif&quot;);
 width: 32px; height: 48px; left: 224px; top: 80px; background-position:
 0px -144px; z-index: 21; display: none;" id="UID_307f53" class="cItem"></div></div><div><img
 style="display: none; visibility: hidden;" 
src="game_data/klan_wilk02.gif" id="UID_90c195" class="cItem"></div><div><img
 style="display: none;" src="game_data/klan_wilk03.gif" id="UID_68cb6" 
class="cItem"></div><div><div style="background-image: 
url(&quot;game_data/obrazki/interface/hm.gif&quot;); 
width: 32px; height: 48px; left: 64px; top: 112px; background-position: 
0px 0px; z-index: 22; display: none;" id="UID_48d10b" class="cItem"></div></div><div><img
 style="display: none;" src="game_data/sur11a.gif" id="UID_64690f" 
class="cItem"></div></div>
<div style="display: none; top: 443px; left: 304px;" class="ctip 
tip_gateway" id="oTip"><b>Kanion Straceñców</b></div>
<div id="chat"></div><input id="chatIn" tabindex="2" maxlength="250" 
type="text" onclick="chatmode=1";>
<div id="equip"></div>
<div style="top: 205px; left: 580px;" class="ctip tip_item" id="oTip_rhand"><b>Niebieska Strza³a</b>Typ: Strza³y<br>Atak Fizyczny +75<br>Obni¿a 50 AC podczas ciosu<br>Iloœæ Strza³: 550<br><b class="att">Wymagany poziom: 50</b><br><b class="att">Wymagana profesja: £owca,Tropiciel</b><br>Wartoœæ: 1284</div>
</div><div
 style="display: none;" id="bag"></div>
<div style="display: none;" id="bagback"></div>
<div id="oDrag"></div>
<div id="clanbutton" tip="Przegl¹danie klanów" 
onclick="dbget('clan','proc=official'); show('clan',true)" rollover="22"></div>
<div style="background-position: 0pt 0pt;" id="questbutton" tip="Otwarte
 questy" 
onclick="pokaz_quest();" rollover="22"></div>
<div id="configbutton" tip="Ustawienia" onclick="config_show()" 
rollover="22"></div>
<div style="background-position: 0pt 0px;" id="pvpbutton" tip="Miecze:
 zgoda na PvP&lt;br&gt;Tarcza: brak zgody" rollover="22" 
onclick="hero.pvpclick()"></div>
<div style="background-position: 0pt 0pt;" id="mapbutton" tip="Minimapa 
œwiata gry" rollover="22" onclick='show("minimap",true)'></div>
<div id="skillsbutton" tip="Umiejêtnoœci gracza" rollover="22"></div>
<div id="friendsbutton" tip="Lista przyjació³&lt;br&gt;i nieprzyjació³" 
rollover="22" onclick='dbget("friends")'></div>
<div style="background-position: 0pt 0pt;" id="eqbutton" rollover="20" onclick="pokaz_ekwipunek();"></div>
<div style="display: none;" id="oQuests"><div 
style="background-position: 0pt 0pt;" class="closeQuest" 
onclick="schowaj_quest();" rollover="22"></div>
<div id="qSpacer"></div><div id="questsTxt"><div class="cquest">Pomó¿ 
Aredheli otworzyæ sklep.<p>Zbierz 5 jagód i zanieœ je Aredheli.</p></div><div
 class="cquest">Bard Grant zniszczy³ mapê. Zdob¹dŸ now¹ dla niego.<p>Poproœ
 kartografa Slina z Karka-han, aby wykona³ dla ciebie now¹ mapê.</p></div><div
 class="cquest">Na trakcie widziano stado czarnych wilków, które atakuj¹
 nieostro¿nych podró¿nych.<p>Udaj siê do Zniszczonego Opactwa i pozb¹dŸ 
siê stada czarnych wilków.</p><p class="qzad">Zabij: Czarny Wilk (4/5) </p></div><div
 class="cquest">Zagin¹³ wombat Andrzej, spróbuj go odnaleŸæ.<p>Odszukaj 
wombata. Je¿eli masz problemy, poradŸ siê Nyquisty.</p></div><div 
class="cquest">Rozpraw siê z ghulami w Wiosce Ghuli.<p class="qzad">Zabij:
 Ghul cmentarny (4/5) </p><p class="qzad">Zabij: Ghul s³abeusz (4/10) </p></div><div
 class="cquest">Zabij roje szerszeni przeszkadzaj¹ce kupcom, którzy 
podró¿uj¹ traktem pomiêdzy Werbin a Torneg.<p class="qzad">Zabij: Rój 
Szerszeni (3/5) </p></div></div></div>
<div id="constat">Server: <div id="servstat">0.9</div>ms<div 
id="netstat"></div></div>
<div style="display: none;" id="menu"><center><div id="menuin"></div><button
 onclick="hide('menu',true)">Zamknij</button></center></div>

<div id="battle">
<div id="battleplace"></div>
<div id="battlebuttons">
<table id="battle_me"><tbody><tr><td id="mana">0</td><td id="energy">0</td></tr></tbody></table>
<div id="battletime"></div>
<div id="bt_attack" onclick="doFight('attack')" rollover="19"></div>
<div id="bt_move" onclick="doFight('move')" rollover="19"></div>
<select id="spell" size="6">
</select>
<div id="bt_use" onclick="doFight('spell')" rollover="19"></div>
<div id="closebattle" onclick="doFight('quit')" rollover="19"></div>
</div>
<div id="battlein"><p class="intro">Przebieg walki:</p></div></div>

<div id="clan" class="clanpage">
<div id="clanlogo"></div>
<div id="clancontent">³adowanie..</div>
<div id="clanbar">
<span id="clanclose" onclick="hide('clan',true)" rollover="22"></span>
<span onclick="dbget('clan','proc=official')" style="width: 78px; 
margin-left: 15px;"></span>
<span onclick="dbget('clan','proc=private')" style="width: 96px;"></span>
<span onclick="dbget('clan','proc=members')" style="width: 91px;"></span>
 
<span onclick="dbget('clan','proc=admin')" style="width: 83px;"></span>
<span onclick="dbget('clan','proc=bank')" style="width: 57px;"></span>
</div>
</div>

<table id="trade">
<tbody><tr><th colspan="2">
</th></tr><tr><td id="tradername1">-</td><td id="tradername2">-
</td></tr><tr class="smallname"><td> </td><td>
</td></tr><tr><td><div id="tradeitem1"></div></td><td><div 
id="tradeitem2"></div>
</td></tr><tr class="smallname"><td> </td><td>
</td></tr><tr><td><div id="showitem1"></div></td><td><div id="showitem2"></div>
</td></tr><tr class="smallname"><td> </td><td> 
</td></tr><tr class="cen"><td><b id="gold1">-</b></td><td><b id="gold2">-</b><br>
<input id="tradegold"><div onclick="setGold()" class="btrade" 
rollover="18"></div>
</td></tr><tr class="cen"><td><b id="tradeaccept1"></b></td><td><button 
id="tradeaccept2" onclick="acceptTrade()"></button>
</td></tr><tr><td colspan="2" class="cen"><center><div id="trcancel" 
onclick="cancelTrade()" rollover="20"></div></center>
</td></tr><tr class="trfooter"><td colspan="2"></td></tr></tbody></table>

<div id="config">
<img src="game_data/conf-title.png">
<div id="configin">
<div class="opt" id="opt1" onclick="optclick(1)">Blokuj wiadomoœci 
prywatne</div>
<div class="opt" id="opt6" onclick="optclick(6)">Blokuj pocztê od 
nieznajomych</div>
<div class="opt" id="opt2" onclick="optclick(2)">Blokuj zaproszenia do 
klanu</div>
<div class="opt" id="opt3" onclick="optclick(3)">Blokuj handel z innymi 
graczami</div>
<div class="opt" id="opt5" onclick="optclick(5)">Blokuj proœby o 
akceptacjê przyjació³</div>
<div class="opt" id="opt4" onclick="optclick(4)">Kiedy atakuje potwór 
pytaj o tryb walki</div>
<div class="opt" id="opt7" onclick="optclick(7)">Wy³¹cz chodzenie myszk¹</div>
<center><table><tbody><tr>
<td><div id="cfgcancel" rollover="20" onclick="hide('config',true)"></div>
</td><td><div id="cfgsave" rollover="20" onclick="config_save()"></div>
</td></tr></tbody></table></center>
</div></div>

<div id="motel">
<div class="motelClose" onclick="hide('motel',true)" rollover="22"></div>
<div id="motbar">Pokoje do wynajêcia</div>
<div id="moteltxt"></div>
</div>


<div><img
 style="left: 309px; top: 394px; z-index: 39; display: none;" 
src="zulek.gif" id="UID_e5e5d3" class="cItem"></div>

<div style="display: none; top: 424px; left: 309px" class="ctip tip_npc" id="oTip"><b>Mietek ¯ul</b><span>Lvl: 25</span><i>heros</i></div>
<div><img
 style="left: 412px; top: 194px; z-index: 39; display: none;" 
src="zulek.gif" id="UID_e5e5d3" class="cItem"></div>

<div style="display: none; top: 224px; left: 402px" class="ctip tip_npc" id="oTip"><b>Mietek ¯ul</b><span>Lvl: 25 (grp)</span><i>heros</i></div>
<div><img
 style="left: 412px; top: 354px; z-index: 39; display: none;" 
src="zulek.gif" id="UID_e5e5d3" class="cItem"></div>

<div style="display: none; top: 324px; left: 402px" class="ctip tip_npc" id="oTip"><b>Mietek ¯ul</b></span><span>Lvl: 25 (grp)</span><i>heros</i></div>
<div><img
 style="left: 482px; top: 147px; z-index: 39; display: none;" 
src="zulek.gif" id="UID_e5e5d3" class="cItem"></div>

<div style="display: none; top: 375px; left: 125px" class="ctip tip_npc" id="oTip"><b>Królik</b><span>Lvl: 1</span></div>
<div><img
 style="left: 150px; top: 350px; z-index: 39; display: none;" 
src="bestia64.gif" id="UID_e5e5d3" class="cItem"></div>

<div style="display: none; top: 180px; left: 320px" class="ctip tip_npc" id="oTip"><b>Tarmus Wuden</b><span>Lvl: 50</span><i>elita II</i></div>

<div style="display: none;" id="dialog"><b class="title">Roan:</b> 
Witaj w moim skromnym sklepie.<div class="dbut" 
onclick="dbget('dialog','lp=10651181&amp;zkim=66')"> Poka¿ mi swój 
sklep. </div><div class="dbut" 
onclick="dbget('dialog','lp=10661902&amp;zkim=66')"> Pssst! </div><div 
class="dbut" onclick="dbget('dialog','lp=NaN&amp;zkim=66')"> Dziêki, idê
 st¹d. </div></div>
<div id="dazed"><b>Jesteœ nieprzytomny.</b><br>Nie wiesz co siê wokó³ 
Ciebie dzieje. 
Chyba ktoœ Ciê przenosi.<br> Ockniesz siê, kiedy si³y wróc¹ Ci za <b 
id="dazedleft"></b></div>
<div style="display: none;" id="shop"><div id="shopin"><div><div 
style="top: 7px; left: 7px; background-image: 
url(&quot;m_zloty.gif&quot;);"
 id="UID_d7a3d5" class="cequip"></div></div><div><div style="top: 39px; 
left: 7px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/kaf/zbroja02.gif&quot;);"
 id="UID_1cad0a" class="cequip"></div></div><div><div style="top: 135px;
 left: 7px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/tar/tarcza01.gif&quot;);"
 id="UID_5b749b" class="cequip"></div></div><div><div style="top: 103px;
 left: 7px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/hat/helm01.gif&quot;);"
 id="UID_447969" class="cequip"></div></div><div><div style="top: 7px; 
left: 39px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/mie/miecz03.gif&quot;);"
 id="UID_af17fd" class="cequip"></div></div><div><div style="top: 7px; 
left: 135px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/top/topor01.gif&quot;);"
 id="UID_4a2aae" class="cequip"></div></div><div><div style="top: 135px;
 left: 71px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/tar/tarcza04.gif&quot;);"
 id="UID_4184a4" class="cequip"></div></div><div><div style="top: 39px; 
left: 39px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/kaf/zbroja01.gif&quot;);"
 id="UID_85cadc" class="cequip"></div></div><div><div style="top: 71px; 
left: 7px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/luk/luk01.gif&quot;);" 
id="UID_becaa1" class="cequip"></div></div><div><div style="top: 103px; 
left: 71px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/hel/helm03.gif&quot;);"
 id="UID_cf767d" class="cequip"></div></div><div><div style="top: 71px; 
left: 39px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/luk/luk02.gif&quot;);" 
id="UID_432a0" class="cequip"></div></div><div><div style="top: 7px; 
left: 7px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/mie/sztylet01.gif&quot;);"
 id="UID_699c4d" class="cequip"></div></div><div><div style="top: 7px; 
left: 103px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/mie/miecz03.gif&quot;);"
 id="UID_5e8fb3" class="cequip"></div></div><div><div style="top: 7px; 
left: 71px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/mie/miecz01.gif&quot;);"
 id="UID_ec197c" class="cequip"></div></div><div><div style="top: 135px;
 left: 39px; background-image: 
url(&quot;http://game9.margonem.pl/obrazki/itemy/tar/tarcza02.gif&quot;);"
 id="UID_18e945" class="cequip"></div></div></div><div id="shopinfo"><b>Ceny:</b>
 normalne<br><b>Skupuje:</b> wszystko<br><b>P³aci </b> 90% wartoœci,  <b>maksymalnie:</b>
 200000</div>
<div style="background-position: 0pt 0pt;" id="shopclose" 
onclick="hide('shop',true)" rollover="20"></div></div>
<div id="msg"></div>
<div id="alert"></div>

<div style="display: none;" id="newlvl" 
onclick="show('abilitypoints',false)"></div>
<div id="abilitypoints">
<div class="closeQuest" onclick="hide('abilitypoints',false)" 
rollover="22"></div>
<div id="qSpacer" style="height: 45px;"></div>
<b id="abpoints"><br>Nie masz wolnych punktów zdolnoœci</b>
<div style="display: none;" class="ab1" id="ab11" 
onclick="dbget('useab','co=sila')"></div>
<div class="ab1" id="ab12" style="top: 178px; display: none;" 
onclick="dbget('useab','co=zrecz')"></div>
<div class="ab1" id="ab13" style="top: 243px; display: none;" 
onclick="dbget('useab','co=intel')"></div>
<div style="display: none;" class="ab5" id="ab51" 
onclick="dbget('useab','co=sila&amp;ile=5')"></div>
<div class="ab5" id="ab52" style="top: 178px; display: none;" 
onclick="dbget('useab','co=zrecz&amp;ile=5')"></div>
<div class="ab5" id="ab53" style="top: 243px; display: none;" 
onclick="dbget('useab','co=intel&amp;ile=5')"></div>
</div>

<div id="skills">
<h1 class="stopic"><div class="skillClose" rollover="22"></div>Twoje umiejêtnoœci</h1>
<div id="skillslist"></div>
</div>
<div id="skillshop">
<h1 class="stopic"><div class="skillClose" 
onclick="hide('skillshop',true)" rollover="22"></div>Nauka umiejêtnoœci</h1>
<div id="skillshoplist"></div>
</div>

<div id="friends">
<div class="motelClose" onclick="hide('friends',true)" rollover="22"></div>
<div id="myfriends"></div><div id="mfadd"><div id="fradd" rollover="22" 
onclick="advget('friends','proc=addfr','frname')"></div><input 
class="frinp" id="frname"></div>
<div id="myenemies"></div><div id="meadd"><div id="enadd" rollover="22" 
onclick="advget('friends','proc=adden','enname')"></div><input 
class="frinp" id="enname"></div>
</div>

<div id="mails">
<div id="mailbar"><div class="mapClose" onclick="hide('mails',true)" 
rollover="22"></div></div>
<div id="mailcontainer">
	<div id="outbox"><button onclick="newmail()">Nowa wiadomoœæ</button> 
(koszt 1 wiadomoœci to zawsze 100 z³ota)
	<div id="newmail"><div id="mailitem"><center>Przedmiot do³aczony do 
wiadomoœci:<div id="attitem"></div>
	<button onclick="delatt()">usuñ</button></center></div><textarea 
id="mailmsg"></textarea>
	Adresat:<input size="10" maxlength="30" id="receiver"> Z³oto:<input 
size="5" id="mailgold">
 	<button onclick="hide('newmail',false)">Anuluj</button> <button 
onclick="sendmail()">Wyœlij</button></div>
	</div>
	<div id="inbox"></div>
</div>
</div>
<div id="mailnotifier" tip="SprawdŸ swoj¹ skrzynkê pocztow¹." 
style="top: 512px;">0</div>

<div style="display: none;" id="auctions">
<div id="auctionsbar"><div class="mapClose" onclick="hide('auctions',true)" rollover="22"></div></div>
<div id="ahselect">
<a href="#" onclick='dbget("auctions")'>Moje aukcje</a>
<a href="#" onclick="ahselect(1)">Broñ bia³a jednorêczna</a>
<a href="#" onclick="ahselect(2)">Broñ bia³a dwurêczna</a>
<a href="#" onclick="ahselect(3)">Broñ bia³a pó³torarêczna</a>
<a href="#" onclick="ahselect(4)">Broñ dystansowa</a>
<a href="#" onclick="ahselect(5)">Broñ pomocnicza</a>
<a href="#" onclick="ahselect(6)">Ró¿d¿ki magiczne</a>

<a href="#" onclick="ahselect(7)">Laski magiczne</a>
<a href="#" onclick="ahselect(8)">Zbroje</a>
<a href="#" onclick="ahselect(9)">He³my</a>
<a href="#" onclick="ahselect(10)">Buty</a>
<a href="#" onclick="ahselect(11)">Rêkawice</a>
<a href="#" onclick="ahselect(12)">Pierœcienie</a>
<a href="#" onclick="ahselect(13)">Naszyjniki</a>
<a href="#" onclick="ahselect(14)">Tarcze</a>
<a href="#" onclick="ahselect(15)">Neutralne</a>

<a href="#" onclick="ahselect(16)">Konsumpcyjne</a>
<a href="#" onclick="ahselect(21)">Strza³y</a>
<a href="#" onclick="ahselect(99)">Eventowe</a>
<!--<a href=# onclick='ahselect(22)'>Talizmany</a>-->
</div>
<div id="ahpanel"><h2>Nowa aukcja</h2><p id="newaitem">Aukcja wystawiona. Mo¿esz wystawiæ nastêpn¹.</p><h2>Moje aukcje</h2><table id="ahtable"><tbody><tr><th colspan="2">Przedmiot</th><th>Cena</th><th>Kup teraz</th><th>Koniec licytacji</th></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/zbr/prs_z04.gif" tip="&lt;b&gt;Wilcza ochrona&lt;/b&gt;Typ: Zbroje&lt;BR&gt;AC:106&lt;br/&gt;ACM:97&lt;br/&gt;Blokuje 81 obra¿eñ od trucizny&lt;br/&gt;Unik +15&lt;br/&gt;Wi¹¿e po za³o¿eniu&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 46&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:13083" tipcl="item"></div></td><td class="itemtype0">Wilcza ochrona<br>(lvl:46)</td><td>10k</td><td>-</td><td><b>48 h</b><br><small>14:26:33<br>6.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/miecz03.gif" tip="&lt;b&gt;Szeroki miecz&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:45-55&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 9&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Wojownik, Paladyn, Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:499" tipcl="item"></div></td><td class="itemtype0">Szeroki miecz<br>(lvl:9)</td><td>-</td><td>1.9k</td><td><b>48 h</b><br><small>14:50:04<br>6.6.2010</small></td></tr></tbody></table></div>

</div>


<div id="ahpanel"><h2>Jednorêczne</h2><div id="aufilter">Lvl od <input size="3" value="0" id="alvlmin" class="nr3"> do <input size="3" value="0" id="alvlmax" class="nr3"> Nie gorsze ni¿:<select id="aitype"><option value="0" selected="selected">zwyk³e</option><option value="1">unikaty</option><option value="2">heroiczne</option><option value="3">legendarne</option></select><br>Nazwa zawiera: <input style="width: 200px;" id="auname" value=""><br>Cena od <input size="3" value="0" id="aprmin" class="nr5"> do <input size="3" value="0" id="aprmax" class="nr5"> <button onclick="aapply()">Zastosuj</button></div><table id="ahtable"><tbody><tr><th colspan="2">Przedmiot</th><th>Cena</th><th>Kup teraz</th><th>Koniec licytacji</th></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/ros/ros59.gif" tip="&lt;b&gt;Bukiet œlubny&lt;/b&gt;&lt;b class=unique&gt;* unikat *&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;&lt;P&gt;Wyj¹tkowy bukiet przygotowany na specjaln¹&lt;br&gt;okazjê, jak¹ jest ceremonia wst¹pienia w&lt;br&gt;zwi¹zek ma³¿eñski.&lt;/P&gt;&lt;BR/&gt;&lt;br&gt;Wartoœæ:20" tipcl="item"></div></td><td class="itemtype1">Bukiet œlubny</td><td><input value="70k" size="4" id="ai30486294"><br><button onclick='aubid(30486294,"70k","0")'>Licytuj</button></td><td>-</td><td><b>4 min</b><br><small>14:50:15<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/ros/ros59.gif" tip="&lt;b&gt;Bukiet œlubny&lt;/b&gt;&lt;b class=unique&gt;* unikat *&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;&lt;P&gt;Wyj¹tkowy bukiet przygotowany na specjaln¹&lt;br&gt;okazjê, jak¹ jest ceremonia wst¹pienia w&lt;br&gt;zwi¹zek ma³¿eñski.&lt;/P&gt;&lt;BR/&gt;&lt;br&gt;Wartoœæ:20" tipcl="item"></div></td><td class="itemtype1">Bukiet œlubny</td><td><input value="500k" size="4" id="ai32325414"><br><button onclick='aubid(32325414,"500k","1m")'>Licytuj</button></td><td>1m<br><button onclick='buyout(32325414,"Bukiet%20%u015Blubny","1m",0)'>Kup teraz</button></td><td><b>12 min</b><br><small>14:58:06<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/szabla07.gif" tip="&lt;b&gt;Wiêksza szpada&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:96-117&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 18&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Wojownik, Paladyn, Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:1780" tipcl="item"></div></td><td class="itemtype0">Wiêksza szpada<br>(lvl:18)</td><td><input value="17k" size="4" id="ai32624297"><br><button onclick='aubid(32624297,"17k","25k")'>Licytuj</button></td><td>25k<br><button onclick='buyout(32624297,"Wi%u0119ksza%20szpada","25k",0)'>Kup teraz</button></td><td><b>1 h</b><br><small>15:19:06<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/drz/palka.gif" tip="&lt;b&gt;Kolczasta pa³ka tolloka&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:146-178&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;G³êboka rana, 10% szans na +120 obra¿eñ&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Tancerz ostrzy, Paladyn, Wojownik&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 35&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:6649" tipcl="item"></div></td><td class="itemtype0">Kolczasta pa³ka tolloka<br>(lvl:35)</td><td>-</td><td>8k<br><button onclick='buyout(32498467,"Kolczasta%20pa%u0142ka%20tolloka","8k",0)'>Kup teraz</button></td><td><b>1 h</b><br><small>15:20:56<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/miecz03.gif" tip="&lt;b&gt;Szeroki miecz&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:45-55&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 9&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Wojownik, Paladyn, Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:499" tipcl="item"></div></td><td class="itemtype0">Szeroki miecz<br>(lvl:9)</td><td><input value="1k" size="4" id="ai32667205"><br><button onclick='aubid(32667205,"1k","1k")'>Licytuj</button></td><td>1k<br><button onclick='buyout(32667205,"Szeroki%20miecz","1k",0)'>Kup teraz</button></td><td><b>1 h</b><br><small>15:27:51<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/sztylet12.gif" tip="&lt;b&gt;Sztylet magazyniera&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:353-431&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;G³êboka rana, 20% szans na +291 obra¿eñ&lt;br/&gt;Wi¹¿e po za³o¿eniu&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Wojownik, Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 70&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:26993" tipcl="item"></div></td><td class="itemtype0">Sztylet magazyniera<br>(lvl:70)</td><td>-</td><td>25k<br><button onclick='buyout(31357892,"Sztylet%20magazyniera","25k",0)'>Kup teraz</button></td><td><b>1 h</b><br><small>15:42:14<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/drz/tasak.gif" tip="&lt;b&gt;Tasak magazyniera&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:504-616&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;Si³a +39&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 70&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Wojownik, Paladyn, Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:26993" tipcl="item"></div></td><td class="itemtype0">Tasak magazyniera<br>(lvl:70)</td><td>-</td><td>20k<br><button onclick='buyout(31553442,"Tasak%20magazyniera","20k",0)'>Kup teraz</button></td><td><b>1 h</b><br><small>15:44:19<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/sztylet07.gif" tip="&lt;b&gt;Ostrze herszta&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:215-263&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;Wi¹¿e po za³o¿eniu&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Wojownik, Paladyn, Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 36&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:7021" tipcl="item"></div></td><td class="itemtype0">Ostrze herszta<br>(lvl:36)</td><td>-</td><td>50k<br><button onclick='buyout(31949729,"Ostrze%20herszta","50k",0)'>Kup teraz</button></td><td><b>1 h</b><br><small>15:57:54<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/szabla07.gif" tip="&lt;b&gt;Wiêksza szpada&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:96-117&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 18&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Wojownik, Paladyn, Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:1780" tipcl="item"></div></td><td class="itemtype0">Wiêksza szpada<br>(lvl:18)</td><td><input value="25k" size="4" id="ai31778054"><br><button onclick='aubid(31778054,"25k","30k")'>Licytuj</button></td><td>30k<br><button onclick='buyout(31778054,"Wi%u0119ksza%20szpada","30k",0)'>Kup teraz</button></td><td><b>1 h</b><br><small>16:01:45<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/drz/jed45.gif" tip="&lt;b&gt;Wekiera&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:120-147&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 22&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Wojownik, Paladyn, Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:2600" tipcl="item"></div></td><td class="itemtype0">Wekiera<br>(lvl:22)</td><td>-</td><td>18k<br><button onclick='buyout(31673385,"Wekiera","18k",0)'>Kup teraz</button></td><td><b>1 h</b><br><small>16:06:53<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/sztylet12.gif" tip="&lt;b&gt;Diamentowy sztylet&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:24-30&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;Zrêcznoœæ +7&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Tancerz ostrzy, Paladyn, Wojownik&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 5&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:199" tipcl="item"></div></td><td class="itemtype0">Diamentowy sztylet<br>(lvl:5)</td><td><input value="10k" size="4" id="ai32604287"><br><button onclick='aubid(32604287,"10k","10k")'>Licytuj</button></td><td>10k<br><button onclick='buyout(32604287,"Diamentowy%20sztylet","10k",0)'>Kup teraz</button></td><td><b>1 h</b><br><small>16:11:02<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/szabla07.gif" tip="&lt;b&gt;Wiêksza szpada&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:96-117&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 18&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Wojownik, Paladyn, Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:1780" tipcl="item"></div></td><td class="itemtype0">Wiêksza szpada<br>(lvl:18)</td><td><input value="3k" size="4" id="ai32349756"><br><button onclick='aubid(32349756,"3k","8k")'>Licytuj</button></td><td>8k<br><button onclick='buyout(32349756,"Wi%u0119ksza%20szpada","8k",0)'>Kup teraz</button></td><td><b>2 h</b><br><small>16:48:42<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/szabla07.gif" tip="&lt;b&gt;Wiêksza szpada&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:96-117&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 18&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Wojownik, Paladyn, Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:1780" tipcl="item"></div></td><td class="itemtype0">Wiêksza szpada<br>(lvl:18)</td><td>-</td><td>3k<br><button onclick='buyout(17114225,"Wi%u0119ksza%20szpada","3k",0)'>Kup teraz</button></td><td><b>3 h</b><br><small>17:38:03<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/miecz07.gif" tip="&lt;b&gt;Miecz tolloka&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:230-281&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Tancerz ostrzy, Paladyn, Wojownik&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 38&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:7425" tipcl="item"></div></td><td class="itemtype0">Miecz tolloka<br>(lvl:38)</td><td>-</td><td>8.9k<br><button onclick='buyout(32307653,"Miecz%20tolloka","8.9k",0)'>Kup teraz</button></td><td><b>3 h</b><br><small>17:40:50<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/tuz034.gif" tip="&lt;b&gt;Obroñca drzew&lt;/b&gt;&lt;b class=unique&gt;* unikat *&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:501-554&lt;br/&gt;Atak+Si³a/1.1&lt;br/&gt;SA +41%&lt;br/&gt;Obni¿a SA przeciwnika o 0.27&lt;br/&gt;Wi¹¿e po za³o¿eniu&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 65&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:36020" tipcl="item"></div></td><td class="itemtype1">Obroñca drzew<br>(lvl:65)</td><td><input value="100k" size="4" id="ai32539714"><br><button onclick='aubid(32539714,"100k","130k")'>Licytuj</button></td><td>130k<br><button onclick='buyout(32539714,"Obro%u0144ca%20drzew","130k",0)'>Kup teraz</button></td><td><b>3 h</b><br><small>17:43:52<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/dzik_miecz2.gif" tip="&lt;b&gt;Miecz gula&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:153-187&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;Cios krytyczny +2%&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Tancerz ostrzy, Paladyn, Wojownik&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 27&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:4035" tipcl="item"></div></td><td class="itemtype0">Miecz gula<br>(lvl:27)</td><td>-</td><td>4k<br><button onclick='buyout(27488166,"Miecz%20gula","4k",0)'>Kup teraz</button></td><td><b>3 h</b><br><small>17:47:30<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/gob_miecz1.gif" tip="&lt;b&gt;Prosty miecz goblina&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:166-203&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;Si³a +19&lt;br/&gt;Wi¹¿e po za³o¿eniu&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 29&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Wojownik, Paladyn, Tancerz ostrzy&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:5102" tipcl="item"></div></td><td class="itemtype0">Prosty miecz goblina<br>(lvl:29)</td><td>-</td><td>48k<br><button onclick='buyout(32545765,"Prosty%20miecz%20goblina","48k",0)'>Kup teraz</button></td><td><b>3 h</b><br><small>17:50:35<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/shj_m01.gif" tip="&lt;b&gt;Ognisty z³oty miecz&lt;/b&gt;&lt;b class=heroic&gt;* heroiczny *&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:302-369&lt;br/&gt;Atak+Si³a/1.3&lt;br/&gt;Obra¿enia od ognia ~373&lt;br/&gt;+40% szans na kontrê po krytyku&lt;br/&gt;Niszczy 35 ACM podczas ciosu&lt;br/&gt;Si³a +50&lt;br/&gt;SA +31%&lt;br/&gt;Si³a krytyka fizycznego +7%&lt;br/&gt;Wi¹¿e po za³o¿eniu&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Paladyn&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 46&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:27829" tipcl="item"></div></td><td class="itemtype2">Ognisty z³oty miecz<br>(lvl:46)</td><td><input value="7m" size="4" id="ai25431797"><br><button onclick='aubid(25431797,"7m","10m")'>Licytuj</button></td><td>10m<br><button onclick='buyout(25431797,"Ognisty%20z%u0142oty%20miecz","10m",0)'>Kup teraz</button></td><td><b>3 h</b><br><small>17:59:57<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/drz/palka.gif" tip="&lt;b&gt;Kolczasta pa³ka tolloka&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:146-178&lt;br/&gt;Atak+Si³a/1.2&lt;br/&gt;G³êboka rana, 10% szans na +120 obra¿eñ&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Tancerz ostrzy, Paladyn, Wojownik&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 35&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:6649" tipcl="item"></div></td><td class="itemtype0">Kolczasta pa³ka tolloka<br>(lvl:35)</td><td>-</td><td>6k<br><button onclick='buyout(32553242,"Kolczasta%20pa%u0142ka%20tolloka","6k",0)'>Kup teraz</button></td><td><b>3 h</b><br><small>18:07:37<br>4.6.2010</small></td></tr><tr><td><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/mie/shj-sword06.gif" tip="&lt;b&gt;Miecz potêpionego&lt;/b&gt;&lt;b class=unique&gt;* unikat *&lt;/b&gt;Typ: Jednorêczne&lt;BR&gt;Atak:516-630&lt;br/&gt;Atak+Si³a/1.3&lt;br/&gt;Obra¿enia od ognia ~636&lt;br/&gt;+35% szans na kontrê po krytyku&lt;br/&gt;Niszczy 56 ACM podczas ciosu&lt;br/&gt;Si³a krytyka fizycznego +9%&lt;br/&gt;Si³a krytyka magicznego +9%&lt;br/&gt;Wi¹¿e po za³o¿eniu&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Paladyn&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 74&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:53800" tipcl="item"></div></td><td class="itemtype1">Miecz potêpionego<br>(lvl:74)</td><td><input value="1.1m" size="4" id="ai31652844"><br><button onclick='aubid(31652844,"1.1m","0")'>Licytuj</button></td><td>-</td><td><b>4 h</b><br><small>18:18:34<br>4.6.2010</small></td></tr></tbody></table><center><button onclick="aunext()">dalej</button></center></div>

</div>

<div style="display: none; top: 330px; left: 508px;" class="ctip tip_item" id="oTip"><b>Szeroki miecz</b>Typ: Jednorêczne<br>Atak:45-55<br>Atak+Si³a/1.2<br><b class="att">Wymagany poziom: 9</b><br><b class="att2">Wymagana profesja: Wojownik, Paladyn, Tancerz ostrzy</b><br>Wartoœæ: 499</div>


<div id="minimap">
<div id="mmapbar"><div class="mapClose" onclick="hide('minimap',true)" 
rollover="22"></div></div>
<div id="mmaphtml">
<center><img src="game_data/minimap.png"></center>
<p style="padding: 10px;">
<b>1 - Ithan, 2 - Torneg,</b> 3 - Orla Grañ,
4 - Prze³êcz £otrzyków, 8 - Zniszczone Opactwo, <b>9 - Werbin,</b>
10 - Prze³êcz Dwóch Koron, 11 - Dolina Yss, 12 - Stare Ruiny,
<b>33 - Eder, 35 - Karka-han, 36 - Przedmieœcia Karka-han,</b>
37 - Brama Pó³nocy, 38 - Uroczysko, 84 - Wichrowe Szczyty,
110 - Dolina Rozbójników, <b>111 - Wioska Ghuli,</b> 115 - Mokrad³a,
116 - Zburzona Twierdza, 121 - Góry Zrêbowe, 122 - Nawiedzony Jar,
128 - Zachodnie Rozdro¿a, <b>137 - Wioska Pszczelarzy,</b> 138 - 
NiedŸwiedzi Uskok,
140 - Mroczny Przesmyk, 150 - Zapomniany Szlak, 151 - Kanion Straceñców,
<b>180 - Andarum Ilami,</b> 198 - Kanion Szaleñców, 214 - Spokojne 
Przejœcie,
222 - Zas³oniête Jezioro, 223 - S³oneczna Wy¿yna, 226 - Cienisty Bór,
229 - Las Dziwów, 244 - Fort Eder, 246 - Z³owrogie Bagna,
253 - Smocze Góry, <b>257 - Mythar,</b> 268 - B³êdny Szlak,
276 - Radosna Polana, 330 - Zawi³y Bór, 331 - Iglaste Œcie¿ki,
332 - Selva Oscura, <b>333 - Wioska Gnolli,</b> 339 - Gadzia Kotlina,
344 - Kwieciste Przejœcie, 347 - Lazurowe Wzgórze, 348 - Z³udny Trakt,
356 - Orcza Wy¿yna, <b>357 - Osada Czerwonych Orków,</b> 361 - Goœciniec
 Bardów, 
368 - Zatopiony Szczyt, 500 - Liœciaste Rozstaje, <b>574 - Nithal</b>
575 - Podgrodzie Nithal, 576 - Zapomniana Œcie¿yna, <b>579 - Szamañska 
Osada</b>,
599 - Bagna Chojraków, 600 - Nizina Wieœniaków, 631 - Dziewicza Knieja,
632 - Las Tropicieli, 701 - Sosnowe Odludzie, 708 - Zaginiona dolina, 
712 - Opuszczona Twierdza,
725 - Las Goblinów, 726 - Morwowe Przejœcie, 727 - Podmok³a Dolina,
730 - Zachodnia Rubie¿, 731 - Winnica Meflakasti, 845 - Baszta Wilczych 
K³ów,
900 - Dziki Zagajnik, 901 - Ukryty Kanion, 1057 - Skalista Wy¿yna, <b>1058
 - Wioska £owców, 
1059 - Obóz Wojaków, 1060 - Myœliwska Wioska, 1062 - Cygañska Wioska, 
1084 - Œwiêty Zagajnik</b>, 
1100 - Wyj¹cy W¹wóz, 1101 - Babi Wzgórek, 1108 - Leœna Prze³êcz, 1111 - 
Zapomniany Las,
1115 - Rozleg³a Równina, 1116 - G³uchy Las, 1131 - Pajêczy Las, 1137 - 
Ksiê¿ycowe Wzniesienie,
1141 - Trupia Prze³êcz, 1154 - Stare Sio³o, 1159 - P³askowy¿ Arpan, 1167
 - Sucha Dolina, 1219 - Prastara Puszcza,
1230 - Tygrysia Granica, 1235 - Osada Zulusów, 1263 - Kryjówka Dzikich 
Kotów, 1267 - Tygrysia Polana,
<b>1285 - Osada Mulusów</b>, 1293 - Upiorna Droga, 1294 - Sabatowe Góry,
 1297 - Tristam
</p>
</div>
</div>

<div id="oHelp">
<div class="closeQuest" onclick="hide('oHelp',true)" rollover="22"></div>
<div id="qSpacer"></div>
<div id="helpTxt"><br>
<p><b>Poruszanie siê</b> - klikamy myszk¹, lub trzymamy lewy przycisk 
myszy ca³y czas. Równie¿ strza³ki dzia³aj¹, ale trzeba wpierw
klikn¹æ gdzieœ na mapie, ¿eby okienko gry by³o aktywne.</p>
<p><b>Podnoszenie przedmiotów</b> - klikamy na naszego bohatera, kiedy 
stoi na przedmiocie.</p>
<p><b>Przechodzenie na inne mapy</b> - klikamy na siebie kiedy stoimy na
 przeŸroczystej ikonce drzwi.</p>
<p><b>Rozmowa/walka z postaciami</b> - podchodzimy do postaci i na ni¹ 
klikamy. Po walce przedmiot wpada 
do tzw. sakwy (pole to mruga na ¿ó³to) - trzeba taki przedmiot przenieœæ
 do torby, inaczej zostanie usuniêty
przy nastêpnej walce.</p>
<p><b>Przedmioty</b> przeci¹gamy aby za³o¿yæ, zdj¹æ, sprzedaæ lub kupiæ.
 Upuszczamy przedmioty
poprzez przeci¹gniêcie na dowolne miejsce mapy.</p>
<p><b>Leczenie</b> - Po walce zwykle tracimy parê punktów ¿ycia. Leczyæ 
siê mo¿na konsumuj¹c jakieœ po¿ywienie,
korzystaj¹c z pomocy postaci które lecz¹ lub obiektów jak magiczna 
studnia w Szamañskiej Osadzie.</p>
<p><b>Picie/jedzenie</b> - wystarczy przeci¹gn¹æ butelkê lub miêso na 
postaæ (tam gdzie zak³adamy przedmioty)</p>
<p><b>Konfiguracja</b> jest na stronie g³ównej (<a 
href="http://margonem.pl/" target="_top">margonem.pl</a>). Mo¿na w niej 
zmieniæ
wygl¹d postaci, nicka, etc.
</p><p><b>Pe³na pomoc i FAQ</b> znajduje siê pod adresem <a 
href="http://pomoc.margonem.pl/" target="_blank">pomoc.margonem.pl</a></p>
</div></div>
<div id="helpbut" rollover="20" onclick="show('oHelp',true)"></div>
<div id="logoutbut" rollover="20" 
onclick="wyloguj();"></div>

<div id="customdiv"></div>

<img class="fixit" src="game_data/lt-hor.png" style="position: absolute;
 left: 0pt; top: 0pt; z-index: 389;">
<img class="fixit" src="game_data/lt-ver.png" style="position: absolute;
 left: 0pt; top: 4px; z-index: 389;">
<img class="fixit" src="game_data/ld-hor.png" style="position: absolute;
 left: 0pt; top: 507px; z-index: 389;">
<img class="fixit" src="game_data/ld-ver.png" style="position: absolute;
 left: 0pt; top: 489px; z-index: 389;">
<img class="fixit" src="game_data/rt-hor.png" style="position: absolute;
 left: 489px; top: 0pt; z-index: 389;">
<img class="fixit" src="game_data/rt-ver.png" style="position: absolute;
 left: 508px; top: 4px; z-index: 389;">
<img class="fixit" src="game_data/rd-hor.png" style="position: absolute;
 left: 489px; top: 508px; z-index: 389;">
<img class="fixit" src="game_data/rd-ver.png" style="position: absolute;
 left: 508px; top: 491px; z-index: 389;">

<img id="sakwa" src="game_data/arrow-right.gif" style="position: 
absolute; left: 468px; top: 220px; z-index: 389; display: none;">

<style>
#miniMapContainer{
  display: none;
  position:absolute;
  border:1px solid #ffffff;
  z-index: 301;
}
#miniMapContainer div.point{
  position:absolute;
  z-index:101;
}
#miniMapContainer div.npc{
  background-color:#00ff00;
  z-index: 102;
}
#miniMapContainer div.other{
  background-color:#FFCCFF;
  z-index: 102;
}
#miniMapContainer div.attack{
  border: 1px solid #ff0000;
}
#miniMapContainer div.heros{
  background-color: #ffffff;
  border: 1px solid #000000;
}
#miniMapContainer div.elita{
  background-color: #00ffff;
}
#miniMapContainer div.gateway{
  background-color:#ffff00;
}
#miniMap ontainer div.hero{
  background-color:#ff0000;
  z-index:102;
}
#miniMapContainer div.legend{
  padding: 3px;
  border: 1px solid #ffffff;
  background-color: #606060;
  position: absolute;
  font-family: Verdana;
  color: #90ff90;
}
#miniMapContainer div.legend a{
  text-decoration:none;
  color: #00ffff;
}
div.minimap_tooltip{
  position:absolute;
  padding: 3px;
  font-family: Verdana;
  color: #90ff90;
  border: 1px solid #90ff90;
  background-color: #606060;
  display: none;
  z-index: 350;
}
div.minimap_tooltip div.head{
  padding:2px;
  background-color: #707070;
}
div.minimap_tooltip div.dataContainer span{
  color: #d4d4d4;
}
div.minimap_tooltip div.dataContainer span.elita{
  color: #00ffff;
}
div.minimap_tooltip div.dataContainer span.heros{
  color: #ffffff;
}
div.minimap_tooltip div.other{
  width: 32px;
  height: 48px;
}
div.minimap_tooltip div.image_container{
  float: left;
  margin-right: 15px;
  background-color:#808080;
  border: 1px solid #909090;
}
div.minimap_tooltip div.content{
  padding: 2px;
  background-color: #707070;
  margin-top: 2px;
}
div.minimap_tooltip div.dataContainer{
  width: 100px;
  float: right;
}
div.logWindow{
  position: absolute;
  width: 300px;
  height: 300px;
  border: 1 px solid #d4d4d4;
  background-color: #f1f1f1;
}
</style><div id="miniMapContainer"></div><div id="minimap_tooltip" 
class="minimap_tooltip"></div></body></html>

<div style="display: none;" id="oQuests"><div class="closeQuest" onclick="hide('oQuests',true)" rollover="22"></div>
<div id="qSpacer"></div><div id="questsTxt"><div class="cquest">Pomó¿ Aredheli otworzyæ sklep.<p>Zbierz 5 jagód i zanieœ je Aredheli.</p></div><div class="cquest">Bard Grant zniszczy³ mapê. Zdob¹dŸ now¹ dla niego.<p>Poproœ kartografa Slina z Karka-han, aby wykona³ dla ciebie now¹ mapê.</p></div><div class="cquest">Na trakcie widziano stado czarnych wilków, które atakuj¹ nieostro¿nych podró¿nych.<p>Udaj siê do Zniszczonego Opactwa i pozb¹dŸ siê stada czarnych wilków.</p><p class="qzad">Zabij: Czarny Wilk (4/5) </p></div><div class="cquest">Zagin¹³ wombat Andrzej, spróbuj go odnaleŸæ.<p>Odszukaj wombata. Je¿eli masz problemy, poradŸ siê Nyquisty.</p></div><div class="cquest">Rozpraw siê z ghulami w Wiosce Ghuli.<p class="qzad">Zabij: Ghul cmentarny (4/5) </p><p class="qzad">Zabij: Ghul s³abeusz (4/10) </p></div><div class="cquest">Zabij roje szerszeni przeszkadzaj¹ce kupcom, którzy podró¿uj¹ traktem pomiêdzy Werbin a Torneg.<p class="qzad">Zabij: Rój Szerszeni (5/5) </p></div></div></div>

<div style="display: none; top: 136px; left: 598px;" class="ctip tip_item" id="oTip"><b>Korona Krogora</b><b class="unique">* unikat *</b>Typ: He³my<br>AC:49<br>ACM:39<br>Wszystkie cechy +28<br>SA +18%<br>¯ycie +128<br>Zwi¹zany z w³aœcicielem<br><b class="att">Wymagany poziom: 40</b><br>Wartoœæ: 7754</div>

<div style="display: none;" id="clan" class="clanpage">
<div id="clanlogo"></div>

<div id="clancontent"><center><h2>Wybierz klan z listy</h2><span class="clanname" onclick="advget('clan','proc=official&amp;clanid=586')">AAH (187.1k)</span></center></div>

<div id="clanbar">
<span id="clanclose" onclick="hide('clan',true)" rollover="22"></span>
<span onclick="dbget('clan','proc=official')" style="width: 78px; margin-left: 15px;"></span>
<span onclick="dbget('clan','proc=private')" style="width: 96px;"></span>
<span onclick="dbget('clan','proc=members')" style="width: 91px;"></span> 
<span onclick="dbget('clan','proc=admin')" style="width: 83px;"></span>
<span onclick="dbget('clan','proc=bank')" style="width: 57px;"></span>
</div>
</div>

<div style="display: none;" id="config">
<img src="obrazki/interface/conf-title.png">
<div id="configin">
<div style="background-position: 0pt -22px;" class="opt" id="opt1" onclick="optclick(1)">Blokuj wiadomoœci prywatne</div>
<div style="background-position: 0pt -22px;" class="opt" id="opt6" onclick="optclick(6)">Blokuj pocztê od nieznajomych</div>
<div style="background-position: 0pt -22px;" class="opt" id="opt2" onclick="optclick(2)">Blokuj zaproszenia do klanu</div>
<div style="background-position: 0pt -22px;" class="opt" id="opt3" onclick="optclick(3)">Blokuj handel z innymi graczami</div>
<div style="background-position: 0pt -22px;" class="opt" id="opt5" onclick="optclick(5)">Blokuj proœby o akceptacjê przyjació³</div>
<div style="background-position: 0pt -22px;" class="opt" id="opt4" onclick="optclick(4)">Kiedy atakuje potwór pytaj o tryb walki</div>
<div style="background-position: 0pt -22px;" class="opt" id="opt7" onclick="optclick(7)">Wy³¹cz chodzenie myszk¹</div>
<center><table><tbody><tr>
<td><div id="cfgcancel" rollover="20" onclick="hide('config',true)"></div>
</td><td><div id="cfgsave" rollover="20" onclick="config_save()"></div>
</td></tr></tbody></table></center>
</div></div>

<div style="display: none; left: 281px; top: 182px;" id="menu"><center><div id="menuin"><button onclick="hide('menu',true);dbget('fight','auto=1&amp;attack=11501');">Szybka walka</button><button onclick="hide('menu',true);dbget('fight','auto=0&amp;attack=11501');">Walka turowa</button></div><button onclick="hide('menu',true)">Zamknij</button></center></div>

<div style="display: none;" id="battle">
<div style="background-image: url(&quot;cave04.png&quot;);" id="battleplace"><div><div style="border: medium none; visibility: hidden; display: none; left: 240px; top: 204px; background-position: 0px 48px; z-index: 378; background-image: url(&quot;game_data/obrazki/interface/m_lowca08.gif&quot;);" id="UID_dab7c0" class="cItem"></div></div><div><img src="http://game9.margonem.pl/obrazki/npc/hum/klan_dow.gif" style="border: 1px solid red; visibility: hidden; display: none; left: 239px; top: 161px; z-index: 376;" id="UID_ca4af1" class="cItem"></div></div>
<div id="battlebuttons">
<table id="battle_me"><tbody><tr><td id="mana">0</td><td id="energy">82</td></tr></tbody></table>

<div id="battletime">Walka zakoñczona</div>
<div id="bt_attack" onclick="doFight('attack')" rollover="19"></div>
<div id="bt_move" onclick="doFight('move')" rollover="19"></div>
<select id="spell" size="6">
<option value="51">Celne uderzenie</option></select>
<div style="background-position: 0pt 0pt;" id="bt_use" onclick="doFight('spell')" rollover="19"></div>
<div style="background-position: 0pt -38px;" id="closebattle" onclick="doFight('quit')" rollover="19"></div>
</div>
<div id="battlein"><p class="battr100">Rozpoczê³a siê walka pomiêdzy <b>hajssss(51h)</b> a <b>Wilcza Paszcza(48)</b></p><p class="battr1">hajssss(100%) atakuje przeciwnika z si³¹ 617<br>+g³êboka rana<br>+obni¿enie AC o 50<br>332 obra¿eñ przyj¹³ Wilcza Paszcza(86%)</p><p class="battr4">280 obra¿eñ z powodu g³êbokiej rany otrzyma³ Wilcza Paszcza(74%)</p><p class="battr1">hajssss(100%) atakuje przeciwnika z si³¹ 841<br>+obni¿enie AC o 50<br>591 obra¿eñ przyj¹³ Wilcza Paszcza(48%)</p><p class="battr4">280 obra¿eñ z powodu g³êbokiej rany otrzyma³ Wilcza Paszcza(35%)</p><p class="battr2">Wilcza Paszcza zrobi³ krok do przodu.</p><p class="battr1">hajssss(100%) atakuje przeciwnika z si³¹ 861<br>+obni¿enie AC o 50<br>659 obra¿eñ przyj¹³ Wilcza Paszcza(6%)</p><p class="battr4">280 obra¿eñ z powodu g³êbokiej rany otrzyma³ Wilcza Paszcza(0%)</p><p class="battr50">hajssss zdoby³ £eb wywerny</p><p class="battr101">Zwyciê¿y³(a) hajssss</p><p class="battr101">Zdobyto ³¹cznie 1078 punktów doœwiadczenia</p></div></div>

<div style="display: none;" id="battle">
<div style="background-image: url(&quot;cave04.png&quot;);" id="battleplace"><div><div style="border: medium none; visibility: visible; display: block; left: 240px; top: 154px; background-position: 0px 48px; z-index: 378; background-image: url(&quot;game_data/obrazki/interface/m_lowca08.gif&quot;);" id="UID_dab7c0" class="cItem"></div></div><div><img src="http://game9.margonem.pl/obrazki/npc/hum/klan_dow.gif" style="border: 1px solid red; visibility: hidden; display: none; left: 239px; top: 161px; z-index: 376;" id="UID_ca4af1" class="cItem"></div><div><img src="bestia64.gif" style="border: 1px solid red; visibility: visible; display: block; left: 240px; top: 121px; z-index: 374;" id="UID_e951bb" class="cItem"></div></div>
<div id="battlebuttons">
<table id="battle_me"><tbody><tr><td id="mana">0</td><td id="energy">100</td></tr></tbody></table>
<div id="battletime">Walka Zakoñczona</div>
<div style="background-position: 0pt 0pt;" id="bt_attack" onclick="doFight('attack')" rollover="19"></div>
<div style="background-position: 0pt 0pt;" id="bt_move" onclick="doFight('move')" rollover="19"></div>
<select id="spell" size="6">
<option value="51">BRAK SKILLI!!!</option></select>
<div style="background-position: 0pt 0pt;" id="bt_use" onclick="doFight('spell')" rollover="19"></div>
<div style="background-position: 0pt -38px;" id="closebattle" onclick="doFight('quit')" rollover="19"></div>
</div>

<div id="battlein"><p class="battr100">Rozpoczê³a siê walka pomiêdzy <b>Rockis(2w)</b> a <b>¯aba(2)</b></p><p class="battr1">Rockis(100%) atakuje przeciwnika z si³¹ 13<br>12 obra¿eñ przyj¹³ ¯aba(76%)</p><p class="battr2">¯aba(76%) atakuje przeciwnika z si³¹ 4<br>0 obra¿eñ przyj¹³ Rockis(100%)</p><p class="battr1">Rockis(100%) atakuje przeciwnika z si³¹ 17<br>16 obra¿eñ przyj¹³ ¯aba(44%)</p><p class="battr2">¯aba(44%) atakuje przeciwnika z si³¹ 4<br>0 obra¿eñ przyj¹³ Rockis(100%)</p><p class="battr1">Rockis(100%) atakuje przeciwnika z si³¹ 18<br>17 obra¿eñ przyj¹³ ¯aba(8%)</p><p class="battr2"><p class="battr1">Rockis(100%) atakuje przeciwnika z si³¹ 11<br>10 obra¿eñ przyj¹³ ¯aba(0%)</p><p class="battr2"><p class="battr50">Rockis zdoby³ ¯abie udka</p><p class="battr101">Zwyciê¿y³(a) Rockis</p><p class="battr101">Zdobyto ³¹cznie 9 punktów doœwiadczenia</p></div></div>

<div style="display: none;" id="skills">
<h1 class=stopic>
<div class=skillClose rollover=22></div>
Twoje umiejêtnoœci</h1>
<div id=skillslist>
</div>
</div>
<div style="display: none;" id="friends">
<div style="background-position: 0pt 0pt;" class="motelClose" onclick="hide('friends',true)" rollover="22"></div>
<div id="myfriends"></div>
<div id=mfadd><div id=fradd rollover=22></div>
<input type='text' class=frinp id='frname'></div>
<div id="myenemies"></div>
</div>

<div style="display: none;" id="mails">
<div id="mailbar"><div style="background-position: 0pt 0pt;" class="mapClose" onclick="hide('mails',true)" rollover="22"></div></div>
<div id="mailcontainer">
	<div id="outbox"><button onclick="newmail()">Nowa wiadomoœæ</button> (koszt 1 wiadomoœci to zawsze 100 z³ota)
	<div style="display: none;" id="newmail"><div id="mailitem"><center>Przedmiot do³aczony do wiadomoœci:<div id="attitem"></div>

	<button onclick="delatt()">usuñ</button></center></div><textarea id="mailmsg"></textarea>
	Adresat:<input size="10" maxlength="30" id="receiver"> Z³oto:<input size="5" id="mailgold">
 	<button onclick="hide('newmail',false)">Anuluj</button> <button onclick="sendmail()">Wyœlij</button></div>
	</div>
	<div id="inbox"><div class="mail"><div class="mailattdel" rollover="22" tip="Pobierz i usuñ" onclick='dbget("mails","proc=del&amp;from=hajssss&amp;ts=1275654463&amp;bag="+global.bag)'></div><div class="mailatt" rollover="22" tip="Pobierz za³¹cznik" onclick='dbget("mails","proc=get&amp;from=hajssss&amp;ts=1275654463&amp;bag="+global.bag)'></div><div class="mailrep" rollover="22" tip="Odpowiedz" onclick='mailreply("hajssss")'></div>Od: <b>hajssss</b> 14:27:43 4.6.2010<br><b>Za³¹czniki:</b><div class="anitem"><img src="http://www.margonem.pl/obrazki/itemy/luk/luk_ork.gif" tip="&lt;b&gt;£uk wilczego oka&lt;/b&gt;Typ: Dystansowe&lt;BR&gt;Atak:154-176&lt;br/&gt;Atak+Zrêcznoœæ/1.2&lt;br/&gt;Obra¿enia od b³yskawic 1-895&lt;br/&gt;Przebicie pancerza +20% szans&lt;br/&gt;&lt;B class=att&gt;Wymagana profesja: Tropiciel&lt;/B&gt;&lt;br/&gt;&lt;B class=att&gt;Wymagany poziom: 45&lt;/B&gt;&lt;br/&gt;&lt;br&gt;Wartoœæ:11369" tipcl="item"></div><br>sda</div></div>

<div style="display: none; top: 324px; left: 460px;" class="ctip tip_item" id="oTip"><b>Eliksir zdrowia z jadu ¿aby</b>Typ: Konsumpcyjne<br>Leczy 850 punktów ¿ycia<br>Iloœæ: 3<br>Wartoœæ: 538</div>

<div id="dazed"><b>Jesteœ nieprzytomny.</b><br>Nie wiesz co siê wokó³ 
Ciebie dzieje. 
Chyba ktoœ Ciê przenosi.<br> Ockniesz siê, kiedy si³y wróc¹ Ci za <b 
id="dazedleft"></b></div>
