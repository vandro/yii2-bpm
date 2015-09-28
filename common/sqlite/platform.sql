-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 26 2015 г., 18:08
-- Версия сервера: 5.5.44
-- Версия PHP: 5.4.44-0+deb7u1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `platform`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', 1, 1439802215),
('member', 2, 1440143150);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Administrator of this application', NULL, NULL, 1439802051, 1439802051),
('adminArticle', 2, 'Allows admin+ roles to manage articles', NULL, NULL, 1439802051, 1439802051),
('createArticle', 2, 'Allows editor+ roles to create articles', NULL, NULL, 1439802051, 1439802051),
('deleteArticle', 2, 'Allows admin+ roles to delete articles', NULL, NULL, 1439802051, 1439802051),
('editor', 1, 'Editor of this application', NULL, NULL, 1439802051, 1439802051),
('manageUsers', 2, 'Allows admin+ roles to manage users', NULL, NULL, 1439802051, 1439802051),
('member', 1, 'Registered users, members of this site', NULL, NULL, 1439802051, 1439802051),
('premium', 1, 'Premium members. They have more permissions than normal members', NULL, NULL, 1439802051, 1439802051),
('support', 1, 'Support staff', NULL, NULL, 1439802051, 1439802051),
('theCreator', 1, 'You!', NULL, NULL, 1439802051, 1439802051),
('updateArticle', 2, 'Allows editor+ roles to update articles', NULL, NULL, 1439802051, 1439802051),
('updateOwnArticle', 2, 'Update own article', 'isAuthor', NULL, 1439802051, 1439802051),
('usePremiumContent', 2, 'Allows premium+ roles to use premium content', NULL, NULL, 1439802051, 1439802051);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('theCreator', 'admin'),
('editor', 'adminArticle'),
('editor', 'createArticle'),
('admin', 'deleteArticle'),
('admin', 'editor'),
('admin', 'manageUsers'),
('support', 'member'),
('support', 'premium'),
('editor', 'support'),
('admin', 'updateArticle'),
('updateOwnArticle', 'updateArticle'),
('editor', 'updateOwnArticle'),
('premium', 'usePremiumContent');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isAuthor', 'O:28:"common\\rbac\\rules\\AuthorRule":3:{s:4:"name";s:8:"isAuthor";s:9:"createdAt";i:1439802051;s:9:"updatedAt";i:1439802051;}', 1439802051, 1439802051);

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `title`, `order`) VALUES
(1, 'Ташкент', 500);

-- --------------------------------------------------------

--
-- Структура таблицы `dictionary`
--

CREATE TABLE IF NOT EXISTS `dictionary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `added` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `dictionary`
--

INSERT INTO `dictionary` (`id`, `title`, `code`, `added`) VALUES
(1, 'Регионы', 'regions', 1),
(2, 'Города', 'cities', 1),
(3, 'Типы вопросов', 'question_type', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `entity`
--

CREATE TABLE IF NOT EXISTS `entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `added` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `entity`
--

