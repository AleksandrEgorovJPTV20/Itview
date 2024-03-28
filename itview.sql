-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 28 2024 г., 16:19
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
(116, 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest', 1, 61, NULL, NULL, NULL, '2024-03-27 16:37:44', '2024-03-27 16:37:55'),
(117, 'ASDAS', 1, 63, NULL, NULL, NULL, '2024-03-28 16:04:46', '2024-03-28 16:04:46');

-- --------------------------------------------------------

--
-- Структура таблицы `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `text` text DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `replyid` int(11) DEFAULT NULL,
  `imgpath` varchar(255) DEFAULT NULL,
  `imgpath2` varchar(255) DEFAULT NULL,
  `imgpath3` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `replies`
--

INSERT INTO `replies` (`id`, `text`, `userid`, `commentid`, `replyid`, `imgpath`, `imgpath2`, `imgpath3`, `created_at`, `updated_at`) VALUES
(94, 'SADASDASDASDSA', 1, 117, NULL, NULL, NULL, NULL, '2024-03-28 16:04:54', '2024-03-28 16:04:59'),
(95, 'DSADA', 1, 117, 94, NULL, NULL, NULL, '2024-03-28 16:05:02', '2024-03-28 16:13:33');

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
(3, 'AMD Ryzen 5000 Series CPUs', 'AMD Ryzen 5000 seeria protsessorid', 'AMD continued its success in the CPU market with the release of the Ryzen 5000 series, featuring the Zen 3 architecture. CPUs like the Ryzen 9 5950X and Ryzen 9 5900X offered excellent multi-core performance, making them popular choices for gaming and content creation. AMD\'s Zen 3 architecture brought improvements in IPC (instructions per cycle) and overall efficiency.', ' AMD jätkas edu protsessoriturul, tuues turule Ryzen 5000 seeria, millel on Zen 3 arhitektuur. Protsessorid nagu Ryzen 9 5950X ja Ryzen 9 5900X pakkusid suurepärast mitmiktuuma jõudlust, muutes need populaarseteks valikuteks mängude ja sisuloome jaoks. AMD Zen 3 arhitektuur tõi kaasa edusamme IPC-s (juhiste arv tsükli kohta) ja üldises efektiivsuses.', 'https://th.bing.com/th/id/OIP.QHwhrV27K5zWB5HirppPqwHaEK?rs=1&pid=ImgDetMain', '2021'),
(4, 'Blockchain', 'Blokkahel', 'Blockchain is a decentralized and tamper-resistant digital ledger that records transactions across a network of computers. It ensures transparency, security, and immutability by utilizing cryptographic techniques. Each block in the chain contains a timestamped and linked set of transactions, creating a secure and transparent record of data. Blockchain technology is widely used in various industries, offering a reliable and efficient way to manage and verify digital transactions without the need for intermediaries.', ' Blokkahel on hajutatud ja muutmiskindel digitaalne pearaamat, mis registreerib tehinguid arvutivõrgustiku kaudu. See tagab läbipaistvuse, turvalisuse ja muutumatuse, kasutades krüptograafilisi tehnikaid. Iga ahela plokk sisaldab ajatempliga ja omavahel ühendatud tehingute kogumit, luues turvalise ja läbipaistva andmerekordi. Blokkahela tehnoloogiat kasutatakse laialdaselt mitmesugustes tööstusharudes, pakkudes usaldusväärset ja efektiivset viisi digitaalsete tehingute haldamiseks ja kinnitamiseks ilma vahendajateta.', 'https://ifpnews.com/wp-content/uploads/2018/08/blockchain.jpg', '2022'),
(5, 'VR and AR', 'VR ja AR', 'Virtual Reality (VR) and Augmented Reality (AR) are immersive technologies transforming how we interact with the digital world. VR creates a simulated environment, completely replacing the user\'s surroundings, while AR overlays digital content onto the real world. Both technologies enhance user experiences in diverse fields, from gaming and education to healthcare and business, offering new dimensions of engagement and interaction.', 'Virtuaalreaalsus (VR) ja täiendatud reaalsus (AR) on immersiivsed tehnoloogiad, mis muudavad seda, kuidas me suhtleme digitaalse maailmaga. VR loob simuleeritud keskkonna, täielikult asendades kasutaja ümbruse, samal ajal kui AR kuvab digitaalset sisu reaalsesse maailma. Mõlemad tehnoloogiad rikastavad kasutajakogemusi mitmetes valdkondades, alates mängudest ja haridusest kuni tervishoiu ja äriteni, pakkudes uusi mõõtmeid kaasatuse ja suhtlemise jaoks.', 'https://www.tubefilter.com/wp-content/uploads/2017/09/ar-vs-vr.jpg', '2022'),
(6, 'Artificial Intelligence ', 'Tehisintellekt (AI)', 'Artificial Intelligence (AI) is a cutting-edge technology that empowers machines to simulate human intelligence, enabling them to learn, reason, and solve complex problems. Using algorithms and data, AI systems can perform tasks such as natural language processing, image recognition, and decision-making. AI is rapidly advancing across industries, enhancing automation, personalization, and efficiency, and driving innovation in diverse applications from healthcare to finance.', 'Tehisintellekt (AI) on tipptehnoloogia, mis võimaldab masinatel simuleerida inimintellekti, võimaldades neil õppida, põhjendada ja lahendada keerukaid probleeme. Algoritmide ja andmete abil saavad AI süsteemid teostada ülesandeid nagu loomuliku keele töötlemine, pildituvastus ja otsustamine. AI areneb kiiresti erinevates tööstusharudes, suurendades automatiseerimist, isikupärastamist ja efektiivsust ning käivitades innovatsiooni mitmekesistel aladel, alates tervishoiust kuni finantsini.', 'https://th.bing.com/th/id/R.e855c069d6ffe8fcf411d937ff3744ae?rik=oEVsxoOzLhnKGA&pid=ImgRaw&r=0', '2022'),
(7, 'Artificial Intelligence ', 'Tehisintellekt (AI)', 'Artificial Intelligence (AI) is a cutting-edge technology that empowers machines to simulate human intelligence, enabling them to learn, reason, and solve complex problems. Using algorithms and data, AI systems can perform tasks such as natural language processing, image recognition, and decision-making. AI is rapidly advancing across industries, enhancing automation, personalization, and efficiency, and driving innovation in diverse applications from healthcare to finance.', 'Tehisintellekt (AI) on tipptehnoloogia, mis võimaldab masinatel simuleerida inimintellekti, võimaldades neil õppida, põhjendada ja lahendada keerukaid probleeme. Algoritmide ja andmete abil saavad AI süsteemid teostada ülesandeid nagu loomuliku keele töötlemine, pildituvastus ja otsustamine. AI areneb kiiresti erinevates tööstusharudes, suurendades automatiseerimist, isikupärastamist ja efektiivsust ning käivitades innovatsiooni mitmekesistel aladel, alates tervishoiust kuni finantsini.', 'https://th.bing.com/th/id/R.e855c069d6ffe8fcf411d937ff3744ae?rik=oEVsxoOzLhnKGA&pid=ImgRaw&r=0', '2023'),
(8, 'Machine Learning (ML)', 'Masinõpe (ML)', 'Machine Learning (ML) is a subset of artificial intelligence that empowers computers to learn patterns from data and improve their performance over time without explicit programming. Through algorithms, ML models can make predictions, recognize patterns, and adapt to new information. Widely applied in various domains, from recommendation systems to image recognition, machine learning drives automation and data-driven decision-making, revolutionizing how we approach complex problems in diverse fields.\r\n\r\n\r\n\r\n\r\n', ' Masinõpe (ML) on tehisintellekti alamhulk, mis võimaldab arvutitel õppida andmetest mustreid ja parandada aja jooksul oma jõudlust ilma otsese programmeerimiseta. Algoritmide abil suudavad ML mudelid teha prognoose, ära tunda mustreid ja kohanduda uue teabega. Laialdaselt rakendatakse erinevates valdkondades, alates soovitussüsteemidest kuni pildituvastuseni. Masinõpe juhib automatiseerimist ja andmekeskset otsustusprotsessi, muutes seda, kuidas me läheneme mitmekesistes valdkondades keerukatele probleemidele.', 'https://th.bing.com/th/id/R.2d4dc96a9afc64bd79ef86d6115370fc?rik=ZjA7FTP4pRNCVA&pid=ImgRaw&r=0', '2023'),
(9, 'Internet of Things (IoT)', 'Asjade Internet (IoT)', 'The Internet of Things (IoT) is a revolutionary concept that connects everyday objects to the internet, enabling them to collect and exchange data. This interconnected network of devices, from smart appliances to industrial sensors, allows for seamless communication and automation. IoT enhances efficiency, enables real-time insights, and transforms how we interact with our surroundings. Its applications span across industries, driving innovations in smart homes, healthcare, agriculture, and more.', 'Asjade Internet (IoT) on revolutsiooniline kontseptsioon, mis ühendab igapäevased objektid internetiga, võimaldades neil koguda ja vahetada andmeid. See omavahel ühendatud seadmete võrk, alates nutikatest kodumasinatest kuni tööstuslike anduriteni, võimaldab sujuvat suhtlust ja automatiseerimist. IoT suurendab efektiivsust, võimaldab reaalajas teadmisi ja muudab meie suhtumist ümbritsevasse keskkonda. Selle rakendused ulatuvad erinevatesse tööstusharudesse, käivitades innovatsioone nutikates kodudes, tervishoius, põllumajanduses ja mujal.', 'https://th.bing.com/th/id/OIP.9eoYGk1V6saI-6RkvxcSqgHaFj?rs=1&pid=ImgDetMain', '2023');

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `userid` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`, `userid`, `created_at`) VALUES
(61, 'test', '<font color=\"#0000ff\" style=\"\"><u>wqasdasdssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssswqasdasdssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</u><b style=\"font-style: italic;\">sssssssssssssssssssssssssssssssssssssssssssss</b></font><u style=\"color: rgb(0, 0, 255);\">sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</u><span style=\"font-weight: bolder; color: rgb(0, 0, 255); font-style: italic;\">sssssssssssssssssssssssssssssssssssssssssssss</span><u style=\"color: rgb(0, 0, 255);\">sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</u><span style=\"font-weight: bolder; color: rgb(0, 0, 255); font-style: italic;\">sssssssssssssssssssssssssssssssssssssssssssss</span>', 1, '2024-03-28 16:38:14'),
(62, 'Алексей Егоров', '<div>sadsad</div>', 1, '2024-03-28 16:38:14'),
(63, '12312312', '<div>test</div>', 3, '2024-03-28 16:38:14'),
(69, 'asdasd', '', 1, '2024-03-28 16:42:56');

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
  `description` text DEFAULT NULL,
  `banexpiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `role`, `imgpath`, `description`, `banexpiry`) VALUES
(1, 'admin@test.ee', '$2y$10$r8xcQsYIm35EIS99fZcnY.gncYL0QgYmxMAwAD7ggr0OqVTNC/1d6', 'Admin', 'admin', 'https://i.ibb.co/CKqT1FV/questionmark.jpg	', '', NULL),
(2, 'user@test.eea', '$2y$10$U6WdQgTA0fw50J15NGQcG.pP.IfN.R95vfadxtYULn0Q1w0/XwbwC', 'User', 'user', 'https://i.ibb.co/CKqT1FV/questionmark.jpg	', 'sadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsadssadsads', NULL),
(3, 'manager@test.ee', '$2y$10$5sbLzHFIYZ6Djsb8/TKopOaWjZAPm/k/CVkRUJUnPgmOzgXEwy2Xq', 'Manager', 'user', 'https://i.ibb.co/CKqT1FV/questionmark.jpg	', 'This <font color=\"#09fb39\" style=\"\">user descripti<u style=\"\">on is emptydasdadadas dadsdad&nbsp;</u></font>', NULL),
(18, 'test@gmail.com', '$2y$10$VDpa0BYPjHpDCl6RmOX3oOpXV/aoIh/ffWkDnkeSbmXumfLNYpMNy', 'test', 'manager', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', '\'This user description is empty\'', '2024-01-31 17:15:00'),
(19, 'furranous@gmail.com', '$2y$10$Q3EbBtwxWvVYvXrI089oSenxaQoyZericvQn2S0pLLdWVGJiKFG26', 'Furranous', 'user', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', '\'This user description is empty\'', NULL),
(20, 'user12312@test.ee', '$2y$10$t74XLXbSGDIEh5E02JX1KOBaVVR7I/JH64Oaq/qo9WNMixUX.DwjG', 'User tesstasta ', 'user', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', '\'This user description is empty\'', NULL);

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
  ADD KEY `commentid` (`commentid`),
  ADD KEY `replyid` (`replyid`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT для таблицы `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT для таблицы `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `tech`
--
ALTER TABLE `tech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
