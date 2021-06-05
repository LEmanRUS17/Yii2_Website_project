-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 05 2021 г., 10:16
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `website`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `viewed` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`id`, `title`, `description`, `content`, `date`, `viewed`, `user_id`, `status`, `category_id`) VALUES
(1, 'Curabitur blandit tempus porttitor nullam id dolor nibh ultricies', 'Aenean leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Curabitur blandit tempus porttitor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.', '<p>Donec sed odio dui consectetur adipiscing elit. Etiam adipiscing tincidunt elit, eu convallis felis suscipit ut. Phasellus rhoncus tincidunt auctor. Nullam eu sagittis mauris. Donec non dolor ac elit aliquam tincidunt at at sapien. Aenean tortor libero, condimentum ac laoreet vitae, varius tempor nisi. Duis non arcu vel lectus. Mauris lacinia dui non metus dignissim venenatis. Etiam elit tellus, condimentum tempor lobortis non. Aliquam pharetra vestibulum arcu, eget iaculis. Pellentesque Euismod Amet Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna vel. View Larger View Larger Mauris convallis, sapien id ultricies aliquet, mi nisi congue dui, id laoreet ligula ante vitae ligula. <img alt=\"\" src=\"/upload/files/some/sub/path/%D0%B8%D0%B7%D0%BE%D0%B1%D1%80%D0%B0%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5.png\" style=\"float:right; height:200px; width:200px\" />Duis lectus magna, cursus in molestie eget, cursus eget quam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi ullamcorper laoreet metus, eu commodo diam cursus et. Nam eleifend aliquam augue, id condimentum erat vehicula vel. Donec sed odio dui. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet. Sit Vulputate Bibendum Purus Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vestibulum id ligula porta felis euismod semper. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. View Larger Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Nullam id dolor id nibh ultricies vehicula ut id elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui. Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum. Cras mattis consectetur purus sit amet fermentum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Vestibulum id ligula porta felis euismod semper. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.</p>\r\n', '2021-05-05 15:18:00', 5, 1, 1, 4),
(2, 'Ridiculus ultricies pellentesque', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Fusce dapibus, tellus ac cursus commodo. Etiam porta sem malesuada magna mollis euismod. Praesent commodo cursus magna.', 'Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.\r\n\r\nDonec sed odio dui consectetur adipiscing elit. Etiam adipiscing tincidunt elit, eu convallis felis suscipit ut. Phasellus rhoncus tincidunt auctor. Nullam eu sagittis mauris. Donec non dolor ac elit aliquam tincidunt at at sapien. Aenean tortor libero, condimentum ac laoreet vitae, varius tempor nisi. Duis non arcu vel lectus.\r\n\r\n    Mauris lacinia dui non metus dignissim venenatis.\r\n    Etiam elit tellus, condimentum tempor lobortis non.\r\n    Aliquam pharetra vestibulum arcu, eget iaculis.\r\n\r\nPellentesque Euismod Amet\r\n\r\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna vel.\r\nView Larger\r\nView Larger\r\n\r\nMauris convallis, sapien id ultricies aliquet, mi nisi congue dui, id laoreet ligula ante vitae ligula. Duis lectus magna, cursus in molestie eget, cursus eget quam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi ullamcorper laoreet metus, eu commodo diam cursus et. Nam eleifend aliquam augue, id condimentum erat vehicula vel. Donec sed odio dui. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet.\r\nSit Vulputate Bibendum Purus\r\n\r\nFusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vestibulum id ligula porta felis euismod semper. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.\r\nView Larger\r\n\r\nCras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Nullam id dolor id nibh ultricies vehicula ut id elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui. Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum. Cras mattis consectetur purus sit amet fermentum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Vestibulum id ligula porta felis euismod semper. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.', '2021-05-05 15:35:00', 0, 2, 1, 5),
(3, 'Vestibulum id ligula porta felis euismod semper vel scelerisque', 'Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Etiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur, tortor mauris condimentum nibh. Cum sociis natoque penatibus et magnis dis parturient.', 'Pellentesque Euismod Amet\r\n\r\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna vel.\r\nView Larger\r\nView Larger\r\n\r\nMauris convallis, sapien id ultricies aliquet, mi nisi congue dui, id laoreet ligula ante vitae ligula. Duis lectus magna, cursus in molestie eget, cursus eget quam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi ullamcorper laoreet metus, eu commodo diam cursus et. Nam eleifend aliquam augue, id condimentum erat vehicula vel. Donec sed odio dui. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vivamus sagittis lacus vel augue laoreet.', '2021-05-07 13:30:00', 4, 27, 1, 3),
(4, 'Inceptos porta nibh', 'Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Curabitur blandit tempus porttitor. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nulla vitae elit libero, a pharetra augue. Fusce dapibus, tellus ac cursus commodo.', 'Sit Vulputate Bibendum Purus\r\n\r\nFusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vestibulum id ligula porta felis euismod semper. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.\r\nView Larger\r\n\r\nCras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Nullam id dolor id nibh ultricies vehicula ut id elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui. Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum. Cras mattis consectetur purus sit amet fermentum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Vestibulum id ligula porta felis euismod semper. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.', '2021-05-07 15:26:00', 3, 38, 1, 1),
(10, 'test', 'test', 'test', '2021-05-12 07:51:00', 0, 1, 1, 1),
(11, 'test', 'test', 'test', '2021-05-12 08:44:00', 0, 2, 1, 3),
(12, 'test', 'test', 'test', '2021-05-12 10:14:00', 0, 12, 1, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `article_tag`
--

CREATE TABLE `article_tag` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `article_tag`
--

INSERT INTO `article_tag` (`id`, `article_id`, `tag_id`) VALUES
(11, 1, 1),
(12, 1, 2),
(13, 1, 3),
(14, 1, 8),
(15, 2, 1),
(16, 2, 2),
(17, 2, 13),
(18, 2, 15),
(19, 3, 2),
(20, 3, 8),
(21, 3, 12),
(22, 3, 14),
(23, 4, 2),
(24, 4, 4),
(25, 4, 10),
(26, 4, 12),
(27, 4, 13),
(28, 10, 3),
(29, 10, 10),
(30, 10, 13),
(31, 10, 15),
(32, 11, 2),
(33, 11, 3),
(34, 11, 4),
(35, 12, 2),
(36, 12, 3),
(37, 12, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1621926248),
('user', '2', 1621926248),
('user', '26', 1621926531),
('user', '27', 1622274797),
('user', '29', 1622533302),
('user', '30', 1622545277),
('user', '31', 1622545936),
('user', '32', 1622546529),
('user', '33', 1622547403),
('user', '34', 1622548151),
('user', '35', 1622548266),
('user', '38', 1622548753),
('user', '39', 1622613240);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('accessAdminPanel', 2, 'Access to admin panel', NULL, NULL, 1621926247, 1621926247),
('admin', 1, NULL, NULL, NULL, 1621926248, 1621926248),
('createArticle', 2, 'Create a Article', NULL, NULL, 1621926246, 1621926246),
('updateArticle', 2, 'Update Article', NULL, NULL, 1621926247, 1621926247),
('user', 1, NULL, NULL, NULL, 1621926247, 1621926247);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'accessAdminPanel'),
('admin', 'updateArticle'),
('admin', 'user'),
('user', 'createArticle');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(1, 'Web Design'),
(2, 'Photography'),
(3, 'Graphic Design'),
(4, 'Manipulation'),
(5, 'Motion Graphics');

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `filePath` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemId` int(11) DEFAULT NULL,
  `isMain` tinyint(1) DEFAULT NULL,
  `modelName` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urlAlias` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `filePath`, `itemId`, `isMain`, `modelName`, `urlAlias`, `name`) VALUES
