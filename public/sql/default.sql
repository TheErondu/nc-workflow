-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 20, 2021 at 01:32 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brave_spark`
--

-- --------------------------------------------------------

--
-- Table structure for table `analyses`
--

DROP TABLE IF EXISTS `analyses`;
CREATE TABLE IF NOT EXISTS `analyses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

DROP TABLE IF EXISTS `awards`;
CREATE TABLE IF NOT EXISTS `awards` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `showing_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commendation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `type`, `show_title`, `showing_time`, `show_location`, `photo`, `name`, `description`, `picture`, `fullname1`, `fullname2`, `image1`, `image2`, `commendation`, `created_at`, `updated_at`) VALUES
(8, 'show', 'News@9', '9pm', 'studio 2', 'ewBaO6sR3CidxBknhxD53PObXfosy8UoNJSNMsy3.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-30 09:02:53', '2021-08-30 09:02:53'),
(10, 'award', NULL, NULL, NULL, NULL, 'Erondu Emmanuel', 'System Administrator', 'yiHutsKuPayFK2dfc16zKuuenKPnAwvIezYJ9VPg.jpg', NULL, NULL, NULL, NULL, NULL, '2021-08-30 10:14:03', '2021-08-30 10:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE IF NOT EXISTS `contents` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_lead` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` date NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distribution_platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `title`, `start`, `end`, `genre`, `team_lead`, `delivery_date`, `country`, `location`, `status`, `distribution_platform`, `project_brief`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'Business Edge', '2021-09-07', '2021-09-07', 'Features', 'Mike', '2021-09-08', 'NG', 'Lagos, Nigeria', 'ok', 'dstv', 'test', 1, '2021-09-07 12:11:54', '2021-09-07 14:15:48'),
(4, 'UHURU', '2021-09-09', '2021-09-09', 'Features', 'OCHIENG', '2021-10-19', 'KE', 'Mombasa', 'Ongoing', 'KWESE', 'Empowerment of the Youth In Kenya', 1, '2021-09-07 12:26:33', '2021-09-07 14:02:33'),
(8, 'LASONGA', '2021-10-13', '2021-10-14', 'Features', 'OCHIENG', '2021-10-19', 'SA', 'JOHANESBURG', 'Ongoing', 'DSTV', 'Empowerment of the Youth In Kenya', 1, '2021-09-07 12:29:40', '2021-09-07 12:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'TECHNICAL', NULL, NULL),
(3, 'PRODUCTION', NULL, NULL),
(4, 'PROGRAMMING', NULL, NULL),
(5, 'LEGAL', NULL, NULL),
(6, 'FINANCE', NULL, NULL),
(7, 'HUMAN RESOURCES', NULL, NULL),
(8, 'Administration', NULL, NULL),
(9, 'MARKETING', NULL, NULL),
(10, 'OFFICE OF THE CEO', NULL, NULL),
(11, 'DRIVERS', NULL, NULL),
(12, 'SECURITY', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `document_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `download_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dutyloggers`
--

DROP TABLE IF EXISTS `dutyloggers`;
CREATE TABLE IF NOT EXISTS `dutyloggers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `editor_logs`
--

DROP TABLE IF EXISTS `editor_logs`;
CREATE TABLE IF NOT EXISTS `editor_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_interval` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_interval` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_interval` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `closed_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `editor_logs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `editor_logs`
--

INSERT INTO `editor_logs` (`id`, `user_id`, `first_interval`, `second_interval`, `third_interval`, `closed_at`, `created_at`, `updated_at`) VALUES
(1, 1, '08-GUINEA POLITICAL PRISONERS FREED-VIDEO-rwangui-1018\r\n08-DROUGHT WORSENING IN TANA RIVER-VIDEO-kmutai-0942\r\n08-HEALTH UNIONISTS ON VACCIANTION EXERCISE-VIDEO-jmakori-0949\r\n08-RC NATEMBEYA SOUND BITE-VIDEO-schazima-1248\r\n08-WAJIR GOVERNOR STANDOFF - COUNTY HQ BLOCKED - ELMOGE-VIDEO-schazima-1251\r\n08-WAIGURU ON POLITICAL FUTURE-VIDEO-kmurithi-1312', '08-7PM KONA YA AFYA - YOGA-VIDEO-nabdulaziz-0928\r\n08-7PM ORIE ROGO MANDULI DEAD -VIDEO-lmohammed-1746\r\n08-7PM UHURU DECLARES DROUGHT NATIONAL DISASTER-VIDEO-rwangui-18\r\n08-7PM SCHOOL UNREST-VIDEO-rsarmwei-1654', '08-ORIE ROGO MANDULI IS DEAD-VIDEO-lmohammed-1801\r\n08-TROUBLED HISTORY-VIDEO-haura-1429\r\n08-JUBILEE AND RUTO OPTIONS-VIDEO-kmurithi-1009\r\n08-SCHOOL UNREST-VIDEO-rsarmwei-1354\r\n08-DOING BUSINESS REFORMS UPDATE-VIDEO-intern-1655\r\n08-BOLT DRIVER STABS GIRL-VIDEO-skirori-1905\r\n08-WAJIR GOVERNOR DRAMA - ELMOGE-VIDEO-ssendeyo-1827\r\n08-COAL MINNING-VIDEO-haura-1749', '11:50pm', '2021-09-19 16:06:37', '2021-09-19 16:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `engineer_logs`
--

DROP TABLE IF EXISTS `engineer_logs`;
CREATE TABLE IF NOT EXISTS `engineer_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
CREATE TABLE IF NOT EXISTS `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mcr_logs`
--

