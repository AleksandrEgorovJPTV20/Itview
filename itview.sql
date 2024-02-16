-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 16 2024 г., 18:29
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
(98, 'test', 1, 1, 'uploads/comments/hiii.png', '', '', '2024-02-05 17:31:48', '2024-02-15 19:25:10');

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
(68, 'test', 3, 98, NULL, NULL, NULL, '2024-02-05 17:32:06', '2024-02-05 17:32:06'),
(69, 'asdasd', 1, 98, NULL, NULL, NULL, '2024-02-16 09:22:49', '2024-02-16 09:22:49');

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
(4, 'asdsa', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tech`
--

CREATE TABLE `tech` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nameEST` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `descriptionEST` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `tech`
--

INSERT INTO `tech` (`id`, `name`, `nameEST`, `description`, `descriptionEST`, `image`, `year`) VALUES
(1, 'Apple M1 Chip', 'Apple M1 kiip', 'Apple introduced its M1 chip in 2020, but its impact continued to be significant in 2021. The M1 is a custom-designed ARM-based system on a chip (SoC) that powers a range of Apple devices, including the MacBook Air, MacBook Pro, and Mac mini. It brought notable improvements in performance and energy efficiency, marking Apple\'s transition away from Intel processors.', ' Apple tutvustas oma M1 kiipi aastal 2020, kuid selle mõju oli märkimisväärne ka 2021. M1 on kohandatud ARM-põhine süsteem kiip (SoC), mis toidab mitmeid Apple\'i seadmeid, sealhulgas MacBook Air, MacBook Pro ja Mac mini. See tõi kaasa märkimisväärseid edusamme jõudluse ja energiatõhususe osas, märkides Apple\'i üleminekut Intel\'i protsessoritest.', 'https://th.bing.com/th/id/OIP.3ODPI6UHE1z7YMNGBELP_QHaEK?rs=1&pid=ImgDetMain', '2021'),
(2, 'NVIDIA GeForce RTX 30 Series GPUs', 'NVIDIA GeForce RTX 30 seeria graafikaprotsessorid', 'NVIDIA released its GeForce RTX 30 series graphics cards based on the Ampere architecture. Notable models include the GeForce RTX 3080, RTX 3070, and RTX 3060. These GPUs introduced advancements in ray tracing and AI-powered features, delivering impressive performance for gaming, content creation, and professional applications.', 'NVIDIA avaldas oma GeForce RTX 30 seeria graafikakaardid, mis põhinevad Ampere arhitektuuril. Märkimisväärsed mudelid hõlmavad GeForce RTX 3080, RTX 3070 ja RTX 3060. Need graafikaprotsessorid tõid kaasa edusammud kiirjälgimise ja AI-toega funktsioonides, pakkudes muljetavaldavat jõudlust mängude, sisuloome ja professionaalsete rakenduste jaoks.', 'https://th.bing.com/th/id/OIP.ssfyf2CkcLcvgM2l_1OL9QHaEK?rs=1&pid=ImgDetMain', '2021'),
(3, 'AMD Ryzen 5000 Series CPUs', 'AMD Ryzen 5000 seeria protsessorid', 'AMD continued its success in the CPU market with the release of the Ryzen 5000 series, featuring the Zen 3 architecture. CPUs like the Ryzen 9 5950X and Ryzen 9 5900X offered excellent multi-core performance, making them popular choices for gaming and content creation. AMD\'s Zen 3 architecture brought improvements in IPC (instructions per cycle) and overall efficiency.', ' AMD jätkas edu protsessoriturul, tuues turule Ryzen 5000 seeria, millel on Zen 3 arhitektuur. Protsessorid nagu Ryzen 9 5950X ja Ryzen 9 5900X pakkusid suurepärast mitmiktuuma jõudlust, muutes need populaarseteks valikuteks mängude ja sisuloome jaoks. AMD Zen 3 arhitektuur tõi kaasa edusamme IPC-s (juhiste arv tsükli kohta) ja üldises efektiivsuses.', 'https://th.bing.com/th/id/OIP.QHwhrV27K5zWB5HirppPqwHaEK?rs=1&pid=ImgDetMain', '2021');

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
(1, 'Announcements', '', 1),
(29, 'Other', '', 1),
(30, 'General Questions', '<font color=\"#1a1a1a\">A channel where you can ask a question anyone.</font>', 1);

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
(1, 'admin@test.ee', '$2y$10$r8xcQsYIm35EIS99fZcnY.gncYL0QgYmxMAwAD7ggr0OqVTNC/1d6', 'Admin', 'admin', 'uploads/users/GEW9Rhla4AAuYNG.jpg', '<u style=\"\"><font color=\"#9e6767\">a dsadas <b style=\"\">dsadasda<i style=\"\">d s<a href=\"http://www.roblox.com/my/avatar\" style=\"\">adadasda</a></i></b></font></u>', '12321', '213', '12', '12', NULL),
(2, 'user@test.ee', '$2y$10$U6WdQgTA0fw50J15NGQcG.pP.IfN.R95vfadxtYULn0Q1w0/XwbwC', 'User', 'user', 'uploads/users/kitty kitty.png', 'teta<u style=\"\"><i style=\"font-weight: bold;\">ta</i>sdsadas</u>', NULL, NULL, NULL, NULL, NULL),
(3, 'manager@test.ee', '$2y$10$5sbLzHFIYZ6Djsb8/TKopOaWjZAPm/k/CVkRUJUnPgmOzgXEwy2Xq', 'Manager', 'manager', 'uploads/users/vrkitten fr.png', 'This <b><i><font color=\"#09fb39\">user descripti<u>on is emptydasdadadas dadsdad&nbsp;</u></font></i></b>', NULL, NULL, NULL, NULL, NULL),
(18, 'test@gmail.com', '$2y$10$VDpa0BYPjHpDCl6RmOX3oOpXV/aoIh/ffWkDnkeSbmXumfLNYpMNy', 'test', 'manager', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', '\'This user description is empty\'', NULL, NULL, NULL, NULL, '2024-01-31 17:15:00'),
(19, 'furranous@gmail.com', '$2y$10$Q3EbBtwxWvVYvXrI089oSenxaQoyZericvQn2S0pLLdWVGJiKFG26', 'Furranous', 'user', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', '\'This user description is empty\'', NULL, NULL, NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT для таблицы `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `tech`
--
ALTER TABLE `tech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
