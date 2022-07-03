-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 03, 2016 at 08:21 PM
-- Server version: 5.5.41-log
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `banned`
--

CREATE TABLE IF NOT EXISTS `banned` (
  `id` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `reason` varchar(32) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `time` varchar(200) NOT NULL,
  `date` varchar(32) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banned`
--

INSERT INTO `banned` (`id`, `admin`, `reason`, `time`, `date`) VALUES
(8, 1, '5', '0', '25 ноября 2016');

-- --------------------------------------------------------

--
-- Table structure for table `donated`
--

CREATE TABLE IF NOT EXISTS `donated` (
  `id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `checked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `from_who` int(11) NOT NULL,
  `to_who` int(11) NOT NULL,
  `accepted` int(1) NOT NULL,
  `msg` varchar(100) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`from_who`, `to_who`, `accepted`, `msg`) VALUES
(1, 5, 1, ''),
(1, 2, 1, ''),
(1, 0, 0, ''),
(1, 0, 0, ''),
(1, 3, 1, ''),
(1, 8, 1, ''),
(5, 2, 1, ''),
(5, 3, 1, ''),
(5, 6, 1, ''),
(6, 2, 1, ''),
(1, 6, 0, ''),
(7, 1, 1, ''),
(7, 2, 0, ''),
(8, 2, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_who` int(11) NOT NULL,
  `to_who` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` varchar(32) NOT NULL,
  `readed` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_who`, `to_who`, `text`, `date`, `readed`) VALUES
(2, 5, 1, 'Ку епты', '0', 0),
(3, 5, 1, 'Тестовое сообщение', '0', 0),
(4, 5, 2, 'Сколько стоит буст в доте?', '0', 0),
(5, 5, 6, 'привет.можно картошки 1кг по скидке?', '0', 0),
(6, 5, 2, 'епты бля', '0', 0),
(7, 5, 2, 'ыфыфы', '0', 0),
(8, 5, 2, 'фыфыфыфыфы', '0', 0),
(9, 5, 2, '1515151515', '0', 0),
(10, 7, 1, 'привет я твой фанат!!!!', '0', 0),
(11, 8, 1, 'привет! дай галочку!', '0', 0),
(12, 1, 8, '', '0', 0),
(13, 8, 1, 'ПОЧЕМУ ТЫ МЕНЯ ЗАБЛОКИРОВАЛ??!!!!!', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `text` text NOT NULL,
  `screens` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `screens`, `date`) VALUES
(2, 'Повышение', 'ГОЛД НОВА 4', 'http://i.imgur.com/d0Aa92d.jpg', '2016-11-01'),
(3, 'Калаш', 'Поднял спустя 20 побед', 'http://i.imgur.com/u0eoOmD.jpg', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reporter` int(11) NOT NULL,
  `reported` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date` varchar(32) NOT NULL,
  `text` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `surname` varchar(32) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `says` varchar(100) NOT NULL,
  `gender` varchar(32) NOT NULL,
  `email` varchar(32) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `code_activation` varchar(32) NOT NULL,
  `email_status` int(1) NOT NULL,
  `support` int(1) NOT NULL,
  `offical` int(11) NOT NULL,
  `password` varchar(32) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `b_day` int(11) NOT NULL,
  `b_month` varchar(32) NOT NULL,
  `b_year` int(11) NOT NULL,
  `city` varchar(32) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `web-site` text NOT NULL,
  `last_login` varchar(32) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `user_ip` varchar(100) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `online` int(11) NOT NULL,
  `avatar` text NOT NULL,
  `experience` int(11) NOT NULL,
  `site_lang` int(11) NOT NULL,
  `banned` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `says`, `gender`, `email`, `code_activation`, `email_status`, `support`, `offical`, `password`, `b_day`, `b_month`, `b_year`, `city`, `web-site`, `last_login`, `user_ip`, `online`, `avatar`, `experience`, `site_lang`, `banned`) VALUES
(1, 'Danil', 'Vikulov', 'Бог всея SOCIAL', 'Мужской', 'vikulovd15@gmail.com', '30351\n', 1, 2, 1, 'stoc5667', 15, 'January', 1996, 'Stockholm', 'deevee.hol.es', '02 декабря 2016 года в 22:50', '127.0.0.1', 0, '/files/1.jpg', 1248360, 2, 0),
(2, 'Папич', 'Жаднич', '', 'Средний', 'papi4@gmail.com', '8982\n', 1, 0, 0, 'jopi4', 1, 'February', 1990, 'Винница', '', '03 декабря 2016 года в 12:23', '127.0.0.1', 0, '/files/2.jpg', 199, 1, 0),
(3, 'Гриша', 'Зейналов', '', 'Мужской', 'grinya@mail.ru', '29652\n', 0, 0, 0, 'grisha2002', 8, 'January', 2002, '', '', '25 октября 2016 года в 17:01', '127.0.0.1', 0, '/img/avatar.png', 10, 1, 0),
(5, 'Павел', 'Дуров', 'ВКонтакте - прошлый век.Заходите на SOCIAL!', 'Мужской', 'durov@vk.com', '27619\n', 1, 0, 1, 'stoc5667', 15, 'October', 1984, 'Санкт-Петербург', '', '03 декабря 2016 года в 12:23', '127.0.0.1', 1, '/files/5.jpg', 193710, 2, 0),
(6, 'Михуд', 'Эбжанов', 'Аллах акбар', 'Мужской', 'mihud1212@list.ru', '23099\n', 1, 0, 0, 'stoc5667', 3, 'July', 1953, 'Тбилиси', '', '22 ноября 2016 года в 21:49', '127.0.0.1', 0, 'http://www.bagnet.org/storage/28/20/19/02/729_486_560d69ada7ff2.jpg', 30, 1, 0),
(7, 'Master', 'Guardian-2', 'Стучусь в твое окно', 'Мужской', 'venki@gmail.com', '23199\n', 1, 0, 0, 'stoc5667', 31, 'November', 2016, 'CS:GO', '', '20 ноября 2016 года в 14:41', '127.0.0.1', 0, 'http://csgoally.weebly.com/uploads/5/5/0/7/55076847/s441419538591078959_p10_i3_w1920.jpeg', 30, 0, 0),
(8, 'Юрий', 'Хованский', 'Видеоблогер, алкоголик, гангстер', 'Мужской', 'khovanskiy@gmail.com', '20510\n', 1, 0, 0, 'stoc5667', 19, 'January', 1990, 'Санкт-Петербург', 'khovansky.info', '26 ноября 2016 года в 13:19', '127.0.0.1', 0, 'https://pp.vk.me/c604619/v604619436/1407e/ki1KRT94u4s.jpg', 18359, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wall`
--

CREATE TABLE IF NOT EXISTS `wall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `text` text NOT NULL,
  `w_date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `wall`
--

INSERT INTO `wall` (`id`, `user`, `text`, `w_date`) VALUES
(3, 1, 'Сделал систему загрузки фотографий.Мне нравится :)', '02 декабря 2016 года в 21:43'),
(4, 1, 'Тестыч', '02 декабря 2016 года в 22:16'),
(5, 1, 'Я тут бог', '02 декабря 2016 года в 22:29'),
(6, 5, 'После моего ухода из VK,я понял,что мой сайт - не само совершенство.SOCIAL - вот действительно лучший сайт.', '03 декабря 2016 года в 12:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
