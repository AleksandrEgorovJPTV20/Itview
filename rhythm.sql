-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 08 2023 г., 09:26
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rhythm`
--

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`id`, `name`, `description`, `image`) VALUES
(1, 'Classical', 'Известные композиции классической музыки 17-19 веков', 'https://i.ibb.co/BgS0GwF/klassicheskaya-muzika.jpg'),
(2, 'Rock', 'В этом жанре вы найдете огромное количество отличных песен и исполнителей в жанре рок.', 'https://i.ibb.co/Vq5YV9J/D9-R3-Qp-Fxvks.jpg'),
(3, 'Pop', 'Поп-музыка - это область массовой культуры, охватывающая различные формы, жанры и стили.', 'https://i.ibb.co/L1q2df8/scale-1200.webp'),
(4, 'Rap', 'Рэп-музыка - это музыкальная форма вокального исполнения, которая включает в себя \"рифмы, ритмичную речь и уличный сленг\", которые исполняются различными способами, обычно под фоновый ритм или музыкальное сопровождение.', 'https://i.ibb.co/5FRjn6q/f071669a31ae3a3d9b3c7b956690c332.jpg'),
(5, 'Electronic', 'Электронная музыка - это музыка, созданная с использованием электрических музыкальных инструментов и электронных технологий (компьютерные технологии с последних десятилетий 20 века).', 'https://i.ibb.co/MML6Sm2/muzykalnyj-zhanr-electro-istoriya-poyavleniya-i-sovremennye-tendenczii.jpg'),
(6, 'Phonk', 'Непосредственно вдохновленный мемфисским рэпом 1990-х, phonk характеризуется старым мемфисским рэп-вокалом и сэмплами из хип-хопа начала 1990-х. Они часто сочетаются с джазовыми и фанковыми сэмплами.', 'https://i.ibb.co/bRJ0DqH/What-is-Phonk.webp');

-- --------------------------------------------------------

--
-- Структура таблицы `music`
--

CREATE TABLE `music` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `performer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `releaseDate` int(4) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `audioLink` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `genreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `music`
--

INSERT INTO `music` (`id`, `name`, `performer`, `releaseDate`, `image`, `audioLink`, `likes`, `genreID`) VALUES
(1, 'Moonlight Sonata', 'Ludwig van Beethoven', 1801, 'https://i.ibb.co/KXNbSBB/1141.jpg', 'https://cdn.discordapp.com/attachments/1082606984165072910/1082608239025324103/Beethoven-Moonlight-Sonata.mp3', 21, 1),
(2, 'Turkish rondo', 'Wolfgang Amadeus Mozart', 1784, 'https://i.ibb.co/4ZQJV8V/409.jpg', 'https://cdn.discordapp.com/attachments/1082606984165072910/1082608724436336660/189.mp3', 9, 1),
(3, 'Toccata and Fugue in D minor', 'Johann Sebastian Bach', 1707, 'https://i.ibb.co/NNtgqgr/98995cc0fdcb4b190-5cc0fdcb48237.jpg', 'https://cdn.discordapp.com/attachments/1082606984165072910/1082610738415280218/Toccata-and-fugue-in-d-minor_1.mp3', 6, 1),
(4, 'Overture 1812', 'Peter Ilyich Tchaikovsky', 1880, 'https://i.ibb.co/XxhPj7N/12102702.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082612576715800646/Pyotr-Ilyich-Tchaikovsky_-_1812-Overture-Op49-Finale_muziqa.ru.mp3', 5, 1),
(5, 'Carmen', 'Georges Bizet', 1874, 'https://i.ibb.co/02cq2br/13103104.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082622968892510278/georges-bizet-carmen-overture-45.mp3', 6, 1),
(6, 'Show Must Go On', 'Queen', 1991, 'https://i.ibb.co/kGh62KN/show-must-go-on-queen-gina-dsgn.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082622444747116624/queen-the-show-must-go-on_456361248.mp3', 3, 2),
(7, 'Wonderwall', 'Oasis', 1995, 'https://i.ibb.co/vdBy1h4/artworks-KSKyl-FZ35-LNe-Kitz-r-Nye-Ng-t500x500.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082622192459714611/oasis-wonderwall_456293329.mp3', 2, 2),
(8, 'Kashmir', 'Led Zeppelin', 1975, 'https://i.ibb.co/44GbZbM/il-500x500-4151585272-g9fx.webp', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082622006693998642/led-zeppelin-kashmir-456287415.mp3', 0, 2),
(9, 'Argentina - Jamaica 5:0', 'Chaif', 1998, 'https://i.ibb.co/VmJT6Px/1434836372840-lc-gallery-Image-Argentina-s-Lionel-Messi.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082621291972022372/chajf-argentina-jamajka-50_456316108.mp3', 0, 2),
(10, 'Kak Na Voyne\r\n', 'Agatha Christie', 1993, 'https://i.ibb.co/yVwcrgv/hqdefault.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082620947716116490/agata-kristi-kak-na-vojne_456365889.mp3', 1, 2),
(11, 'Mamma Mia', 'ABBA', 1975, 'https://i.ibb.co/7JWXR87/Mamma-Mia-Intermezzo-No-1.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082620670510387240/abba-mamma-mia-456366523.mp3', 0, 3),
(12, 'Bad Romance', 'Lady Gaga', 2009, 'https://i.ibb.co/gj4dwLX/artworks-000020985496-vhi2fl-t500x500.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082620063166763028/lady-gaga-bad-romance_456292884.mp3', 0, 3),
(13, 'Billie Jean\r\n', 'Michael Jackson', 1982, 'https://i.ibb.co/Xjpv1r1/51-IJG7k-IFd-L-SX260.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082619805393231943/michael-jackson-billie-jean_456513926.mp3', 4, 3),
(14, 'Don’t Stop Believin’', 'Journey', 1983, 'https://i.ibb.co/3k20NyY/artworks-000330658995-n6sdfg-t500x500.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082619581719384094/1552086116-journey-dont-stop-bel.mp3', 0, 3),
(15, 'A town that does not exist', 'Igor Kornelyuk', 2003, 'https://i.ibb.co/5xDhkJ7/e6a07097ea3d8d2da9015984f68d73fe.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082618727935246346/file.mp3', 1, 3),
(16, 'Baila Baila Baila', 'Ozuna', 2019, 'https://i.ibb.co/988xjW4/Getty-Images-1068273910-s70fj6.webp', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082618351773307020/ozuna-baila-baila-baila_59222051.mp3', 0, 4),
(17, 'Lose Yourself', 'Eminem', 2002, 'https://i.ibb.co/t2Tg4yX/R-1858561-1248281037.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082617671188746261/Eminem_-_Lose_Yourself.mp3', 0, 4),
(18, 'Stronger', 'Kanye West', 2007, 'https://i.ibb.co/Yb1mVYm/DRNB0029-800x.webp', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082617458764025916/Kanye-West-Stronger-musmorecom.mp3', 0, 4),
(19, 'Hero', 'Nas', 2008, 'https://i.ibb.co/9rSBt9M/Nashero.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082616998254612530/videoplayback.mp3', 0, 4),
(20, 'Hands Up', 'Lloyd Banks', 2006, 'https://i.ibb.co/ZVqt1qQ/Lloydbankshandsup.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082616128242712596/lloyd-banks-feat-50-cent-hands-u.mp3', 0, 4),
(21, 'Faded', 'Alan Walker', 2015, 'https://i.ibb.co/zJqxGrS/MV5-BZTUy-YWI4-Y2-Et-ZGQ2-MC00-NDNi-LTg3-N2-Ut-MWMw-Y2-I1-ZTVi-Yz-A4-Xk-Ey-Xk-Fqc-Gde-QXVy-MTY5-MDE5.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082615485658562580/alan-walker-faded_456295834.mp3', 2, 5),
(22, 'Titanium', 'David Guetta', 2011, 'https://i.ibb.co/WWV3pB7/Titaniumsong.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082615241994674256/david-guetta-feat-sia-titanium-f.mp3', 3, 5),
(23, 'Windowlicker', 'Aphex Twin', 1999, 'https://i.ibb.co/dtkTtD3/widowlicker.png', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082614935844028478/aphex-twin-windowlicker_1.mp3', 1, 5),
(24, 'Strobe', 'deadmau5', 2006, 'https://i.ibb.co/5hn2DLH/sddefault.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082613494505033849/Deadmau5_-_Strobe_Radio_Edit_mp3store.cc.mp3', 0, 5),
(25, 'Levels', 'Avicii', 2011, 'https://i.ibb.co/LSSVgHW/Levelssong.jpg', 'https://cdn.discordapp.com/attachments/1079371947458179193/1082613034226298920/avicii-levels_6778334.mp3', 0, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` enum('admin','manager','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `role`) VALUES
(1, 'admin@test.ee', '$2y$12$mjv/GPng4oQFohhkPl8RPucmgRDFVs/UCVP02US.r92ra09kK4d7u', 'Admin', 'admin'),
(2, 'user@test.ee', '$2y$12$mjv/GPng4oQFohhkPl8RPucmgRDFVs/UCVP02US.r92ra09kK4d7u', 'User', 'user'),
(3, 'manager@test.ee', '$2y$10$5sbLzHFIYZ6Djsb8/TKopOaWjZAPm/k/CVkRUJUnPgmOzgXEwy2Xq', 'Manager', 'manager');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genreID` (`genreID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `music`
--
ALTER TABLE `music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `music_ibfk_1` FOREIGN KEY (`genreID`) REFERENCES `genre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
