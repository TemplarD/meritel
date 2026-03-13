<?
session_start();
include("_mysql.php");
include("_pdo.php");
include("_csrf.php");
include("_additional.php");

// CSRF проверка
csrf_validate_or_die();

// Проверка капчи
if(!isset($_SESSION['captcha_keystring']) || $_SESSION['captcha_keystring'] !== $_POST['keystring']){ 
    echo '<p style="color:red">Введите цифры на картинке!</p>';
    exit; 
}

// Валидация данных
$name = trim(htmlspecialchars($_POST['name']));
$contacts = trim(htmlspecialchars($_POST['contacts']));
$text = trim(htmlspecialchars($_POST['text']));
$good = (int)$_POST['good'];
$title = trim(htmlspecialchars($_POST['title']));
$price = (float)$_POST['price'];

if(empty($name) || empty($contacts)) {
    echo '<p style="color:red">Заполните обязательные поля!</p>';
    exit;
}

// Сохранение заказа в БД
try {
    $order_id = pdo_insert(MySQLprefix."_orders", [
        'user' => $_SESSION['user'],
        'status' => 1, // Новый заказ
        'customer_name' => $name,
        'customer_phone' => $contacts,
        'customer_coment' => $text,
        'data' => date('Y-m-d H:i:s'),
        'done' => 0,
        'payed' => 0
    ]);
    
    // Формирование письма
    $in_cart = '<table cellpadding="2" cellspacing="0" border="1" width="100%">
        <tr><td align="left">Товар</td><td align="center">Кол-во</td><td align="right">Цена</td><td align="right">Сумма</td></tr>
        <tr><td align="left"><a href="'.$_SERVER['HTTP_HOST'].'/goods/'.$good.'/">'.$title.'</a></td>
            <td align="center">1</td><td align="right">'.$price.'</td><td align="right">'.$price.'</td></tr>
        <tr><td colspan="3" align="right">Итого:</td><td align="right">'.$price.'</td></tr>
    </table>';
    
    $customer_data = '<p><b>Заказ №'.$order_id.'</b></p>
        <p>ФИО: <b>'.$name.'</b><br/>Телефон: <b>'.$contacts.'</b><br/>';
    if(!empty($text)) {
        $customer_data .= 'Комментарий: <i>'.$text.'</i></p>';
    }
    $customer_data .= '<br/><center><p>СОСТАВ ЗАКАЗА</p></center><br/>'.$in_cart;
    
    $headers = 'MIME-Version: 1.0'."\r\n".
        'Content-type: text/html; charset=utf-8'."\r\n".
        'From: '.$additional[2].' <noreplay@'.$_SERVER['SERVER_NAME'].'>'."\r\n".
        'Reply-To: '.$additional[11]."\r\n";
    
    mail($additional[11], 'Новый заказ №'.$order_id.' (быстрый)', $customer_data, $headers);
    
    echo "Заказ №$order_id принят. Менеджер свяжется с вами в ближайшее время.";
    
} catch(Exception $e) {
    error_log("Order Error: " . $e->getMessage());
    echo '<p style="color:red">Ошибка при оформлении заказа!</p>';
}
?>
