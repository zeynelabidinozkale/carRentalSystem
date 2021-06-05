-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 Haz 2021, 03:06:33
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `carrental_db`
--

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_logs` ()  BEGIN
SELECT * FROM logs ORDER BY id DESC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `billing_information`
--

CREATE TABLE `billing_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tcPassportNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `companyName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TaxAdministration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `billing_information`
--

INSERT INTO `billing_information` (`id`, `name`, `surname`, `tcPassportNo`, `address`, `companyName`, `taxNo`, `TaxAdministration`, `reservation_id`, `created_at`, `updated_at`) VALUES
(17, 'Chapman', 'Wong', 'Lambert', 'Culpa mollit invent', 'Ferrell', 'Coleman', 'Walls', 20, '2021-06-04 21:46:37', '2021-06-04 21:46:37'),
(18, 'Daugherty', 'Martin', 'Oconnor', 'Velit sit earum sus', 'Murphy', 'Gray', 'Sawyer', 21, '2021-06-04 21:47:23', '2021-06-04 21:47:23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `fueltypes`
--

CREATE TABLE `fueltypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `fueltypes`
--

INSERT INTO `fueltypes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'Diesel', '2021-06-04 21:05:25', '2021-06-04 21:05:25'),
(5, 'Gasolyne', '2021-06-04 21:05:36', '2021-06-04 21:05:36'),
(6, 'Hybrit', '2021-06-04 21:05:46', '2021-06-04 21:05:46');

--
-- Tetikleyiciler `fueltypes`
--
DELIMITER $$
CREATE TRIGGER `fueltypes_delete` BEFORE DELETE ON `fueltypes` FOR EACH ROW INSERT INTO logs VALUES( null, 'Fueltype', old.id, 'Deleted data', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `fueltypes_insert` AFTER INSERT ON `fueltypes` FOR EACH ROW INSERT INTO logs VALUES(null,'Fueltype',new.id,'Inserted data',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `fueltypes_update` AFTER UPDATE ON `fueltypes` FOR EACH ROW INSERT INTO logs VALUES( null, 'Fueltype', new.id, 'Updated data', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `geartypes`
--

CREATE TABLE `geartypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `geartypes`
--

