<?php
session_start();
include('_mysql.php');
include('_pdo.php');
include('_promo.php');
header('Content-Type: application/json');

$code = isset($_POST['code']) ? $_POST['code'] : '';
$order_sum = isset($_POST['order_sum']) ? (float)$_POST['order_sum'] : 0;

if($order_sum <= 0) {
    echo json_encode(['success' => false, 'error' => 'Сумма заказа некорректна']);
    exit;
}

$result = promo_apply($code, $order_sum);
echo json_encode($result);
?>
