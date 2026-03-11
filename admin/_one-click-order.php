<?
session_start();
include("_csrf.php");

// CSRF проверка
csrf_validate_or_die();

// Проверка капчи
if(!isset($_SESSION['captcha_keystring']) || $_SESSION['captcha_keystring'] !== $_POST['keystring']){ ?><p style="color:red">Введите цифры на картинке!</p><? exit; }

$HEVA_CMS = "3.1.5.20130222";
include('_mysql.php');
include('_additional.php');
$in_cart = '<table cellpadding="2" cellspacing="0" border="1" width="100%"><tr><td align="left">Товар</td><td align="center">Количество</td><td align="right">Цена, руб.</td><td align="right">Сумма, руб.</td></tr><tr><td align="left"><a href="'.$_SERVER['HTTP_HOST'].'/goods/'.$_POST['good'].'/">'.$_POST['title'].'</a></td><td align="center">1</td><td align="right">'.$_POST['price'].'</td><td align="right">'.$_POST['price'].'</td></tr><tr><td colspan="3" align="right">Итого:</td><td align="right">'.$_POST['price'].'</td></tr></table>';
$customer_data = '<p>ФИО: <b>'.$_POST['name'].'</b><br/>Телефон: <b>'.$_POST['contacts'].'</b><br/>';
if(strlen($_POST['text'])>0)
  $customer_data .= 'Коментарии к заказу: <i>'.$_POST['text'].'</i></p>';
$customer_data .= '<br/><center><p>СОСТАВ ЗАКАЗА</p></center><br/>';
$headers  = 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8'."\r\n".'From: '.$additional[2].' <noreplay@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
mail($additional[11], 'Новый заказ /быстрый/', $customer_data.$in_cart, $headers);
?>Заказ принят. Менеджер свяжется с вами в ближайшее время.