<?php
require_once('../php/mysql-connect.php');
mysql_query("update postac set zalogowany = 0 where id = ".$_SESSION['postac']." ");

$_SESSION['postac'] = 0;
echo "Wylogowales sie. Odswiez aby wyjsc do menu Glownego";
exit;
?>