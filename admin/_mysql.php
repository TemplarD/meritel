<?php
/**
 * Конфигурация базы данных
 * 
 * ВНИМАНИЕ: Этот файл содержит чувствительные данные!
 * Для продакшена используйте переменные окружения.
 * 
 * Настройте параметры подключения ниже или используйте .env файл.
 */

define(MySQLprefix, "viz620");

// === НАСТРОЙКИ ПОДКЛЮЧЕНИЯ ===
// Замените на ваши параметры или используйте переменные окружения
$m_Link = mysql_connect("localhost", "meritel", "meritel123") or die ("<!-- Ошибка подключения к серверу. -->");
mysql_query("SET NAMES utf8");
mysql_select_db("viz620") or die ("<!-- Ошибка соединения с БД. -->");

function textTrimm($text, $length){
	$s_text = strip_tags($text);
	return (strlen($s_text) > $length ? substr($s_text, 0, strrpos(substr($s_text, 0, $length), " ")).' ...' : $s_text);
}
function getmicrotime(){
    list($usec, $sec) = explode(" ", microtime()); 
    return ((float)$usec + (float)$sec); 
}
function mysql_real_escape_string_Array($ar){
	foreach($ar AS $key => $val)
		if(is_array($ar[$key]))
			$ar[$key] = mysql_real_escape_string_Array($ar[$key]);
		else
			$ar[$key] = mysql_real_escape_string($ar[$key]);
	return $ar;
}

$_POST = mysql_real_escape_string_Array($_POST);
$_GET = mysql_real_escape_string_Array($_GET);

$FILE_TYPE_ENABLED = array(
	'files' => array('7z', 'avi', 'bmp', 'csv', 'doc', 'flv', 'gif', 'gz', 'gzip', 'ico', 'jpeg', 'jpg', 'mov', 'mp3', 'mp4', 'mpeg', 'mpg', 'pdf', 'png', 'ppt', 'psd', 'rar', 'rtf', 'swf', 'tar', 'tgz', 'tif', 'tiff', 'txt', 'wma', 'wmv', 'xls', 'xml', 'zip'),
	'images'	=> array('jpg', 'jpeg', 'gif', 'png', 'bmp', 'psd')
);
$FILE_TYPE_DISABLED = array('php','php3','php4','php5','phtml','asp','aspx','ascx','jsp','cfm','cfc','pl','bat','exe','dll','reg','cgi');


?>