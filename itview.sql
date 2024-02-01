-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 01 2024 г., 13:59
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
  `text` varchar(255) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `topicid` int(11) NOT NULL,
  `imgpath` varchar(255) DEFAULT NULL,
  `imgpath2` varchar(255) DEFAULT NULL,
  `imgpath3` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `text`, `userid`, `topicid`, `imgpath`, `imgpath2`, `imgpath3`, `created_at`, `updated_at`) VALUES
(34, '&nbsp;sadsad adad<u>ada</u>', 1, 1, NULL, NULL, NULL, '2023-12-31 08:19:59', '2024-01-18 11:51:54'),
(35, 'u sdaad ad', 1, 1, NULL, NULL, NULL, '2023-12-31 08:20:18', '2024-01-18 12:22:40'),
(53, '&nbsp;saddsa sdad<u> adad&nbsp;</u>', 2, 1, NULL, NULL, NULL, '2024-01-18 12:19:58', '2024-01-18 12:22:27'),
(54, '<u><b><i><font color=\"#542727\">&nbsp;sdad ad&nbsp;</font></i></b></u>', 1, 1, NULL, NULL, NULL, '2024-01-18 12:22:54', '2024-01-18 12:23:03'),
(83, '<b>asdasd</b>', 1, 29, 'uploads/comments/kitty kitty.png', 'uploads/comments/GEW9Rhla4AAuYNG.jpg', 'uploads/comments/1705612140.png', '2024-01-26 19:55:05', '2024-01-26 19:59:45'),
(84, 'asd', 1, 29, 'uploads/comments/lion_tech_3_2020_4x.png', 'uploads/comments/kitty kitty.png', 'uploads/comments/1705612140.png', '2024-01-26 20:19:09', '2024-01-26 20:19:09'),
(88, 'asdasd', 1, 1, 'uploads/comments/kitty kitty.png', 'uploads/comments/vr dog.png', '', '2024-01-26 20:45:34', '2024-01-27 12:24:49'),
(90, 'asdsad', 1, 30, 'uploads/comments/vr dog.png', '', '', '2024-01-26 21:13:28', '2024-01-29 17:44:21'),
(92, 'test', 1, 43, 'uploads/comments/IMG_20230520_143020.png', '', '', '2024-01-27 12:30:30', '2024-01-29 17:44:42');

-- --------------------------------------------------------

--
-- Структура таблицы `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `imgpath` varchar(255) DEFAULT NULL,
  `imgpath2` varchar(255) DEFAULT NULL,
  `imgpath3` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `replies`
--

INSERT INTO `replies` (`id`, `text`, `userid`, `commentid`, `imgpath`, `imgpath2`, `imgpath3`, `created_at`, `updated_at`) VALUES
(46, 'new test', 2, 36, NULL, NULL, NULL, '2023-12-31 08:49:19', '2024-01-09 08:19:16'),
(61, '<a href=\"http://sada\">test</a>&nbsp;sa<i><b><font color=\"#49b110\">dsa</font></b></i>', 3, 90, 'uploads/replies/1705612140.png', 'uploads/replies/kitty kitty.png', NULL, '2024-01-27 09:40:38', '2024-01-27 10:25:02'),
(63, 'sad', 1, 83, 'uploads/replies/lion_tech_3_2020_4x.png', NULL, NULL, '2024-01-27 11:20:36', '2024-01-27 12:27:09'),
(64, 'asda', 1, 88, 'uploads/replies/GEW9Rhla4AAuYNG.jpg', 'uploads/replies/vr dog.png', '', '2024-01-27 11:50:56', '2024-01-27 12:27:21'),
(65, 'a<font color=\"#1d10d1\">sdsa</font>da<b><i><u><font color=\"#7fc615\">sdasda</font></u></i></b>', 1, 92, 'uploads/replies/1500x500 (1).jpg', 'uploads/replies/F__UtmqbIAAldPP.jpg', 'uploads/replies/vr dog.png', '2024-01-27 12:30:46', '2024-01-29 17:44:59');

-- --------------------------------------------------------

--
-- Структура таблицы `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `userId` int(11) NOT NULL,
  `reportedUserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `reports`
--

INSERT INTO `reports` (`id`, `text`, `userId`, `reportedUserId`) VALUES
(1, '<b><i><u>sadasd</u></i></b>', 1, 2);

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
(30, 'General yes', '<font color=\"#4e21a1\">s<i>ad<b><u><a href=\"http://vk.com\">sadasd sasadsa</a></u></b></i></font>', 1),
(43, 'asda', '', 1);

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
  `description` varchar(255) NOT NULL DEFAULT '''This user description is empty''',
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `discord` varchar(255) DEFAULT NULL,
  `banexpiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `role`, `imgpath`, `description`, `twitter`, `instagram`, `facebook`, `discord`, `banexpiry`) VALUES
(1, 'admin@test.ee', '$2y$10$r8xcQsYIm35EIS99fZcnY.gncYL0QgYmxMAwAD7ggr0OqVTNC/1d6', 'Admin231321', 'admin', 'uploads/users/GEW9Rhla4AAuYNG.jpg', '<u style=\"\"><font color=\"#9e6767\">a dsadas <b style=\"\">dsadasda<i style=\"\">d s<a href=\"http://www.roblox.com/my/avatar\" style=\"\">adadasda</a></i></b></font></u>', '12321', '213', NULL, NULL, NULL),
(2, 'user@test.ee', '$2y$10$OUU7XB56xQ4u5qvyBB0YOuX0n2jh34y532XEOvJ.ceoZBVijnKDOG', 'User', 'user', 'uploads/users/GEW9Rhla4AAuYNG.jpg', 'tetatas', NULL, NULL, NULL, NULL, NULL),
(3, 'manager@test.ee', '$2y$10$5sbLzHFIYZ6Djsb8/TKopOaWjZAPm/k/CVkRUJUnPgmOzgXEwy2Xq', 'Manager', 'manager', 'uploads/questionmark.jpg', 'This <b><i><font color=\"#09fb39\">user descripti<u>on is emptydasdadadas dadsdad&nbsp;</u></font></i></b>', NULL, NULL, NULL, NULL, NULL),
(18, 'test@gmail.com', '$2y$10$VDpa0BYPjHpDCl6RmOX3oOpXV/aoIh/ffWkDnkeSbmXumfLNYpMNy', 'test', 'manager', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', '\'This user description is empty\'', NULL, NULL, NULL, NULL, '2024-01-31 17:15:00');

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
-- Индексы таблицы `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `reportedUserId` (`reportedUserId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT для таблицы `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT для таблицы `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tech`
--
ALTER TABLE `tech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
-- Ограничения внешнего ключа таблицы `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`reportedUserId`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
