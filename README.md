# JojoJobs
# JojoJobs — Платформа для фриланс-проектов



---

## 📖 Описание проекта
JojoJobs — это веб-платформа для фрилансеров и заказчиков, где можно создавать проекты, откликаться на них и управлять профилем.  

**Основные возможности:**
- Регистрация и авторизация пользователей (обычные пользователи и администраторы)
- Личный кабинет с профилем и статистикой (просмотры, отклики, интервью)
- Категории проектов для удобной фильтрации
- Управление проектами: создание, редактирование, удаление
- API для динамического взаимодействия с фронтендом
- Графики активности пользователя в профиле (Chart.js)

---

## 🗂 Структура проекта

project/
├─ api/ # API-эндпоинты (возвращают JSON)
│ ├─ users.php
│ ├─ projects.php
│ ├─ categories.php
│ └─ profile.php
├─ assets/ # Стили, скрипты и изображения
│ ├─ css/reset.css
│ └─ js/app.js
├─ auth/ # Страницы авторизации
│ ├─ login.php
│ ├─ logout.php
│ └─ register.php
├─ config/ # Настройки проекта и подключение к базе
│ ├─ db.php
│ └─ config.php
├─ database/ # Скрипты и дампы базы данных
│ ├─ full_dump.sql
│ └─ tables/ # отдельные таблицы
├─ include/ # Общие функции работы с таблицами
│ ├─ users.php
│ ├─ profile.php
│ ├─ categories.php
│ └─ projects.php
├─ layout/ # Шаблоны страниц (header, footer, nav)
├─ pages/ # Основные страницы
│ ├─ 404.php
│ ├─ index.php
│ └─ profile/
│ ├─ profile.php
│ ├─ profile_update.php
│ ├─ upload_avatar.php
│ └─ admin/admin-profile.php
├─ uploads/ # Загруженные файлы пользователей
│ └─ avatars/
├─ Dockerfile # Конфиг для сборки PHP-контейнера
├─ docker-compose.yml # Docker Compose для всех сервисов
├─ router.php # Центральный маршрутизатор
├─ routes.php # Карта маршрутов
└─ README.md


---

## ⚙️ Технологии

- **PHP 8+** — серверная логика
- **MySQL / MariaDB** — база данных
- **Docker & Docker Compose** — контейнеризация проекта
- **HTML / CSS / JS** — фронтенд
- **Chart.js** — динамические графики в профиле
- **PDO** — безопасное подключение к базе и выполнение SQL-запросов

---

## 🚀 Установка и запуск

1. Клонируем репозиторий:
```bash
git clone https://github.com/yourusername/JojoJobs.git
cd JojoJobs
