-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 09 2024 г., 09:45
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `itview`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` text DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `topicid` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `text`, `userid`, `topicid`, `created_at`, `updated_at`) VALUES
(33, 'lol  dsada', 1, 1, '2023-12-31 08:11:26', '2023-12-31 08:19:00'),
(34, 'd sad dsad', 1, 1, '2023-12-31 08:19:59', '2023-12-31 08:20:23'),
(35, 'sad', 1, 1, '2023-12-31 08:20:18', '2023-12-31 08:20:18'),
(36, 'sadas', 1, 1, '2023-12-31 08:44:15', '2023-12-31 08:44:15'),
(40, 'дщд', 3, 1, '2024-01-09 10:37:21', '2024-01-09 10:37:21');

-- --------------------------------------------------------

--
-- Структура таблицы `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `text` text DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `replies`
--

INSERT INTO `replies` (`id`, `text`, `userid`, `commentid`, `created_at`, `updated_at`) VALUES
(43, 'sadsa dsads', 1, 33, '2023-12-31 08:47:17', '2023-12-31 08:47:17'),
(44, 'lol', 1, 33, '2023-12-31 08:47:21', '2024-01-09 08:17:07'),
(45, 'sad asd sad sa', 1, 33, '2023-12-31 08:47:21', '2023-12-31 08:47:21'),
(46, 'new test', 2, 36, '2023-12-31 08:49:19', '2024-01-09 08:19:16');

-- --------------------------------------------------------

--
-- Структура таблицы `tech`
--

CREATE TABLE `tech` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `tech`
--

INSERT INTO `tech` (`id`, `name`, `description`, `image`, `year`) VALUES
(1, 'Apple M1 Chip', 'Apple introduced its M1 chip in 2020, but its impact continued to be significant in 2021. The M1 is a custom-designed ARM-based system on a chip (SoC) that powers a range of Apple devices, including the MacBook Air, MacBook Pro, and Mac mini. It brought notable improvements in performance and energy efficiency, marking Apple\'s transition away from Intel processors.', 'https://th.bing.com/th/id/OIP.3ODPI6UHE1z7YMNGBELP_QHaEK?rs=1&pid=ImgDetMain', '2021'),
(2, 'NVIDIA GeForce RTX 30 Series GPUs', 'NVIDIA released its GeForce RTX 30 series graphics cards based on the Ampere architecture. Notable models include the GeForce RTX 3080, RTX 3070, and RTX 3060. These GPUs introduced advancements in ray tracing and AI-powered features, delivering impressive performance for gaming, content creation, and professional applications.', 'https://th.bing.com/th/id/OIP.ssfyf2CkcLcvgM2l_1OL9QHaEK?rs=1&pid=ImgDetMain', '2021'),
(3, 'AMD Ryzen 5000 Series CPUs', 'AMD continued its success in the CPU market with the release of the Ryzen 5000 series, featuring the Zen 3 architecture. CPUs like the Ryzen 9 5950X and Ryzen 9 5900X offered excellent multi-core performance, making them popular choices for gaming and content creation. AMD\'s Zen 3 architecture brought improvements in IPC (instructions per cycle) and overall efficiency.', 'https://th.bing.com/th/id/OIP.QHwhrV27K5zWB5HirppPqwHaEK?rs=1&pid=ImgDetMain', '2021');

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`, `userid`) VALUES
(1, 'Announcements', 'test', 1),
(29, 'Other', 't', 1),
(30, 'General', 'test', 1),
(33, 'te yeeeeeeee', 'tesdassdsadasdasdsaddassadsadada asasdsadsadd asdad aadad adad ad sad asd ad adasdasd asd sadsa d sa dsadsadsad ad sad sad sadasd sad ad sad sad sa da das', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` enum('admin','manager','user') NOT NULL DEFAULT 'user',
  `imgpath` varchar(255) NOT NULL DEFAULT 'https://i.ibb.co/CKqT1FV/questionmark.jpg',
  `description` text NOT NULL DEFAULT 'This user description is empty'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `role`, `imgpath`, `description`) VALUES
(1, 'admin@test.ee', '$2y$10$r8xcQsYIm35EIS99fZcnY.gncYL0QgYmxMAwAD7ggr0OqVTNC/1d6', 'Admin', 'admin', 'uploads/questionmark.jpg', 'test'),
(2, 'user@test.ee', '$2y$12$mjv/GPng4oQFohhkPl8RPucmgRDFVs/UCVP02US.r92ra09kK4d7u', 'User', 'user', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', 'This user description is empty'),
(3, 'manager@test.ee', '$2y$10$5sbLzHFIYZ6Djsb8/TKopOaWjZAPm/k/CVkRUJUnPgmOzgXEwy2Xq', 'Manager', 'manager', 'uploads/questionmark.jpg', 'This user description is empty');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `topicid` (`topicid`);

--
-- Индексы таблицы `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `commentid` (`commentid`);

--
-- Индексы таблицы `tech`
--
ALTER TABLE `tech`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`name`),
  ADD KEY `userid` (`userid`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `tech`
--
ALTER TABLE `tech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`topicid`) REFERENCES `topics` (`id`);

--
-- Ограничения внешнего ключа таблицы `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`commentid`) REFERENCES `comments` (`id`);

--
-- Ограничения внешнего ключа таблицы `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