INSERT INTO `geartypes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'Automatic', '2021-05-29 10:57:05', '2021-05-29 10:57:08'),
(5, 'Manuel', '2021-05-29 10:57:15', '2021-05-29 10:57:15');

--
-- Tetikleyiciler `geartypes`
--
DELIMITER $$
CREATE TRIGGER `geartypes_delete` AFTER DELETE ON `geartypes` FOR EACH ROW INSERT INTO logs VALUES( null, 'Geartype',  old.id, 'Deleted data', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `geartypes_insert` AFTER INSERT ON `geartypes` FOR EACH ROW INSERT INTO logs VALUES(null,'Geartype',new.id,'Inserted data',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `geartypes_update` AFTER UPDATE ON `geartypes` FOR EACH ROW INSERT INTO logs VALUES( null, 'Geartype', new.id, 'Updated data', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(50) DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `logs`
--

INSERT INTO `logs` (`id`, `model`, `model_id`, `action`, `created_at`) VALUES
(1, 'Office', 63, 'Inserted data', '2021-06-04 17:09:41'),
(2, 'Offices', 63, 'Updated data', '2021-06-04 17:10:27'),
(3, 'Geartype', 6, 'Inserted data', '2021-06-04 17:22:51'),
(4, 'Geartype', 6, 'Deleted data', '2021-06-04 17:23:08'),
(5, 'Reservation', 16, 'Inserted data', '2021-06-04 19:15:01'),
(6, 'Reservation', 16, 'Updated data', '2021-06-04 19:15:01'),
(7, 'Reservation', 16, 'Updated data', '2021-06-04 19:15:22'),
(8, 'User', 4, 'Updated data', '2021-06-04 19:16:39'),
(9, 'Reservation', 16, 'Updated data', '2021-06-04 19:16:56'),
(10, 'Reservation', 16, 'Updated data', '2021-06-04 19:17:03'),
(11, 'Reservation', 16, 'Updated data', '2021-06-04 19:18:12'),
(12, 'User', 3, 'Updated data', '2021-06-04 19:21:15'),
(13, 'User', 23, 'Inserted data', '2021-06-04 19:21:54'),
(14, 'Reservation', 17, 'Inserted data', '2021-06-04 19:21:57'),
(15, 'Reservation', 17, 'Updated data', '2021-06-04 19:21:57'),
(16, 'Reservation', 17, 'Updated data', '2021-06-04 19:22:09'),
(17, 'User', 3, 'Updated data', '2021-06-04 19:23:20'),
(18, 'User', 24, 'Inserted data', '2021-06-04 19:23:43'),
(19, 'Reservation', 18, 'Inserted data', '2021-06-04 19:23:44'),
(20, 'Reservation', 18, 'Updated data', '2021-06-04 19:23:44'),
(21, 'Reservation', 18, 'Updated data', '2021-06-04 19:23:52'),
(22, 'Reservation', 19, 'Inserted data', '2021-06-04 19:37:59'),
(23, 'Reservation', 19, 'Updated data', '2021-06-04 19:37:59'),
(24, 'Reservation', 19, 'Updated data', '2021-06-04 19:38:22'),
(25, 'Reservation', 19, 'Updated data', '2021-06-04 19:38:44'),
(26, 'Reservation', 17, 'Updated data', '2021-06-04 20:08:34'),
(27, 'Reservation', 17, 'Updated data', '2021-06-04 20:09:27'),
(28, 'Reservation', 17, 'Updated data', '2021-06-04 20:09:30'),
(29, 'Reservation', 11, 'Updated data', '2021-06-04 20:09:40'),
(30, 'Reservation', 11, 'Updated data', '2021-06-04 20:09:42'),
(31, 'User', 3, 'Updated data', '2021-06-04 22:44:38'),
(32, 'User', 4, 'Updated data', '2021-06-04 22:57:22'),
(33, 'User', 25, 'Inserted data', '2021-06-04 22:57:52'),
(34, 'User', 25, 'Updated data', '2021-06-04 22:58:10'),
(35, 'User', 8, 'Updated data', '2021-06-04 23:00:21'),
(36, 'User', 3, 'Updated data', '2021-06-04 23:04:10'),
(37, 'User', 25, 'Deleted data', '2021-06-04 23:36:22'),
(38, 'Role', 7, 'Inserted data', '2021-06-04 23:36:42'),
(39, 'User', 24, 'Updated data', '2021-06-04 23:37:02'),
(40, 'Role', 7, 'Updated data', '2021-06-04 23:37:29'),
(41, 'Role', 7, 'Updated data', '2021-06-04 23:37:42'),
(42, 'User', 24, 'Updated data', '2021-06-04 23:37:57'),
(43, 'Role', 7, 'Deleted data', '2021-06-04 23:38:05'),
(44, 'Reservation', 2, 'Deleted data', '2021-06-04 23:46:37'),
(45, 'Reservation', 3, 'Deleted data', '2021-06-04 23:46:37'),
(46, 'Reservation', 4, 'Deleted data', '2021-06-04 23:46:37'),
(47, 'Reservation', 5, 'Deleted data', '2021-06-04 23:46:37'),
(48, 'Reservation', 6, 'Deleted data', '2021-06-04 23:46:37'),
(49, 'Reservation', 7, 'Deleted data', '2021-06-04 23:46:37'),
(50, 'Reservation', 8, 'Deleted data', '2021-06-04 23:46:37'),
(51, 'Reservation', 9, 'Deleted data', '2021-06-04 23:46:37'),
(52, 'Reservation', 10, 'Deleted data', '2021-06-04 23:46:37'),
(53, 'Reservation', 11, 'Deleted data', '2021-06-04 23:46:37'),
(54, 'Reservation', 12, 'Deleted data', '2021-06-04 23:46:37'),
(55, 'Reservation', 13, 'Deleted data', '2021-06-04 23:46:37'),
(56, 'Reservation', 14, 'Deleted data', '2021-06-04 23:46:37'),
(57, 'Reservation', 15, 'Deleted data', '2021-06-04 23:46:37'),
(58, 'Reservation', 16, 'Deleted data', '2021-06-04 23:46:37'),
(59, 'Reservation', 17, 'Deleted data', '2021-06-04 23:46:37'),
(60, 'Reservation', 18, 'Deleted data', '2021-06-04 23:46:37'),
(61, 'Reservation', 19, 'Deleted data', '2021-06-04 23:46:37'),
(62, 'Office', 63, 'Deleted data', '2021-06-04 23:52:09'),
(63, 'Office', 62, 'Deleted data', '2021-06-04 23:52:13'),
(64, 'Fueltype', 1, 'Deleted data', '2021-06-05 00:04:11'),
(65, 'Fueltype', 3, 'Deleted data', '2021-06-05 00:04:17'),
(66, 'Fueltype', 2, 'Deleted data', '2021-06-05 00:05:06'),
(67, 'Fueltype', 4, 'Inserted data', '2021-06-05 00:05:25'),
(68, 'Fueltype', 5, 'Inserted data', '2021-06-05 00:05:36'),
(69, 'Fueltype', 6, 'Inserted data', '2021-06-05 00:05:46'),
(70, 'Vehicle', 28, 'Updated data', '2021-06-05 00:06:39'),
(71, 'Vehicle', 31, 'Updated data', '2021-06-05 00:06:45'),
(72, 'User', 14, 'Deleted data', '2021-06-05 00:07:12'),
(73, 'Office', 64, 'Inserted data', '2021-06-05 00:16:43'),
(74, 'Offices', 64, 'Updated data', '2021-06-05 00:17:09'),
(75, 'User', 8, 'Updated data', '2021-06-05 00:17:55'),
(76, 'Reservation', 20, 'Inserted data', '2021-06-05 00:46:37'),
(77, 'Reservation', 20, 'Updated data', '2021-06-05 00:46:37'),
(78, 'Reservation', 21, 'Inserted data', '2021-06-05 00:47:23'),
(79, 'Reservation', 21, 'Updated data', '2021-06-05 00:47:23'),
(80, 'Reservation', 21, 'Updated data', '2021-06-05 00:47:46'),
(81, 'Reservation', 21, 'Updated data', '2021-06-05 00:48:03'),
(82, 'Reservation', 20, 'Updated data', '2021-06-05 00:50:08'),
(83, 'Reservation', 21, 'Updated data', '2021-06-05 00:50:19'),
(84, 'User', 26, 'Inserted data', '2021-06-05 00:52:56'),
(85, 'User', 26, 'Updated data', '2021-06-05 00:53:14'),
(86, 'User', 3, 'Updated data', '2021-06-05 01:04:54');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_25_065148_create_roles_table', 2),
(10, '2021_05_29_092521_create_vclasses_table', 3),
(11, '2021_05_29_092553_create_fueltypes_table', 3),
(12, '2021_05_29_092635_create_geartypes_table', 3),
(13, '2021_05_29_111824_create_offices_table', 3),
(14, '2021_05_29_111851_create_vehicles_table', 3),
(15, '2021_05_29_111851_create_office_personnel_table', 4),
(16, '2021_05_29_111851_create_office_vehicle_table', 5),
(19, '2021_05_31_125506_create_billing_information_table', 7),
(20, '2021_05_30_214746_create_reservations_table', 8);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `offices`
--

CREATE TABLE `offices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `offices`
--

