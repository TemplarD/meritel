<?php
/**
 * Конфигурация базы данных
 * 
 * Для локальной разработки скопируйте .env.example в .env
 * и настройте параметры подключения.
 * 
 * Для продакшена используйте переменные окружения.
 */

// Загрузка .env файла (если существует)
if (file_exists(__DIR__ . '/../.env')) {
    $env = parse_ini_file(__DIR__ . '/../.env');
    if ($env) {
        extract($env);
    }
}

// Получение параметров из переменных окружения или дефолтные значения
define('MySQLprefix', getenv('DB_PREFIX') ?: 'viz620');

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'viz620';
$db_user = getenv('DB_USER') ?: 'meritel';
$db_pass = getenv('DB_PASSWORD') ?: '';

// Подключение к базе данных
$m_Link = mysql_connect($db_host, $db_user, $db_pass) or die ("<!-- Ошибка подключения к серверу. -->");
mysql_query("SET NAMES utf8");
mysql_select_db($db_name) or die ("<!-- Ошибка соединения с БД: $db_name -->");

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
    'images'  => array('jpg', 'jpeg', 'gif', 'png', 'bmp', 'psd')
);

$FILE_TYPE_DISABLED = array('php','php3','php4','php5','phtml','asp','aspx','ascx','jsp','cfm','cfc','pl','bat','exe','dll','reg','cgi');
?>