INSERT INTO `entity` (`id`, `title`, `code`, `added`) VALUES
(1, 'Заявка', 'Request', 1),
(2, 'Заявка2', 'Request2', 1),
(3, 'Заявка3', 'Request3', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `length` int(11) NOT NULL,
  `dictionary_id` int(11) DEFAULT NULL,
  `added` tinyint(1) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `fields`
--

INSERT INTO `fields` (`id`, `entity_id`, `title`, `code`, `type`, `length`, `dictionary_id`, `added`, `visible`) VALUES
(1, 1, 'Murojaatchining F.I.Sh', 'full_name', 'VARCHAR', 255, 0, 1, 1),
(2, 1, 'Yashash manzili yoki Yuridik adres', 'address', 'TEXT', 500, 0, 1, 1),
(3, 1, 'Telefon raqami', 'phone', 'VARCHAR', 20, 0, 1, 1),
(4, 1, 'Tadbirkorlik subyekti nomi', 'entrepreneur_name', 'VARCHAR', 255, 0, 1, 1),
(5, 1, 'Murojaatning qisqacha mazmuni', 'description', 'TEXT', 500, 0, 1, 1),
(6, 1, 'Oldingi arizaning raqami', 'requests_nums', 'VARCHAR', 255, 0, 1, 1),
(7, 1, 'Electron pochta manzili', 'email', 'VARCHAR', 50, 0, 1, 1),
(8, 1, 'Регион', 'region', 'INT', 11, 1, 1, 1),
(9, 1, 'Города', 'city', 'INT', 11, 2, 1, 1),
(10, 2, 'Города', 'city', 'INT', 11, 2, 1, 1),
(11, 2, 'Тип вопросов', 'question_type', 'INT', 11, 3, 1, 1),
(12, 3, 'Города', 'city', 'INT', 11, 2, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `gridviews`
--

CREATE TABLE IF NOT EXISTS `gridviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `gridviews`
--

INSERT INTO `gridviews` (`id`, `title`, `user_id`, `default`) VALUES
(1, 'MyView', 1, 0),
(3, 'Test', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `gridview_fields`
--

CREATE TABLE IF NOT EXISTS `gridview_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gridview_id` int(11) NOT NULL,
  `entity_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `order` int(6) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`),
  KEY `gridview_id` (`gridview_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `gridview_fields`
--

INSERT INTO `gridview_fields` (`id`, `gridview_id`, `entity_type_id`, `field_id`, `order`) VALUES
(1, 1, 2, 4, 100),
(2, 1, 1, 1, 100),
(4, 1, 2, 4, 100);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1439802033),
('m141022_115823_create_user_table', 1439802037),
('m141022_115912_create_rbac_tables', 1439802037),
('m141022_115922_create_session_table', 1439802037),
('m150104_153617_create_article_table', 1439802037);

-- --------------------------------------------------------

--
-- Структура таблицы `process`
--

CREATE TABLE IF NOT EXISTS `process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `question_type`
--

CREATE TABLE IF NOT EXISTS `question_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `question_type`
--

INSERT INTO `question_type` (`id`, `title`, `order`) VALUES
(1, 'Алименты', 500),
(2, 'Уголовный', 500);

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '500',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `title`, `order`) VALUES
(1, 'Андижанская область', 500),
(2, 'Наманганская область', 500),
(3, 'Ташкентская область', 500);

-- --------------------------------------------------------

--
-- Структура таблицы `Request`
--

CREATE TABLE IF NOT EXISTS `Request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `address` text,
  `phone` varchar(20) DEFAULT NULL,
  `entrepreneur_name` varchar(255) DEFAULT NULL,
  `description` text,
  `requests_nums` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `Request`
--

INSERT INTO `Request` (`id`, `full_name`, `address`, `phone`, `entrepreneur_name`, `description`, `requests_nums`, `email`, `region`, `city`) VALUES
(1, 'Рахимов Эркин Шодикович', 'Yashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adres', '+9989032423', 'ООО Рахимов Эркин Шодикович', 'Murojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuni', '12; 45; 23;', 'adsd@df.df', 1, 1),
(4, 'Анваров Эркин Шодикович', ' Yashash manzili yoki Yuridik adres Yashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adres', '+9989032423', 'ООО Рахимов Эркин Шодикович', 'Murojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuni', '12; 45;', 'adsd@df.df', 3, 1),
(5, 'Рахимов Эркин Шодикович', 'Yashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adres', '+9989032423', 'ООО Рахимов Эркин Шодикович', 'Murojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuni', '12; 45; 23;', 'adsd@df.df', 2, 1),
(6, 'Ботиров Эргаш Мирмухамедович', 'г. Ташкен, Мирабадский район, улица Фаргона йули, дом 234', '+998905672341', 'OOO Spark parts', 'Нету претензии', '23, 45, 67', 'dfg@gh.pf', 1, 1),
(7, 'Ашуров Мухмуд Эргашевич', 'Yashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adres', '+9989032423', 'ООО Ашуров Мухмуд Эргашевич', 'Murojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuni', '23', 'ffg@fg.com', 3, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `Request2`
--

CREATE TABLE IF NOT EXISTS `Request2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` int(11) DEFAULT NULL,
  `question_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `Request2`
--

