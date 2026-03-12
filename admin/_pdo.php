<?php
/**
 * PDO подключение к базе данных
 * Современная замена устаревшему mysql_* API
 */

// Глобальный объект PDO
$GLOBALS['pdo'] = null;

/**
 * Инициализация PDO подключения
 */
function pdo_connect() {
    if ($GLOBALS['pdo'] !== null) {
        return $GLOBALS['pdo'];
    }
    
    $db_host = getenv('DB_HOST') ?: 'db';
    $db_name = getenv('DB_NAME') ?: 'viz620';
    $db_user = getenv('DB_USER') ?: 'meritel';
    $db_pass = getenv('DB_PASSWORD') ?: 'meritel123';
    
    try {
        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        $GLOBALS['pdo'] = new PDO($dsn, $db_user, $db_pass, $options);
        return $GLOBALS['pdo'];
    } catch (PDOException $e) {
        error_log("PDO Error: " . $e->getMessage());
        die("<!-- Ошибка подключения к БД -->");
    }
}

/**
 * Выполнение запроса с подготовленными выражениями
 * @param string $sql SQL запрос
 * @param array $params Параметры для prepared statement
 * @return PDOStatement
 */
function pdo_query($sql, $params = []) {
    $pdo = pdo_connect();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}

/**
 * Получить одну строку
 * @param string $sql SQL запрос
 * @param array $params Параметры
 * @return array|false
 */
function pdo_fetch_one($sql, $params = []) {
    $stmt = pdo_query($sql, $params);
    return $stmt->fetch();
}

/**
 * Получить все строки
 * @param string $sql SQL запрос
 * @param array $params Параметры
 * @return array
 */
function pdo_fetch_all($sql, $params = []) {
    $stmt = pdo_query($sql, $params);
    return $stmt->fetchAll();
}

/**
 * Получить одно значение
 * @param string $sql SQL запрос
 * @param array $params Параметры
 * @return mixed
 */
function pdo_fetch_column($sql, $params = []) {
    $stmt = pdo_query($sql, $params);
    return $stmt->fetchColumn();
}

/**
 * Вставка записи
 * @param string $table Имя таблицы
 * @param array $data Данные
 * @return string Last insert ID
 */
function pdo_insert($table, $data) {
    $pdo = pdo_connect();
    $columns = implode(', ', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));
    
    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    
    return $pdo->lastInsertId();
}

/**
 * Обновление записи
 * @param string $table Имя таблицы
 * @param array $data Данные для обновления
 * @param string $where WHERE условие
 * @param array $where_params Параметры WHERE
 * @return int Количество затронутых строк
 */
function pdo_update($table, $data, $where, $where_params = []) {
    $pdo = pdo_connect();
    $set = [];
    foreach (array_keys($data) as $col) {
        $set[] = "$col = :$col";
    }
    $set_str = implode(', ', $set);
    
    $sql = "UPDATE $table SET $set_str WHERE $where";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array_merge($data, $where_params));
    
    return $stmt->rowCount();
}

/**
 * Удаление записи
 * @param string $table Имя таблицы
 * @param string $where WHERE условие
 * @param array $params Параметры WHERE
 * @return int Количество затронутых строк
 */
function pdo_delete($table, $where, $params = []) {
    $pdo = pdo_connect();
    $sql = "DELETE FROM $table WHERE $where";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->rowCount();
}

/**
 * Экранирование строки (для совместимости)
 * @param string $str Строка
 * @return string
 */
function pdo_escape($str) {
    $pdo = pdo_connect();
    return $pdo->quote($str);
}

// Инициализация подключения
pdo_connect();
?>
