-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 08:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itview`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
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
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `text`, `userid`, `topicid`, `imgpath`, `imgpath2`, `imgpath3`, `created_at`, `updated_at`) VALUES
(102, '&nbsp;Lorem IpsumLorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum', 21, 48, NULL, NULL, NULL, '2024-03-26 10:41:08', '2024-03-26 10:41:08'),
(111, 'thanks Charlotte, got it', 21, 50, NULL, NULL, NULL, '2024-03-28 07:36:20', '2024-03-28 07:36:20'),
(113, 'test', 1, 50, NULL, NULL, NULL, '2024-04-01 15:03:08', '2024-04-01 15:03:08'),
(114, 'Wow, it was really easy to study this topic!!! thx god XD', 26, 50, NULL, NULL, NULL, '2024-04-17 09:31:38', '2024-04-17 09:31:38'),
(115, 'It was good to see this topic!)', 27, 52, NULL, NULL, NULL, '2024-04-17 09:38:36', '2024-04-17 09:38:36'),
(116, '<font color=\"#ffffff\" style=\"background-color: rgb(75, 172, 198);\">NICE!!!</font>', 26, 53, NULL, NULL, NULL, '2024-04-17 10:28:53', '2024-04-17 10:29:06'),
(117, 'Can you describe more ur topic? Cause I want understand more this)', 28, 55, NULL, NULL, NULL, '2024-04-26 09:07:56', '2024-04-26 09:07:56'),
(118, 'Great topic)', 28, 53, NULL, NULL, NULL, '2024-04-26 09:08:24', '2024-04-26 09:08:24'),
(119, 'John, it\'s brilliant work', 28, 52, NULL, NULL, NULL, '2024-04-26 09:08:56', '2024-04-26 09:08:56'),
(120, 'It was very easy to read', 28, 50, NULL, NULL, NULL, '2024-04-26 09:09:37', '2024-04-26 09:09:37'),
(121, 'John dm me! Want to work this topic', 29, 52, NULL, NULL, NULL, '2024-05-02 09:04:50', '2024-05-02 09:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
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
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `text`, `userid`, `commentid`, `replyid`, `imgpath`, `imgpath2`, `imgpath3`, `created_at`, `updated_at`) VALUES
(72, 'test', 1, 102, NULL, 'uploads/replies/123.png', '', '', '2024-03-27 07:14:00', '2024-03-28 06:15:43'),
(73, 'Goot!', 1, 111, NULL, NULL, NULL, NULL, '2024-03-28 11:39:11', '2024-03-28 11:39:11'),
(74, 'Hi!', 1, 111, NULL, NULL, NULL, NULL, '2024-03-28 11:40:35', '2024-03-28 19:40:43'),
(77, 'test', 1, 113, NULL, NULL, NULL, NULL, '2024-04-01 15:03:36', '2024-04-01 15:03:36'),
(80, 'testts', 1, 113, 77, NULL, NULL, NULL, '2024-04-02 11:15:38', '2024-04-02 11:15:38'),
(83, 'I agree with u John', 28, 114, NULL, NULL, NULL, NULL, '2024-04-26 09:38:48', '2024-04-26 09:38:48'),
(84, 'Yup. It was easy to me too) Can u dm me?)', 28, 115, NULL, NULL, NULL, NULL, '2024-04-26 09:40:29', '2024-04-26 09:40:29'),
(85, '<font face=\"Tahoma\">What\'s there to describe? I don\'t think it needs any additional changes.</font>', 1, 117, NULL, NULL, NULL, NULL, '2024-05-03 14:10:29', '2024-05-03 14:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `userId` int(11) NOT NULL,
  `reportedUserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `text`, `userId`, `reportedUserId`) VALUES
