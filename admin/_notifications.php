<?php
/**
 * Отправка уведомлений в Telegram и Email
 */

/**
 * Отправка в Telegram
 * @param string $message Сообщение
 * @return bool
 */
function send_telegram_notification($message) {
    global $additional;
    
    // Проверяем включены ли уведомления
    if (empty($additional[75]) || $additional[75] != '1') {
        return false;
    }
    
    $token = !empty($additional[72]) ? $additional[72] : '';
    $chat_id = !empty($additional[73]) ? $additional[73] : '';
    
    if (empty($token) || empty($chat_id)) {
        return false;
    }
    
    $url = "https://api.telegram.org/bot{$token}/sendMessage";
    $data = [
        'chat_id' => $chat_id,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result !== false;
}

/**
 * Отправка на Email
 * @param string $subject Тема
 * @param string $body Тело письма
 * @param string $to Получатель
 * @return bool
 */
function send_email_notification($subject, $body, $to = null) {
    global $additional;
    
    // Проверяем включены ли уведомления
    if (empty($additional[76]) || $additional[76] != '1') {
        return false;
    }
    
    $notify_email = !empty($additional[74]) ? $additional[74] : $additional[11];
    if (empty($notify_email)) {
        return false;
    }
    
    if ($to) {
        $notify_email = $to;
    }
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: {$additional[2]} <noreply@{$_SERVER['SERVER_NAME']}>\r\n";
    $headers .= "Reply-To: {$additional[11]}\r\n";
    
    return mail($notify_email, $subject, $body, $headers);
}

/**
 * Уведомление о новом заказе
 * @param int $order_id Номер заказа
 * @param array $order_data Данные заказа
 */
function notify_new_order($order_id, $order_data) {
    global $additional;
    
    $message = "🛒 <b>Новый заказ №{$order_id}</b>\n\n";
    $message .= "👤 <b>Клиент:</b> {$order_data['name']}\n";
    $message .= "📞 <b>Телефон:</b> {$order_data['contacts']}\n";
    
    if (!empty($order_data['items'])) {
        $message .= "\n📦 <b>Товары:</b>\n";
        foreach ($order_data['items'] as $item) {
            $message .= "  • {$item['name']} x {$item['kol']} = {$item['price']} руб.\n";
        }
    }
    
    if (!empty($order_data['total'])) {
        $message .= "\n💰 <b>Итого:</b> {$order_data['total']} руб.";
    }
    
    // Отправляем в Telegram
    send_telegram_notification($message);
    
    // Отправляем на Email
    $email_body = "<h2>Новый заказ №{$order_id}</h2>";
    $email_body .= "<p><b>Клиент:</b> {$order_data['name']}</p>";
    $email_body .= "<p><b>Телефон:</b> {$order_data['contacts']}</p>";
    send_email_notification("Новый заказ №{$order_id}", $email_body);
}

/**
 * Уведомление о заявке (обратный звонок, вопрос и т.д.)
 * @param string $type Тип заявки
 * @param array $data Данные
 */
function notify_request($type, $data) {
    $type_names = [
        'call-back' => '📞 Обратный звонок',
        'write-us' => '✉️ Письмо',
        'ask-quest' => '❓ Вопрос'
    ];
    
    $type_name = isset($type_names[$type]) ? $type_names[$type] : 'Заявка';
    
    $message = "{$type_name}\n\n";
    foreach ($data as $key => $value) {
        $message .= "<b>{$key}:</b> {$value}\n";
    }
    
    send_telegram_notification($message);
    send_email_notification($type_name, "<h2>{$type_name}</h2>" . nl2br(htmlspecialchars($message)));
}
?>
