<?php
session_start();
include('_pdo.php');

pdo_delete(
    MySQLprefix."_cart",
    "user = ? AND id = ?",
    [$_SESSION['user'], (int)$_POST['id']]
);

$total = pdo_fetch_column(
    "SELECT SUM(kol) FROM ".MySQLprefix."_cart WHERE user = ? AND status = 1",
    [$_SESSION['user']]
);
echo $total ?: 0;
?>
