FAQ Servise Application. 
======================
Проект представляет из себя сервис вопросов - ответов. Любой пользователь может задавать вопросы, но они публикуются после ответа на них администратором и и перевода в статус опубликовано. Администратор также может скрыть вопрос. Ведется лог действий пользователей. В коде могут присутствовать следы от фоукционала по блокировке вопросов по базе запрещенных слов, но эта чать не доведена до конца.

Требования
------------
php >=7.1
MySQL

Установка
------------

Склонировать проект к себе в католог с веб-сервером, скачав его и переметив в нужный каталог, либо :
```bash
$ git clone https://github.com/mikhachev/diplom2.git
```

Установить проект 
```bash
$ composer install
```

Переименовать файл .env.example в .env, настроить его под свою среду. Для загрузки таблиц БД импортировать .sql файл. Либо накатить миграции таблиц, далее импортировать содержание таблиц можно через:
```bash
$ php artisan migrate
```
Таблица questions накатывается последней
```bash
$ php artisan db:seed
```
Для корректной работы css стилей в файле /diplom/resources/views/main.twig в строках 8-12 просписать полный путь, соотвествующий расположению на вашем хосте. Стартовая страница находится в каталоге /public  проекта.

Другой вариант настройки, это прописать виртуальный хост (если apache, то это файл httpd-vhosts.conf):
<VirtualHost *:80>
    ServerAdmin admin@diplom.local
    DocumentRoot "full route to public folder"
    ServerName diplom.local
    ErrorLog "logs/diplom-error.log"
    CustomLog "logs/diplom-access.log" common
</VirtualHost>

Тогда в main.twig путь к стилям таков: /bootstrap/css/bootstrap.css, и можно удалить .htaccess и index.php из корневого каталога. Сайт в данном случае доступен по адресу diplom.local.

По умолчанию, создан администратор admin с паролем admin




