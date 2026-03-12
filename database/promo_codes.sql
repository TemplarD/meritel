-- Таблица промокодов
CREATE TABLE IF NOT EXISTS `viz620_promo_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `discount_type` enum('percent','fixed') NOT NULL DEFAULT 'percent',
  `discount_value` decimal(10,2) NOT NULL DEFAULT '0',
  `min_order` decimal(10,2) NOT NULL DEFAULT '0',
  `max_uses` int(11) NOT NULL DEFAULT '0',
  `used_count` int(11) NOT NULL DEFAULT '0',
  `valid_from` datetime DEFAULT NULL,
  `valid_until` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Тестовые промокоды
INSERT INTO `viz620_promo_codes` (`code`, `discount_type`, `discount_value`, `min_order`, `max_uses`, `valid_until`, `active`) VALUES
('WELCOME10', 'percent', 10.00, 1000.00, 100, '2026-12-31 23:59:59', 1),
('FIXED500', 'fixed', 500.00, 5000.00, 50, '2026-12-31 23:59:59', 1),
('SALE20', 'percent', 20.00, 2000.00, 0, '2026-06-30 23:59:59', 1);
