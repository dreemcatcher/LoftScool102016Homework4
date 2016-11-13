-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 13 2016 г., 12:22
-- Версия сервера: 5.7.13-log
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `LoftScoolDZBD`
--

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `phname` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`id`, `userid`, `phname`) VALUES
(27, '8', 'test435171479028865.jpg'),
(28, '8', 'test961221479028877.jpg'),
(29, '8', 'test153601479028887.jpg'),
(30, '8', 'test335381479028895.jpg'),
(31, '8', 'test773431479028910.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(56) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `usr` varchar(56) DEFAULT NULL,
  `pas` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `photo`, `usr`, `pas`, `about`, `age`) VALUES
(5, NULL, 'oleg@nn.ru', NULL, 'Oleg', '123', NULL, 0),
(6, NULL, '123@mail.ru', NULL, 'Ярослав', '123', NULL, 0),
(7, 'test', NULL, NULL, '123', '123', 'Ничего не расскажу', 18),
(8, 'Toniq', '123@mail.ru', NULL, 'test', '123', 'Ничего не расскажу', 18);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
