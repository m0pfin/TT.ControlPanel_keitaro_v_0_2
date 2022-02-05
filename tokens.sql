-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Фев 05 2022 г., 04:29
-- Версия сервера: 5.7.30
-- Версия PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tt_cost`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tokens`
--

INSERT INTO `tokens` (`id`, `name`, `token`) VALUES
(3, 'Пример', 'eyJjb29raWVzIjpbeyJkb21haW4iOiIuYWRzLnRpa3Rvay5jb20iLCJleHBpcmF0aW9uRGF0ZSI6MTY0NDMwMjUwMy44NjE5MzEsImhvc3RPbmx5IjpmYWxzZSwiaHR0cE9ubHkiOmZhbHNlLCJuYW1lIjoiZ2ZzaXRlc2lkIiwicGF0aCI6Ii9jcmVhdGl2ZS9pbnRlcmFjdGl2ZV9hZGRfb25zL3ByZXZpZXcuaHRtbC8iLCJzYW1lU2l0ZSI6InVuc3BlY2lmaWVkIiwic2VjdXJlIjpmYWxzZSwic2Vzc2lvbiI6ZmFsc2UsInN0b3JlSWQiOiIwIiwidmFsdWUiOiJNVEF3TmpjNU16RTJmREUyTkRNMk9UUTNNVE13T1h4OE1BY0hCd2NIQndjIn0seyJkb21haW4iOiJhZHMudGlrdG9rLmNvbSIsImhvc3RPbmx5Ijp0S81MzcuMzYiLCJicm93c2VyX3BsYXRmb3JtIjoiV2luMzIiL');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