(4, 'Articles/Article12/a2776d.jpg', 12, 1, 'Article', 'ff7318ecd9-1', ''),
(5, 'Articles/Article12/afccdd.png', 12, NULL, 'Article', '9176ebf174-2', ''),
(6, 'Articles/Article1/8c691b.png', 1, 1, 'Article', 'aa42d21930-1', ''),
(7, 'Articles/Article1/86fbfd.jpg', 1, NULL, 'Article', '4660307f91-2', ''),
(8, 'Articles/Article2/e70462.jpg', 2, 1, 'Article', '66514d0fba-1', ''),
(9, 'Articles/Article2/f52e86.png', 2, NULL, 'Article', '7fdcee45e3-2', ''),
(10, 'Articles/Article2/9a44ff.png', 2, NULL, 'Article', '8eda68b604-3', ''),
(11, 'Articles/Article2/e282df.png', 2, NULL, 'Article', '9f1e0220a3-4', ''),
(12, 'Articles/Article2/694646.png', 2, NULL, 'Article', 'f8e5fa6942-5', ''),
(13, 'Articles/Article2/0a258f.png', 2, NULL, 'Article', '28f6122e91-6', ''),
(14, 'Users/User38/182fa9.jpg', 38, 1, 'User', '5829630cba-1', ''),
(15, 'Users/User39/e6901e.jpg', 39, 1, 'User', '94c7019cad-1', '');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1620187864),
('m140506_102106_rbac_init', 1621573495),
('m140622_111540_create_image_table', 1620724623),
('m140622_111545_add_name_to_image_table', 1620724623),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1621573496),
('m180523_151638_rbac_updates_indexes_without_prefix', 1621573496),
('m200409_110543_rbac_update_mssql_trigger', 1621573496),
('m210406_074250_create_article_table', 1620187868),
('m210406_074314_create_category_table', 1620187868),
('m210406_074328_create_tag_table', 1620187868),
('m210406_074342_create_user_table', 1620187869),
('m210406_074415_create_article_tag_table', 1620187872),
('m210407_052506_create_comment_table', 1620187874),
('m210506_053731_drop_photo_column_from_user_table', 1620279659),
('m210506_055006_create_account_type_table', 1620284814),
('m210506_065058_create_accounttype_user_table', 1620286264),
('m210506_070611_drop_isAdmin_column_from_user_table', 1620286265),
('m210508_073906_add_auth_key_column_to_user_table', 1620459554),
('m210508_075344_add_type_column_to_user_table', 1620460431),
('m210528_125638_add_description_column_to_user_table', 1622269475),
('m210529_054911_add_avatar_column_to_user_table', 1622269475);

