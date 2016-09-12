-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Сен 12 2016 г., 14:19
-- Версия сервера: 5.6.28
-- Версия PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `php1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id_article` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id_article`, `title`, `content`, `date_add`, `date_edit`) VALUES
(1, 'Новость № 1', 'Содержание новости №1', '2016-09-10 12:52:14', '2016-09-10 12:52:14'),
(2, 'Новость № 2', 'Содержание новости №2', '2016-09-10 12:52:14', '2016-09-10 12:52:14'),
(4, 'Новость № 3', 'ЛОРвлоылвофыловрфлоырвфо', '2016-09-10 13:07:35', '2016-09-10 13:07:35'),
(8, 'Проверка 1', 'ешгщшгшгщ', '2016-09-10 17:57:20', '2016-09-10 17:57:20'),
(9, 'Проверка 2', 'ыдвлаоывлоады', '2016-09-10 18:13:52', '2016-09-10 18:13:52'),
(30, '123', '1234567', '2016-09-12 09:10:12', '2016-09-12 12:18:32'),
(39, 'Новость №5', 'Текст 1', '2016-09-12 12:18:52', '2016-09-12 12:18:52');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`),
  ADD UNIQUE KEY `title` (`title`),
  ADD UNIQUE KEY `title_2` (`title`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
