<?php
/**
 * CSRF-защита для форм
 * 
 * Использование:
 * 1. В форме: echo csrf_field();
 * 2. При обработке: csrf_validate() или csrf_validate_or_die()
 */

// Генерация токена
function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = md5(uniqid(rand(), true));
    }
    return $_SESSION['csrf_token'];
}

// HTML поле с токеном
function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '" />';
}

// Проверка токена (возвращает true/false)
function csrf_validate() {
    if (empty($_SESSION['csrf_token'])) {
        return false;
    }
    
    if (empty($_POST['csrf_token'])) {
        return false;
    }
    
    return hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
}

// Проверка с завершением при ошибке
function csrf_validate_or_die() {
    if (!csrf_validate()) {
        http_response_code(403);
        die('Ошибка CSRF: недопустимый запрос');
    }
}

// Регенерация токена (после логина и т.п.)
function csrf_regenerate() {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf_token'];
}
?>
