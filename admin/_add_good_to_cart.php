<?php
session_start();
include('_pdo.php');

if(isset($_POST['good']) && strlen($_POST['good'])<10 && is_numeric($_POST['good'])){
    $kols = pdo_fetch_one(
        "SELECT kol FROM ".MySQLprefix."_cart WHERE user = ? AND good = ? AND status = 1",
        [$_SESSION['user'], $_POST['good']]
    );
    
    if(!$kols) {
        pdo_insert(MySQLprefix."_cart", [
            'kol' => (int)$_POST['kol'],
            'user' => $_SESSION['user'],
            'good' => $_POST['good']
        ]);
    } else {
        pdo_query(
            "UPDATE ".MySQLprefix."_cart SET kol = kol + ? WHERE user = ? AND good = ?",
            [(int)$_POST['kol'], $_SESSION['user'], $_POST['good']]
        );
    }
} else {
    $data = explode('|', $_POST['good']);
    foreach($data AS $line) {
        if(strlen($line) > 0) {
            $good[] = explode(":", $line);
        }
    }
    
    $kols = pdo_fetch_one(
        "SELECT kol FROM ".MySQLprefix."_cart WHERE user = ? AND good = ? AND mods = ? AND status = 1",
        [$_SESSION['user'], $good[count($good)-1][1], $_POST['good']]
    );
    
    if(!$kols) {
        pdo_insert(MySQLprefix."_cart", [
            'kol' => (int)$_POST['kol'],
            'user' => $_SESSION['user'],
            'good' => $good[count($good)-1][1],
            'mods' => $_POST['good'],
            'price' => $good[count($good)-2][1]
        ]);
    } else {
        pdo_query(
            "UPDATE ".MySQLprefix."_cart SET kol = kol + ? WHERE user = ? AND good = ? AND mods = ?",
            [(int)$_POST['kol'], $_SESSION['user'], $good[count($good)-1][1], $_POST['good']]
        );
    }
}

$total = pdo_fetch_column(
    "SELECT SUM(kol) FROM ".MySQLprefix."_cart WHERE user = ? AND status = 1",
    [$_SESSION['user']]
);
echo $total ?: 0;
?>