(4, 'asdsa', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tech`
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
-- Dumping data for table `tech`
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
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `userid` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`, `userid`, `created_at`) VALUES
(48, 'AI Solutions', '<i><font color=\"#bb0c0c\"><b>Something about AI</b></font></i>', 21, '2024-03-28 17:41:06'),
(50, 'AngularJS Tutorial', 'This tutorial is specially designed to help you learn AngularJS as quickly and efficiently as possible.\nFirst, you will learn the basics of AngularJS: directives, expressions, filters, modules, and controllers.\nThen you will learn everything else you need to know about AngularJS:\nEvents, DOM, Forms, Input, Validation, Http, and more.', 23, '2024-03-28 17:41:06'),
(52, 'JavaScript Sorting Arrays', '<h2 style=\"box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; margin: 10px 0px; color: rgb(0, 0, 0);\"><b><i><span style=\"font-size:18px;\">JavaScript Array toReversed() Method</span></i></b></h2><div><div><a href=\"https://www.w3schools.com/js/js_2023.asp\" style=\"box-sizing: inherit; color: inherit;\">ES2023</a>&nbsp;added the&nbsp;<code class=\"w3-codespan\" style=\"box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;\">toReversed()</code>&nbsp;method as a safe way to reverse an array without altering the original array.</div><div>The difference between&nbsp;<code class=\"w3-codespan\" style=\"box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;\">toReversed()</code>&nbsp;and&nbsp;<code class=\"w3-codespan\" style=\"box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;\">reverse()</code>&nbsp;is that the first method creates a new array, keeping the original array unchanged, while the last method alters the original array.</div></div><div><br></div><div><img src=\"data:image/png;base64,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\" alt=\"\" style=\"cursor: default;\"><br></div>', 26, '2024-04-17 09:27:52'),
(53, 'Python String Formatting', '<h2 style=\"box-sizing: inherit; font-size: 32px; font-family: &quot;Segoe UI&quot;, Arial, sans-serif; margin: 10px 0px; color: rgb(0, 0, 0);\"><i><b><span style=\"font-size:18px;\">F-Strings</span></b></i></h2><div><div>F-string allows you to format selected parts of a string.</div><div>To specify a string as an f-string, simply put an&nbsp;<code class=\"w3-codespan\" style=\"box-sizing: inherit; font-family: Consolas, Menlo, &quot;courier new&quot;, monospace; font-size: 15.75px; color: crimson; background-color: rgba(222, 222, 222, 0.3); padding-left: 4px; padding-right: 4px;\">f</code>&nbsp;in front of the string literal, like this:</div></div><div><i><b style=\"background-color: rgb(255, 255, 0);\">EXAMPLE</b></i></div><div><i><b style=\"background-color: rgb(255, 255, 0);\"><br></b></i></div><div><img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAABDCAYAAACyYlP5AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAABgRSURBVHhe7Z0PVFTXnce/lkaJQQwtOY5GU9DElZBdgZrCzCmaoMH1b1fQJMzUroWaaCDZRAI9iUjPwmBPRRKjEkiNxNUzo1EZzvoHq0bin+4MNAmDNoprI7AVdTihxSiFATudvfe9NzAwMzDMDAjx9znn8t783nv3/bv3fu+9v3sfo6wMEARBEMQA+Y60JAiCIIgBQQJCEARBeAQJCEEQBOERJCAEQRCER5CAEARBEB5BAkIQBEF4BAkIQRAE4REkIL7GVIHCVxKheGIURo2yhURoG6XtaIZ+TTi04SysKUUTNzWVQsd/s3Do+B1hL8+xxb8WeiHy+5OmT7Jx8Gn2HFbvwpUOyTjS6KjF6dUx0D69HEc+aZaMRL/Y8pMtf3mMXV61C7oy1+/iYoHj/tqCGmnrSMH9MqpvATEboc1Ow6KXdDBJJp/TyArczF9AkW+QDCOYmkLMjZyLtCIdDF9JNgeCMf4JadXPX1rpxv+RcdIapwYnbImwvzDiEulg0oyrB0vR2cZW9flouChaRxwXj+CGnmXWtlrcPnjGy8LQl3TAmBvVlfZOVEvmXlju1KKq4HV8/GMpjf54CQ4VHMVVb+tIxCDjfhnVt4A016I0txDlt8ySYRBoNCAtfycMg3iKoeEWdFvTUGGSYeHGU7jZbgWf5C+GUignS7vZM/VRTODLhx/BaMFA+IZgTFueiNFj2aoiAyHhonXEEb4YkxQss44NQ+DyOWJaGQa0/mErruzru1nXevEDlMUtx9WSk7C0SMaWOrSWZKIqKR8XubgPe4KhKL4I5UUxzFXPluyuCU/v3l+5Z5VkHcH0U0ZRF5bPqEXtR2wR8SbUb8VB5ijcXTwkC5PWJMYESi9nNgIeFVYkIhBvS4xSmJksbgne09OuTI8QNxACE+blYPln7LnsWIXpYyTjSGNMGJ7ZUQnlZwexeF6wZLzHdNRAn7MLlrFJCFwm2XrD93ljK2sBTkWg+iDiq8U0uvyz4wj7GUv79btwfksVRnyd8VuMu2UUCYivaKyH0JJ/YiImCgbXPDj2EWHp/wNboTAGfj2EgyCGJ1d2b0Bz/RgEqP8DoUGSsRfmPxxB83XA79VNWLAsDMGSgI8eOxmRv9yCKTPZD00pvqSurGGLu2WUo4BU5nU7f6eooOO2AypM7HIIS+F5bZdfxMyOUQj2RGgbJGMXZhh/rRCOmfhKOW4xi2lvYnc88ixxt2xxnx4h91vgF3HChGVFQo0sYbmtXysMc0/wWloRFD7rp3gUDz4MNOk/wKHFMd190MVVaLZIu/Sis6kKp99S4WPufOb7x6lwpKQKTS72Hwiic1ENYwdw+3Ipjq1eIp4jPAYHc0ud9ItL/h/JidfjmKfniMf07gapzpfitA/56NcFYmlGbVk+DiXOkY6JwscrM3Fa34xOaRd7Brdvf+COWw5/d+dy2TXFSb4J/oze2gVj/R344PUJWOr34sKWOuCZXETPt/fV9eQbrh6Mh2ZMhZ+wZs9kTEuIZsuj+LpWtHhD17uw3Td/dylbXbdu2hphLMnEwa79Y/DxatfveigwX2cttm2Z0NnyKb+HxNdxorwWtx1engf5gsPS+Pl9asc0frrOyTncL6N80gLxj1kPjVYJGZMb1Ss7US/ZOebKAqS+zYQgRg3dpoVgZdq3BkOundj1Jbb3RAg78dfdKpxavRWtrBAR4H3Q25Jx6v0ahwzWygrfsrhk3DhUA4stATbV4HYB2/8nvuqzroNp+1ocScxGi54VRAJ30LkvG1VJH+CK05LuDhp2MCGzP6aNZXZ+zDpvR9nwfHUWx34yB8asXWi9bCukO2CpPoobqzfg814nsFwvxX+76tuPWwu9WHYOKZbLu1glIRnX9rFrapJ8E/wZHcpH7eJiXBYt3mFpRNVv1OgcOxvTshe55Y8xX3f+MPz8xCZJ+3XvRpb18LPY7pu/u3rn8VquH8Wh+PmoZWLf2bU/E1g9f9fxOLStBq2Sdeiowdl4FRqKj8Jsy6f8Hi6fRHPGchzb4uqaBpAvLLU4/Xw8LubudUzjqUtQeV4yeYCjgDAx6HL+XtMggdtWaHCzyyEshf1cMLoJTSpA4UpmOfYLqN41isZWA9Rrs2CQKaHZux7yANEsSyrtjsegFo05+p7x87BBLm7zCAPyehfkzsK3tJUDsETEEp/fshzM+r3YB71gxyqhRmgpPoJaex9oyyeoeHkXLKGJCNl/BgkXuvusw9dECH3WX+6u9UFNtgotJWcBxWsIP1GNF/g5fl+C4FC2qX4rLjsbwnwuH1e31GL0cnYfZ6RjKt5DIG9On9uLK/a1lagM4brFoEG/XgNeKGatRQuPI+plhB+rxnLp+KUVhxH2aq8aNM+IL2cz8Y1A8I7jWCo9pxeqz2CWOhF+bWfRwAonm654xkAdtx24cCAfnW2TEfhe9zUpL1Rj7pEiTHgm0Ce1xKajeWg4xyqLv1yPWf2ox4Qfzhb6yzu3bMAJfSNapYTTyWr/V8o/wP9sqxIN3tDlZxkH/1dLEMv9XdJ9L9ZmOHH4NkKfkYlW9nLs84TyQiUU+aswemwHOot/iap7MGLP75lVCNlzHIslXxG/h/j9WfAfy5JcyQe46EwPB5AvzPpS3LjcAb8X3+t+TiyIaXw2E3RpRw/woQ9EhoT3dVDHsKJ7XSryPq9HeWYC8mpkUL6jhjJE2u1bhHyDndj1JbZeCaHn+CWXYMF/JmK61FcdpEjClB/xteto532JEteOf4TWtjBMejcHivBg+EsJivdZz3w1F1PCWULWncVV0ewVfqoixBe/jJmPjhEK59FB0ZibI45Waf3C6KTrYSqCik9gGb+PYOmYCfMQOp9vq0W7F6W15fxeoVDEzCwodr2GmY+N6Sp4AiZMReSaDETbFZbmKibKLGMG5pcgXjEZAdJz8hsTjOnL1mP6i+zH8TNDPEy1E5bb4prf2PF40FYYsFr+hNDZmFv4Mnq5QwcOq2BU5TLhZ88patlkJ91SvXgsAWHJU1mNuAbNq+fj0L/wLpNwHHx6Pj7P2ApzV+3fc1pOa0U/S3IxFq6JxhQ+4o7D7jtQNs6xYLvMatu8ph2bg1i7PAG/cQhZmIHYt7lQN6Lpd6wFLm4ZIiLYO8qAIopVAGyDPdg9BIcn4Z94emKVrm+cNuTczxftbVICGT0O4+0GlIhpvAhzuU/KQ3woIIwAOdbv+RALWe0/a4kCKUUmyHN02JnEq5hDDbuW3gW5s3CPCvfBZzam/DQagT1y+2SMf0pa7eIOmr7gc0hqcePfxIzeMyzBNV4ru34Vt31QMAb962wE9yqB/B57EsKgtetf4xvBYs9sPBYb7FBo2YZLxkdJBg+4+sUnwjJwbQJC+i0VgT9f5GoD3E7tngPRHaJQu49vPe8iww8W4zAjibcsG9Gyeg4OpuZDr69Ds/dltEQHjNtZzb0tAlPyktx6TtzhGp5+ENGsZh8ww84JO+M5BG0owcy3uQ+E4VZczrnx5VH2dwyC5kWIaacfmmpFYQhYFo9JTs47IXaxGM+frsK7jrWB4+C/ksL5Er6VvUiniuZ+vgiKVQqtfMvuZBx5bi1OlFWhgSUQXwilbwWE83gKsnJYncdkggmpyHpV7tYLJu4VrOk+pDVmJwQ/Cql3c0i5e1v8PMDoh9wb52vbf7gREJWBRcd4d9U4WE7vQsPqJTgRFYWPmZhUXfbOiW6b8+H3OmulDageOAbTWM1+aekZqcukGi+UbsGCF6PxQBtXWFaZme7t0ORoBNj3o/dBcx1rQTF6TtS14x6lQfN5Psill//K14yNQPz+42J31Z2zaM5Khn4OSx9xTEycOurdx+cCwkdkpWfXQhYjRyQKkfKatodTfei4330gA2U2Qiq6+0cdwybMcj3wxjtY60ZwFDqZ9ToUWP4urbiJwxycHuE45s6QdhxCAh7j3VVnBH+MYkcOgiUxuZqoxKnznhdM/3dulyBAli3L8bFd7bi7hswK55WSzZ1Ph1hqce0AE+Kx8yCzzXb2mDq3uzCDfiC2esxfu6gtNV+/Bw70Ozj/X9yPw5K+ahMUNr+MFGxzvnwCH0K9pggvVFYj/kgJQpIlMeGOeieDatzFPQFhGaxdWu2TBi1SlnGneTo0JytQmCOHaY+q26neF3elJTHEBCP4h3yoHktMX9ybpsgNwydCAvaLmDqks60nPbVIWLYcP+tW4dG1/x98MaBgcOD+mBBFIuKZmCx+L5FZ6tD8iQ/Gy/oCyx1c3JKJJu67eGkxZnjRhfVAIE+zjfhbXa80a2nE59t2ORSI35swVVi2snftTHNunD4ipsEfPjmEafAqvjnOl9GY8u+LENJjXk0HOr3w77mE+1dCo6FILxKd7sxkKT7psX+zbwEJlkFotZZtRsEeI271WVOrhzZTBa0pEusPqBEX4A/5GwXdTvVKFxrHzhHHl7lq5H1q8lgJHbnffSDuMy02QehLbc1Q4si+GlzzyZBd55gbG3FbqhBbOppxpSwb5351ltWQWAtoqdfu3gERFLsYgdz5uu91/O5XpbjSxDKtuAnm5joYi/NRZVelDvpRPAL4yJhtKpRtO+uzfmTvqMGp1WqcO12Hpjvd18OfrenG1+IPxyFJbtPj0xy9gsNXEYoTnRa+nW3NaNCX4sSa51irpQ4IXYWnVGHeuEAwTSGl2V9lQl8v3rf5ehVOrFrK0pRtiHg3/j9azHupgOMbcOo3Z7vTOBO1rjTI/YZDmgZtk/NqYDLUwSw09TrQXH+WvdM5qC3j27znYnEyju1j6bXpjngODjtPy58bxfQ+dozHXVGjWCFqldadwCcBxiGKz+PoDR9t1DWU1wxDbhwU2QZEbtBDz1oets4I3qUVJ5eG8ho0TkZjmaD7WSQS9zj5XCMf2jtSCvhGLRL5XJAez8X38Al5vOuAZ1rnDmQ+EW0OGs7xLinHiYni8b23deDKjmR8vsX1Bxn91WeQsMzzPmvbdTuHjyj5CPE9nIJ8wpSK3c0qzLyYAXc+Z9X3OUR6Pzc+/+XoSrGbxhHHZ3jjOCts1pW6Fo5klsa9+awM/+ppHB8q3AexOZjbVVjbnpMLgp7DtNItPUaT+Yq+0qLLd6HIQOQ7qxDmdXdoM6pS43H1dO/uuakIZPH7rctGS4/n1N+75scVYcF8u1Fmvn4XAj3Tc4NGBf1GZ/luHEbPGI/Oy429nq+v88U4BOQfwdKFnuXtfoTHH5FvleOSTo2UZ8NcFor1e1OQwMSDTxYszOzpNPePSUcBExSYtEjPduYPkSGhxIhTW1OREHMvRmsRvCY0fbUG8docBM9jNUPbkMjBJmgq/JeyTFBxGAucjCgZCrgDelmFBiHJz8Fvgs2ZPg5+8/jY/FyHOQ+T5ucIDutJS6Ph5+JTHkNLBGafEK9/dKhdqRwajcD0IsQeGxzxcB8++ioMAS9mYfr+M1i+wxfiwQlG9NYTCOeOYSG9svM8s4qJpZaJwJMY7eSzG+K7Lun57uzS4GJ78RgiQl4sRrQ6CaNtaa/reioR+1Ox281bZqQdR6R6FQLC7eKTzhN25CQWeSgenH5aIAThG/qqrRIEMTLx+SgsgiAI4v6ABIQgCILwCBIQgiAIwiNIQAiCIAiPICc6QRAE4RHUAiEIgiA8ggSEIAiC8AgSEIIgCMIjSEAIgiAIjyABIQiCIDyCBIQgCILwCBIQgiAIwiNIQAiCIAiPIAEhCIIgPIIEhCAIgvAIEhCCIAjCI0hA3OGWAXkvFcDYKv0eCTSU4811WtT3+X/sCYIgPGd4CIjZhMLnqzFqYg3ePPZXyThMaGXisUCBrMPlqLjc539HHlaYPtNA864KimRn/0aYIAjCe4aHgNTcQtoBtjT9AwUftcAkWn2G6dP/xZvJNSiolAxuY4LulQRkVcqhLjuK9Fn2/+3dHjOMe7OQtvQX0DVKJl9jNkKbnYZFL+ncej6yFTuhy5HDtEcF1a+N7AoJgiB8y/AQkIiHsX0FW8q+g/SfB0EmWn1G/e//xoTpHwMuRE0H0pG6xwR5TgHSY1yJB+cWasvyUHi4ZfAK6uZalOYWovyWu2fwh3wDa4Ww52p4OxUFn5OEEAThW4aHgPjLkLo/CtabEdi84HuS8R7TWoHNr2lhilCjIEPOiuORSCiUGz/EQhiQla2hriyCIHwKOdFdUH+gAAUmICU7FfKRqR4ij6uQ/hZr0x3Lws5PqRVCEIQP4f+R0IFrX1kT8IU17rcmq/XuX6ynNl2wxj31hRXMJnvqgnVzxV+kHbu5qa0RtqsN7EevY0Jj2DHnWsQdu/iLVbNC3G4fErSOcQtI15Swu9lqvWOyluZcsMofdxW/87idBeF6Hai2bo6AFbL11lPtkskBvVXNHh9/hH2HBKvmmnRIvcaqlHFbpHX9OceIb+5XWllRb0XMZnYFDIO6V1wuwgqN9aYQgwuMm62RfL+1R6293wJBEISn9NkCqfhjC/JiGzA38y4qvhRtpi/v4s24BqQd/kY09KL9T2xbr2PqK9kxzJZX6X0NWHf4JtKeu47E7LswfCXafBm/QE0FNDVsuTIOCl+2PkKU2FmmhhxG5K3IQoX9sOAGLdJ5l5lMCc3edLAC33dExEEVwZZF5dDfEk0EQRBeIwlJT6TavlBLlxmt6dqb1pa7fEO7tW73BVZLZvaIy2ItWcLWAhHC4zWsldJsbReOuW299L60LaOBxeAc2/H9tUDEcxitqbZrunvLeirH2Gf8+hzxOOetDUduahPY/rCmHnK3vn6TtXh4a8CuteGSdmv1RrkQv6yrRVAnHS9n1+jiCV3TsPt3o7XhAv0GHr/Mqv5MMhAEQXhJ3z4Q2QP48NMnsDlJhoe/yw3+CF35KAr4iKmadlRLLQB7ZCvH4ZJxJtKf/T78hWPGIWxJAFjhx2rZf4f3FeDvQG14Attt1/Td8Yhj5/Rd/KxF85VOWE585GFh6Vv8EfmWBpqVMpiKUpB6oB7Gd1VQHWDy0e9oL88JDeNPyIRL9b4eJE0QxP1K3wISOxaLZjwk/bDxPYQJ/Sv/gKlZMPRAseD7CAuQftiYPA2l1ihY90/zfojuinFIiel1TSH+iJJWfUcCQidLqz4nFMr3NUiXmaB9TYGF6wxMeJmobBj80V5mmplOEISP8GgU1sQQP2mN8JiAOLz5jpI1CkysXSBHVqaSyQpBEMTIwQMBsaC+1iKuCl1U31Z0qB+sWeUc7jRfpwVi5Ew+DEhbnQfDEHxrS+xWJAiC8J6BC0jrDRw9zFdGI/JxwTJiaP+7JHz9IAsRPCq4dM0Df4E7XUT8+1pJKmhNC/HhHj00WiVklVlIyCzv34fD4m+XVgfCzQY9+yvDk6G+nudPEMT9St8Ccusu6k1t0o+7MDdcQ57ya+TVAPKNQYgbDB/zICCTibeZt/FPqGjsf6hvaFiU4KvRfnbJzU+TPMxEhy912LxJC6MT31A3Zhg2pSKrEkjYvR0pTIRDk9QosDnV97qYLx4sE7u4yjajYI8Rtwbky6hH9adcDFWQPyVaCIIgvKVvATnZBsXEyxg1qpqFP+LB0K+RxVoffKTVzlcf9c7h23gViUK8YpioFFsHOmVDl23U81fd+nBgf4QuCISSK8KxNsydcqk7fhbynH1gcVYc0vj+eyqgd0tB/KF4ns/vAIxFKkQ9MorFbQuJ0Np1hdXvTUFCrhFYocHmlTavRyiUOQXsGk3QKlXO57P4K6DaKJwBhT+LQtADdud4Xtv3c/qqArqTbLk2DlEjeVY9QRDDigF1YYU9+wDUukmo3f2E40ir4czkqdAYH8H2tX6Qu9XtJsfCdZGAKQ+FZe5JmP+s9Sj/YynUP49DmIteInNlHlRKabLgpl5O8xAl1O8oWcvHgKw3Cpz4Q/jw33Jc0qmR8mzYAEazsRbP3kKUsyPWr4hjbSWCIAjfMIpPBpHWu+GtgynfQLdiPG76YujtSKS5HGn/vAiFsvXQn2Oti5EkmPY0aJEYqoJuwYeoK0+hkV4EQfiMgTvR7xeCFyJ9UwJQk4f0dw2D95n2QaUe2ux06FiLavNGEg+CIHwLCUgfhK7cLMwYN2QnIMWVc3vYYoYhVwXVHhMW/laDdP4tLIIgCB9CAtInfMa4DuoYybk9gv4pk+lAChKyxRnu21dT24MgCN9DAtIfAXKs33sU6W+kQRkxcoYwyZ5ehEU/10C/m2a4EwQxODh3ohMEQRBEP1ALhCAIgvAIEhCCIAjCI0hACIIgCA8A/h/m0xqE2mU/HQAAAABJRU5ErkJggg==\" alt=\"\"><i><b style=\"background-color: rgb(255, 255, 0);\"><br></b></i></div>', 27, '2024-04-17 09:37:36'),
(55, 'Virtual Machine Topic', '<ul><li><span style=\"color: rgb(86, 86, 86); font-family: metropolislight;\">A </span><span style=\"margin: 0px; padding: 0px; color: rgb(86, 86, 86); font-family: metropolislight; background-color: rgb(255, 255, 0);\"><i style=\"\">Virtual Machine</i></span><span style=\"color: rgb(86, 86, 86); font-family: metropolislight;\">&nbsp;(VM)&nbsp;is&nbsp;a&nbsp;compute resource&nbsp;that&nbsp;uses software&nbsp;instead of a physical computer&nbsp;to run&nbsp;programs&nbsp;and&nbsp;deploy&nbsp;apps.&nbsp;One or more&nbsp;virtual&nbsp;“guest”&nbsp;machines&nbsp;run on&nbsp;a&nbsp;physical&nbsp;“host”&nbsp;machine.&nbsp;&nbsp;Each virtual machine runs its&nbsp;own operating system&nbsp;and&nbsp;functions separately&nbsp;from&nbsp;the&nbsp;other VMs,&nbsp;even&nbsp;when&nbsp;they are all&nbsp;running&nbsp;on&nbsp;the same&nbsp;host.&nbsp;This means that, for example,&nbsp;a virtual MacOS virtual machine can run on a physical PC.&nbsp;</span></li></ul><div><span style=\"color: rgb(86, 86, 86); font-family: metropolislight;\"><br></span></div>', 26, '2024-04-23 14:23:33'),
(57, 'Pivot table calculated item example', '<a href=\"https://exceljet.net/sites/default/files/styles/original_with_watermark/public/images/pivot/pivot%20table%20calculated%20item%20example.png\" target=\"_self\">Pivot table calculated item example</a><div><b style=\"font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\"><font color=\"#ffffff\" face=\"Geneva\"><span style=\"font-size: 14px;\"><span style=\"font-size: 18px; background-color: rgb(79, 129, 189);\">SUMMARY</span></span></font></b><font face=\"Comic Sans MS\"><i><b><br></b></i></font></div><div><div><span style=\"font-size: 12px; color: rgb(0, 0, 0); text-align: var(--bs-body-text-align);\"><font face=\"Comic Sans MS\" style=\"\"><i style=\"\"><b>Standard Pivot Tables</b></i><span style=\"font-weight: var(--bs-body-font-weight);\"> have a simple feature for creating&nbsp;calculated items. You can think of a calculated item as \"virtual rows\" in&nbsp;the source data. A calculated&nbsp;item will not appear in the field list window. Instead, it will appear as an item in&nbsp;the field for which it is defined. In the example shown, a calculated item called \"Southeast\" has been created with a formula that adds South to East. The pivot table displays the&nbsp; correct regional totals, including the new region \"Southeast\".</span></font></span><font style=\"background-color: rgb(79, 129, 189);\" color=\"#ffffff\" face=\"Geneva\"><br></font></div></div><div><h3 style=\"margin: var(--space-xs) 0; font-size: var(--font-size-m); font-weight: 800; letter-spacing: var(--letter-spacing-s); line-height: var(--line-height-m);\"><font style=\"background-color: rgb(79, 129, 189);\" color=\"#ffffff\" face=\"Geneva\"><br></font></h3><h3 style=\"margin: var(--space-xs) 0; font-size: var(--font-size-m); font-weight: 800; letter-spacing: var(--letter-spacing-s); line-height: var(--line-height-m);\"><font style=\"\" color=\"#ffffff\" face=\"Geneva\"><span style=\"font-size: 18px; background-color: rgb(79, 129, 189);\">FIELDS</span></font></h3></div><div><font face=\"Comic Sans MS\"><img src=\"https://exceljet.net/sites/default/files/images/pivot/inline/pivot%20table%20calculated%20item%20example%20fields.png\" alt=\"Field list does not show calculated item\" style=\"cursor: default;\"><font color=\"#008000\" style=\"\"><span style=\"font-size:18px;\"><br></span></font></font></div><div><font face=\"Comic Sans MS\"><br></font></div><div><span style=\"color: rgb(0, 0, 0);\"><span style=\"font-size: 12px;\"><font face=\"Comic Sans MS\">The source data contains three fields:&nbsp;Date, Region, and Sales. Note the field list does not include the calculated item.</font></span></span><br></div><div><span style=\"font-size: 12px; color: rgb(0, 0, 0); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\"><font face=\"Comic Sans MS\"><br></font></span></div><div><br></div>', 29, '2024-05-02 09:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `role`, `imgpath`, `description`, `banexpiry`) VALUES
(1, 'admin@test.ee', '$2y$10$U6WdQgTA0fw50J15NGQcG.pP.IfN.R95vfadxtYULn0Q1w0/XwbwC', 'Admin', 'admin', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', '<font color=\"#9e6767\"><u>test</u></font>', NULL),
(2, 'user@test.ee', '$2y$10$U6WdQgTA0fw50J15NGQcG.pP.IfN.R95vfadxtYULn0Q1w0/XwbwC', 'User', 'user', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', '<br>', NULL),
(3, 'manager@test.ee', '$2y$10$5sbLzHFIYZ6Djsb8/TKopOaWjZAPm/k/CVkRUJUnPgmOzgXEwy2Xq', 'Manager', 'manager', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', 'Hmm <b><i>Testing</i></b>', NULL),
(21, 'scott34@gmail.com', '$2y$10$vmfsYLX0Ft1oMdMx71R4B.fBWeroTzyxS23jF0RoakqqFIMB3WsVO', 'Scott34', 'user', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', 'This user description is empty', NULL),
(22, 'test@test.com', '$2y$10$iHnFK4wmh9xk9D/EEAgba.ex6wY1N0hHV2Xs/vEX0uf.Tl6zCUMXC', 'fgjfg', 'user', 'uploads/users/download.jpg', '', NULL),
(23, 'charlotte.bendson@gmail.com', '$2y$10$ZtuS44Rmaa68nioMjEsOlu9f2ZB6c8IhydG7sq1YXSKEFeaP1lNBC', 'Charlotte', 'user', 'uploads/users/avatarAvatar.jpg', '', NULL),
(24, 'james25@gmail.com', '$2y$10$hjI7ilwG7vfuYq1jeyHpsuL.HUjYDqXuKLYZlV872B9cM//Fpeyb6', 'james25', 'user', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', NULL, NULL),
(25, 'test@test.ee123', '$2y$10$.UkOgmhgN5DX/12omduXN.5/YXNQFD7CAkB6kSSYZjE28MMxerIr2', 'Scott341', 'user', 'https://i.ibb.co/CKqT1FV/questionmark.jpg', NULL, NULL),
(26, 'john.marley@gmail.com', '$2y$10$wblGcCqfRhWBG9.R3FIM4.wODGrXX5zsw6G/KbWzxXHBmwGs1OES6', 'John_marley', 'user', 'uploads/users/avatarJohn.png', '', NULL),
(27, 'pamel_ka@gmail.com', '$2y$10$V2fut3OL2m4ZKMcQWqq/HODghK81wxw/ZvqkSmAY4xbNRMNLQdgSG', 'Pamella788', 'user', 'uploads/users/2289_SkVNQSBGQU1PIDEwMjgtMTE2.jpg', '', NULL),
(28, 'amanda_calberg@hot.mail', '$2y$10$5r9cqWnntpw6jxtSZU6LfueLNyYItxFUMN8GygMsCLqgu0UP9DmI2', 'Amanda', 'user', 'uploads/users/logoAmanda.png', 'IT co-worker', NULL),
(29, 'brian.danielson@gmail.com', '$2y$10$BWo1t2I9YX9iuYPjg8dIReHfbqZ02lj0207OMjD9eKrUT0vtrah96', 'BrianD', 'user', 'uploads/users/avatarBrian.jpg', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `topicid` (`topicid`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `commentid` (`commentid`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `reportedUserId` (`reportedUserId`);

--
-- Indexes for table `tech`
--
ALTER TABLE `tech`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`name`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tech`
--
ALTER TABLE `tech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`topicid`) REFERENCES `topics` (`id`);

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`commentid`) REFERENCES `comments` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`reportedUserId`) REFERENCES `users` (`id`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