INSERT INTO `offices` (`id`, `name`, `address`, `email`, `tel`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'İstanbul Havalimanı', 'Nemo laborum Quis s', 'tibileqyv@mailinator.com', 'Esse veniam cupida', 'sadf', '38.5743173', '2021-05-29 18:02:00', '2021-06-01 08:14:20'),
(2, 'İstanbul Sabiha Gökçen Havalimanı', 'Cum sint odio repreh', 'cehevuham@mailinator.com', 'Similique laudantium', '36.3304402', '38.5743173', '2021-05-29 18:04:53', '2021-05-29 18:04:53'),
(3, 'İzmir İç Hatlar', 'Est officiis mollit', 'ribuwonux@mailinator.com', 'Reiciendis ad est e', '37.8704402', '38.5743173', '2021-05-29 18:05:01', '2021-05-29 18:05:01'),
(4, 'Ankara İç Hatlar', 'Et nesciunt iusto f', 'zodul@mailinator.com', 'Elit consequuntur t', '37.1304402', '38.5743173', '2021-05-29 18:05:09', '2021-05-29 18:05:09'),
(5, 'Antalya İç Hatlar', 'Itaque aliquam aut v', 'lirily@mailinator.com', 'Enim ullamco ea et e', '37.8304402', '38.5743173', '2021-05-29 18:05:19', '2021-05-29 18:05:19'),
(6, 'Antalya Dış Hatlar', 'Voluptatem culpa ve', 'babamy@mailinator.com', 'Eveniet deserunt se', '37.8304402', '38.5743173', '2021-05-29 18:05:28', '2021-05-29 18:05:28'),
(7, 'Adana İç Hatlar', 'Nulla recusandae La', 'zysokuro@mailinator.com', 'Ipsam iste incididun', '37.9304402', '38.5743173', '2021-05-29 18:05:35', '2021-05-29 18:05:35'),
(8, 'Adana Merkez', 'Consectetur consecte', 'julywak@mailinator.com', 'Qui suscipit ad opti', '37.8304402', '38.5743173', '2021-05-29 18:05:42', '2021-05-29 18:05:42'),
(9, 'Afyon Merkez', 'At id tempore cupid', 'xigepohut@mailinator.com', 'Ducimus minim moles', '37.8304402', '38.5743173', '2021-05-29 18:05:49', '2021-05-29 18:05:49'),
(10, 'Amasya Merzifon Havalimanı', 'Suscipit quia eos et', 'sawoc@mailinator.com', 'Consequatur aute mi', '37.8304402', '38.5743173', '2021-05-29 18:05:58', '2021-05-29 18:05:58'),
(11, 'Ankara Batıkent', 'Necessitatibus Nam v', 'tulahumy@mailinator.com', 'Non sint nostrum vel', '37.8304402', '38.5743173', '2021-05-29 18:06:06', '2021-05-29 18:06:06'),
(12, 'Ankara Merkez', 'Maxime dolore volupt', 'fagypuf@mailinator.com', 'Laudantium vero qui', '37.8304402', '38.5743173', '2021-05-29 18:06:13', '2021-05-29 18:06:13'),
(13, 'Antalya Belek', 'Omnis esse consequat', 'fitawonu@mailinator.com', 'Officia dolore quis', '37.8304402', '38.5743173', '2021-05-29 18:06:29', '2021-05-29 18:06:29'),
(14, 'Antalya Şehir Merkezi', 'Eveniet sit provide', 'juwogojiba@mailinator.com', 'Quia aut cum illo de', '37.8304402', '38.5743173', '2021-05-29 18:06:44', '2021-05-29 18:06:44'),
(16, 'Aydın Kuşadası', 'Nobis officiis minim', 'jitovyteho@mailinator.com', 'Perspiciatis ut est', '37.8304402', '38.5743173', '2021-05-29 18:07:06', '2021-05-29 18:07:06'),
(17, 'Balıkesir Ayvalık Merkez', 'Anim et delectus la', 'xozetaxeh@mailinator.com', 'Dolore eos quas per', '37.8304402', '38.5743173', '2021-05-29 18:07:14', '2021-05-29 18:07:14'),
(18, 'Balıkesir Edremit Körfez Havalimanı', 'Sed laborum Archite', 'dedific@mailinator.com', 'Sint qui aut sint et', '37.8304402', '38.5743173', '2021-05-29 18:07:21', '2021-05-29 18:07:21'),
(19, 'Batman Havalimanı', 'Nobis mollitia aliqu', 'quwaqu@mailinator.com', 'Sit accusamus ipsam', '37.8304402', '38.5743173', '2021-05-29 18:07:28', '2021-05-29 18:07:28'),
(20, 'Bursa Merkez', 'Voluptatem totam ve', 'bepelem@mailinator.com', 'Id rem laboris occae', '37.8304402', '38.5743173', '2021-05-29 18:07:36', '2021-05-29 18:07:36'),
(21, 'Çorum Merkez', 'Laborum et nostrud n', 'hicic@mailinator.com', 'Cupiditate saepe mag', '37.8304402', '38.5743173', '2021-05-29 18:07:43', '2021-05-29 18:07:43'),
(22, 'Denizli Havalimanı', 'Dolor velit est fugi', 'nagudacaba@mailinator.com', 'Aut eiusmod aut cons', '37.8304402', '38.5743173', '2021-05-29 18:08:28', '2021-05-29 18:08:28'),
(23, 'Denizli Merkez', 'Laborum Autem nulla', 'mizexaj@mailinator.com', 'Esse consectetur qu', '37.8304402', '38.5743173', '2021-05-29 18:08:36', '2021-05-29 18:08:36'),
(24, 'Diyarbakır Havalimanı', 'Elit dolor ut dolor', 'kopodu@mailinator.com', 'Sed aliquip et nihil', '37.8304402', '38.5743173', '2021-05-29 18:08:43', '2021-05-29 18:08:43'),
(25, 'Diyarbakır Merkez', 'Nostrud elit sunt a', 'gowonam@mailinator.com', 'Aut illum pariatur', '37.8304402', '38.5743173', '2021-05-29 18:08:51', '2021-05-29 18:08:51'),
(26, 'Elazığ Havalimanı', 'Do quia nemo magnam', 'rijovisuza@mailinator.com', 'Assumenda quia ipsa', '37.8304402', '38.5743173', '2021-05-29 18:08:58', '2021-05-29 18:08:58'),
(27, 'Elazığ Merkez', 'Eum distinctio Quae', 'daboqu@mailinator.com', 'Eos dolor deserunt', '37.8304402', '38.5743173', '2021-05-29 18:09:05', '2021-05-29 18:09:05'),
(28, 'Erzincan Merkez', 'Animi distinctio N', 'mujepoxow@mailinator.com', 'A dolore quia deleni', '37.8304402', '38.5743173', '2021-05-29 18:09:19', '2021-05-29 18:09:19'),
(29, 'Erzurum Havalimanı', 'Voluptates quo ut et', 'porahyqa@mailinator.com', 'Ut enim labore saepe', '37.8304402', '38.5743173', '2021-05-29 18:09:26', '2021-05-29 18:09:26'),
(30, 'Erzurum Merkez', 'Autem perspiciatis', 'cinu@mailinator.com', 'Sed excepturi volupt', '37.8304402', '38.5743173', '2021-05-29 18:09:35', '2021-05-29 18:09:35'),
(31, 'Eskişehir Havalimanı', 'Vel iure magnam ad q', 'juhadatyx@mailinator.com', 'Tempore pariatur E', '37.8304402', '38.5743173', '2021-05-29 18:09:42', '2021-05-29 18:09:42'),
(32, 'Eskişehir Merkez', 'Pariatur Tenetur pr', 'qysoxor@mailinator.com', 'Est pariatur Odio', '37.8304402', '38.5743173', '2021-05-29 18:09:48', '2021-05-29 18:09:48'),
(33, 'Gaziantep Dış Hatlar', 'Ipsa duis vel ipsum', 'jeduhuluma@mailinator.com', 'Soluta corrupti aut', '37.8304402', '38.5743173', '2021-05-29 18:10:01', '2021-05-29 18:10:01'),
(34, 'Gaziantep İç Hatlar', 'Amet laudantium il', 'litafeh@mailinator.com', 'Officia dolorum perf', '37.8304402', '38.5743173', '2021-05-29 18:10:09', '2021-05-29 18:10:09'),
(35, 'Hatay Havalimanı', 'Aute amet voluptas', 'jybo@mailinator.com', 'Beatae incididunt ut', '37.8304402', '38.5743173', '2021-05-29 18:10:15', '2021-05-29 18:10:15'),
(36, 'Hatay, İskenderun Merkez', 'Modi dolore eius vel', 'tyfiku@mailinator.com', 'Dolor mollit repudia', '37.8304402', '38.5743173', '2021-05-29 18:10:26', '2021-05-29 18:10:26'),
(37, 'İstanbul Acıbadem', 'Dolorem aliquid eius', 'tyqinele@mailinator.com', 'Aut sint quibusdam', '37.8304402', '38.5743173', '2021-05-29 18:10:38', '2021-05-29 18:10:38'),
(38, 'İstanbul Ataşehir', 'Ut atque ipsa autem', 'sexofuse@mailinator.com', 'Ea sed labore libero', '37.8304402', '38.5743173', '2021-05-29 18:10:49', '2021-05-29 18:10:49'),
(39, 'İstanbul Beylikdüzü', 'Nihil reiciendis sol', 'zygego@mailinator.com', 'Quia ut facilis dign', '37.8304402', '38.5743173', '2021-05-29 18:10:57', '2021-05-29 18:10:57'),
(40, 'İstanbul Kadıköy', 'Animi ut saepe magn', 'qice@mailinator.com', 'A soluta molestiae i', '37.8304402', '38.5743173', '2021-05-29 18:11:08', '2021-05-29 18:11:08'),
(41, 'İstanbul Maltepe', 'Fugit sed odio ex f', 'pelemaravy@mailinator.com', 'Cupidatat ipsum cons', '37.8304402', '38.5743173', '2021-05-29 18:11:19', '2021-05-29 18:11:19'),
(42, 'İstanbul Maslak', 'Temporibus dolor ips', 'pibe@mailinator.com', 'Quae dolores officia', '37.8304402', '38.5743173', '2021-05-29 18:26:55', '2021-05-29 18:26:55'),
(43, 'İstanbul Taksim', 'Dolore voluptatem s', 'raxewik@mailinator.com', 'Non Nam officia comm', '37.8304402', '38.5743173', '2021-05-29 18:27:04', '2021-05-29 18:27:04'),
(44, 'İstanbul Ümraniye', 'Odio illo maxime qua', 'xuqycaqu@mailinator.com', 'Modi est magni Nam q', '37.8304402', '38.5743173', '2021-05-29 18:27:12', '2021-05-29 18:27:12'),
(45, 'Kahramanmaraş Merkez', 'Aut consectetur vit', 'vysydipyci@mailinator.com', 'Dolor sint perferend', '37.8304402', '38.5743173', '2021-05-29 18:27:25', '2021-05-29 18:27:25'),
(46, 'Kayseri Merkez', 'Temporibus sit nece', 'fawywojim@mailinator.com', 'Fugiat iusto sit do', '37.8304402', '38.5743173', '2021-05-29 18:27:33', '2021-05-29 18:27:33'),
(47, 'Konya Merkez', 'Qui atque temporibus', 'vexasole@mailinator.com', 'Cumque voluptas ut m', '37.8304402', '38.5743173', '2021-05-29 18:27:44', '2021-05-29 18:27:44'),
(48, 'Kütahya Merkez', 'Sequi ut aut molesti', 'pefinocy@mailinator.com', 'Duis laboriosam bea', '37.8304402', '38.5743173', '2021-05-29 18:27:53', '2021-05-29 18:27:53'),
(49, 'Malatya Havalimanı', 'Amet perferendis ea', 'rimynuvi@mailinator.com', 'Quas a ullam dolores', '37.8304402', '38.5743173', '2021-05-29 18:28:00', '2021-05-29 18:28:00'),
(50, 'Malatya Merkez', 'Sapiente impedit qu', 'jozit@mailinator.com', 'Rerum tempore delen', '37.8304402', '38.5743173', '2021-05-29 18:28:12', '2021-05-29 18:28:12'),
(51, 'Muğla Merkez', 'Sapiente voluptatem', 'nodujonyge@mailinator.com', 'Dolorem mollitia aut', '37.8304402', '38.5743173', '2021-05-29 18:28:40', '2021-05-29 18:28:40'),
(52, 'Muş Merkez', 'Voluptatem rerum ips', 'woqupu@mailinator.com', 'Autem sed sunt facil', '37.8304402', '38.5743173', '2021-05-29 18:28:46', '2021-05-29 18:28:46'),
(53, 'Nevşehir Ürgüp', 'Unde quis tenetur ex', 'cijerato@mailinator.com', 'Qui ea dolorem minim', '37.8304402', '38.5743173', '2021-05-29 18:28:59', '2021-05-29 18:28:59'),
(54, 'Sakarya Merkez', 'Consequatur quidem', 'lobaroc@mailinator.com', 'Cillum dolor rerum s', '37.8304402', '38.5743173', '2021-05-29 18:29:05', '2021-05-29 18:29:05'),
(55, 'Samsun Merkez', 'Recusandae Quia opt', 'vicakigece@mailinator.com', 'Vitae ipsam hic dele', '37.8304402', '38.5743173', '2021-05-29 18:29:14', '2021-05-29 18:29:14'),
(56, 'Şanlıurfa Merkez', 'Optio eos ea odio', 'zebinamuni@mailinator.com', 'Animi animi volupt', '37.8304402', '38.5743173', '2021-05-29 18:29:21', '2021-05-29 18:29:21'),
(57, 'Sinop Merkez', 'Ea ullamco nobis rep', 'wajonimivu@mailinator.com', 'Aut dolores non repr', '37.8304402', '38.5743173', '2021-05-29 18:29:31', '2021-05-29 18:29:31'),
(58, 'Sivas Merkez', 'Aut aspernatur eos', 'piqopu@mailinator.com', 'Reprehenderit perfe', '37.8304402', '38.5743173', '2021-05-29 18:29:43', '2021-05-29 18:29:43'),
(59, 'Trabzon Merkez', 'Anim nostrud sit qu', 'xoqaqerit@mailinator.com', 'Quia temporibus volu', '37.8304402', '38.5743173', '2021-05-29 18:29:50', '2021-05-29 18:29:50'),
(60, 'Van Merkez', 'Dolor pariatur Nisi', 'hogyzi@mailinator.com', 'Consequatur voluptat', '37.8304402', '38.5743173', '2021-05-29 18:29:58', '2021-05-30 17:16:36'),
(61, 'Yalova Merkez', 'Explicabo Et molest', 'sunijakuhe@mailinator.com', 'Labore ratione nemo', '37.8304402', '38.5743173', '2021-05-29 18:30:06', '2021-05-30 17:06:30'),
(64, 'Zonguldak Merkez', 'ads dasf', 'dabyquh@mailinator.com', '425342', '43', '24', '2021-06-04 21:16:43', '2021-06-04 21:17:09');

