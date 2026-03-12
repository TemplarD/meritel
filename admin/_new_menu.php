<?php
/**
 * Новое верхнее меню с категориями и услугами
 */

// Получаем категории через mysql (для совместимости)
$categories_result = mysql_query("
    SELECT c.id, c.name, c.p_id, u.url 
    FROM ".MySQLprefix."_categories c
    LEFT JOIN ".MySQLprefix."_urls u ON c.id = u.target_id AND u.target_type = 'categories'
    WHERE c.p_id = 0
    ORDER BY c.sort_id ASC
");

$categories = [];
while($cat = mysql_fetch_assoc($categories_result)) {
    $categories[] = $cat;
}

// Получаем услуги (mypages с place='left')
$services_result = mysql_query("
    SELECT id, menu, url FROM ".MySQLprefix."_mypages 
    WHERE place = 'left' AND shows = 1 
    ORDER BY sort_id ASC
");

$services = [];
while($srv = mysql_fetch_assoc($services_result)) {
    $services[] = $srv;
}
?>

<!-- Мобильная кнопка -->
<button class="mobile-menu-btn" onclick="toggleMobileMenu()">☰</button>

<!-- Основное меню -->
<nav class="main-nav">
    <ul>
        <li><a href="/">Главная</a></li>
        
        <!-- Каталог с выпадающим списком -->
        <li>
            <a href="/katalog/">Каталог ▾</a>
            <ul class="dropdown">
                <?php foreach($categories as $cat): ?>
                <li><a href="/<?=$cat['url']?>/"><?=$cat['name']?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>
        
        <!-- Услуги с выпадающим списком -->
        <li>
            <a href="#" class="services-btn">Услуги ▾</a>
            <ul class="dropdown">
                <?php foreach($services as $service): ?>
                <li><a href="/<?=$service['url']?>/"><?=$service['menu']?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>
        
        <li><a href="/news/">Новости</a></li>
        <li><a href="/faq/">Вопросы-ответы</a></li>
        <li><a href="/kontakti-/">Контакты</a></li>
        
        <!-- Корзина -->
        <li>
            <a href="/cart/" class="cart-in-nav">
                Корзина <i id="cart-count"><?=$in_cart_res_echo?></i>
            </a>
        </li>
    </ul>
</nav>

<!-- Мобильное меню -->
<div class="mobile-overlay" onclick="toggleMobileMenu()"></div>
<div class="mobile-nav" id="mobileNav">
    <button class="mobile-nav-close" onclick="toggleMobileMenu()">×</button>
    <ul>
        <li><a href="/">Главная</a></li>
        
        <li class="has-submenu">
            <a href="#" onclick="toggleSubmenu(this); return false;">Каталог</a>
            <ul class="dropdown">
                <?php foreach($categories as $cat): ?>
                <li><a href="/<?=$cat['url']?>/"><?=$cat['name']?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>
        
        <li class="has-submenu">
            <a href="#" onclick="toggleSubmenu(this); return false;">Услуги</a>
            <ul class="dropdown">
                <?php foreach($services as $service): ?>
                <li><a href="/<?=$service['url']?>/"><?=$service['menu']?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>
        
        <li><a href="/news/">Новости</a></li>
        <li><a href="/faq/">Вопросы-ответы</a></li>
        <li><a href="/kontakti-/">Контакты</a></li>
        <li><a href="/cart/">Корзина <span id="mobile-cart-count">(<?=$in_cart_res_echo?>)</span></a></li>
    </ul>
</div>

<script>
function toggleMobileMenu() {
    document.getElementById('mobileNav').classList.toggle('active');
    document.querySelector('.mobile-overlay').classList.toggle('active');
}

function toggleSubmenu(el) {
    el.parentElement.classList.toggle('open');
}
</script>
