<?php
$additional_r = mysql_query("SELECT * FROM ".MySQLprefix."_additional");
while($additional_i = mysql_fetch_assoc($additional_r))
	$additional[$additional_i['id']] = $additional_i['text'];
$katalog_a = mysql_fetch_assoc(mysql_query("SELECT menu, url FROM ".MySQLprefix."_mypages WHERE id='2'"));
$photogal_a = mysql_fetch_assoc(mysql_query("SELECT menu, url FROM ".MySQLprefix."_mypages WHERE id='64'"));
?>