DROP TABLE IF EXISTS `mcr_logs`;
CREATE TABLE IF NOT EXISTS `mcr_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programmes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `squeezbacks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `traffic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `handed_over_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mcr_logs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `title`, `file`, `filename`, `message`, `type`, `created_at`, `updated_at`) VALUES
(7, 1, 'Reports', 'public/files/tGef5DXc3CPeLLyHmcZUgcrKiQ5dNZP4We9QnI6S.pdf', '80967_1_EMMANUEL_ERONDU (1).pdf', NULL, 'notification', '2021-08-23 00:00:22', '2021-08-23 00:00:22'),
(8, 1, 'IN THE GAME-new', 'public/files/J5HozGT1qwN0NalCKm0UsX8L0h349dRQQ7v9qlQr.pdf', 'News Central TV - Certificate of Broadcast.pdf', NULL, 'notification', '2021-08-23 00:00:40', '2021-08-30 06:15:47'),
(9, 1, 'Photo', 'public/files/NlyWDPJyKEA72LVdPXu6aksJow1iKkchtAywgqKg.jpg', 'caspar cg.jpeg', NULL, 'notification', '2021-08-23 00:20:36', '2021-08-23 00:20:36'),
(10, 1, 'News Central TV', NULL, NULL, '<p>Welocme,</p><p>This is a <b>test</b></p><p><b><font color=\"#000000\" style=\"background-color: rgb(0, 255, 0);\">great</font>!</b></p>', 'message', '2021-08-23 00:37:11', '2021-08-23 00:37:11'),
(11, 1, 'Welcome', NULL, NULL, '<p style=\"font-style: italic;\">Dear Colleagues,</p><p style=\"font-style: italic;\">After 365 days of intense hard work, I am pleased to congratulate everyone for this milestone.</p><p style=\"font-style: italic;\">It is officially a year for many of us, and beyond or to come for others, but the common purpose has been <b>NEWS CENTRAL!</b></p><p style=\"font-style: italic;\">The time we have spent together will never return to us, but we have much more to cheer about - the great comradeship and friendship we have built; a thing that takes purpose and time to do.</p><p style=\"font-style: italic;\">The impact of this comradeship and friendship means that our lives, individually, may never be the same again, most especially in areas where we have impacted each other positively.</p><p style=\"font-style: italic;\">As we look forward to the opening of our 24-hour broadcast operations this morning, I hope that this achievement will represent a token of fulfillment and evidence that our talent has been put to great purpose.</p><p style=\"font-style: italic;\">The task ahead of us is achievable with teamwork. We have shown great resilience as a team and my hope is that we continue to be cohesive.</p><p style=\"font-style: italic;\">Congratulations colleagues! Let’s celebrate our first anniversary as a company. Let’s celebrate one year since we began to nurture this great dream - News Central.</p><p style=\"font-style: italic;\">The reality of it all is upon us now!</p><p style=\"margin-bottom: 0px; font-style: italic;\"><b>Africa. First.</b></p>', 'message', '2021-08-23 00:41:56', '2021-08-23 00:41:56'),
(17, 1, 'NC-WORKFLOW', NULL, NULL, '<h3 style=\"margin-right: 0px; margin-bottom: 1.2rem; margin-left: 0px; line-height: 1.5;\"><br class=\"Apple-interchange-newline\">NC-WORKFLOW is a production system which gives control over inventory, use of assets while optimizing the whole team for maximum output.</h3><p><br style=\"clear: both !important;\"></p><h3 style=\"margin-right: 0px; margin-bottom: 1.2rem; margin-left: 0px; line-height: 1.5;\">Modules:</h3><h3 style=\"margin-right: 0px; margin-bottom: 1.2rem; margin-left: 0px; line-height: 1.5;\">BOOKING MANAGER</h3><p style=\"line-height: inherit; margin-right: 0px; margin-bottom: 1.6rem; margin-left: 0px;\">Provides Studio Bookings, Location Production Bookings, OB Van Bookings, Satellite Bookings, Boardroom Bookings and Transport Bookings all to be made within the program with permissions given to those who require them. The module allows resource planning effectively in terms of personnel and also use of production cars and fuel consumption. This is presented graphically both to the required supervisor on any display.</p><p><br style=\"clear: both !important;\"></p><h3 style=\"margin-right: 0px; margin-bottom: 1.2rem; margin-left: 0px; line-height: 1.5;\">STORE MANAGER</h3><p style=\"line-height: inherit; margin-right: 0px; margin-bottom: 1.6rem; margin-left: 0px;\">Provides the requisition of services and hardware items and the tracking of the same with warning alerts when items are overdue. Consumables Inventory and Stock Taking can all be performed and depreciation values shown for easy accounting.</p><p><br style=\"clear: both !important;\"></p><h3 style=\"margin-right: 0px; margin-bottom: 1.2rem; margin-left: 0px; line-height: 1.5;\">SERVICE MANAGER</h3><p style=\"line-height: inherit; margin-right: 0px; margin-bottom: 1.6rem; margin-left: 0px;\">Provides the electronic raising of support tickets to make the work of the Broadcast and IT Engineers more efficient and also reveal the progress of a support issue. It also creates a database for the station. This helps in ISO certification</p><p><br style=\"clear: both !important;\"></p><h3 style=\"margin-right: 0px; margin-bottom: 1.2rem; margin-left: 0px; line-height: 1.5;\">COMPANY HIGHLIGHTS AND EVENTS DISPLAY</h3><p style=\"line-height: inherit; margin-right: 0px; margin-bottom: 1.6rem; margin-left: 0px;\">Provides Digital Signage to monitors throughout the station to A) Build the Family feeling with Employee of the month, Birthdays, Goof of the week, Show of the week, Company events and B) display Organisation Key Performance Index (KPI) for the number of You Tube stories, Instagram stories, Facebook stories and Breaking News Stories as a target for the year and how well the station is doing as the year progresses. The Broadcast Dashboard displays in the relevant department tasks assigned to different people in that department on a particular day. It is like a public Calendar within the department.</p><p><br style=\"clear: both !important;\"></p><h3 style=\"margin-right: 0px; margin-bottom: 1.2rem; margin-left: 0px; line-height: 1.5;\">REPORT CALENDAR</h3><p style=\"line-height: inherit; margin-right: 0px; margin-bottom: 1.6rem; margin-left: 0px;\">This module provides reports on Shift Rosters and Handovers so the Studio, Production Department, Engineers and IT can all see who is on duty and going to be on duty in the future.</p><p><br style=\"clear: both !important;\"></p><h3 style=\"margin-right: 0px; margin-bottom: 1.2rem; margin-left: 0px; line-height: 1.5;\">CONTENT CALENDAR</h3><p style=\"line-height: inherit; margin-right: 0px; margin-bottom: 1.6rem; margin-left: 0px;\">This Module show all the events of note that are happening with the area the Station covers for the coming year. For example, Independence Days, Marathons, State Visits, International days like Women’s Day, Labour Day or Aids Day. This allows the Production Department to plan in advance productions required for these events.</p><div><br></div>', 'message', '2021-08-26 12:54:35', '2021-08-26 12:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_07_22_115516_create_ticketit_tables', 1),
(4, '2015_07_22_123254_alter_users_table', 1),
(5, '2015_09_29_123456_add_completed_at_column_to_ticketit_table', 1),
(6, '2015_10_08_123457_create_settings_table', 1),
(7, '2016_01_15_002617_add_htmlcontent_to_ticketit_and_comments', 1),
(8, '2016_01_15_040207_enlarge_settings_columns', 1),
(9, '2016_01_15_120557_add_indexes', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2021_08_21_092335_create_messages_table', 2),
(13, '2021_08_21_092353_create_humans_table', 2),
(16, '2021_08_21_092457_create_dutyloggers_table', 2),
(18, '2021_08_21_094453_create_departments_table', 2),
(22, '2021_08_21_095544_create_employees_table', 2),
(23, '2021_08_22_083613_create_permission_tables', 2),
(24, '2021_08_21_092414_create_schedules_table', 3),
(25, '2021_08_26_061207_create_reports_table', 4),
(26, '2021_08_26_061221_create_o_blogs_table', 4),
(27, '2021_08_26_061252_create_analyses_table', 4),
(28, '2021_08_26_143853_create_trip_loggers_table', 4),
(30, '2021_08_21_092353_create_awards_table', 5),
(31, '2021_08_28_154312_modify_schedules_table', 6),
(32, '2021_08_21_094920_create_vehicles_table', 7),
(34, '2021_08_30_114851_modify_users_table', 8),
(35, '2021_09_05_182945_modify_ob_logs_table', 9),
(38, '2021_08_21_092519_create_contents_table', 10),
(42, '2021_09_08_054354_create_mileage_trackings_table', 12),
(43, '2021_09_08_055556_create_trackings_table', 13),
(54, '2021_08_21_094935_create_trackers_table', 14),
(55, '2021_08_21_095356_create_stores_table', 15),
(57, '2021_09_09_102449_create_store_requests_table', 16),
(58, '2021_09_09_164534_create_bookings_table', 17),
(59, '2021_09_09_165032_create_facilities_table', 17),
(62, '2021_09_17_125125_mcrlogs', 18),
(63, '2021_09_17_171416_create_mcr_logs_table', 19),
(64, '2021_09_17_211008_create_production_show_logs_table', 20),
(65, '2021_09_17_214450_create_engineer_logs_table', 21),
(68, '2021_09_18_185326_create_video_editors_reports_table', 22),
(72, '2021_09_17_215008_create_editor_logs_table', 23),
(76, '2021_09_17_215055_create_prompter_logs_table', 24),
(77, '2021_09_20_043506_create_transmission_reports_table', 25),
(79, '2021_08_21_092440_create_documents_table', 26);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o_blogs`
--

DROP TABLE IF EXISTS `o_blogs`;
CREATE TABLE IF NOT EXISTS `o_blogs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(21) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vision_mixer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sound` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engineer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reporter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `digital` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transmission_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `o_blogs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `o_blogs`
--

INSERT INTO `o_blogs` (`id`, `user_id`, `created_at`, `event_name`, `event_date`, `location`, `producer`, `director`, `vision_mixer`, `sound`, `engineer`, `dop`, `reporter`, `digital`, `transmission_time`, `comment`, `updated_at`) VALUES
(1, 1, '2021-09-05 19:12:28', 'NTV on the Sea', '2021-03-08 21:02:14', 'Kenya Maritime Authority', 'Erondu Emmanuel', 'Heather Bradtke MD', 'Oswaldo Lind', 'Esther Roob', 'Sarah Lakin', 'Oswaldo Lind', 'Sarah Lakin', 'Erondu Emmanuel', 'News time from 6th and 7th of March', 'Production was ok, though some equipment needs calibration and repair .', '2021-09-05 19:12:28'),
(2, 1, '2021-09-05 19:15:21', 'NTV on the Sea', '2021-03-08 21:02:14', 'Kenya Maritime Authority', 'Erondu Emmanuel', 'Heather Bradtke MD', 'Oswaldo Lind', 'Esther Roob', 'Sarah Lakin', 'Oswaldo Lind', 'Sarah Lakin', 'Erondu Emmanuel', 'News time from 6th and 7th of March', 'Production was ok, though some equipment needs calibration and repair .', '2021-09-05 19:15:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `production_show_logs`
--

DROP TABLE IF EXISTS `production_show_logs`;
CREATE TABLE IF NOT EXISTS `production_show_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producer1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producer2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vision_mixer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engineer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sound_technician` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `camera_operator1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `camera_operator2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `graphics` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `digital` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transmission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transmission_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `production_show_logs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `production_show_logs`
--

INSERT INTO `production_show_logs` (`id`, `date`, `location`, `producer1`, `producer2`, `director`, `vision_mixer`, `engineer`, `sound_technician`, `camera_operator1`, `camera_operator2`, `host`, `graphics`, `digital`, `transmission`, `transmission_time`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2021-09-18', 'Lagos, Nigeria', 'Erondu Emmanuel', 'Erondu Emmanuel', 'Sarah Lakin', 'Erondu Emmanuel', 'Erondu Emmanuel', 'Sarah Lakin', 'Sarah Lakin', 'Sarah Lakin', 'Esther Roob', 'Esther Roob', 'Heather Bradtke MD', 'Oswaldo Lind', '11:50am', 1, '2021-09-18 15:45:08', '2021-09-18 15:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `prompter_logs`
--

DROP TABLE IF EXISTS `prompter_logs`;
CREATE TABLE IF NOT EXISTS `prompter_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `segment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rundown_in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `script_in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anchor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `graphics` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engineer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `challenges` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prompter_logs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(11) UNSIGNED NOT NULL,
  `bulletin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dts_in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actual_in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variance1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dts_out` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actual_out` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variance2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b2bulletin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b2dts_in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b2actual_in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b2variance1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b2dts_out` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b2actual_out` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b2variance2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b2comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reports_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `bulletin`, `dts_in`, `actual_in`, `variance1`, `dts_out`, `actual_out`, `variance2`, `comment`, `b2bulletin`, `b2dts_in`, `b2actual_in`, `b2variance1`, `b2dts_out`, `b2actual_out`, `b2variance2`, `b2comment`, `created_at`, `updated_at`) VALUES
(1, 1, 'NTV JIONI', '1857', '1857', '00', '1933', '1933', '00', 'Smooth TX All sponsored elements aired as planned', 'WEEKEND EDITION', '2057', '2057', '00', '2200', '2200', '00', 'Smooth TX All sponsored elements aired as planned', '2021-09-02 21:10:59', '2021-09-02 21:10:59'),
(7, 1, 'NTV JIONI', '1858', '1857', '00', '1933', '1933', '00', 'Smooth TX All sponsored elements aired as planned', 'WEEKEND EDITION', '2057', '2057', '00', '2200', '2200', '00', 'Smooth TX All sponsored elements aired as planned', '2021-09-07 04:37:50', '2021-09-07 04:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `allDay` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `color` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'green',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producer1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producer2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dop1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dop2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dop3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dop4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_editor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `graphic_editor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `digital_editor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `user_id`, `title`, `start`, `end`, `allDay`, `color`, `status`, `producer1`, `producer2`, `dop1`, `dop2`, `dop3`, `dop4`, `description`, `video_editor`, `graphic_editor`, `digital_editor`, `others`, `created_at`, `updated_at`, `type`) VALUES
(1, 0, 'jaziri', '2021-08-21 00:00:00', '2021-08-22 00:00:00', 'true', 'green', 'normal', 'Kunbi', 'Inyang', 'sam', 'ade', 'thomas', 'mario', 'test', 'sesan', 'akan', 'lawrence', 'none', NULL, NULL, 'video'),
(2, 0, 'Hustle and grind', '2021-08-21 00:00:00', '2021-08-22 00:00:00', 'true', 'red', '2021-08-21 00:00:00', '2021-08-21 00:00:00', 'Inyang', 'Kunbi', 'Kunbi', 'Kunbi', 'Kunbi', 'test', 'sesan', 'akan', 'lawrence', 'none', NULL, '2021-08-24 14:07:15', 'preproduction'),
(3, 1, 'News Central TV', '2021-08-24 11:59:19', '2021-08-25 11:59:48', 'true', 'green', 'normal', 'important', 'critical', 'important', 'critical', 'important', 'critical', 'Test of shoot', NULL, NULL, NULL, NULL, '2021-08-24 10:00:33', '2021-08-24 10:00:33', 'graphics'),
(4, 1, 'Zero to Launch', '2021-08-27 11:59:19', '2021-08-27 11:59:48', 'true', 'yello', 'normal', 'important', 'critical', 'important', 'critical', 'important', 'critical', 'Test of shoot', NULL, NULL, NULL, NULL, '2021-08-24 10:00:33', '2021-08-24 10:00:33', 'digital');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `item_name`, `serial_no`, `state`, `assigned_department`, `created_at`, `updated_at`) VALUES
(2, 'Macbook Pro (C02Z2A7GLVCG)', 'C02Z2A7GLVCG', 'New Item', 'PRODUCTION', '2021-09-11 11:43:31', '2021-09-11 12:24:00'),
(3, 'Teranex Studio Pro', '1234567890', 'New Item', 'TECHNICAL', '2021-09-11 12:24:51', '2021-09-11 12:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `store_requests`
--

DROP TABLE IF EXISTS `store_requests`;
CREATE TABLE IF NOT EXISTS `store_requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `store_requests_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_requests`
--

INSERT INTO `store_requests` (`id`, `item`, `return_date`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Teranex Studio Pro', '2021-09-09 17:07:51', 1, 'Returned', '2021-09-11 15:08:43', '2021-09-11 19:42:10'),
(2, 'Teranex Studio Pro', '2021-09-22 21:43:33', 1, 'Approved', '2021-09-11 19:43:38', '2021-09-11 19:44:00'),
(3, 'Teranex Studio Pro', '2021-09-25 22:13:31', 1, 'Rejected', '2021-09-11 20:13:34', '2021-09-11 20:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `ticketit`
--

DROP TABLE IF EXISTS `ticketit`;
CREATE TABLE IF NOT EXISTS `ticketit` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `html` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `priority_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticketit_subject_index` (`subject`),
  KEY `ticketit_status_id_index` (`status_id`),
  KEY `ticketit_priority_id_index` (`priority_id`),
  KEY `ticketit_user_id_index` (`user_id`),
  KEY `ticketit_agent_id_index` (`agent_id`),
  KEY `ticketit_category_id_index` (`category_id`),
  KEY `ticketit_completed_at_index` (`completed_at`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticketit`
--

INSERT INTO `ticketit` (`id`, `subject`, `content`, `html`, `status_id`, `priority_id`, `user_id`, `agent_id`, `category_id`, `created_at`, `updated_at`, `completed_at`) VALUES
(1, 'Paper Jam', 'Printer will not work', 'Printer will not work', 1, 2, 1, 1, 2, '2021-08-18 17:26:59', '2021-08-20 23:10:18', '2021-08-20 21:51:37'),
(2, 'Paper Jam', 'Printer will not work', 'Printer will not work', 1, 2, 1, 1, 1, '2021-08-18 17:30:31', '2021-08-19 09:47:25', '2021-08-19 09:47:22'),
(3, 'Paper Jam', 'Printer will not work', 'Printer will not work', 1, 2, 1, 1, 1, '2021-08-18 17:31:19', '2021-08-20 21:40:37', NULL),
(4, 'Paper Jam', 'Printer will not work', 'Printer will not work', 1, 1, 1, 1, 3, '2021-08-18 17:37:02', '2021-08-20 23:55:11', NULL),
(5, 'Paper Jam', 'Printer will not work', 'Printer will not work', 1, 2, 1, 1, 1, '2021-08-18 17:38:50', '2021-08-20 22:03:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticketit_audits`
--

DROP TABLE IF EXISTS `ticketit_audits`;
CREATE TABLE IF NOT EXISTS `ticketit_audits` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `operation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticketit_categories`
--

DROP TABLE IF EXISTS `ticketit_categories`;
CREATE TABLE IF NOT EXISTS `ticketit_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticketit_categories`
--

INSERT INTO `ticketit_categories` (`id`, `name`, `color`) VALUES
(1, 'News Room', '#1118ee'),
(2, 'TECHNICAL', '#059e78'),
(3, 'VIDEO EDITORS', '#ff006f');

-- --------------------------------------------------------

--
-- Table structure for table `ticketit_categories_users`
--

DROP TABLE IF EXISTS `ticketit_categories_users`;
CREATE TABLE IF NOT EXISTS `ticketit_categories_users` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticketit_categories_users`
--

INSERT INTO `ticketit_categories_users` (`category_id`, `user_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(1, 3),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ticketit_comments`
--

DROP TABLE IF EXISTS `ticketit_comments`;
CREATE TABLE IF NOT EXISTS `ticketit_comments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `html` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticketit_comments_user_id_index` (`user_id`),
  KEY `ticketit_comments_ticket_id_index` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticketit_priorities`
--

DROP TABLE IF EXISTS `ticketit_priorities`;
CREATE TABLE IF NOT EXISTS `ticketit_priorities` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticketit_priorities`
--

INSERT INTO `ticketit_priorities` (`id`, `name`, `color`) VALUES
(1, 'normal', '#0ee16a'),
(2, 'emergency', '#e60a0a'),
(3, 'urgent', '#ebfb04');

-- --------------------------------------------------------

--
-- Table structure for table `ticketit_settings`
--

DROP TABLE IF EXISTS `ticketit_settings`;
CREATE TABLE IF NOT EXISTS `ticketit_settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticketit_settings_slug_unique` (`slug`),
  UNIQUE KEY `ticketit_settings_lang_unique` (`lang`),
  KEY `ticketit_settings_lang_index` (`lang`),
  KEY `ticketit_settings_slug_index` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticketit_settings`
--

INSERT INTO `ticketit_settings` (`id`, `lang`, `slug`, `value`, `default`, `created_at`, `updated_at`) VALUES
(1, NULL, 'main_route', 'tickets', 'tickets', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(2, NULL, 'main_route_path', 'tickets', 'tickets', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(3, NULL, 'admin_route', 'tickets-admin', 'tickets-admin', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(4, NULL, 'admin_route_path', 'tickets-admin', 'tickets-admin', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(5, NULL, 'master_template', 'layouts.app', 'master', '2021-08-18 16:48:11', '2021-08-20 15:52:41'),
(6, NULL, 'bootstrap_version', '4', '4', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(7, NULL, 'email.template', 'ticketit::emails.templates.ticketit', 'ticketit::emails.templates.ticketit', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(8, NULL, 'email.header', 'Ticket Update', 'Ticket Update', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(9, NULL, 'email.signoff', 'Thank you for your patience!', 'Thank you for your patience!', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(10, NULL, 'email.signature', 'Your friends', 'Your friends', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(11, NULL, 'email.dashboard', 'My Dashboard', 'My Dashboard', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(12, NULL, 'email.google_plus_link', '#', '#', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(13, NULL, 'email.facebook_link', '#', '#', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(14, NULL, 'email.twitter_link', '#', '#', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(15, NULL, 'email.footer', 'Powered by Ticketit', 'Powered by Ticketit', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(16, NULL, 'email.footer_link', 'https://github.com/thekordy/ticketit', 'https://github.com/thekordy/ticketit', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(17, NULL, 'email.color_body_bg', '#FFFFFF', '#FFFFFF', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(18, NULL, 'email.color_header_bg', '#44B7B7', '#44B7B7', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(19, NULL, 'email.color_content_bg', '#F46B45', '#F46B45', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(20, NULL, 'email.color_footer_bg', '#414141', '#414141', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(21, NULL, 'email.color_button_bg', '#AC4D2F', '#AC4D2F', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(22, NULL, 'default_status_id', '1', '1', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(23, NULL, 'default_close_status_id', '0', '0', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(24, NULL, 'default_reopen_status_id', '0', '0', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(25, NULL, 'paginate_items', '10', '10', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(26, NULL, 'length_menu', 'a:2:{i:0;a:3:{i:0;i:10;i:1;i:50;i:2;i:100;}i:1;a:3:{i:0;i:10;i:1;i:50;i:2;i:100;}}', 'a:2:{i:0;a:3:{i:0;i:10;i:1;i:50;i:2;i:100;}i:1;a:3:{i:0;i:10;i:1;i:50;i:2;i:100;}}', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(27, NULL, 'status_notification', '1', '1', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(28, NULL, 'comment_notification', '1', '1', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(29, NULL, 'queue_emails', '0', '0', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(30, NULL, 'assigned_notification', '1', '1', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(31, NULL, 'agent_restrict', '0', '0', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(32, NULL, 'close_ticket_perm', 'a:3:{s:5:\"owner\";b:1;s:5:\"agent\";b:1;s:5:\"admin\";b:1;}', 'a:3:{s:5:\"owner\";b:1;s:5:\"agent\";b:1;s:5:\"admin\";b:1;}', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(33, NULL, 'reopen_ticket_perm', 'a:3:{s:5:\"owner\";b:1;s:5:\"agent\";b:1;s:5:\"admin\";b:1;}', 'a:3:{s:5:\"owner\";b:1;s:5:\"agent\";b:1;s:5:\"admin\";b:1;}', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(34, NULL, 'delete_modal_type', 'builtin', 'builtin', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(35, NULL, 'editor_enabled', '0', '1', '2021-08-18 16:48:11', '2021-09-10 14:01:35'),
(36, NULL, 'include_font_awesome', '1', '1', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(37, NULL, 'summernote_locale', 'en', 'en', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(38, NULL, 'editor_html_highlighter', '1', '1', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(39, NULL, 'codemirror_theme', 'monokai', 'monokai', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(40, NULL, 'summernote_options_json_file', 'vendor/kordy/ticketit/src/JSON/summernote_init.json', 'vendor/kordy/ticketit/src/JSON/summernote_init.json', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(41, NULL, 'purifier_config', 'a:3:{s:15:\"HTML.SafeIframe\";s:4:\"true\";s:20:\"URI.SafeIframeRegexp\";s:72:\"%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%\";s:18:\"URI.AllowedSchemes\";a:5:{s:4:\"data\";b:1;s:4:\"http\";b:1;s:5:\"https\";b:1;s:6:\"mailto\";b:1;s:3:\"ftp\";b:1;}}', 'a:3:{s:15:\"HTML.SafeIframe\";s:4:\"true\";s:20:\"URI.SafeIframeRegexp\";s:72:\"%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%\";s:18:\"URI.AllowedSchemes\";a:5:{s:4:\"data\";b:1;s:4:\"http\";b:1;s:5:\"https\";b:1;s:6:\"mailto\";b:1;s:3:\"ftp\";b:1;}}', '2021-08-18 16:48:11', '2021-08-18 16:48:11'),
(42, NULL, 'routes', '/Users/mac/brave-mat/vendor/kordy/ticketit/src/routes.php', '/Users/mac/brave-mat/vendor/kordy/ticketit/src/routes.php', '2021-08-18 16:48:11', '2021-08-18 16:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `ticketit_statuses`
--

DROP TABLE IF EXISTS `ticketit_statuses`;
CREATE TABLE IF NOT EXISTS `ticketit_statuses` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticketit_statuses`
--

INSERT INTO `ticketit_statuses` (`id`, `name`, `color`) VALUES
(1, 'Open', '#f51414'),
(2, 'Resolved', '#1ace0d');

-- --------------------------------------------------------

--
-- Table structure for table `trackers`
--

DROP TABLE IF EXISTS `trackers`;
CREATE TABLE IF NOT EXISTS `trackers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `odometer_reading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refuel_date` date NOT NULL,
  `fuel_added` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel_cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_odometer_reading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kilometres` decimal(10,2) GENERATED ALWAYS AS (`odometer_reading` - `last_odometer_reading`) STORED,
  `cost_per_litre` decimal(10,2) GENERATED ALWAYS AS (`fuel_cost` / `fuel_added`) STORED,
  `mileage` decimal(10,2) GENERATED ALWAYS AS (`kilometres` / `fuel_added`) STORED,
  `cost_per_km` decimal(10,2) GENERATED ALWAYS AS (`fuel_cost` / `kilometres`) STORED,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trackers_user_id_foreign` (`user_id`),
  KEY `trackers_vehicle_id_foreign` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trackers`
--

INSERT INTO `trackers` (`id`, `vehicle_id`, `odometer_reading`, `refuel_date`, `fuel_added`, `fuel_cost`, `last_odometer_reading`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, '4', '2021-01-16', '5', '1600', '0', 1, '2021-09-08 22:51:54', '2021-09-08 22:51:54'),
(2, 4, '9', '2021-01-17', '6', '2000', '4', 1, '2021-09-08 22:52:54', '2021-09-08 22:52:54'),
(3, 4, '12', '2021-09-22', '5', '1600', '9', 1, '2021-09-08 22:55:56', '2021-09-08 22:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `transmission_reports`
--

DROP TABLE IF EXISTS `transmission_reports`;
CREATE TABLE IF NOT EXISTS `transmission_reports` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tc_on_duty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_interval` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_interval` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_interval` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `closed_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transmission_reports_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trip_loggers`
--

DROP TABLE IF EXISTS `trip_loggers`;
CREATE TABLE IF NOT EXISTS `trip_loggers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `number_plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `production_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trip_date` date NOT NULL,
  `assigned_driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `odometer_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `odometer_stop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trip_information` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trip_distance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel_station` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_loggers`
--

INSERT INTO `trip_loggers` (`id`, `number_plate`, `production_name`, `trip_date`, `assigned_driver`, `odometer_start`, `odometer_stop`, `trip_information`, `trip_distance`, `fuel_station`, `created_at`, `updated_at`) VALUES
(1, 'EKY-345-JJJ', 'Hustle and grind', '2021-08-09', 'Erondu Emmanuel', '161132', '161169', 'Smooth', '57', 'Oando-Lekki', '2021-08-30 15:25:51', '2021-08-30 15:25:51'),
(2, 'EKY-345-JJJ', 'Zebra Crossing', '2021-08-30', 'Sarah Lakin', '161169', '161207', 'Round Trip we stopped to fix the tires at CMS', '57', 'Oando-Lekki', '2021-08-30 15:27:46', '2021-08-30 15:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ticketit_admin` tinyint(1) NOT NULL DEFAULT 0,
  `ticketit_agent` tinyint(1) NOT NULL DEFAULT 0,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `ticketit_admin`, `ticketit_agent`, `department`, `status`) VALUES
(1, 'Erondu Emmanuel', 'admin@admin.com', '2021-08-20 15:32:52', '$2y$10$/HbUIEfEg1YXsl/02m8thu2kp2yu6125DH/2EatR4CEDMm/1E/adS', 'FTiWZeqty4vnVc9F0JKbBXPVj0oCawKpxqcgzGex9zEe36bMLwFZDPD5i0bG', '2021-08-20 15:32:52', '2021-08-20 23:11:00', 1, 1, 'TECHNICAL', ''),
(2, 'Sarah Lakin', 'jconnelly@example.org', '2021-08-20 15:32:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gWA8xVQqgT', '2021-08-20 15:32:52', '2021-08-20 15:32:52', 0, 0, 'DRIVERS', ''),
(3, 'Esther Roob', 'tavares.ankunding@example.net', '2021-08-20 15:32:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'NFvxGEwSXj', '2021-08-20 15:32:52', '2021-08-20 23:11:00', 0, 1, 'DRIVERS', ''),
(4, 'Oswaldo Lind', 'haley.lyla@example.org', '2021-08-20 15:32:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'iSOc1nS0DU', '2021-08-20 15:32:52', '2021-08-20 15:32:52', 0, 0, 'PRODUCERS', ''),
(5, 'Heather Bradtke MD', 'niko46@example.net', '2021-08-20 15:32:52', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zv83ppjRzG', '2021-08-20 15:32:52', '2021-08-20 15:32:52', 0, 0, 'EDITORS', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `number_plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_make` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_colour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vehicles_number_plate_unique` (`number_plate`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `number_plate`, `vehicle_make`, `purpose`, `vehicle_colour`, `assigned_driver`, `created_at`, `updated_at`) VALUES
(4, 'EKY-345-JJJ', 'Toyota Sienna', 'Operations', 'White', 'Sarah Lakin', '2021-08-30 13:55:57', '2021-09-11 12:09:54'),
(5, 'EKY-345-4HA', 'GMC-RHINO', 'Operations', 'BLACK', 'Sarah Lakin', '2021-09-08 09:47:42', '2021-09-08 09:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `video_editors_reports`
--

DROP TABLE IF EXISTS `video_editors_reports`;
CREATE TABLE IF NOT EXISTS `video_editors_reports` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `1pm_stories` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `7pm_stories` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `9pm_stories` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `video_editors_reports_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `editor_logs`
--
ALTER TABLE `editor_logs`
  ADD CONSTRAINT `editor_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mcr_logs`
--
ALTER TABLE `mcr_logs`
  ADD CONSTRAINT `mcr_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `o_blogs`
--
ALTER TABLE `o_blogs`
  ADD CONSTRAINT `o_blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `production_show_logs`
--
ALTER TABLE `production_show_logs`
  ADD CONSTRAINT `production_show_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `prompter_logs`
--
ALTER TABLE `prompter_logs`
  ADD CONSTRAINT `prompter_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `store_requests`
--
ALTER TABLE `store_requests`
  ADD CONSTRAINT `store_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trackers`
--
ALTER TABLE `trackers`
  ADD CONSTRAINT `trackers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `trackers_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `transmission_reports`
--
ALTER TABLE `transmission_reports`
  ADD CONSTRAINT `transmission_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `video_editors_reports`
--
ALTER TABLE `video_editors_reports`
  ADD CONSTRAINT `video_editors_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
