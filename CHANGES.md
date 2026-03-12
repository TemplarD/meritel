# 📝 Изменения и новые функции

## 🎨 Верхняя часть сайта (Header)

### Что добавлено:
- **Логотип компании** - отображается слева
- **Название и слоган** - кликабельные, ведут на главную
- **Телефоны** - кликабельные ссылки `tel:`
- **Кнопки связи**:
  - 📞 Позвонить (красная)
  - 💬 WhatsApp (зелёная)
  - ✈️ Telegram (синяя)
  - 📱 Viber (фиолетовая)

### Файлы:
- `admin/css/header.css` - стили
- `admin/_header_top.php` - HTML шапка

### Настройка:
Отредактируйте `admin/_header_top.php`:
```php
// WhatsApp номер
href="https://wa.me/79000000000"

// Telegram username
href="https://t.me/username"
```

---

## 🛒 Настройки магазина

### Админ-панель:
**URL:** `/admin/cms.php?go=23` (через меню "🛒 Магазин")

### Возможности:

#### 1. Цены
- ☑️ Скрыть цены на сайте
- 📝 Текст вместо цены (например: "Уточняйте у менеджера")

#### 2. Telegram уведомления
- ☑️ Включить/выключить
- 🔑 Bot Token (получить у @BotFather)
- 📍 Chat ID (узнать у @userinfobot)

#### 3. Email уведомления
- ☑️ Включить/выключить
- 📧 Email для уведомлений

### Файлы:
- `admin/shop_settings.php` - страница настроек
- `admin/_notifications.php` - модуль уведомлений

---

## 📬 Уведомления

### Типы уведомлений:
1. **Новый заказ** - notify_new_order()
2. **Обратный звонок** - notify_request('call-back')
3. **Письмо** - notify_request('write-us')
4. **Вопрос** - notify_request('ask-quest')

### Интеграция:

Для отправки уведомления о заказе:
```php
include('_notifications.php');

$order_data = [
    'name' => 'Иван',
    'contacts' => '+79991234567',
    'items' => [...],
    'total' => 5000
];

notify_new_order($order_id, $order_data);
```

### Telegram Bot:
1. Создайте бота в @BotFather
2. Получите токен
3. Добавьте бота в чат/канал
4. Узнайте Chat ID через @userinfobot
5. Сохраните в настройках

---

## 🎯 Ссылки

- **Сайт:** http://localhost:8080
- **Админка:** http://localhost:8080/admin/
- **Настройки магазина:** http://localhost:8080/admin/cms.php?go=23
- **GitHub:** https://github.com/TemplarD/meritel

---

*Последнее обновление: 12 марта 2026*