INSERT INTO `Request2` (`id`, `city`, `question_type`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `rules`
--

CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fields_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fields_id` (`fields_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `rules`
--

INSERT INTO `rules` (`id`, `fields_id`, `code`, `value`) VALUES
(1, 1, 'required', 'true'),
(2, 1, 'string', 'true'),
(4, 2, 'required', 'true'),
(5, 2, 'string', 'true'),
(6, 3, 'string', 'true'),
(7, 3, 'required', 'true'),
(8, 4, 'required', 'true'),
(9, 5, 'required', 'true'),
(10, 6, 'required', 'true'),
(11, 7, 'required', '1'),
(12, 8, 'required', 'true'),
(13, 9, 'string', 'true'),
(14, 10, 'required', 'true'),
(15, 11, 'required', 'true');

-- --------------------------------------------------------

--
-- Структура таблицы `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `expire` int(11) NOT NULL,
  `data` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `session`
--

INSERT INTO `session` (`id`, `expire`, `data`) VALUES
('02uvrf7jbrob7jhuleh9mjg5i1', 1440489344, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('095q56te5eg9s5i7mslstpu5m3', 1441528125, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('0rb25tassoce5cs07vppj5k4l7', 1439988730, 0x5f5f666c6173687c613a303a7b7d5f5f72657475726e55726c7c733a393a222f6261636b656e642f223b),
('13dh5ffa41luq5e7c4tvsjh175', 1442252001, 0x5f5f666c6173687c613a303a7b7d),
('2ggnsp9rsj96e3pb8g3josnl61', 1442233606, 0x5f5f666c6173687c613a303a7b7d),
('3csppg72jnsoqocou7cfvc10t4', 1439978051, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('3hi2iaaq2neb8iheraft1u3ir2', 1442068474, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('4hgluujnvaacdpji5h619jtea6', 1440144676, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a323b5f5f636170746368612f736974652f636170746368617c733a363a227a6d6b636e6f223b5f5f636170746368612f736974652f63617074636861636f756e747c693a313b),
('4v41uoicj8ke1fm76sibs6sc27', 1443184998, 0x5f5f666c6173687c613a303a7b7d),
('5fj489kr8fq0q0lsbla172oug2', 1441983398, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('5l5joavgl6fqn67ofghl1aa2l1', 1442397541, 0x5f5f666c6173687c613a303a7b7d),
('6ujidr8u48djpklhfpdpfebdp3', 1440143874, 0x5f5f666c6173687c613a303a7b7d),
('721ic3h7v31tk7e4q2hi9mn4i4', 1441796456, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('77s63sj5f465e7nniemb8hv196', 1441645230, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('9dcp73bc84vn7k63aa6vpf15g4', 1440154160, 0x5f5f666c6173687c613a303a7b7d),
('9hjbgg1kepoen1qvp2v0a4qdc3', 1442234153, 0x5f5f666c6173687c613a303a7b7d),
('9k2lbubo6p9l2ol3c9ustep696', 1442814333, 0x5f5f666c6173687c613a303a7b7d),
('c35eb2vpmp0ff00d4h71u60155', 1439989252, 0x5f5f666c6173687c613a303a7b7d),
('ckuv71gnc2ln4fpd80ttf7hkt4', 1441437057, 0x5f5f666c6173687c613a303a7b7d),
('d4gokjcger8m8hdd5bbadlnlt5', 1443170131, 0x5f5f666c6173687c613a303a7b7d),
('dadb96i56coavtfa8aup21hfr1', 1440765232, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('e5pdp3ahr2r8nt9eebt62f57v3', 1439804331, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('e81giprlqal4bdh47v5jve38n6', 1441121846, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('ed53r569lj83hk2u854jpdot91', 1442985275, 0x5f5f666c6173687c613a303a7b7d),
('f6c9pf3ljougi4jk6ine4tsdc7', 1442925532, 0x5f5f666c6173687c613a303a7b7d),
('faofvll3603b30pf1n715h4bg0', 1441287622, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('fn6t92bih9c0s1k5c690u9n3h0', 1441256776, 0x5f5f666c6173687c613a303a7b7d),
('g22ct2ut9ksbri8n53ic20qus1', 1439912118, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('g38jimo4pmj9uj5tch009983n2', 1443012510, 0x5f5f666c6173687c613a303a7b7d),
('gb6m7jhin54t2keoap64jb3i20', 1441208984, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('glmboo0pdqec3melvpmt6k9lp4', 1440153978, 0x5f5f666c6173687c613a303a7b7d),
('h2sb0ajkm31gl6pnjjnhe5nad6', 1441715179, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('hivfjdm7bvkjer20d3keh8ep14', 1439872701, 0x5f5f666c6173687c613a303a7b7d),
('hr4k158ompvgl1jn819n36prs1', 1442557328, 0x5f5f666c6173687c613a303a7b7d),
('i80e0vs9vkqq9aebj5vt9coh64', 1442064566, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('itgv61vs84ej1t23g0rkrgk9h1', 1442652574, 0x5f5f666c6173687c613a303a7b7d),
('jm3s7kg5neqrdvse8bif2bdg66', 1442469951, 0x5f5f666c6173687c613a303a7b7d),
('k3fg1ng2i9rcbob9pe2q5t9mt7', 1442223321, 0x5f5f666c6173687c613a303a7b7d5f5f72657475726e55726c7c733a33353a222f7379732f61646d696e2f696e6465782e7068703f723d73697465253246696e646578223b),
('kq3vb033avqu7cqjg1bg7sapc3', 1439989753, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('l238s3l1vckjqgro7h4bu33rc6', 1441026021, 0x5f5f666c6173687c613a303a7b7d5f5f636170746368612f736974652f636170746368617c733a373a2263756d68666966223b5f5f636170746368612f736974652f63617074636861636f756e747c693a313b5f5f72657475726e55726c7c733a393a222f6261636b656e642f223b),
('ljjupdt9q6urp5j68rk8u84hp2', 1442579882, 0x5f5f666c6173687c613a303a7b7d),
('lumdc8uiffhh2vm1n1iooeklr6', 1439978240, 0x5f5f666c6173687c613a303a7b7d),
('md99gt4no5g00tpmasifhaga21', 1442133500, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('mjoo1at2kqo2j7aiojq51umqg5', 1442299026, 0x5f5f666c6173687c613a303a7b7d),
('mvraf6l1n6qn8vmge0qbj9t435', 1441375601, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('netsiqvvb844juqlq7iigkl577', 1440860247, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('nud99ic4tclubgulii8t974gu3', 1440168639, 0x5f5f666c6173687c613a303a7b7d),
('odlcd6j9uj7pj51pkg6s7ria21', 1443256622, 0x5f5f666c6173687c613a303a7b7d),
('ofjdcf53g5qo9uvdelo09cie64', 1442083243, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('pin5621i4qhtu1vp94la77spi5', 1440676433, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('q84kqh2jonslp07v26ojhg7ke6', 1442219288, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('si7q7b4pub8d6nuk466qamvet5', 1441635185, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('udbmb7rq6unt3dq7p2ff458is5', 1439827143, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b),
('ujv5lj5odbgn7uq95j78027j21', 1440953318, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a313b);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organisation_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `role` int(4) DEFAULT '10',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `organisation_id`, `department_id`, `username`, `email`, `password_hash`, `status`, `role`, `auth_key`, `password_reset_token`, `account_activation_token`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 'avazbe', 'avazbe@gmail.com', '$2y$13$6MZ1rdwT3Qwjv4G6gt6nRucLFFBXytWJ4mrbKwiLFMTkU0P4aQlyS', 10, 2, '8Ul_0mgB7bH6dOD8tcmRcS_fBiIH0Xz2', '', '', 1439802215, 1439802754),
(2, NULL, NULL, 'mirsaid', 'm.mirmaksudov@uzinfocom.uz', '$2y$13$tOL3.StxjuwGPzO4VwyIputkFWDk.TJTm2FbqI4gxX7E7AImxSroC', 10, 2, 'kOtqJb7S3aMHCA8YzAczOcYZhMT5tvvz', 'kOtqJb7S3aMHCA8YzAczOcYZhMT5tvvz', 'kOtqJb7S3aMHCA8YzAczOcYZhMT5tvvz', 1440143150, 1440143150),
(3, NULL, NULL, 'Owner', 'Owner@umail.com', '$2y$13$P9wDzShX.JyxWahHpsRf0OiHnvb6xXmocaEaeqzxswA6lwkgjYdzi', 10, 10, 'J3wi3MQBAerpS3qG8inKMHo4NN8Ey-iH', NULL, NULL, 1443183596, 1443183596);

-- --------------------------------------------------------

--
-- Структура таблицы `user_role_link`
--

CREATE TABLE IF NOT EXISTS `user_role_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `user_role_link`
--

INSERT INTO `user_role_link` (`id`, `user_id`, `role_id`) VALUES
(2, 3, 4),
(3, 1, 2);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `fields`
--
ALTER TABLE `fields`
  ADD CONSTRAINT `fields_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `entity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `gridview_fields`
--
ALTER TABLE `gridview_fields`
  ADD CONSTRAINT `gridview_fields_ibfk_1` FOREIGN KEY (`gridview_id`) REFERENCES `gridviews` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `rules_ibfk_1` FOREIGN KEY (`fields_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
