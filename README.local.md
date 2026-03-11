# meritel43.ru - Локальный запуск

## Требования
- Docker
- Docker Compose

## Быстрый старт

```bash
./start.sh
```

## Доступ

| Ресурс | URL |
|--------|-----|
| Сайт | http://localhost:8080 |
| Админ-панель | http://localhost:8080/admin/ |

## Учётные данные (из актуальной БД)

| Логин | Пароль |
|-------|--------|
| adm | MERITEL2017 |
| admin | 69696969 |
| and107 | 69696969 |

## Управление

```bash
# Запуск
./start.sh

# Остановка
./stop.sh
# или
docker-compose down

# Просмотр логов
docker-compose logs -f

# Перезапуск веб-контейнера
docker-compose restart web
```

## Компоненты

- **PHP 5.6** + Apache
- **MySQL 5.7**
- База данных: `viz620`

## Примечания

- Сайт использует устаревшую CMS (2013 год)
- Требуется PHP 5.x из-за `mysql_*` функций
- Порт 8080 для веб, 3306 для MySQL
