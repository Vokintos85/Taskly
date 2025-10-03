# Taskly API • One-command Docker (SQLite)

Один запуск: контейнер собирается, Laravel получает `APP_KEY`, SQLite создаётся/переиспользуется, миграции (включая таблицу сессий) применяются автоматически.

## Требования
- Docker и Docker Compose
- Свободные порты `8080` (HTTP) и `9000` (php-fpm внутри сети)

## Запуск
```bash
docker compose up -d --build
```

Первый старт может занять ~1 минуту: entrypoint устанавливает зависимости, прогоняет `php artisan migrate --force` и выдаёт логи приложения.

## Проверка
```bash
curl http://localhost:8080/api/tasks
```

Ожидаемый ответ — JSON-массив задач. Для удобства можно открыть браузером `http://localhost:8080/api/tasks`.

## Полезные команды
- Просмотр логов Laravel: `docker compose logs -f app`
- Войти в контейнер приложения: `docker compose exec app bash`
- Остановить и удалить контейнеры: `docker compose down`
- Очистить созданную БД (удалит данные): `rm database/database.sqlite`

**Технические детали:**
- База данных: SQLite
- PHP 8.2 + Nginx
- Автоматические миграции
- Сессии хранятся в таблице `sessions`
- Готовый CRUD API
