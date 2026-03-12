<?php
/**
 * Настройки магазина
 * Управление ценами, уведомлениями и т.д.
 */

session_start();
include('_mysql.php');
include('_additional.php');

// Проверка администратора
if ($_SESSION['u_id'] != -1 && (!isset($_SESSION['accesss']) || $_SESSION['accesss'][0] != 'all')) {
    die('Доступ запрещён');
}

// Обработка сохранения
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Скрыть цены
    if (isset($_POST['hide_prices'])) {
        $hide_prices = $_POST['hide_prices'] ? '1' : '0';
        mysql_query("UPDATE ".MySQLprefix."_additional SET text='$hide_prices' WHERE id=70");
    }
    
    // Текст вместо цены
    if (isset($_POST['price_text'])) {
        $price_text = mysql_real_escape_string($_POST['price_text']);
        mysql_query("UPDATE ".MySQLprefix."_additional SET text='$price_text' WHERE id=71");
    }
    
    // Telegram токен
    if (isset($_POST['tg_token'])) {
        $tg_token = mysql_real_escape_string($_POST['tg_token']);
        mysql_query("UPDATE ".MySQLprefix."_additional SET text='$tg_token' WHERE id=72");
    }
    
    // Telegram chat_id
    if (isset($_POST['tg_chat_id'])) {
        $tg_chat_id = mysql_real_escape_string($_POST['tg_chat_id']);
        mysql_query("UPDATE ".MySQLprefix."_additional SET text='$tg_chat_id' WHERE id=73");
    }
    
    // Email для уведомлений
    if (isset($_POST['notify_email'])) {
        $notify_email = mysql_real_escape_string($_POST['notify_email']);
        mysql_query("UPDATE ".MySQLprefix."_additional SET text='$notify_email' WHERE id=74");
    }
    
    // Включить уведомления Telegram
    if (isset($_POST['tg_enabled'])) {
        $tg_enabled = $_POST['tg_enabled'] ? '1' : '0';
        mysql_query("UPDATE ".MySQLprefix."_additional SET text='$tg_enabled' WHERE id=75");
    }
    
    // Включить уведомления Email
    if (isset($_POST['email_enabled'])) {
        $email_enabled = $_POST['email_enabled'] ? '1' : '0';
        mysql_query("UPDATE ".MySQLprefix."_additional SET text='$email_enabled' WHERE id=76");
    }
    
    $message = 'Настройки сохранены!';
}

// Получаем текущие значения
$hide_prices = mysql_result(mysql_query("SELECT text FROM ".MySQLprefix."_additional WHERE id=70"), 0);
$price_text = mysql_result(mysql_query("SELECT text FROM ".MySQLprefix."_additional WHERE id=71"), 0);
$tg_token = mysql_result(mysql_query("SELECT text FROM ".MySQLprefix."_additional WHERE id=72"), 0);
$tg_chat_id = mysql_result(mysql_query("SELECT text FROM ".MySQLprefix."_additional WHERE id=73"), 0);
$notify_email = mysql_result(mysql_query("SELECT text FROM ".MySQLprefix."_additional WHERE id=74"), 0);
$tg_enabled = mysql_result(mysql_query("SELECT text FROM ".MySQLprefix."_additional WHERE id=75"), 0);
$email_enabled = mysql_result(mysql_query("SELECT text FROM ".MySQLprefix."_additional WHERE id=76"), 0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Настройки магазина</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .settings-container { max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #500106; margin-bottom: 20px; }
        .section { margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #eee; }
        .section h2 { color: #333; font-size: 18px; margin-bottom: 15px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        .form-group input[type="text"], .form-group input[type="email"], .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        .form-group input[type="checkbox"] { width: auto; margin-right: 10px; }
        .form-group .checkbox-label { display: inline-flex; align-items: center; }
        .hint { font-size: 12px; color: #999; margin-top: 5px; }
        .btn { background: linear-gradient(135deg, #500106 0%, #2a0c0e 100%); color: #fff; padding: 12px 30px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: all 0.3s; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(80,1,6,0.4); }
        .message { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .back-link { display: inline-block; margin-top: 20px; color: #500106; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="settings-container">
        <h1>⚙️ Настройки магазина</h1>
        
        <?php if(isset($message)): ?>
        <div class="message"><?=htmlspecialchars($message)?></div>
        <?php endif; ?>
        
        <form method="POST">
            <!-- Цены -->
            <div class="section">
                <h2>💰 Настройки цен</h2>
                
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="hide_prices" value="1" <?=($hide_prices == '1' ? 'checked' : '')?> />
                        Скрыть цены на сайте
                    </label>
                    <div class="hint">При включении цены не будут отображаться</div>
                </div>
                
                <div class="form-group">
                    <label>Текст вместо цены:</label>
                    <input type="text" name="price_text" value="<?=htmlspecialchars($price_text)?>" placeholder="Уточняйте цену у менеджера" />
                    <div class="hint">Будет показан вместо цены</div>
                </div>
            </div>
            
            <!-- Telegram -->
            <div class="section">
                <h2>📬 Уведомления в Telegram</h2>
                
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="tg_enabled" value="1" <?=($tg_enabled == '1' ? 'checked' : '')?> />
                        Включить уведомления в Telegram
                    </label>
                </div>
                
                <div class="form-group">
                    <label>Telegram Bot Token:</label>
                    <input type="text" name="tg_token" value="<?=htmlspecialchars($tg_token)?>" placeholder="123456789:ABCdefGHIjklMNOpqrsTUVwxyz" />
                    <div class="hint">Получить у @BotFather</div>
                </div>
                
                <div class="form-group">
                    <label>Chat ID (куда отправлять):</label>
                    <input type="text" name="tg_chat_id" value="<?=htmlspecialchars($tg_chat_id)?>" placeholder="-1001234567890" />
                    <div class="hint">ID чата или канала. Узнать у @userinfobot</div>
                </div>
            </div>
            
            <!-- Email -->
            <div class="section">
                <h2>📧 Уведомления на Email</h2>
                
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="email_enabled" value="1" <?=($email_enabled == '1' ? 'checked' : '')?> />
                        Включить уведомления на Email
                    </label>
                </div>
                
                <div class="form-group">
                    <label>Email для уведомлений:</label>
                    <input type="email" name="notify_email" value="<?=htmlspecialchars($notify_email)?>" placeholder="manager@example.com" />
                    <div class="hint">На этот email будут приходить уведомления о заказах</div>
                </div>
            </div>
            
            <button type="submit" class="btn">💾 Сохранить настройки</button>
        </form>
        
        <a href="cms.php?go=8" class="back-link">← Вернуться в настройки</a>
    </div>
</body>
</html>
