-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 18 2023 г., 10:51
-- Версия сервера: 5.6.51
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `UserAuth`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `login` varchar(25) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `login`, `pass`, `name`) VALUES
(29, 'Dsdasd', '$2y$10$WGFQ0a226cWxnnIW1dKyMeutAm4ZvYaGQAybjXZ1BdL7rHzbjzvp2', 'Dasddsa'),
(30, 'Testing5', '$2y$10$z3QUTsLsXIQ7YSTOXBC74uzCrDwZnFnq1fqyx5ZtSlEETevFzlwQ2', 'Илья'),
(31, 'Qwerty', '$2y$10$39vzXW36BAn7EhPjZSu6h.fNQ8ZctMAsea8x7su7aZDv1t8a2wpDy', 'Илья'),
(33, 'Qwerty123', '$2y$10$Wi12q97ziLotXThZ6tKlBuDkKTvnfSkPthtpwmrLL3Z274.sVUhSS', 'илья'),
(34, 'admin', '$2y$10$l2dFsdfOm0Wm8zH8aT76O.1A15fKWwhR4Twhd3kdJLTqStuwT5Lmm', 'Илья'),
(35, 'CrazyDave', '$2y$10$BeAC5nseAq0K2bOBnDESu.CZu6N.ijAGFAyLunXCCQ5s0bKpwAe5e', 'Илья');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