--
-- Tetikleyiciler `offices`
--
DELIMITER $$
CREATE TRIGGER `offices_delete` AFTER DELETE ON `offices` FOR EACH ROW INSERT INTO logs VALUES( null, 'Office', old.id, 'Deleted data', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `offices_insert` AFTER INSERT ON `offices` FOR EACH ROW INSERT INTO logs VALUES(null,'Office', new.id,'Inserted data',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `offices_update` AFTER UPDATE ON `offices` FOR EACH ROW INSERT INTO logs VALUES( null, 'Offices', new.id, 'Updated data', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `office_personnel`
--

CREATE TABLE `office_personnel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED DEFAULT NULL,
  `personnel_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `office_personnel`
--

INSERT INTO `office_personnel` (`id`, `office_id`, `personnel_id`, `created_at`, `updated_at`) VALUES
(1, 9, 7, NULL, NULL),
(2, 14, 7, NULL, NULL),
(3, 21, 7, NULL, NULL),
(7, 1, 3, NULL, NULL),
(8, 2, 3, NULL, NULL),
(9, 3, 3, NULL, NULL),
(19, 2, 8, NULL, NULL),
(20, 4, 8, NULL, NULL),
(21, 9, 26, NULL, NULL),
(22, 12, 26, NULL, NULL),
(23, 13, 26, NULL, NULL),
(24, 18, 26, NULL, NULL),
(25, 20, 26, NULL, NULL),
(26, 27, 26, NULL, NULL),
(27, 28, 26, NULL, NULL),
(28, 30, 26, NULL, NULL),
(29, 31, 26, NULL, NULL),
(30, 33, 26, NULL, NULL),
(31, 35, 26, NULL, NULL),
(32, 37, 26, NULL, NULL),
(33, 42, 26, NULL, NULL),
(34, 48, 26, NULL, NULL),
(35, 50, 26, NULL, NULL),
(37, 53, 26, NULL, NULL),
(38, 54, 26, NULL, NULL),
(39, 57, 26, NULL, NULL),
(40, 59, 26, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `office_vehicle`
--

CREATE TABLE `office_vehicle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deposit` decimal(8,2) UNSIGNED DEFAULT NULL,
  `cost` decimal(8,2) UNSIGNED DEFAULT NULL,
  `qty` smallint(6) UNSIGNED DEFAULT 0,
  `active` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `office_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vehicle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `office_vehicle`
--

INSERT INTO `office_vehicle` (`id`, `deposit`, `cost`, `qty`, `active`, `office_id`, `vehicle_id`, `created_at`, `updated_at`) VALUES
(51, '0.01', NULL, 0, '1', 59, 26, NULL, NULL),
(52, NULL, NULL, 0, '1', 59, 27, NULL, NULL),
(53, '0.01', NULL, 0, '1', 59, 28, NULL, NULL),
(54, NULL, NULL, 0, '1', 59, 29, NULL, NULL),
(55, NULL, NULL, 0, '1', 59, 31, NULL, NULL),
(106, '13.00', '6.00', 0, '1', 60, 26, NULL, NULL),
(107, '68.00', '19.00', 0, '1', 60, 27, NULL, NULL),
(108, '91.00', '52.00', 0, '1', 60, 28, NULL, NULL),
(109, '77.00', '7.02', 0, '1', 60, 29, NULL, NULL),
(110, '40.00', '77.03', 0, '0', 60, 31, NULL, NULL),
(181, '91.00', '100.00', 2, '1', 1, 26, NULL, NULL),
(182, '80.00', '110.00', 1, '1', 1, 27, NULL, NULL),
(183, '24.00', '120.00', 1, '1', 1, 28, NULL, NULL),
(184, '28.00', '200.00', 1, '1', 1, 29, NULL, NULL),
(185, '96.00', '210.00', 1, '1', 1, 31, NULL, NULL),
(191, '178.00', '1650.00', 3, '1', 61, 26, NULL, NULL),
(192, '195.00', '1510.00', 0, '1', 61, 27, NULL, NULL),
(193, '119.00', '1260.00', 0, '1', 61, 28, NULL, NULL),
(194, '184.00', '1130.00', 0, '1', 61, 29, NULL, NULL),
(195, '185.00', '1240.00', 0, '1', 61, 31, NULL, NULL),
(201, NULL, NULL, 5, '1', 58, 26, NULL, NULL),
(202, NULL, NULL, 1, '1', 58, 27, NULL, NULL),
(203, NULL, NULL, 3, '1', 58, 28, NULL, NULL),
(204, NULL, NULL, NULL, '0', 58, 29, NULL, NULL),
(205, NULL, NULL, NULL, '0', 58, 31, NULL, NULL),
(216, '100.00', '200.00', 1, '0', 64, 26, NULL, NULL),
(217, '100.00', '200.00', 1, '1', 64, 27, NULL, NULL),
(218, '100.00', '200.00', 2, '1', 64, 28, NULL, NULL),
(219, '100.00', '200.00', 1, '0', 64, 29, NULL, NULL),
(220, '100.00', '200.00', 2, '1', 64, 31, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trackNumber` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `personnel_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vehicle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pick_up_office_id` bigint(20) UNSIGNED DEFAULT NULL,
  `drop_off_office_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reservation_pick_up_datetime` timestamp NULL DEFAULT NULL,
  `reservation_drop_off_datetime` timestamp NULL DEFAULT NULL,
  `days` tinyint(3) UNSIGNED DEFAULT NULL,
  `deposit` decimal(8,2) UNSIGNED DEFAULT 0.00,
  `cost` decimal(8,2) UNSIGNED DEFAULT 0.00,
  `total` decimal(8,2) UNSIGNED DEFAULT 0.00,
  `toPay` decimal(8,2) DEFAULT 0.00,
  `pick_up_datetime` timestamp NULL DEFAULT NULL,
  `drop_off_datetime` timestamp NULL DEFAULT NULL,
  `canceled_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` bit(1) DEFAULT b'0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `reservations`
--

INSERT INTO `reservations` (`id`, `trackNumber`, `client_id`, `personnel_id`, `vehicle_id`, `pick_up_office_id`, `drop_off_office_id`, `reservation_pick_up_datetime`, `reservation_drop_off_datetime`, `days`, `deposit`, `cost`, `total`, `toPay`, `pick_up_datetime`, `drop_off_datetime`, `canceled_at`, `status`, `seen`, `created_at`, `updated_at`) VALUES
(20, '60BAC96D25F4C', 3, NULL, 27, 64, NULL, '2021-06-17 20:59:00', '2021-06-20 21:00:00', 3, NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, 'pending', b'1', '2021-06-04 21:46:37', '2021-06-04 21:50:08'),
(21, '60BAC99B9586C', 3, NULL, 27, 64, NULL, '2021-06-17 20:59:00', '2021-06-20 21:00:00', 3, '100.00', '200.00', '708.00', '808.00', NULL, NULL, '2021-06-04 21:50:19', 'canceled', b'1', '2021-06-04 21:47:23', '2021-06-04 21:50:19');

--
-- Tetikleyiciler `reservations`
--
DELIMITER $$
CREATE TRIGGER `reservations_delete` AFTER DELETE ON `reservations` FOR EACH ROW INSERT INTO logs VALUES( null, 'Reservation', old.id, 'Deleted data', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `reservations_insert` AFTER INSERT ON `reservations` FOR EACH ROW INSERT INTO logs VALUES(null,'Reservation',new.id,'Inserted data',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `reservations_update` AFTER UPDATE ON `reservations` FOR EACH ROW INSERT INTO logs VALUES( null, 'Reservation', new.id, 'Updated data', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `panelLogin` bit(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`id`, `name`, `panelLogin`, `created_at`, `updated_at`) VALUES
(1, 'admin', b'1', '2021-05-25 06:58:15', '2021-05-26 11:11:53'),
(2, 'client', b'0', '2021-05-25 07:20:24', '2021-05-26 11:12:32'),
(6, 'staff', b'1', '2021-05-30 14:30:17', '2021-05-30 14:30:17');

--
-- Tetikleyiciler `roles`
--
DELIMITER $$
CREATE TRIGGER `roles_delete` AFTER DELETE ON `roles` FOR EACH ROW INSERT INTO logs VALUES( null, 'Role', old.id, 'Deleted data', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `roles_insert` AFTER INSERT ON `roles` FOR EACH ROW INSERT INTO logs VALUES(null,'Role',new.id,'Inserted data',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `roles_update` AFTER UPDATE ON `roles` FOR EACH ROW INSERT INTO logs VALUES( null, 'Role', new.id, 'Updated data', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tcPassportNo` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `tcPassportNo`, `tel`, `email`, `address`, `email_verified_at`, `password`, `remember_token`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 'Lance Sanchez', '23452345', '5051078955', 'zeynelabidinozkale@gmail.com', 'gfh dhfghd', NULL, '$2y$10$VpBE12Raxbr0eVkgD8ZX5.iP7qSRciKMwNCrFTgLrJ6UnrO/GRnH6', 'YZH6KgBXWtWWMZJj3cRBkPDK6mxqxnypSznkghpTKoG1ynwmT7tnZRo4SN43', 1, '2021-05-25 04:07:06', '2021-06-04 20:04:10'),
(4, 'Alice Gates', '2435435', '124234423', 'zeynel@morza.com.tr', 'adsf adsfa sfda f', NULL, '$2y$10$z3f/tvXmnfY7Plyu.TwgAeERU4.tjSQx23SuED9yLXyj7iCVp/tCq', 'VpfxBVrdrRx1cPQJRQ5qWN0svoXBnPAk1ujf6rxXd0dHqPgfps46glrLoXNh', 2, '2021-05-26 06:03:06', '2021-06-03 20:06:26'),
(6, 'Lael Blackwell', NULL, '1', 'vabijazu@mailinator.com', 'kjh lkjblkn', NULL, '$2y$10$hbF3cINsJ/gajlf60mqOwu5yiUW1xhI.59pVs6wiOZlV.Tjlfyova', NULL, 1, '2021-05-26 12:09:52', '2021-06-03 20:12:54'),
(7, 'Alvin Carver', NULL, 'panoz@mailinator.com', 'vejimufyjy@mailinator.com', NULL, NULL, '$2y$10$9qs0OpJEOToDVFY5eH97c.iZtUMgltpHSblganOQ4csiYCLFMozLS', NULL, 6, '2021-05-30 14:22:09', '2021-05-30 14:31:00'),
(8, 'Colorado Clemons', '342534324', 'adsfdasff', 'morzadev2@gmail.com', 'dsaf adsf asdfa sdf', NULL, '$2y$10$UqJDR9tlpUJ5R79a9uZQhemXVZ3pKCkD81grV8/pU1xLzL.SXGpAO', 'OEAysCF0j84Qjf5kLMnUZYaYumTHKedcTe72Ses1UJKWiaKX5lPvnv4gMHEU', 6, '2021-05-30 14:31:31', '2021-06-04 21:17:55'),
(10, 'Bree Beard', NULL, NULL, 'wakujeduk@mailinator.com', NULL, NULL, '$2y$10$awXSQKW7NVbwcM6A0YkZ4.p46PUz/swmCjs8nPToXrA.M/TsUW7xW', NULL, NULL, '2021-06-01 09:26:54', '2021-06-01 09:26:54'),
(11, 'Raja Wong', NULL, NULL, 'vygarod@mailinator.com', NULL, NULL, '$2y$10$l5oqHyhOZp2VHEtjGwDlReTxb0h4fFslD6LJJRrcD7afQn5MIacz.', NULL, NULL, '2021-06-01 09:27:21', '2021-06-01 09:27:21'),
(12, 'Tanya Horton', NULL, NULL, 'hopy@mailinator.com', NULL, NULL, '$2y$10$ZFMbYaVEKahrOSTUbCnot./pr8WA2W.PHDakXrl9o2yaXqfcWlAeC', NULL, NULL, '2021-06-01 09:28:36', '2021-06-01 09:28:36'),
(13, 'Rylee Dickson', NULL, NULL, 'ceho@mailinator.com', NULL, NULL, '$2y$10$ImLjjYcR6Jx9AYkQoVB1K.ptM1UORGqOfyiCFfoSqpnzeCTAmphmG', NULL, NULL, '2021-06-01 09:29:17', '2021-06-01 09:29:17'),
(18, 'nypedyhate', '23423', '2342432', 'devegabis1@gmail.com', 'Quasi est aut sapien', NULL, '$2y$10$3Zq8PD8FRYWsy9svGo/gs.MP25WUWF8zstx/3/0HZk/hXLiSv6iA.', NULL, 2, '2021-06-02 20:21:06', '2021-06-02 20:21:06'),
(19, 'lefocajucu', '324234', '12343242', 'morzadev1@gmail.com', 'Voluptatibus qui aut', NULL, '$2y$10$pOymZXkl2mtiW/UJre3O7uf1qBGsA.57DUUhIPIHUDvYALlSmOuKu', NULL, 2, '2021-06-02 20:55:13', '2021-06-02 20:55:13'),
(20, 'qotasis', '17', 'Molestiae nesciunt', 'jaracal@mailinator.com', 'Tempor nihil sed imp', NULL, '$2y$10$oFt8MSq/RBwQ0zgURFacO.pMD7pEgRP354sF7QlmcWKul9rjV4XNe', NULL, 2, '2021-06-03 15:56:43', '2021-06-03 15:56:43'),
(21, 'Walker Harrington', NULL, NULL, 'bylydizeq@mailinator.com', NULL, NULL, '$2y$10$6fP/C4UuArJoHYmv/XmdU.ydis/1pW0Pigb7vgTX2T4sokTz.vHJi', NULL, 2, '2021-06-03 20:27:44', '2021-06-03 20:27:44'),
(22, 'Eaton Garrett', '669435', '2345345', 'wugor@mailinator.com', 'Explicabo Dolores q', NULL, '$2y$10$l8nomMhRIZCVOV5iv05Bk.kQqTUJ20J82.GiR/mh7aDDmiGeXA.Gq', NULL, 2, '2021-06-03 20:32:47', '2021-06-03 20:32:47'),
(23, 'kopaz', '96', '452353', 'pidyxuvi@mailinator.com', 'Debitis neque dolor', NULL, '$2y$10$L5wpEyxJ0MqPLzkx63MOmurd1SR8rkKlpMwFDOciponT2ZYXs3Bta', NULL, 2, '2021-06-04 16:21:54', '2021-06-04 16:21:54'),
(24, 'wacyfuxaj', '40', '2345', 'fozudor@mailinator.com', 'Minima laboriosam l', NULL, '$2y$10$cQphqCreqRZi4AgL7mW6KOFpFidWG35pbrddzzrJDZBcyt3jvJSKu', NULL, 2, '2021-06-04 16:23:43', '2021-06-04 16:23:43'),
(26, 'Myles Downs', '93', '+1 (539) 324-4508', 'cuzudygewa@mailinator.com', 'Iure iure rerum null', NULL, '$2y$10$xUMCJiP/6a2LDU7qd/D4Q.fs76kgizXQXg8R5RSreccX8iucZfOIK', NULL, 1, '2021-06-04 21:52:56', '2021-06-04 21:53:14');

--
-- Tetikleyiciler `users`
--
DELIMITER $$
CREATE TRIGGER `users_delete` AFTER DELETE ON `users` FOR EACH ROW INSERT INTO logs VALUES( null, 'User', old.id, 'Deleted data', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `users_insert` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO logs VALUES(null,'User',new.id,'Inserted data',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `users_update` AFTER UPDATE ON `users` FOR EACH ROW INSERT INTO logs VALUES( null, 'User', new.id, 'Updated data', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vclasses`
--

CREATE TABLE `vclasses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `vclasses`
--

INSERT INTO `vclasses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Caravan', '2021-05-29 10:53:54', '2021-05-29 10:53:54'),
(2, 'Luxury', '2021-05-29 10:53:58', '2021-05-29 10:53:58'),
(3, 'Top', '2021-05-29 10:54:02', '2021-05-29 10:54:02'),
(4, 'Minibus', '2021-05-29 10:54:06', '2021-05-29 10:54:06'),
(5, 'Suv', '2021-05-29 10:54:11', '2021-05-29 10:54:11'),
(6, 'Middle', '2021-05-29 10:54:16', '2021-05-29 10:54:16'),
(7, 'Economy', '2021-05-29 10:54:20', '2021-05-29 10:54:20');

--
-- Tetikleyiciler `vclasses`
--
DELIMITER $$
CREATE TRIGGER `vclasses_delete` AFTER DELETE ON `vclasses` FOR EACH ROW INSERT INTO logs VALUES( null, 'Vclass', old.id, 'Deleted data', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `vclasses_insert` AFTER INSERT ON `vclasses` FOR EACH ROW INSERT INTO logs VALUES(null,'Vclass',new.id,'Inserted data',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `vclasses_update` AFTER UPDATE ON `vclasses` FOR EACH ROW INSERT INTO logs VALUES( null, 'Vclass', new.id, 'Updated data', NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seats` tinyint(3) UNSIGNED DEFAULT NULL,
  `bags` tinyint(3) UNSIGNED DEFAULT NULL,
  `doors` tinyint(3) UNSIGNED DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vclass_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fueltype_id` bigint(20) UNSIGNED DEFAULT NULL,
  `geartype_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `image`, `seats`, `bags`, `doors`, `notes`, `vclass_id`, `fueltype_id`, `geartype_id`, `created_at`, `updated_at`) VALUES
(26, 'Hiram Oneil', 'vehicles/img/ak6wi9fcC15OkEqEYv7KKU96QMExr4Ar1klCz5QQ.jpg', 93, 15, 5, 'Exercitation rerum s', 7, NULL, 4, '2021-05-30 16:35:13', '2021-05-31 21:57:52'),
(27, 'Victoria Hood', 'vehicles/img/jpP3UM8sc8lvCV8owIKmGa07vXMRGsHoZ0eciQqh.jpg', 61, 4, 12, 'Culpa irure iure con', 4, NULL, 4, '2021-05-30 16:35:21', '2021-05-31 21:57:47'),
(28, 'Amy Mendoza', 'vehicles/img/sxXkxwyWiODZ1PGUztiXl0A629JtL9unptMpHr4R.jpg', 95, 72, 99, 'Et officia et offici', 2, 6, 5, '2021-05-30 16:35:28', '2021-06-04 21:06:39'),
(29, 'Cynthia Ewing', 'vehicles/img/movNdSo2gOhUMhMtLNfel6T7JIHpU0PbHYpX8ypQ.jpg', 29, 82, 96, 'Quisquam vero at lab', 6, NULL, 5, '2021-05-30 16:39:46', '2021-05-31 21:57:38'),
(31, 'Flynn Deleon', NULL, 73, 1, 45, 'Alias quis cillum es', 5, 4, 5, '2021-05-30 16:44:57', '2021-06-04 21:06:45');

--
-- Tetikleyiciler `vehicles`
--
DELIMITER $$
CREATE TRIGGER `vehicles_delete` AFTER DELETE ON `vehicles` FOR EACH ROW INSERT INTO logs VALUES( null, 'Vehicle', old.id, 'Deleted data', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `vehicles_insert` AFTER INSERT ON `vehicles` FOR EACH ROW INSERT INTO logs VALUES(null,'Vehicle',new.id,'Inserted data',NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `vehicles_update` AFTER UPDATE ON `vehicles` FOR EACH ROW INSERT INTO logs VALUES( null, 'Vehicle', new.id, 'Updated data', NOW())
$$
DELIMITER ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `billing_information`
--
ALTER TABLE `billing_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_billing_information` (`reservation_id`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Tablo için indeksler `fueltypes`
--
ALTER TABLE `fueltypes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `geartypes`
--
ALTER TABLE `geartypes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `office_personnel`
--
ALTER TABLE `office_personnel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personnel_office_personnel` (`personnel_id`),
  ADD KEY `office_office_personnel` (`office_id`);

--
-- Tablo için indeksler `office_vehicle`
--
ALTER TABLE `office_vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_office_vehicle` (`office_id`),
  ADD KEY `vehicle_office_vehicle` (`vehicle_id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_pickUpOffice` (`pick_up_office_id`),
  ADD KEY `reservation_dropOffOffice` (`drop_off_office_id`),
  ADD KEY `reservation_vehicle` (`vehicle_id`),
  ADD KEY `reservation_client` (`client_id`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `user_role` (`role_id`);

--
-- Tablo için indeksler `vclasses`
--
ALTER TABLE `vclasses`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_vclass` (`vclass_id`),
  ADD KEY `vehicle_geartype` (`geartype_id`),
  ADD KEY `vehicle_fueltype` (`fueltype_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `billing_information`
--
ALTER TABLE `billing_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `fueltypes`
--
ALTER TABLE `fueltypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `geartypes`
--
ALTER TABLE `geartypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `offices`
--
ALTER TABLE `offices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Tablo için AUTO_INCREMENT değeri `office_personnel`
--
ALTER TABLE `office_personnel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Tablo için AUTO_INCREMENT değeri `office_vehicle`
--
ALTER TABLE `office_vehicle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- Tablo için AUTO_INCREMENT değeri `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `vclasses`
--
ALTER TABLE `vclasses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `billing_information`
--
ALTER TABLE `billing_information`
  ADD CONSTRAINT `reservation_billing_information` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `office_personnel`
--
ALTER TABLE `office_personnel`
  ADD CONSTRAINT `office_office_personnel` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personnel_office_personnel` FOREIGN KEY (`personnel_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `office_vehicle`
--
ALTER TABLE `office_vehicle`
  ADD CONSTRAINT `office_office_vehicle` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicle_office_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservation_client` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservation_dropOffOffice` FOREIGN KEY (`drop_off_office_id`) REFERENCES `offices` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservation_pickUpOffice` FOREIGN KEY (`pick_up_office_id`) REFERENCES `offices` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservation_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicle_fueltype` FOREIGN KEY (`fueltype_id`) REFERENCES `fueltypes` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `vehicle_geartype` FOREIGN KEY (`geartype_id`) REFERENCES `geartypes` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `vehicle_vclass` FOREIGN KEY (`vclass_id`) REFERENCES `vclasses` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
