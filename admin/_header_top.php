<?php
/**
 * Верхняя часть с логотипом и контактами
 */

// Получаем настройки
$additional_2 = !empty($additional[2]) ? $additional[2] : 'МЕРИТЕЛЬНЫЙ ИНСТРУМЕНТ';
$additional_3 = !empty($additional[3]) ? $additional[3] : '';
$additional_4 = !empty($additional[4]) ? $additional[4] : '+7 (8332) 45-08-19';
$additional_5 = !empty($additional[5]) ? $additional[5] : 'admin/uploads/9576394384.png';

// Телефоны
$phones = explode("\r\n", $additional_4);
$main_phone = !empty($phones[0]) ? $phones[0] : '+7 (8332) 45-08-19';
?>

<div class="header-top">
    <div class="header-container">
        <!-- Логотип -->
        <div class="header-logo">
            <a href="/">
                <img src="/<?=$additional_5?>" alt="<?=$additional_2?>" />
            </a>
        </div>
        
        <div class="header-info">
            <!-- Название компании -->
            <div>
                <?php if(!empty($additional_2)): ?>
                <a href="/" class="company-name"><?=$additional_2?></a>
                <?php endif; ?>
                <?php if(!empty($additional_3)): ?>
                <span class="company-slogan"><?=$additional_3?></span>
                <?php endif; ?>
            </div>
            
            <!-- Кнопки связи -->
            <div class="contact-buttons">
                <a href="tel:<?=preg_replace('/[^0-9+]/', '', $main_phone)?>" class="contact-btn call">
                    <svg viewBox="0 0 24 24"><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/></svg>
                    Позвонить
                </a>
            </div>
            
            <!-- Телефоны -->
            <div class="header-phones">
                <a href="tel:<?=preg_replace('/[^0-9+]/', '', $main_phone)?>" class="header-phone"><?=$main_phone?></a>
                <?php if(count($phones) > 1): ?>
                <a href="tel:<?=preg_replace('/[^0-9+]/', '', $phones[1])?>" class="header-phone"><?=$phones[1]?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
