<?
session_start();
include("_csrf.php");
include("_pdo.php");

// CSRF проверка
csrf_validate_or_die();

// Проверка капчи
if(!isset($_SESSION['captcha_keystring']) || $_SESSION['captcha_keystring'] !== $_POST['keystring']){ ?><p style="color:red">Введите цифры на картинке!</p><? exit; }

include("_additional.php");

// Очищаем данные (PDO prepared statements защищают от SQL injection)
$name = htmlspecialchars($_POST['name']);
$contacts = htmlspecialchars($_POST['contacts']);
$text = htmlspecialchars($_POST['text']);

$headers  = 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8'."\r\n".'From: '.$additional[2].' <noreplay@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
mail($additional[11], 'Письмо от '.$name, '<p>'.$name.' ('.$contacts.'):<br/><i>'.$text.'</i></p>', $headers);
?>
<p style="color:green">Сообщение отправлено. Менеджер свяжется с Вами в ближайшее время.</p>