<h2>Тестовое задание</h2>

Для запуска проекта
1. git clone 
2. Настраиваем БД 
   1. Устанавливаем на машину postgresql (если нет)
   2. входим под пользователем postgres ```psql -U postgres```
   3. создаём БД ```CREATE DATABASE library;```
   4. создаём пользователя с нужным именем (в проекте admin) и паролем (в проекте secre) ```CREATE USER admin WITH password 'secre';```
   5. даём пользователю все привилегии на базу ```GRANT ALL privileges ON DATABASE library TO admin;```
3. Настройки .env
   1. Если были изменены какие-то данные при создании БД, то необходимо поправить файл .env
4. ```composer install```
5. ```php artisan migrate:refresh --seed```

