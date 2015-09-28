-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 26 2015 г., 18:07
-- Версия сервера: 5.5.44
-- Версия PHP: 5.4.44-0+deb7u1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `bpm_process`
--

-- --------------------------------------------------------

--
-- Структура таблицы `questionary_for_driver_licence`
--

CREATE TABLE IF NOT EXISTS `questionary_for_driver_licence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `driver_licence_category` varchar(255) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `driver_lessons_class_number` int(3) DEFAULT NULL,
  `lector_of_driving_rights` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `questionary_for_driver_licence`
--

INSERT INTO `questionary_for_driver_licence` (`id`, `full_name`, `driver_licence_category`, `age`, `driver_lessons_class_number`, `lector_of_driving_rights`) VALUES
(1, 'Владелец Заявки', 'В', 25, NULL, NULL),
(3, 'xcXZc', 'XZcXZcXZc', 12, NULL, NULL),
(4, NULL, NULL, NULL, 123, 'dfgasgfdg'),
(5, 'dsfds', 'fadfad', 123, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `additional` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`id`, `title`, `email`, `additional`) VALUES
(69, '323432', '234234', 'ghfdrf'),
(70, '23123', '213123213', '21321321'),
(71, '12321', '321312', '3213123'),
(72, '213213123', '12312312', '213123');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `current_node_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `process_id`, `author_id`, `current_node_id`, `created_at`) VALUES
(1, 1, 1, 1, '2015-09-03 09:15:32'),
(2, 1, 1, 3, '2015-09-03 09:15:39');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks_cart`
--

CREATE TABLE IF NOT EXISTS `tasks_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` int(11) NOT NULL,
  `organisation_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `assigned_to_id` int(11) DEFAULT NULL,
  `current_node_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Дамп данных таблицы `tasks_cart`
--

INSERT INTO `tasks_cart` (`id`, `process_id`, `organisation_id`, `department_id`, `author_id`, `assigned_to_id`, `current_node_id`, `active`, `created_at`) VALUES
(58, 2, NULL, NULL, 3, NULL, 5, 1, '2015-09-25 12:20:08'),
(60, 2, NULL, NULL, 3, NULL, 7, 1, '2015-09-25 14:00:24'),
(61, 2, NULL, NULL, 3, NULL, 6, 1, '2015-09-25 14:23:41'),
(62, 2, 1, NULL, 3, NULL, 5, 1, '2015-09-25 15:47:07'),
(63, 2, 1, 1, 3, NULL, 5, 1, '2015-09-26 09:01:55'),
(64, 2, 2, 3, 1, NULL, 5, 1, '2015-09-26 10:00:27'),
(65, 2, 2, 3, 1, NULL, 5, 1, '2015-09-26 10:15:06');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks_entities_link`
--

CREATE TABLE IF NOT EXISTS `tasks_entities_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `entity_item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Дамп данных таблицы `tasks_entities_link`
--

INSERT INTO `tasks_entities_link` (`id`, `task_id`, `entity_id`, `entity_item_id`, `user_id`, `created_at`) VALUES
(47, 49, 1, 69, 1, '2015-09-21 11:41:54'),
(48, 49, 2, 17, 1, '2015-09-21 11:42:41'),
(49, 49, 1, 69, 1, '2015-09-21 12:07:23'),
(50, 50, 1, 70, 1, '2015-09-23 11:23:35'),
(51, 51, 1, 71, 1, '2015-09-23 11:23:44'),
(52, 52, 1, 72, 1, '2015-09-23 11:23:51'),
(53, 52, 2, 18, 1, '2015-09-23 11:26:45'),
(54, 51, 2, 19, 1, '2015-09-23 11:27:13'),
(55, 50, 2, 20, 1, '2015-09-23 11:27:44'),
(56, 59, 3, 1, 3, '2015-09-25 12:21:53'),
(57, 59, 3, 2, 3, '2015-09-25 12:22:17'),
(58, 60, 3, 3, 3, '2015-09-25 14:00:32'),
(59, 60, 3, 4, 1, '2015-09-25 14:16:55'),
(60, 61, 3, 5, 3, '2015-09-25 14:23:49');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks_entities_link_cart`
--

CREATE TABLE IF NOT EXISTS `tasks_entities_link_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `entity_item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tasks_nodes_action_log`
--

CREATE TABLE IF NOT EXISTS `tasks_nodes_action_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tasks_nodes_action_log_cart`
--

CREATE TABLE IF NOT EXISTS `tasks_nodes_action_log_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_cart_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `second_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `user_data`
--

INSERT INTO `user_data` (`id`, `first_name`, `second_name`) VALUES
(17, 'qwerqe', 'rqewrqer'),
(18, 'dfaer', 'ewrqewr'),
(19, 'qewr', 'qewrqewr'),
(20, 'qwerqew', 'rewrqewr');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
