<?php
$HEVA_CMS = "3.1.5.20130222";
session_start();
include('_mysql.php');
$Query = "DELETE FROM ".MySQLprefix."_cart WHERE user='".$_SESSION['user']."' AND id=".$_POST['id'];
$res3 = mysql_query($Query);
echo mysql_result(mysql_query("SELECT SUM(kol) FROM ".MySQLprefix."_cart WHERE user='".$_SESSION['user']."' AND status=1"), 0);
?>