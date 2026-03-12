<?php
/**
 * Обновление главной страницы с красивым контентом
 */
include('_mysql.php');

$main_content = '
<div style="background: linear-gradient(135deg, #500106 0%, #2a0c0e 100%); color: white; padding: 40px 30px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(80,1,6,0.3);">
    <h1 style="color: white; font-size: 32px; margin-bottom: 15px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">🏭 МЕРИТЕЛЬНЫЙ ИНСТРУМЕНТ ОТ ЗАВОДА КРИН</h1>
    <p style="font-size: 18px; line-height: 1.6; margin-bottom: 20px; opacity: 0.95;">
        <strong>ООО «Меритель»</strong> — официальный представитель завода «КРИН» (г. Киров) предлагает широкий ассортимент 
        высококачественного мерительного инструмента для предприятий машиностроения, металлообработки, приборостроения 
        и других отраслей промышленности.
    </p>
    <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 25px;">
        <div style="background: rgba(255,255,255,0.1); padding: 15px 20px; border-radius: 8px; backdrop-filter: blur(10px);">
            <div style="font-size: 24px; font-weight: bold; color: #FFD700;">📦</div>
            <div style="font-size: 14px; margin-top: 5px;">Более 10 000 позиций на складе</div>
        </div>
        <div style="background: rgba(255,255,255,0.1); padding: 15px 20px; border-radius: 8px; backdrop-filter: blur(10px);">
            <div style="font-size: 24px; font-weight: bold; color: #FFD700;">✅</div>
            <div style="font-size: 14px; margin-top: 5px;">Официальная гарантия качества</div>
        </div>
        <div style="background: rgba(255,255,255,0.1); padding: 15px 20px; border-radius: 8px; backdrop-filter: blur(10px);">
            <div style="font-size: 24px; font-weight: bold; color: #FFD700;">🚚</div>
            <div style="font-size: 14px; margin-top: 5px;">Доставка по России и СНГ</div>
        </div>
    </div>
</div>

<div style="background: #f9f9f9; padding: 30px; border-left: 5px solid #500106; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <h2 style="color: #500106; font-size: 24px; margin-bottom: 20px; border-bottom: 2px solid #500106; padding-bottom: 10px;">📏 Наша продукция</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px;">
        <div style="background: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <strong style="color: #500106; font-size: 16px;">🔹 Микрометры</strong>
            <p style="font-size: 14px; color: #666; margin: 8px 0 0 0; line-height: 1.5;">Гладкие, резьбомерные, зубомерные, трубные. Точность до 0.01 мм.</p>
        </div>
        <div style="background: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <strong style="color: #500106; font-size: 16px;">🔹 Штангенциркули</strong>
            <p style="font-size: 14px; color: #666; margin: 8px 0 0 0; line-height: 1.5;">ШЦ-I, ШЦ-II, ШЦ-III с глубинометром и без. По ГОСТ 166-89.</p>
        </div>
        <div style="background: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <strong style="color: #500106; font-size: 16px;">🔹 Индикаторы часового типа</strong>
            <p style="font-size: 14px; color: #666; margin: 8px 0 0 0; line-height: 1.5;">ИЧ, ИЧС, ИЧО, ИТ. Для точных измерений биения и отклонений.</p>
        </div>
        <div style="background: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <strong style="color: #500106; font-size: 16px;">🔹 Нутромеры</strong>
            <p style="font-size: 14px; color: #666; margin: 8px 0 0 0; line-height: 1.5;">Индикаторные НИ, микрометрические НМ. Для измерения отверстий.</p>
        </div>
        <div style="background: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <strong style="color: #500106; font-size: 16px;">🔹 Глубиномеры</strong>
            <p style="font-size: 14px; color: #666; margin: 8px 0 0 0; line-height: 1.5;">ГМ, ГМИ, ГИ. Для измерения глубины пазов и отверстий.</p>
        </div>
        <div style="background: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <strong style="color: #500106; font-size: 16px;">🔹 Угломеры</strong>
            <p style="font-size: 14px; color: #666; margin: 8px 0 0 0; line-height: 1.5;">УМ, УШ, УГ. Для точного измерения углов от 0 до 360°.</p>
        </div>
    </div>
</div>

<div style="background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%); padding: 30px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h2 style="color: #500106; font-size: 24px; margin-bottom: 20px; border-bottom: 2px solid #500106; padding-bottom: 10px;">⚙️ Услуги</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #500106;">
            <h3 style="color: #500106; font-size: 18px; margin: 0 0 10px 0;">🔧 Поверка и калибровка</h3>
            <p style="font-size: 14px; color: #666; margin: 0; line-height: 1.6;">В аккредитованной лаборатории с выдачей свидетельства.</p>
        </div>
        <div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #500106;">
            <h3 style="color: #500106; font-size: 18px; margin: 0 0 10px 0;">🛠️ Ремонт инструмента</h3>
            <p style="font-size: 14px; color: #666; margin: 0; line-height: 1.6;">Восстановление точности и работоспособности.</p>
        </div>
        <div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #500106;">
            <h3 style="color: #500106; font-size: 18px; margin: 0 0 10px 0;">📚 Обучение персонала</h3>
            <p style="font-size: 14px; color: #666; margin: 0; line-height: 1.6;">Работа с мерительным инструментом, методика измерений.</p>
        </div>
    </div>
</div>

<div style="background: linear-gradient(135deg, #500106 0%, #2a0c0e 100%); color: white; padding: 30px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(80,1,6,0.3);">
    <h2 style="color: white; font-size: 24px; margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">✅ Преимущества работы с нами</h2>
    <ul style="line-height: 2; font-size: 16px; margin: 0; padding-left: 25px;">
        <li>✓ <strong>Официальный дилер</strong> завода КРИН с 2010 года</li>
        <li>✓ <strong>Все сертификаты</strong> и паспорта качества на продукцию</li>
        <li>✓ <strong>Собственный склад</strong> более 10 000 позиций в наличии</li>
        <li>✓ <strong>Оперативная доставка</strong> по России и странам СНГ</li>
        <li>✓ <strong>Гарантия</strong> на весь мерительный инструмент</li>
        <li>✓ <strong>Индивидуальные скидки</strong> для постоянных клиентов</li>
        <li>✓ <strong>Техническая поддержка</strong> и консультации метрологов</li>
    </ul>
</div>

<div style="text-align: center; background: #fff3cd; padding: 25px; border-radius: 10px; border: 2px solid #500106; margin-bottom: 20px;">
    <h3 style="color: #500106; font-size: 22px; margin: 0 0 15px 0;">📞 Свяжитесь с нами</h3>
    <p style="font-size: 18px; margin: 10px 0;"><strong>Телефон:</strong> <a href="tel:+78332450819" style="color: #500106; text-decoration: none; font-weight: bold;">+7 (8332) 45-08-19</a></p>
    <p style="font-size: 18px; margin: 10px 0;"><strong>Email:</strong> <a href="mailto:zakaz@meritel43.ru" style="color: #500106; text-decoration: none;">zakaz@meritel43.ru</a></p>
    <p style="font-size: 14px; color: #666; margin: 15px 0 0 0;">
        🕐 Режим работы: Пн-Пт с 8:00 до 17:00 (МСК)<br>
        📍 Адрес: г. Киров, ул. Производственная, д. 1
    </p>
</div>
';

// Обновляем в БД
$main_content_esc = mysql_real_escape_string($main_content);
mysql_query("UPDATE ".MySQLprefix."_mypages SET text='$main_content_esc' WHERE url='main'");

echo "✅ Главная страница обновлена!";
?>
