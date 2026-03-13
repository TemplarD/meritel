<?php
session_start();
include("_mysql.php");
include("_pdo.php");
include('_csrf.php');

// Проверяем good
$good_id = isset($_POST['good']) ? $_POST['good'] : '';
$kol = isset($_POST['kol']) && is_numeric($_POST['kol']) ? (int)$_POST['kol'] : 1;
$user = $_SESSION['user'];

if(empty($good_id) || empty($user)) {
    echo "0";
    exit;
}

// Простой товар (только ID)
if(is_numeric($good_id) && strlen($good_id)<10) {
    $kols = pdo_fetch_one(
        "SELECT kol FROM ".MySQLprefix."_cart WHERE user = ? AND good = ? AND status = 1",
        [$user, $good_id]
    );
    
    if(!$kols) {
        pdo_insert(MySQLprefix."_cart", [
            'kol' => $kol,
            'user' => $user,
            'good' => $good_id,
            'status' => 1
        ]);
    } else {
        pdo_query(
            "UPDATE ".MySQLprefix."_cart SET kol = kol + ? WHERE user = ? AND good = ? AND status = 1",
            [$kol, $user, $good_id]
        );
    }
} else {
    // Товар с модификаторами
    $data = explode('|', $good_id);
    foreach($data AS $line) {
        if(strlen($line) > 0) {
            $good[] = explode(":", $line);
        }
    }
    
    $good_id_final = $good[count($good)-1][1];
    $price = isset($good[count($good)-2][1]) ? $good[count($good)-2][1] : '';
    
    $kols = pdo_fetch_one(
        "SELECT kol FROM ".MySQLprefix."_cart WHERE user = ? AND good = ? AND mods = ? AND status = 1",
        [$user, $good_id_final, $good_id]
    );
    
    if(!$kols) {
        pdo_insert(MySQLprefix."_cart", [
            'kol' => $kol,
            'user' => $user,
            'good' => $good_id_final,
            'mods' => $good_id,
            'price' => $price,
            'status' => 1
        ]);
    } else {
        pdo_query(
            "UPDATE ".MySQLprefix."_cart SET kol = kol + ? WHERE user = ? AND good = ? AND mods = ? AND status = 1",
            [$kol, $user, $good_id_final, $good_id]
        );
    }
}

// Возвращаем общее количество
$total = pdo_fetch_column(
    "SELECT SUM(kol) FROM ".MySQLprefix."_cart WHERE user = ? AND status = 1",
    [$user]
);
echo $total ?: 0;
?>