-- --------------------------------------------------------

--
-- Структура таблицы `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tag`
--

INSERT INTO `tag` (`id`, `title`) VALUES
(1, 'Web'),
(2, 'Photography'),
(3, 'Illustation'),
(4, 'Fun'),
(5, 'Blog'),
(6, 'Design'),
(7, 'Inspiration'),
(8, 'Tips'),
(9, 'Manipulation'),
(10, 'Graphic'),
(11, 'Travel'),
(12, 'Concept'),
(13, 'Test post'),
(14, 'Test sesion'),
(15, 'Test Post');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `auth_key`, `description`, `avatar`) VALUES
(1, 'admin', 'admin@website.loc', '$2y$13$ZyT9twAPLrcHh3MwE2pN0upN1jXeUesbG7Qo97fY3Ct4dY6BgUtJS', 'aK_X13to3nSo6RAg-wHGyAONNdKpurWM', ' Администратор сайта', NULL),
(2, 'user', 'user@test.loc', '$2y$13$jJ/MV/kHltzZj9YsRbvPuuBA9TwZyuhEcmet.pkTXP0FldgV7szgi', 'xpkLtNKLf7lYVGUxCGP3G_SnOr4jAeAF', NULL, NULL),
(10, 'user_test', 'user_test@test.ru', '$2y$13$R2LYc/okUaVysy9WT5e3vuybBzcsj67pRrf3Erc6NktVmA8AS.GHS', '', NULL, NULL),
(11, 'admin_test', 'admin_test@test.ru', '$2y$13$Vu4lFI4f.tWuwU6Z1IW6wOqQY8nQ5fJpKcJtOh.EVJkXBpDFGzX7O', 'q5qEkHFcUAw-iST_ASgg2WX01MQ8QjNv', NULL, NULL),
(12, 'user#1', 'user#1@test.ru', '$2y$13$e2B/wX7Mlq5UxAI6SVhtOe3cuzZkgBV3Df50EcWyOow9KL0vWd/Wy', '', NULL, NULL),
(14, 'user#3', 'user#3@test.loc', '$2y$13$n3GGOfU1aD0CpvQDimmaTO7w06tdBpcZIe09pjqeEAMfUBBsf5g4G', '', NULL, NULL),
(15, 'user#4', 'user#4@test.loc', '$2y$13$Ph4Z6DLwOpv4n4oQUpsSae8zKhKgxjEBeJ5gvEbeE7lmR6iiLBOfi', '', NULL, NULL),
(16, 'user#5', 'user#5@test.loc', '$2y$13$lv9fAcMFFgr5JH7MoZy2keB5idINCE8jk0D2q4gsYk7e89pf9Vgc.', '', NULL, NULL),
(24, 'user#6', 'user#6@test.loc', '$2y$13$mvOWBImv3cIQw1h7yhMdo.LAGCe1wzYLanAPMgXlP9KzrO1ZnXt7C', 'YTxkNJxeLBguDhwN_iehMGgdLafFn7gL', NULL, NULL),
(25, 'user#7', 'user#7@test.loc', '$2y$13$ysAIDaXMLKc.nt6ESdZTQevV1rrlTABWj735gWQnuXxU/xGQYAgm2', 'gnCro2OfdOmUjmZa1SSqyjAUebGGulZd', NULL, NULL),
(26, 'user#8', 'user#8@test.loc', '$2y$13$Gkx.YLMGyEU.I1/mkY2B/e/jz0yDJKv3N0sRYvOyT34909mbcJAti', '63omQhUlx8a97I0rZg28TAsS9TsdGFM3', NULL, NULL),
(27, 'user#9', 'user#9@test.loc', '$2y$13$XG5uhAVeyM2bNzjfyZWIWuwPhQ4NUfy0pSGs6temUkBXdcUnb2hRy', NULL, 'Этот пользователь тестирует \"краткое описание пользователя\"', NULL),
(29, 'user#10', 'user#10@test.loc', '$2y$13$401otSO3xGDfQ7JA2JS1o.MO2klKrJMBfALuuTndv7mNciadEIM8.', NULL, 'Тестовый пользователь', NULL),
(30, 'user#11', 'user#11@test.loc', '$2y$13$xTeQkIpuAU2quXBqjdmaLO66r172jDLSLZoMr62XFw7HUdnGi.0wC', NULL, 'Пользователь для тестирования изображения', NULL),
(31, 'user#12', 'user#12@test.loc', '$2y$13$aOk4dU27GhFpodKLhXDLneNWOsJNm.2gN/eNZ2/zr6gUZ8Ict8VD2', NULL, 'test', NULL),
(32, 'user#13', 'user#13@test.loc', '$2y$13$VIteabEr71X.tfQzQfPfwuWovEmn77xyVMUvT.hqxXqX3km7/IOZm', NULL, 'test', NULL),
(33, 'user#14', 'user#14@test.loc', '$2y$13$hD/qX1Xs.9sXQjSKg5tMSuJ.JfdGAc/Kr3H91anxLh68rXMGLSyAu', NULL, 'test', NULL),
(34, 'user#15', 'user#15@test.loc', '$2y$13$6OK5J1OGu/0IXdFNmZKUNe7YYGO2ZKSVKDqdVzJ7M/WmxPofXM4oO', NULL, 'test', NULL),
(35, 'user#16', 'user#16@test.loc', '$2y$13$WfYjTHK0R5765EBcw26ZXOqrm2cpJcLQpIO/aDLRvrQfL1by8/yzm', NULL, '123', NULL),
(36, 'user#17', 'user#17@test.loc', '$2y$13$Rn3h0V92.pOqAF1ugqpODuFhXHLqU6YELVI0MFSeaboLP6iwytxhC', NULL, '123', NULL),
(37, 'user#18', 'user#18@test.loc', '$2y$13$Kj0dH.vinlA0tvD408CWbeck4qqk3FVA7ixxO0DTQ.OXha8kbNrl.', NULL, '123', NULL),
(38, 'user#19', 'user#19@test.loc', '$2y$13$X7aPhX..qlX.JqwxXYz6/ebpwmrIO/Ssputzf9CJ/CMgcF2czBvNS', NULL, 'test', NULL),
(39, 'user#20', 'user#20@test.loc', '$2y$13$s6b2XArhSMggMcHBLzLJu.TIGpDTQ86E8Q5ySWco3PSeaFI4l..zW', NULL, 'Тестовый пользователь №20', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `article_tag`
--
ALTER TABLE `article_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_post_post_id` (`article_id`),
  ADD KEY `idx_tag_id` (`tag_id`);

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-post-user_id` (`user_id`),
  ADD KEY `idx-post_id` (`article_id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `article_tag`
--
ALTER TABLE `article_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `fk-tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tag_post_id` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE;

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
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk-post-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-post_id` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
