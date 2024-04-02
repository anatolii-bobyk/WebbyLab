Файл для імпорту фільмів знаходиться в app/files/sample_movies.txt

1.РОЗГОРТАННЯ ПРОЕКТУ

1. Встановити php, mysql-server, composer, docker, docker-compose
2. Створюємо директорію для проекту, наприклад WebbyLab
3. Стягуємо з github код в директорію проекту
4. Відкриваємо командий рядок, робимо cd WebbyLab
5. Виконуємо команду docker-compose up -d --build
6. Виконуємо команду docker-compose exec mysql bash
7. Виконуємо команду mysql -uroot -proot
8. Виконуємо команду create database webbylab;
9. Створюємо 2 таблиці - копіюємо код з файлика app/files/DB_tables.sql
10. Відкриваємо браузер http://localhost, щоб побачити проект


2.АРХІТЕКТУРА ВЕБ-ПРОГРАМИ

Архітектура програми базується на шаблоні MVC (Model, View, Controller).

1. Модель відповідає за роботу з даними. У цьому проекті модель взаємодіє з базою даних, забезпечуючи доступ до даних та
   їх обробку.

2. Представлення відповідає за відображення даних користувачу. Використовуючи HTML та CSS, вона створює інтерфейс, який
   користувач бачить.

3. Контролер відповідає за обробку запитів користувачів та взаємодію з моделлю та представленням. Він приймає вхідні
   дані від користувача, виконує необхідні операції та відправляє відповідь у вигляді представлення.

Додаткові директорії:

1. config - містить конфіги нашої бази даних
2. connection - містить клас з'єднання з базою даних
3. files - містить файли, необхідні для роботи з веб-програмою
4. Helper - містить частини коду, які використовуються багато разів
5. Router - містить клас-маршрутизатор
6. uploads - містить завантажені файли через веб-інтерфейс
7. docker - налаштування для роботи з контейнерами
8. docker-compose - набір правил для роботи контейнерів

index.php - точка входу в програму