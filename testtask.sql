-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 09 2024 г., 14:48
-- Версия сервера: 8.0.24
-- Версия PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testtask`
--

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `username`, `email`, `description`, `date`, `ip`, `browser`) VALUES
(32, 'Anatoly', 'Anatoly1982@mail.ru', 'Очень полезно и информативно', '1725881013', '127.0.0.1', 'Chrome'),
(33, 'Lostman', 'Lost@ropt.com', 'Сайт написан конечно да, ужац', '1725881138', '127.0.0.1', 'Яндекс Браузер'),
(34, 'Olga', 'Usae@gmail.com', 'Вы не задумывались что придумывать почты и текст, не так просто?', '1725881197', '127.0.0.1', 'Яндекс Браузер'),
(35, 'latik', 'latik@grab.ru', 'Очень высокий текст', '1725881244', '127.0.0.1', 'Яндекс Браузер'),
(36, 'Lotus', 'Lotus@lost.com', 'Капча конечно подвела чутка', '1725881286', '127.0.0.1', 'Яндекс Браузер'),
(37, 'Pola', 'lopa@gmail.ru', 'Мне бы домик на берегу моря', '1725881420', '127.0.0.1', 'Яндекс Браузер'),
(38, 'Iva', 'ivan2010@gmail.ru', 'Сайт очень удобный и интуитивно понятный. Успел найти всё, что нужно!', '1725881464', '127.0.0.1', 'Яндекс Браузер'),
(39, 'ira', 'ira1990@mail.ru', 'Здесь много интересных статей. Помогли разобраться с несколькими вопросами!', '1725881507', '127.0.0.1', 'Яндекс Браузер'),
(40, 'dmitriy', 'dmitriy.chernov@example.com', 'Очень полезный ресурс, но хотелось бы больше актуальных новостей.', '1725881607', '127.0.0.1', 'Microsoft Edge'),
(41, 'Grishina', 'tatiana.grishina@example.com', 'Иногда долго загружается, но в остальном претензий нет. Все просто и понятно!', '1725881642', '127.0.0.1', 'Microsoft Edge');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `promo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `promo`) VALUES
(1, 'YWRtaW4xMjM=');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
