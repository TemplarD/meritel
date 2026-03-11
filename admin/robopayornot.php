<?php
$HEVA_CMS = "3.1.5.20130222";
session_start();
include('_mysql.php');
include('_additional.php');
$mrh_pass2 = $additional[53];
$tm=getdate(time()+9*3600);
$date="$tm[year]-$tm[mon]-$tm[mday] $tm[hours]:$tm[minutes]:$tm[seconds]";
$out_summ = $_REQUEST["OutSum"];
$inv_id = $_REQUEST["InvId"];
$shp_item = $_REQUEST["Shp_item"];
$crc = $_REQUEST["SignatureValue"];
$crc = strtoupper($crc);
$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:Shp_item=$shp_item"));
if ($my_crc !=$crc){
	echo "bad sign\n";
	exit();
}
echo "OK$inv_id\n";

mysql_query("UPDATE ".MySQLprefix."_orders SET payed=1 WHERE id='".$inv_id."'");
$headers  = 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8'."\r\n".'From: '.$additional[2].' <noreplay@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
mail($additional[9], 'Оплата заказа', '<p>ЗАКАЗ <b>№'.$inv_id.'</b> на сумму <b>'.$out_summ.' р.</b> <strong style="color:green">ОПЛАЧЕН</strong></p></p>', $headers);

$f=@fopen("robo_orders.txt","a+") or die("error");
fputs($f,"order_num :$inv_id;Summ :$out_summ;Date :$date\n");
fclose($f);
?>