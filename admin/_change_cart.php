<?php
session_start();
include('_pdo.php');
include('_csrf.php');

pdo_update(
    MySQLprefix."_cart",
    ['kol' => (int)$_POST['kol']],
    "user = ? AND id = ?",
    [$_SESSION['user'], (int)$_POST['id']]
);

$total = pdo_fetch_column(
    "SELECT SUM(kol) FROM ".MySQLprefix."_cart WHERE user = ? AND status = 1",
    [$_SESSION['user']]
);
echo $total ?: 0;
?>
