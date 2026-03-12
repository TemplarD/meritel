<?php
/**
 * Конфигурация базы данных
 * 
 * Поддерживает оба режима:
 * - mysql_* (устаревший, для совместимости)
 * - PDO (рекомендуемый)
 * 
 * Для продакшена используйте переменные окружения.
 */

define(MySQLprefix, "viz620");

// === НАСТРОЙКИ ПОДКЛЮЧЕНИЯ ===
// Для Docker: DB_HOST=db, для локального: DB_HOST=localhost
$db_host = getenv('DB_HOST') ?: 'db';
$db_user = getenv('DB_USER') ?: 'meritel';
$db_pass = getenv('DB_PASSWORD') ?: 'meritel123';
$db_name = getenv('DB_NAME') ?: 'viz620';

// Глобальное подключение
$GLOBALS['db_link'] = null;

// Попытка mysql подключения (для обратной совместимости)
if (function_exists('mysql_connect')) {
    $GLOBALS['db_link'] = mysql_connect($db_host, $db_user, $db_pass);
    if ($GLOBALS['db_link']) {
        mysql_query("SET NAMES utf8");
        mysql_select_db($db_name);
    }
}

/**
 * PDO подключение (новый стандарт)
 */
function get_pdo() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $db_host = getenv('DB_HOST') ?: 'db';
            $db_name = getenv('DB_NAME') ?: 'viz620';
            $db_user = getenv('DB_USER') ?: 'meritel';
            $db_pass = getenv('DB_PASSWORD') ?: 'meritel123';
            
            $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            $pdo = new PDO($dsn, $db_user, $db_pass, $options);
        } catch (PDOException $e) {
            error_log("PDO Error: " . $e->getMessage());
            return null;
        }
    }
    return $pdo;
}

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