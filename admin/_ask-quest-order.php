<?
session_start();
include("_csrf.php");
include("_pdo.php");

// CSRF проверка
csrf_validate_or_die();

// Проверка капчи
if(!isset($_SESSION['captcha_keystring']) || $_SESSION['captcha_keystring'] !== $_POST['keystring']){ ?><p style="color:red">Введите цифры на картинке!</p><? exit; }

include("_additional.php");

// Очищаем данные
$name = htmlspecialchars($_POST['name']);
$text = htmlspecialchars($_POST['text']);

// Вставка через PDO
pdo_insert(MySQLprefix."_faq", [
    'name' => $name,
    'question' => $text,
    'st' => 0
]);

$headers  = 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8'."\r\n".'From: '.$additional[2].' <noreplay@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
mail($additional[11], 'Отзыв от '.$name, '<p>'.$name.':<br/><i>'.$text.'</i></p>', $headers);
?>
<p style="color:green">Сообщение отправлено. Мы опубликуем его на сайте после проверки модератором.</p>