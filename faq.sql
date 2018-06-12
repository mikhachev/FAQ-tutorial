-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 12 2018 г., 19:53
-- Версия сервера: 10.1.30-MariaDB
-- Версия PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diplo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `forbidden_words`
--

CREATE TABLE `forbidden_words` (
  `id` int(10) UNSIGNED NOT NULL,
  `word` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_05_02_190945_create_forbidden_table', 1),
(4, '2018_05_02_191502_create_themes_table', 1),
(5, '2018_05_02_191521_create_statuses_table', 1),
(6, '2018_06_12_203836_create_questions_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme_id` int(10) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `answer_created` timestamp NULL DEFAULT NULL,
  `answer_updated` timestamp NULL DEFAULT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `author`, `author_email`, `theme_id`, `status_id`, `user_id`, `name`, `question_created`, `answer_created`, `answer_updated`, `answer`) VALUES
(1, 'admin', 'admin@admin.com', 1, 2, 1, 'Откуда взяты начальные вопросы?', '2018-06-12 17:52:49', '2018-06-12 17:52:49', '2018-06-12 17:52:49', 'Стартовые вопросы взяты из разборов на сайте meduza.io.'),
(2, 'admin', 'admin@admin.com', 1, 2, 1, 'Что это за сайт?', '2018-06-12 17:52:50', '2018-06-12 17:52:50', '2018-06-12 17:52:50', 'Это сервис вопросов и ответов.'),
(3, 'admin', 'admin@admin.com', 2, 2, 1, 'Почему у РКН не получается заблокировать Telegram?', '2018-06-12 17:52:50', '2018-06-12 17:52:50', '2018-06-12 17:52:50', '\n\nПотому что это сложно. Что значит заблокировать мессенджер? Это значит заблокировать IP-адреса всех серверов, которые сервис использует для связи с внешним миром. Роскомнадзор отслеживает, к каким серверам обращается Telegram, и блокирует их целыми блоками — именно из-за этого под блокировкой оказались миллионы IP-адресов, предоставляемых компаниями Amazon и Google.\nБеда в том, что среди блоков заблокированных IP-адресов оказались и те, которые используют другие сервисы и компании. Перебои возникли у мессенджера Viber, онлайн-школы Skyeng и других. Генеральный директор курьерской службы «Птичка» Владимир Кобзев рассказал, что из-за действий Роскомнадзора его сервис простаивал шесть часов и он собирается подавать в суд.'),
(4, 'admin', 'admin@admin.com', 2, 2, 1, 'В России и так часто блокируют сайты. Новый законопроект как-то изменит ситуацию?', '2018-06-12 17:52:50', '2018-06-12 17:52:50', '2018-06-12 17:52:50', '\nДа. Если законопроект примут, риски для СМИ вырастут. Легко можно себе представить ситуацию, когда российский суд признает порочащей публикацию о каком-нибудь высокопоставленном герое журналистского расследования и на этом основании требует удалить всю публикацию. А если издание откажется, его могут просто заблокировать.\nВажно заметить, что законопроект бьет и по иностранным изданиям. Те нормы, которые позволяют блокировать сайты сейчас, относятся только к изданиям, подчиняющимся российскому законодательству. Но если примут новые поправки, ничто не запрещает какому-нибудь чиновнику или бизнесмену подать в суд, к примеру, на The Nеw York Times или The Guardian и добиться решения в свою пользу (подобные иски уже были). А потом Роскомнадзор должен будет заблокировать сайты этих изданий, если они откажутся удалять публикацию.'),
(5, 'admin', 'admin@admin.com', 3, 2, 1, 'Какой вид спорта самый полезный?', '2018-06-12 17:52:50', '2018-06-12 17:52:50', '2018-06-12 17:52:50', 'Тот, который вам больше нравится — главное, чтобы он был достаточно активным. Исследователи не раз пытались понять, какие физические нагрузки приносят больше всего пользы и меньше всего вреда, но к единому мнению прийти не получилось. Крупные медицинские организации не отдают предпочтений какому-то одному виду спорта и предлагают на выбор все: от ходьбы до хоккея — выбирайте сами, чем приятнее заниматься.'),
(6, 'admin', 'admin@admin.com', 3, 2, 1, 'Говорят, нельзя запивать еду. Это правда?', '2018-06-12 17:52:50', '2018-06-12 17:52:50', '2018-06-12 17:52:50', 'Нет. Врачи считают, что вода во время или после еды помогает пищеварению, разрушает еду — и в результате тело лучше усваивает питательные вещества. Другое заблуждение: питье во время еды якобы подавляет выработку слюны. Гастроэнтерологи в ответ на это приводят в пример синдром Шегрена: при этом заболевании плохо выделяется слюна — и пациентов заставляют много пить или хотя бы полоскать рот, не опасаясь, что слюны будет выделяться еще меньше. '),
(7, 'admin', 'admin@admin.com', 3, 2, 1, 'Что страшного в микропластике?', '2018-06-12 17:52:50', '2018-06-12 17:52:50', '2018-06-12 17:52:50', 'Если коротко, у исследователей есть серьезные основания предполагать, что микропластик может быть вреден животным и людям. Микропластик попадает в пищевые цепочки, когда его поедают животные (от зоопланктона до рыб и птиц), и может накапливаться в тканях живых организмов. В пластике часто есть токсичные примеси, например, красители и огнестойкие добавки, которые попадают в пищеварительную систему животных и могут вызывать повреждения органов, воспаление кишечника и влиять на репродукцию. К тому же, микрочастицы легко впитывают другие токсичные вещества, например, пестициды и диоксины, а потом так же легко выделяют их в организм, в который они попали. ');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Ждет ответа'),
(2, 'Опубликован'),
(3, 'Скрыт'),
(4, 'Под запретом');

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE `themes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Вопросы по системе', '2018-06-12 17:52:49', '2018-06-12 17:52:49'),
(2, 'Компьютеры и интернет', '2018-06-12 17:52:50', '2018-06-12 17:52:50'),
(3, 'Здоровье', '2018-06-12 17:52:50', '2018-06-12 17:52:50');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$VxJm14gnNVOE1328fucE7uni/ujBt7mbp6Jd0jkYDQiugUMXU4EWK', NULL, '2018-06-12 17:52:49', '2018-06-12 17:52:49');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `forbidden_words`
--
ALTER TABLE `forbidden_words`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_theme_id_foreign` (`theme_id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `forbidden_words`
--
ALTER TABLE `forbidden_words`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
