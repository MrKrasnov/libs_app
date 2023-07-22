-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 22 2023 г., 15:25
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE `author` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `name`) VALUES
(1, 'Lucius Annaeus Seneca');

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `id` int NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `img` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `title`, `description`, `img`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'De Clementia', 'Seneca\'s De Clementia is an instructional contrast between the good ruler and the tyrant, and an evaluation of the relationship between ruler and subject. A survey of history is made in the first volume to select different rulers to point out as examples, including Dionysius of Syracuse and Sulla being used as cautionary tales and young Augustus as the exemplar. An extended illustration of Augustus showing mercy to the rebellious Cinna alongside an example from Nero\'s own life is meant to encourage the aspiring emperor to likewise show clemency.', 'img/about_mercy.jpg', '2023-07-22 12:25:26', NULL, NULL),
(2, 'Epistulae morales ad Lucilium', '\"Epistulae morales ad Lucilium\" is a collection of 124 letters that Seneca the Younger wrote at the end of his life, during his retirement, after he had worked for the Emperor Nero for more than ten years. They are addressed to Lucilius Junior, the then procurator of Sicily, who is known only through Seneca\'s writings. Regardless of how Seneca and Lucilius actually corresponded, it is clear that Seneca crafted the letters with a broad readership in mind.', 'img/epistulae_morales_ad_Lucilium.jpg', '2023-07-22 12:37:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `books_authors`
--

CREATE TABLE `books_authors` (
  `id` int NOT NULL,
  `books_id` int NOT NULL,
  `authors_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `books_authors`
--

INSERT INTO `books_authors` (`id`, `books_id`, `authors_id`) VALUES
(3, 1, 1),
(4, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `books_categories`
--

CREATE TABLE `books_categories` (
  `id` int NOT NULL,
  `books_id` int NOT NULL,
  `categories_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `books_categories`
--

INSERT INTO `books_categories` (`id`, `books_id`, `categories_id`) VALUES
(2, 1, 2),
(3, 2, 2),
(4, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'essay'),
(2, 'philosophy');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books_authors`
--
ALTER TABLE `books_authors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_authors_books_null_fk` (`books_id`),
  ADD KEY `books_authors_author_null_fk` (`authors_id`);

--
-- Индексы таблицы `books_categories`
--
ALTER TABLE `books_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_categories_books_null_fk` (`books_id`),
  ADD KEY `books_categories_category_null_fk` (`categories_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `books_authors`
--
ALTER TABLE `books_authors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `books_categories`
--
ALTER TABLE `books_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books_authors`
--
ALTER TABLE `books_authors`
  ADD CONSTRAINT `books_authors_author_null_fk` FOREIGN KEY (`authors_id`) REFERENCES `author` (`id`),
  ADD CONSTRAINT `books_authors_books_null_fk` FOREIGN KEY (`books_id`) REFERENCES `book` (`id`);

--
-- Ограничения внешнего ключа таблицы `books_categories`
--
ALTER TABLE `books_categories`
  ADD CONSTRAINT `books_categories_books_null_fk` FOREIGN KEY (`books_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `books_categories_category_null_fk` FOREIGN KEY (`categories_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
