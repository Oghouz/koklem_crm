-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : dim. 12 jan. 2025 à 20:00
-- Version du serveur : 5.7.28
-- Version de PHP : 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `koklem_crm`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `description`, `published`, `created_at`, `updated_at`) VALUES
(1, 0, 'T-Shirt', 't-shirts', 1, '2025-01-06 20:16:37', '2025-01-06 20:16:37');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tva_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_created_by_updated_by_index` (`created_by`,`updated_by`),
  KEY `clients_updated_by_foreign` (`updated_by`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `company`, `type_company`, `first_name`, `last_name`, `address1`, `address2`, `city`, `zip_code`, `phone1`, `phone2`, `phone3`, `siret`, `tva_number`, `iban`, `bic`, `comment`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'LA TOUR MONDIALE', NULL, 'Kuerbanjian', 'Yusufu', '29 Avenue de la Bourdonnais', NULL, 'Paris', '75007', NULL, NULL, NULL, '88024372000021', 'FR68880243720', NULL, NULL, NULL, 1, 1, '2025-01-10 09:08:26', '2025-01-10 09:08:26');

-- --------------------------------------------------------

--
-- Structure de la table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `colors`
--

INSERT INTO `colors` (`id`, `reference`, `name`, `code`) VALUES
(1, 'RG', 'Rouge', '#FF0000'),
(2, 'VT', 'Vert', '#00FF00'),
(3, 'BL', 'Bleu', '#0000FF'),
(4, 'JN', 'Jaune', '#FFFF00'),
(5, 'OR', 'Orange', '#FFA500'),
(6, 'VL', 'Violet', '#800080'),
(7, 'RS', 'Rose', '#FFC0CB'),
(8, 'MR', 'Marron', '#A52A2A'),
(9, 'GR', 'Gris', '#808080'),
(10, 'NR', 'Noir', '#000000'),
(11, 'BL', 'Blanc', '#FFFFFF'),
(12, 'CY', 'Cyan', '#00FFFF'),
(13, 'MG', 'Magenta', '#FF00FF'),
(14, 'VF', 'Vert Foncé', '#006400'),
(15, 'BC', 'Bleu Clair', '#ADD8E6'),
(16, 'BG', 'Beige', '#fddb64'),
(17, 'CV', 'Citron Vert', '#00FF00'),
(18, 'RF', 'Rouge Foncé', '#8B0000'),
(19, 'BCI', 'Bleu Ciel', '#87CEEB'),
(20, 'OR', 'Or', '#FFD700'),
(21, 'AR', 'Argent', '#C0C0C0'),
(22, 'SC', 'Sarcelle', '#008080'),
(23, 'ID', 'Indigo', '#4B0082'),
(24, 'CR', 'Corail', '#FF7F50'),
(25, 'TQ', 'Turquoise', '#40E0D0'),
(26, 'LD', 'Lavande', '#E6E6FA'),
(27, 'OL', 'Olive', '#808000'),
(28, 'BM', 'Bleu Marine', '#000080'),
(29, 'BD', 'Bordeaux', '#800000'),
(30, 'PC', 'Pêche', '#FFE5B4');

-- --------------------------------------------------------

--
-- Structure de la table `designs`
--

DROP TABLE IF EXISTS `designs`;
CREATE TABLE IF NOT EXISTS `designs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `designs_reference_index` (`reference`),
  KEY `designs_created_by_updated_by_index` (`created_by`,`updated_by`),
  KEY `designs_updated_by_foreign` (`updated_by`),
  KEY `color_id` (`color_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `designs`
--

INSERT INTO `designs` (`id`, `reference`, `name`, `image`, `color_id`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'TSH-001-NR', 'T-shirt Modèle TSH-001-NR Noir', 'tsh-001-nr.jpg', 10, 'T-shirt I Love Paris Noir', 1, 1, '2025-01-10 07:37:53', '2025-01-12 07:11:23'),
(2, 'TSH-001-BL', 'T-shirt Modèle TSH-001-BL Blanc', 'tsh-001-bl.jpg', 11, 'T-shirt I Love Paris Blanc', 1, 1, '2025-01-10 07:51:06', '2025-01-12 07:11:36'),
(3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', 'tsh-002-bl.jpg', 11, 'T-shirt Paris', 1, 1, '2025-01-10 07:51:06', '2025-01-12 07:11:36'),
(4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-BL Noir', 'tsh-002-nr.jpg', 10, 'T-shirt Paris', 1, 1, '2025-01-10 07:51:06', '2025-01-12 07:11:36'),
(5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BL Beige', 'tsh-002-bg.jpg', 16, 'T-shirt Paris', 1, 1, '2025-01-10 07:51:06', '2025-01-12 07:11:36'),
(6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BL Belu Marine', 'tsh-002-bmf.jpg', 28, 'T-shirt Paris', 1, 1, '2025-01-10 07:51:06', '2025-01-12 07:11:36'),
(7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', 'tsh-003-bl.jpg', 11, 'T-shirt Paris', 1, 1, '2025-01-10 07:51:06', '2025-01-12 07:11:36'),
(8, 'TSH-003-NR', 'T-shirt Modèle TSH-003-BL Noir', 'tsh-003-nr.jpg', 10, 'T-shirt Paris', 1, 1, '2025-01-10 07:51:06', '2025-01-12 07:11:36'),
(9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BL Beige', 'tsh-003-bg.jpg', 16, 'T-shirt Paris', 1, 1, '2025-01-10 07:51:06', '2025-01-12 07:11:36'),
(10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BL Belu Marine', 'tsh-003-bmf.jpg', 28, 'T-shirt Paris', 1, 1, '2025-01-10 07:51:06', '2025-01-12 07:11:36');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_12_15_220216_create_products_table', 1),
(7, '2024_12_15_221016_create_tvas_table', 1),
(8, '2024_12_15_221226_create_categories_table', 1),
(9, '2024_12_15_221357_create_clients_table', 1),
(10, '2024_12_16_074842_create_orders_table', 1),
(11, '2024_12_16_080206_create_order_lines_table', 1),
(12, '2025_01_06_153522_create_designs_table', 1),
(15, '2025_01_10_081132_create_colors_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `total_ht` decimal(10,2) DEFAULT NULL,
  `total_tva` decimal(10,2) DEFAULT NULL,
  `total_ttc` decimal(10,2) DEFAULT NULL,
  `total_lines` int(11) NOT NULL DEFAULT '0',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_num_index` (`num`),
  KEY `orders_created_by_updated_by_index` (`created_by`,`updated_by`),
  KEY `orders_updated_by_foreign` (`updated_by`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `num`, `status`, `client_id`, `paid`, `payment_method`, `shipping_method`, `delivery_date`, `payment_date`, `total_ht`, `total_tva`, `total_ttc`, `total_lines`, `comment`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'CMD1736694062', '3', 1, 0, NULL, NULL, '2025-01-11', NULL, 178.50, 35.70, 214.20, 5, 'Test commande', 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02');

-- --------------------------------------------------------

--
-- Structure de la table `order_lines`
--

DROP TABLE IF EXISTS `order_lines`;
CREATE TABLE IF NOT EXISTS `order_lines` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `design_id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_lines_order_id_index` (`order_id`),
  KEY `order_lines_product_id_design_id_index` (`product_id`,`design_id`),
  KEY `order_lines_created_by_updated_by_index` (`created_by`,`updated_by`),
  KEY `order_lines_design_id_foreign` (`design_id`),
  KEY `order_lines_updated_by_foreign` (`updated_by`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_lines`
--

INSERT INTO `order_lines` (`id`, `order_id`, `product_id`, `design_id`, `reference`, `name`, `description`, `size`, `color`, `quantity`, `price`, `comment`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XS', 'Blanc', 3, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(2, 1, 2, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'S', 'Blanc', 3, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(3, 1, 3, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'M', 'Blanc', 3, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(4, 1, 4, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'L', 'Blanc', 3, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(5, 1, 5, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XL', 'Blanc', 3, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(6, 1, 6, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XXL', 'Blanc', 3, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(7, 1, 7, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-BL Noir', NULL, 'XS', 'Noir', 3, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(8, 1, 8, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-BL Noir', NULL, 'S', 'Noir', 3, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(9, 1, 9, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-BL Noir', NULL, 'M', 'Noir', 3, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(10, 1, 10, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-BL Noir', NULL, 'L', 'Noir', 3, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(11, 1, 11, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-BL Noir', NULL, 'XL', 'Noir', 3, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(12, 1, 12, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-BL Noir', NULL, 'XXL', 'Noir', 3, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(13, 1, 4, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'L', 'Blanc', 5, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(14, 1, 10, 8, 'TSH-003-NR', 'T-shirt Modèle TSH-003-BL Noir', NULL, 'L', 'Noir', 5, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02'),
(15, 1, 22, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BL Belu Marine', NULL, 'L', 'Bleu Marine', 5, 3.50, NULL, 1, 1, '2025-01-12 14:01:02', '2025-01-12 14:01:02');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `price_buy` decimal(10,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `tva_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_reference_unique` (`reference`),
  KEY `products_reference_index` (`reference`),
  KEY `products_created_by_updated_by_index` (`created_by`,`updated_by`),
  KEY `products_updated_by_foreign` (`updated_by`),
  KEY `products_tva_id_foreign` (`tva_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_color_id_foreign` (`color_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `reference`, `name`, `size`, `description`, `image`, `price`, `price_buy`, `category_id`, `tva_id`, `color_id`, `stock`, `published`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '11380102XS', 'T-shirt Sol\'s Regent 11380', 'XS', NULL, NULL, 1.30, NULL, 1, 1, 11, 54, 1, 1, 1, '2025-01-10 05:44:05', '2025-01-11 08:13:01'),
(2, '11380102S', 'T-shirt Sol\'s Regent 11380', 'S', NULL, NULL, 1.50, NULL, 1, 1, 11, 64, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-10 06:07:37'),
(3, '11380102M', 'T-shirt Sol\'s Regent 11380', 'M', NULL, NULL, 1.50, NULL, 1, 1, 11, 64, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-10 06:07:37'),
(4, '11380102L', 'T-shirt Sol\'s Regent 11380', 'L', NULL, NULL, 1.50, NULL, 1, 1, 11, 64, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-10 06:07:37'),
(5, '11380102XL', 'T-shirt Sol\'s Regent 11380', 'XL', NULL, NULL, 1.50, NULL, 1, 1, 11, 64, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-10 06:07:37'),
(6, '11380102XXL', 'T-shirt Sol\'s Regent 11380', 'XXL', NULL, NULL, 1.50, NULL, 1, 1, 11, 64, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-10 06:07:37'),
(7, '11380309XS', 'T-shirt Sol\'s Regent 11380 Nior', 'XS', NULL, NULL, 1.50, NULL, 1, 1, 10, 25, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-12 07:55:34'),
(8, '11380309S', 'T-shirt Sol\'s Regent 11380 Nior', 'S', NULL, NULL, 1.50, NULL, 1, 1, 10, 25, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-12 06:52:51'),
(9, '11380309M', 'T-shirt Sol\'s Regent 11380 Nior', 'M', NULL, NULL, 1.50, NULL, 1, 1, 10, 25, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-12 06:52:51'),
(10, '11380309L', 'T-shirt Sol\'s Regent 11380 Nior', 'L', NULL, NULL, 1.50, NULL, 1, 1, 10, 25, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-12 06:52:51'),
(11, '11380309XL', 'T-shirt Sol\'s Regent 11380 Nior', 'XL', NULL, NULL, 1.50, NULL, 1, 1, 10, 25, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-12 06:52:51'),
(12, '11380309XXL', 'T-shirt Sol\'s Regent 11380 Nior', 'XXL', NULL, NULL, 1.50, NULL, 1, 1, 10, 25, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-12 06:52:51'),
(13, '11380115XS', 'T-shirt Sol\'s Regent 11380 Sable', 'XS', NULL, NULL, 1.30, NULL, 1, 1, 16, 54, 1, 1, 1, '2025-01-10 05:44:05', '2025-01-12 07:59:32'),
(14, '11380115S', 'T-shirt Sol\'s Regent 11380 Sable', 'S', NULL, NULL, 1.50, NULL, 1, 1, 16, 64, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-10 06:07:37'),
(15, '11380115M', 'T-shirt Sol\'s Regent 11380 Sable', 'M', NULL, NULL, 1.50, NULL, 1, 1, 16, 64, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-10 06:07:37'),
(16, '11380115L', 'T-shirt Sol\'s Regent 11380 Sable', 'L', NULL, NULL, 1.50, NULL, 1, 1, 16, 64, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-10 06:07:37'),
(17, '11380115XL', 'T-shirt Sol\'s Regent 11380 Sable', 'XL', NULL, NULL, 1.50, NULL, 1, 1, 16, 64, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-10 06:07:37'),
(18, '11380115XXL', 'T-shirt Sol\'s Regent 11380 Sable', 'XXL', NULL, NULL, 1.50, NULL, 1, 1, 16, 64, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-10 06:07:37'),
(19, '11380319XS', 'T-shirt Sol\'s Regent 11380 FRENCH MARINE', 'XS', NULL, NULL, 1.50, NULL, 1, 1, 28, 25, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-12 08:00:13'),
(20, '11380319S', 'T-shirt Sol\'s Regent 11380 FRENCH MARINE', 'S', NULL, NULL, 1.50, NULL, 1, 1, 28, 25, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-12 06:52:51'),
(21, '11380319M', 'T-shirt Sol\'s Regent 11380 FRENCH MARINE', 'M', NULL, NULL, 1.50, NULL, 1, 1, 28, 25, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-12 06:52:51'),
(22, '11380319L', 'T-shirt Sol\'s Regent 11380 FRENCH MARINE', 'L', NULL, NULL, 1.50, NULL, 1, 1, 28, 25, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-12 06:52:51'),
(23, '11380319XL', 'T-shirt Sol\'s Regent 11380 FRENCH MARINE', 'XL', NULL, NULL, 1.50, NULL, 1, 1, 28, 25, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-12 06:52:51'),
(24, '11380319XXL', 'T-shirt Sol\'s Regent 11380 FRENCH MARINE', 'XXL', NULL, NULL, 1.50, NULL, 1, 1, 28, 25, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-12 06:52:51');

-- --------------------------------------------------------

--
-- Structure de la table `tvas`
--

DROP TABLE IF EXISTS `tvas`;
CREATE TABLE IF NOT EXISTS `tvas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `compte` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tvas`
--

INSERT INTO `tvas` (`id`, `name`, `value`, `compte`, `created_at`, `updated_at`) VALUES
(1, 'TVA 20%', 20.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Merdan', 'merdan@koklem.fr', NULL, '$2y$12$SyjQjtmT2tH2EDbix3sqP.cQBs8JF86HAUjdo4TrA/iLJgPDqrWRO', NULL, '2025-01-06 19:15:58', '2025-01-06 19:15:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
