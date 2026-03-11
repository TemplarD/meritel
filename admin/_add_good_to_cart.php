<?php
$HEVA_CMS = "3.1.5.20130222";
session_start();
include('_mysql.php');
if(isset($_POST['good']) && strlen($_POST['good'])<10 && is_numeric($_POST['good'])){
	$kols = mysql_query("SELECT kol FROM ".MySQLprefix."_cart WHERE user='".$_SESSION['user']."' AND good='".$_POST['good']."' AND status=1");
	if(mysql_num_rows($kols)==0)
		$Query = "INSERT INTO `".MySQLprefix."_cart` (`kol`, `user`, `good`) VALUES ('".$_POST['kol']."', '".$_SESSION['user']."', '".$_POST['good']."')";
	else
		$Query = "UPDATE ".MySQLprefix."_cart SET kol=kol+".$_POST['kol']." WHERE user='".$_SESSION['user']."' AND good='".$_POST['good']."'";
}else{
	$data = explode('|', $_POST['good']);
	foreach($data AS $line)
		if(strlen($line) > 0)
			$good[] = explode(":", $line);
	$kols = mysql_query("SELECT kol FROM ".MySQLprefix."_cart WHERE user='".$_SESSION['user']."' AND good='".$good[count($good)-1][1]."' AND mods='".$_POST['good']."' AND status=1");
	if(mysql_num_rows($kols)==0)
		$Query = "INSERT INTO `".MySQLprefix."_cart` (`kol`, `user`, `good`, `mods`, `price`) VALUES ('".$_POST['kol']."', '".$_SESSION['user']."', '".$good[count($good)-1][1]."', '".$_POST['good']."', '".$good[count($good)-2][1]."')";
	else
		$Query = "UPDATE ".MySQLprefix."_cart SET kol=kol+".$_POST['kol']." WHERE user='".$_SESSION['user']."' AND good='".$good[count($good)-1][1]."' AND mods='".$_POST['good']."'";
}
$res3 = mysql_query($Query);
echo mysql_result(mysql_query("SELECT SUM(kol) FROM ".MySQLprefix."_cart WHERE user='".$_SESSION['user']."' AND status=1"), 0);
?>