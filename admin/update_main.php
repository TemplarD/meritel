<?php
/**
 * Обновление главной страницы с контентом
 */
include('_mysql.php');

$main_content = '
<h1 style="color: #500106; font-size: 28px; margin-bottom: 20px;">МЕРИТЕЛЬНЫЙ ИНСТРУМЕНТ от завода КРИН</h1>

<p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
    <strong>ООО «Меритель»</strong> — официальный представитель завода «КРИН» предлагает широкий ассортимент мерительного инструмента 
    для предприятий машиностроения, металлообработки и приборостроения.
</p>

<div style="background: #f9f9f9; padding: 20px; border-left: 4px solid #500106; margin: 20px 0;">
    <h2 style="color: #500106; font-size: 22px; margin-bottom: 15px;">🏭 Наша продукция</h2>
    <ul style="line-height: 2; font-size: 15px;">
        <li><strong>Микрометры</strong> — гладкие, резьбомерные, зубомерные</li>
        <li><strong>Штангенциркули</strong> — ШЦ-I, ШЦ-II, ШЦ-III с точностью до 0.01 мм</li>
        <li><strong>Индикаторы часового типа</strong> — ИЧ, ИЧС, ИЧО</li>
        <li><strong>Нутромеры</strong> — индикаторные и микрометрические</li>
        <li><strong>Глубиномеры</strong> — ГМ, ГМИ, ГИ</li>
        <li><strong>Угломеры</strong> — УМ, УШ, УГ</li>
        <li><strong>Калибры</strong> — ПР, НЕ, резьбовые</li>
        <li><strong>Плиты поверочные</strong> — ЧПУ, лекальные</li>
    </ul>
</div>

<div style="background: #f0f0f0; padding: 20px; border-radius: 8px; margin: 20px 0;">
    <h2 style="color: #500106; font-size: 22px; margin-bottom: 15px;">⚙️ Услуги</h2>
    <p style="font-size: 15px; line-height: 1.6;">
        Помимо поставки мерительного инструмента, мы предлагаем комплекс услуг:
    </p>
    <ul style="line-height: 2; font-size: 15px;">
        <li><strong>Поверка и калибровка</strong> — в аккредитованной лаборатории</li>
        <li><strong>Ремонт инструмента</strong> — восстановление точности</li>
        <li><strong>Консультации метрологов</strong> — подбор инструмента под задачи</li>
        <li><strong>Обучение персонала</strong> — работа с мерительным инструментом</li>
    </ul>
</div>

<div style="background: linear-gradient(135deg, #500106 0%, #2a0c0e 100%); color: white; padding: 25px; border-radius: 8px; margin: 20px 0;">
    <h2 style="color: white; font-size: 22px; margin-bottom: 15px;">✅ Преимущества работы с нами</h2>
    <ul style="line-height: 2; font-size: 15px;">
        <li>✓ Официальный дилер завода КРИН</li>
        <li>✓ Все сертификаты и паспорта качества</li>
        <li>✓ Доставка по России и СНГ</li>
        <li>✓ Собственный склад более 10 000 позиций</li>
        <li>✓ Гарантия на весь инструмент</li>
        <li>✓ Индивидуальные скидки для постоянных клиентов</li>
    </ul>
</div>

<div style="text-align: center; margin: 30px 0;">
    <p style="font-size: 18px; margin-bottom: 15px;">
        📞 <strong>Звоните:</strong> +7 (8332) 45-08-19, +7 (8332) 42-08-58
    </p>
    <p style="font-size: 16px;">
        ✉️ <strong>Пишите:</strong> zakaz@meritel43.ru
    </p>
    <p style="font-size: 14px; color: #666; margin-top: 20px;">
        Работаем с понедельника по пятницу с 8:00 до 17:00 (МСК)
    </p>
</div>
';

// Обновляем в БД
$main_content_esc = mysql_real_escape_string($main_content);
mysql_query("UPDATE ".MySQLprefix."_mypages SET text='$main_content_esc' WHERE url='main'");

echo "Главная страница обновлена!";
?>
