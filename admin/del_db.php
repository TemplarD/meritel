<?php
ini_set('display_errors', 0);
session_start();
include("_mysql.php");
mysql_query("DROP TABLE `".MySQLprefix."_additional`, `".MySQLprefix."_admins`, `".MySQLprefix."_anons`, `".MySQLprefix."_goods`, `".MySQLprefix."_mypages`, `".MySQLprefix."_news`, `".MySQLprefix."_partners`, `".MySQLprefix."_photoalb`, `".MySQLprefix."_photogal`, `".MySQLprefix."_production`, `".MySQLprefix."_slides`, `".MySQLprefix."_urls`;");
?>