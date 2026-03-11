<?
session_start();
if(!isset($_SESSION['captcha_keystring']) || $_SESSION['captcha_keystring'] !== $_POST['keystring']){ ?><p style="color:red">Введите цифры на картинке!</p><? exit; }
include("_mysql.php");
include("_additional.php");
$headers  = 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8'."\r\n".'From: '.$additional[2].' <noreplay@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
mail($additional[11], 'Письмо от '.$_POST['name'], '<p>'.$_POST['name'].' ('.$_POST['contacts'].'):<br/><i>'.$_POST['text'].'</i></p>', $headers);
?>
<p style="color:green">Сообщение отправлено. Менеджер свяжется с Вами в ближайшее время.</p>