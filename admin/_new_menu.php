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

// Получаем основные услуги (p_id=0)
$services_result = mysql_query("
    SELECT id, menu, url FROM ".MySQLprefix."_mypages 
    WHERE place = 'left' AND shows = 1 AND p_id = 0
    ORDER BY sort_id ASC
");

$services = [];
while($srv = mysql_fetch_assoc($services_result)) {
    $services[] = $srv;
}

// Получаем вложенные услуги
$services_nested_result = mysql_query("
    SELECT id, menu, url, p_id FROM ".MySQLprefix."_mypages 
    WHERE place = 'left' AND shows = 1 AND p_id > 0
    ORDER BY p_id ASC, sort_id ASC
");

$services_nested = [];
while($srv = mysql_fetch_assoc($services_nested_result)) {
    $services_nested[$srv['p_id']][] = $srv;
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
        
        <!-- Услуги с выпадающим списком и вложенностью -->
        <li class="services-menu">
            <a href="#" class="services-btn">Услуги</a>
            <ul class="dropdown">
                <!-- Основные услуги -->
                <?php foreach($services as $service): ?>
                <li><a href="/<?=$service['url']?>/"><?=$service['menu']?></a></li>
                <!-- Вложенные услуги -->
                <?php if(isset($services_nested[$service['id']])): ?>
                    <?php foreach($services_nested[$service['id']] as $nested): ?>
                    <li style="padding-left: 15px; border-left: 2px solid #500106;">
                        <a href="/<?=$nested['url']?>/">→ <?=$nested['menu']?></a>
                    </li>
                    <?php endforeach; ?>
                <?php endif; ?>
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
                <?php if(isset($services_nested[$service['id']])): ?>
                    <?php foreach($services_nested[$service['id']] as $nested): ?>
                    <li style="padding-left: 15px;">→ <?=$nested['menu']?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
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
// Подсветка активного пункта меню
(function() {
    var currentPath = window.location.pathname;
    var navLinks = document.querySelectorAll('.main-nav > ul > li > a');
    
    // Сначала снимаем active со всех
    navLinks.forEach(function(link) {
        link.classList.remove('active');
    });
    
    // Находим активный
    navLinks.forEach(function(link) {
        var href = link.getAttribute('href');
        // Пропускаем ссылки с #
        if (!href || href === '#' || href.indexOf('#') === 0) {
            return;
        }
        // Главная
        if (href === '/' && currentPath === '/') {
            link.classList.add('active');
        }
        // Остальные
        else if (href !== '/' && currentPath.indexOf(href) === 0) {
            link.classList.add('active');
        }
    });
})();

function toggleMobileMenu() {
    var nav = document.getElementById('mobileNav');
    var overlay = document.querySelector('.mobile-overlay');
    if (nav && overlay) {
        nav.classList.toggle('active');
        overlay.classList.toggle('active');
    }
}

function toggleSubmenu(el) {
    if (el && el.parentElement) {
        el.parentElement.classList.toggle('open');
    }
}
</script>
