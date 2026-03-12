<?php
/**
 * Система промокодов
 */

/**
 * Проверка и применение промокода
 * @param string $code Код промокода
 * @param float $order_sum Сумма заказа
 * @return array Результат
 */
function promo_apply($code, $order_sum) {
    $code = strtoupper(trim($code));
    
    if(empty($code)) {
        return ['success' => false, 'error' => 'Введите код промокода'];
    }
    
    // Поиск промокода в БД
    $promo = pdo_fetch_one(
        "SELECT * FROM ".MySQLprefix."_promo_codes 
         WHERE code = ? AND active = 1 
         AND (valid_from IS NULL OR valid_from <= NOW())
         AND (valid_until IS NULL OR valid_until > NOW())",
        [$code]
    );
    
    if(!$promo) {
        return ['success' => false, 'error' => 'Промокод не найден или неактивен'];
    }
    
    // Проверка минимальной суммы
    if($order_sum < $promo['min_order']) {
        return [
            'success' => false, 
            'error' => 'Минимальная сумма заказа для этого промокода: '.$promo['min_order'].' руб.'
        ];
    }
    
    // Проверка количества использований
    if($promo['max_uses'] > 0 && $promo['used_count'] >= $promo['max_uses']) {
        return ['success' => false, 'error' => 'Лимит использований промокода исчерпан'];
    }
    
    // Расчёт скидки
    $discount = 0;
    if($promo['discount_type'] === 'percent') {
        $discount = $order_sum * ($promo['discount_value'] / 100);
    } else {
        $discount = $promo['discount_value'];
    }
    
    // Скидка не может превышать сумму заказа
    if($discount > $order_sum) {
        $discount = $order_sum;
    }
    
    return [
        'success' => true,
        'code' => $code,
        'discount_type' => $promo['discount_type'],
        'discount_value' => $promo['discount_value'],
        'discount' => round($discount, 2),
        'total' => round($order_sum - $discount, 2)
    ];
}

/**
 * Увеличение счётчика использований промокода
 * @param string $code Код промокода
 */
function promo_increment_use($code) {
    $code = strtoupper(trim($code));
    pdo_query(
        "UPDATE ".MySQLprefix."_promo_codes SET used_count = used_count + 1 WHERE code = ?",
        [$code]
    );
}

/**
 * Получение списка активных промокодов
 * @return array
 */
function promo_get_list() {
    return pdo_fetch_all(
        "SELECT * FROM ".MySQLprefix."_promo_codes 
         WHERE active = 1 
         AND (valid_until IS NULL OR valid_until > NOW())
         ORDER BY id DESC"
    );
}
?>
