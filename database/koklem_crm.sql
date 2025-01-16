-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : jeu. 16 jan. 2025 à 18:29
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `description`, `published`, `created_at`, `updated_at`) VALUES
(1, 0, 'T-Shirt', 't-shirts', 1, '2025-01-06 20:16:37', '2025-01-06 20:16:37'),
(2, 0, 'Magnet', 'Magnet', 1, '2025-01-15 13:14:52', '2025-01-15 13:14:52');

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `company`, `type_company`, `first_name`, `last_name`, `address1`, `address2`, `city`, `zip_code`, `phone1`, `phone2`, `phone3`, `siret`, `tva_number`, `iban`, `bic`, `comment`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'LA TOUR MONDIALE', NULL, 'LA TOUR MONDIALE', 'Yusufu', '29 Avenue de la Bourdonnais', NULL, 'Paris', '75007', NULL, NULL, NULL, '88024372000021', 'FR68880243720', NULL, NULL, 'Qurbanjan', 1, 1, '2025-01-10 09:08:26', '2025-01-15 14:38:35'),
(2, 'VB LA TROUVAILLE', NULL, 'LA TROUVAILLE', NULL, '9 RUE NORVINS', NULL, 'PARIS', '75018', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2025-01-14 18:10:07', '2025-01-15 12:30:10'),
(3, 'L\'AVENIR PY', NULL, NULL, NULL, '15 Rue Castagnary', NULL, 'Paris', '75015', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2025-01-15 11:48:28', '2025-01-15 11:48:28'),
(4, 'SACRE-SOUVENIRS', NULL, NULL, NULL, '5 Rue Norvins', NULL, 'Paris', '75018', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2025-01-15 11:55:05', '2025-01-15 11:55:05'),
(5, 'AU PIED DE LA BUTTE', NULL, NULL, NULL, '13 Rue de Steinkerque', NULL, 'Paris', '75018', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2025-01-15 11:58:00', '2025-01-15 11:58:00'),
(6, 'N.K. STEINKERQUE', NULL, NULL, NULL, '3 Rue de Steinkerque', NULL, 'Paris', '75018', NULL, NULL, NULL, '82889349500014', 'FR40828893495', NULL, NULL, NULL, 1, 1, '2025-01-15 12:00:55', '2025-01-15 12:00:55'),
(7, 'ANVERS TISSUS', NULL, NULL, NULL, '6 Rue de Steinkerque', NULL, 'Paris', '75018', NULL, NULL, NULL, '57211270400018', 'FR57211270400018', NULL, NULL, NULL, 1, 1, '2025-01-15 12:06:04', '2025-01-15 12:06:04'),
(8, 'JOHAR', NULL, NULL, NULL, '4 Rue Yvonne Le Tac', NULL, 'Paris', '75018', NULL, NULL, NULL, '477 783 419 00021', NULL, NULL, NULL, NULL, 1, 1, '2025-01-15 12:09:44', '2025-01-15 12:09:44'),
(9, 'GALERIE LA BELLE GABRIELLE', NULL, NULL, NULL, '3 Rue Norvins', NULL, 'Paris', '75018', NULL, NULL, NULL, '56200096800015', 'FR35562000968', NULL, NULL, NULL, 1, 1, '2025-01-15 12:13:18', '2025-01-15 12:13:18'),
(10, 'VB DIFFUSION', NULL, NULL, NULL, '8 Rue Lepic', NULL, 'Paris', '75018', NULL, NULL, NULL, '53937172400011', 'FR81539371724', NULL, NULL, NULL, 1, 1, '2025-01-15 12:33:15', '2025-01-15 12:33:15'),
(11, 'SHOP SOUVENIRS', NULL, NULL, NULL, '1 Rue Tardieu', NULL, 'Paris', '75018', NULL, NULL, NULL, '38420427700014', 'FR61384204277', NULL, NULL, NULL, 1, 1, '2025-01-15 12:35:00', '2025-01-15 12:35:00'),
(12, 'AU PARIS MONTMARTRE', NULL, NULL, NULL, '19 Place Saint-Pierre', NULL, 'Paris', '75018', NULL, NULL, NULL, '52119186600016', 'FR18521191866', NULL, NULL, NULL, 1, 1, '2025-01-15 12:36:58', '2025-01-15 12:36:58'),
(13, 'ART. ATAK', NULL, NULL, NULL, '51 Rue du Chevalier de la Barre', NULL, 'Paris', '75018', NULL, NULL, NULL, '49317495700016', 'FR82493174957', NULL, NULL, NULL, 1, 1, '2025-01-15 12:39:25', '2025-01-15 12:39:25'),
(14, 'LE CHAT NOIR SOUVENIRS', NULL, NULL, NULL, '57 Rue du Chevalier de la Barre', NULL, 'Paris', '75018', NULL, NULL, NULL, '85182371600010', 'FR49851823716', NULL, NULL, NULL, 1, 1, '2025-01-15 12:42:03', '2025-01-15 12:42:03'),
(15, 'PARIS FOREVER', NULL, NULL, NULL, '4 Rue du Cloître Notre-Dame', NULL, 'Paris', '75004', NULL, NULL, NULL, '80820986000028', 'FR35808209860', NULL, NULL, NULL, 1, 1, '2025-01-15 14:54:57', '2025-01-15 14:54:57'),
(16, 'ARCADE SOUVENIRS', NULL, NULL, NULL, '3 Rue d\'Arcole', NULL, 'Paris', '75004', NULL, NULL, NULL, '83924193200012', 'FR16839241932', NULL, NULL, NULL, 1, 1, '2025-01-15 15:00:16', '2025-01-15 15:00:16'),
(17, 'HUGO SOUVENIRS', NULL, NULL, NULL, '7 Rue d\'Arcole', NULL, 'Paris', '75004', NULL, NULL, NULL, '90292905800029', 'FR09902929058', NULL, NULL, NULL, 1, 1, '2025-01-15 15:04:20', '2025-01-15 15:04:20'),
(18, 'TOITS DE PARIS', NULL, NULL, NULL, '19 Quai Saint-Michel', NULL, 'Paris', '75005', NULL, NULL, NULL, '81878456300020', 'FR03818784563', NULL, NULL, NULL, 1, 1, '2025-01-15 15:07:00', '2025-01-15 15:07:00'),
(19, 'TABAC NOTRE DAME', NULL, 'SABRINA', NULL, '3 Rue Lagrange', NULL, 'Paris', '75005', NULL, NULL, NULL, '34914489900011', NULL, NULL, NULL, NULL, 1, 1, '2025-01-15 15:09:00', '2025-01-15 15:09:00'),
(20, 'LA FLECHE DE NOTRE-DAME', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '91506697100010', 'FR45915066971', NULL, NULL, 'Nom de Société: ZIC-ARON', 1, 1, '2025-01-15 15:12:24', '2025-01-15 15:12:24'),
(21, 'ZAS SOUVENIRS', NULL, NULL, NULL, '13 Rue d\'Arcole', NULL, 'Paris', '75004', NULL, NULL, NULL, '41322462700054', 'FR22413224627', NULL, NULL, NULL, 1, 1, '2025-01-16 08:38:43', '2025-01-16 08:38:43'),
(22, 'LEORO', NULL, NULL, NULL, '178 Rue de Rivoli', NULL, 'Paris', '75001', NULL, NULL, NULL, '48010896800052', 'FR09480108968', NULL, NULL, NULL, 1, 1, '2025-01-16 08:49:02', '2025-01-16 08:49:02');

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
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `designs`
--

INSERT INTO `designs` (`id`, `reference`, `name`, `image`, `color_id`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'TSH-001-NR', 'T-shirt Modèle TSH-001-NR Noir', 'tsh-001-nr.jpg', 10, '', 1, 1, '2025-01-10 06:37:53', '2025-01-12 06:11:23'),
(2, 'TSH-001-BL', 'T-shirt Modèle TSH-001-BL Blanc', 'tsh-001-bl.jpg', 11, '', 1, 1, '2025-01-10 06:51:06', '2025-01-12 06:11:36'),
(3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', 'tsh-002-bl.jpg', 11, '', 1, 1, '2025-01-10 06:51:06', '2025-01-12 06:11:36'),
(4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', 'tsh-002-nr.jpg', 10, '', 1, 1, '2025-01-10 06:51:06', '2025-01-12 06:11:36'),
(5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', 'tsh-002-bg.jpg', 16, '', 1, 1, '2025-01-10 06:51:06', '2025-01-12 06:11:36'),
(6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', 'tsh-002-bmf.jpg', 28, '', 1, 1, '2025-01-10 06:51:06', '2025-01-12 06:11:36'),
(7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', 'tsh-003-bl.jpg', 11, '', 1, 1, '2025-01-10 06:51:06', '2025-01-12 06:11:36'),
(8, 'TSH-003-NR', 'T-shirt Modèle TSH-003-NR Noir', 'tsh-003-nr.jpg', 10, '', 1, 1, '2025-01-10 06:51:06', '2025-01-12 06:11:36'),
(9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', 'tsh-003-bg.jpg', 16, '', 1, 1, '2025-01-10 06:51:06', '2025-01-12 06:11:36'),
(10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', 'tsh-003-bmf.jpg', 28, '', 1, 1, '2025-01-10 06:51:06', '2025-01-12 06:11:36'),
(11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', 'tsh-004-nr.jpg', 10, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', 'tsh-004-bl.jpg', 11, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(13, 'TSH-004-BG', 'T-shirt Modèle TSH-004-BG Beige', 'tsh-004-bg.jpg', 16, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', 'tsh-004-bmf.jpg', 28, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(15, 'TSH-005-NR', 'T-shirt Modèle TSH-005-NR Noir', 'tsh-005-nr.jpg', 10, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(16, 'TSH-005-BL', 'T-shirt Modèle TSH-005-BL Blanc', 'tsh-005-bl.jpg', 11, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(17, 'TSH-005-BG', 'T-shirt Modèle TSH-005-BG Beige', 'tsh-005-bg.jpg', 16, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(18, 'TSH-005-BMF', 'T-shirt Modèle TSH-005-BMF Bleu marine', 'tsh-005-bmf.jpg', 28, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(19, 'TSH-006-NR', 'T-shirt Modèle TSH-006-NR Noir', 'tsh-006-nr.jpg', 10, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', 'tsh-006-bl.jpg', 11, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(21, 'TSH-006-BG', 'T-shirt Modèle TSH-006-BG Beige', 'tsh-006-bg.jpg', 16, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', 'tsh-006-bmf.jpg', 28, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', 'tsh-007-nr.jpg', 10, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', 'tsh-007-bl.jpg', 11, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(25, 'TSH-007-BG', 'T-shirt Modèle TSH-007-BG Beige', 'tsh-007-bg.jpg', 16, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', 'tsh-007-bmf.jpg', 28, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', 'tsh-008-nr.jpg', 10, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', 'tsh-008-bl.jpg', 11, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', 'tsh-008-bg.jpg', 16, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', 'tsh-008-bmf.jpg', 28, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(31, 'TSH-009-NR', 'T-shirt Modèle TSH-009-NR Noir', 'tsh-009-nr.jpg', 10, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(32, 'TSH-009-BL', 'T-shirt Modèle TSH-009-BL Blanc', 'tsh-009-bl.jpg', 11, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(33, 'TSH-009-BG', 'T-shirt Modèle TSH-009-BG Beige', 'tsh-009-bg.jpg', 16, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(34, 'TSH-009-BMF', 'T-shirt Modèle TSH-009-BMF Bleu marine', 'tsh-009-bmf.jpg', 28, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(35, 'TSH-010-NR', 'T-shirt Modèle TSH-010-NR Noir', 'tsh-010-nr.jpg', 10, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(36, 'TSH-010-BL', 'T-shirt Modèle TSH-010-BL Blanc', 'tsh-010-bl.jpg', 11, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(37, 'TSH-010-BG', 'T-shirt Modèle TSH-010-BG BG', 'tsh-010-bg.jpg', 16, '', 1, 1, '2025-01-10 05:37:53', '2025-01-12 05:11:23'),
(38, 'TSH-010-BMF', 'T-shirt Modèle TSH-010-BMF Bleu marine', 'tsh-010-bmf.jpg', 28, '', 1, 1, '2025-01-10 05:51:06', '2025-01-12 05:11:36'),
(39, 'MGT50', 'Magnet carré 50mmx50mm', 'magnets/MGT50.JPG', NULL, NULL, 1, 1, '2025-01-15 13:22:35', '2025-01-15 13:22:35');

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
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `num`, `status`, `client_id`, `paid`, `payment_method`, `shipping_method`, `delivery_date`, `payment_date`, `total_ht`, `total_tva`, `total_ttc`, `total_lines`, `comment`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'CMD1736694062', '1', 1, 1, 'Virement', NULL, '2025-01-11', '2025-01-02', 178.50, 35.70, 214.20, 5, 'Test commande', 1, 1, '2025-01-12 14:01:02', '2025-01-16 10:03:03'),
(32, 'CMD1736883211', '3', 2, 0, NULL, NULL, NULL, NULL, 129.60, 25.92, 155.52, 25, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(4, 'CMD1736945376', '3', 3, 1, NULL, NULL, NULL, '2025-01-08', 333.00, 66.60, 399.60, 5, NULL, 1, 1, '2024-12-04 11:49:36', '2025-01-15 11:49:36'),
(5, 'CMD1736945785', '3', 4, 0, NULL, NULL, NULL, NULL, 228.00, 45.60, 273.60, 3, NULL, 1, 1, '2024-12-04 11:56:25', '2025-01-15 11:56:25'),
(6, 'CMD1736945947', '3', 5, 0, NULL, NULL, NULL, NULL, 342.00, 68.40, 410.40, 5, NULL, 1, 1, '2024-12-13 11:59:07', '2025-01-15 11:59:07'),
(7, 'CMD1736946232', '3', 6, 1, NULL, NULL, NULL, '2025-01-14', 216.00, 43.20, 259.20, 7, 'F24-0007\r\n13/12/2024\r\nPayé: 14/01/25', 1, 1, '2024-12-13 12:03:52', '2025-01-15 12:03:52'),
(8, 'CMD1736946500', '3', 7, 0, NULL, NULL, NULL, NULL, 216.00, 43.20, 259.20, 5, 'F04-008\r\nCMD:13/12/2024', 1, 1, '2024-12-13 12:08:20', '2025-01-15 12:08:20'),
(9, 'CMD1736946639', '3', 8, 0, NULL, NULL, NULL, NULL, 273.60, 54.72, 328.32, 4, 'F24-0009\r\nCMD:13/12/2024', 1, 1, '2024-12-13 12:10:39', '2025-01-15 12:10:39'),
(14, 'CMD1736948033', '3', 10, 0, NULL, NULL, NULL, NULL, 144.00, 28.80, 172.80, 1, 'F24-0014\r\nCMD:19/12/2024', 1, 1, '2024-12-19 12:33:53', '2025-01-15 12:33:53'),
(13, 'CMD1736947924', '3', 2, 0, NULL, NULL, NULL, NULL, 532.80, 106.56, 639.36, 10, NULL, 1, 1, '2024-12-19 12:32:04', '2025-01-15 12:32:04'),
(12, 'CMD1736947736', '3', 9, 0, NULL, NULL, NULL, NULL, 86.40, 17.28, 103.68, 1, NULL, 1, 1, '2024-12-19 12:28:56', '2025-01-15 12:28:57'),
(15, 'CMD1736948141', '3', 11, 0, NULL, NULL, NULL, NULL, 159.60, 31.92, 191.52, 3, NULL, 1, 1, '2024-12-19 12:35:41', '2025-01-15 12:35:41'),
(16, 'CMD1736948284', '3', 12, 1, NULL, NULL, NULL, '2025-01-13', 331.20, 66.24, 397.44, 7, NULL, 1, 1, '2024-12-19 12:38:04', '2025-01-15 12:38:04'),
(17, 'CMD1736948312', '3', 8, 0, NULL, NULL, NULL, NULL, 72.00, 14.40, 86.40, 1, NULL, 1, 1, '2024-12-19 12:38:32', '2025-01-15 12:38:32'),
(18, 'CMD1736948466', '3', 13, 1, NULL, NULL, NULL, '2025-01-13', 319.20, 63.84, 383.04, 7, 'F24-0018\r\nCMD:20/12/2024', 1, 1, '2024-12-20 12:41:06', '2025-01-15 12:41:06'),
(20, 'CMD1736956586', '3', 15, 1, NULL, NULL, NULL, '2025-01-13', 288.00, 57.60, 345.60, 6, 'F24-0020', 1, 1, '2024-12-20 14:56:26', '2025-01-15 14:56:27'),
(19, 'CMD1736956729', '3', 14, 1, NULL, NULL, NULL, '2025-01-13', 302.40, 60.48, 362.88, 7, 'F24-0019\r\nCMD:20/12/2024', 1, 1, '2024-12-20 14:58:49', '2025-01-15 14:58:49'),
(21, 'CMD1736956893', '3', 16, 0, NULL, NULL, NULL, NULL, 357.60, 71.52, 429.12, 6, 'F24-0021\r\nCMD:20/12/2024', 1, 1, '2024-12-20 15:01:33', '2025-01-15 15:01:33'),
(22, 'CMD1736957170', '3', 17, 0, NULL, NULL, NULL, NULL, 201.60, 40.32, 241.92, 4, 'F24-0022\r\nCMD:20/12/2024', 1, 1, '2024-12-20 15:06:10', '2025-01-15 15:06:10'),
(23, 'CMD1736957250', '3', 18, 0, NULL, NULL, NULL, NULL, 115.20, 23.04, 138.24, 1, 'F24-0023\r\nCMD:21/12/2024', 1, 1, '2024-12-21 15:07:30', '2025-01-15 15:07:30'),
(24, 'CMD1736957366', '3', 19, 1, NULL, NULL, NULL, '2025-01-10', 115.20, 23.04, 138.24, 1, 'F24-0024\r\nCMD:21/12/2024', 1, 1, '2024-12-21 15:09:26', '2025-01-15 15:09:26'),
(25, 'CMD1736957589', '3', 20, 0, NULL, NULL, NULL, NULL, 57.60, 11.52, 69.12, 1, 'F24-0025\r\nCMD:21/12/24', 1, 1, '2024-12-21 15:13:09', '2025-01-15 15:13:09'),
(26, 'CMD1737020347', '3', 21, 0, NULL, NULL, NULL, NULL, 50.40, 10.08, 60.48, 1, NULL, 1, 1, '2024-12-21 08:39:07', '2025-01-16 08:39:07'),
(28, 'CMD1737020453', '3', 7, 0, NULL, NULL, NULL, NULL, 453.60, 90.72, 544.32, 7, NULL, 1, 1, '2024-12-31 08:40:53', '2025-01-16 08:40:53'),
(29, 'CMD1737020819', '3', 5, 0, NULL, NULL, NULL, NULL, 201.40, 40.28, 241.68, 20, NULL, 1, 1, '2024-12-31 08:46:59', '2025-01-16 08:46:59'),
(30, 'CMD1737021001', '3', 22, 0, NULL, NULL, NULL, NULL, 259.20, 51.84, 311.04, 4, NULL, 1, 1, '2025-01-10 08:50:01', '2025-01-16 08:50:01'),
(31, 'CMD1737021227', '3', 8, 0, NULL, NULL, NULL, NULL, 152.20, 30.44, 182.64, 9, NULL, 1, 1, '2025-01-10 08:53:47', '2025-01-16 08:53:47');

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
) ENGINE=MyISAM AUTO_INCREMENT=587 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_lines`
--

INSERT INTO `order_lines` (`id`, `order_id`, `product_id`, `design_id`, `reference`, `name`, `description`, `size`, `color`, `quantity`, `price`, `comment`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(16, 32, 12, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XXL', 'Noir', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(17, 32, 9, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'M', 'Noir', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(18, 32, 8, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(19, 32, 7, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(20, 32, 5, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XL', 'Blanc', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(21, 32, 4, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(22, 32, 3, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'M', 'Blanc', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(23, 32, 1, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(24, 32, 24, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(25, 32, 23, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(26, 32, 19, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(27, 32, 13, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'XS', 'Beige', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(28, 32, 10, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'L', 'Noir', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(29, 32, 7, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XS', 'Noir', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(30, 32, 3, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'M', 'Blanc', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(31, 32, 2, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'S', 'Blanc', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(32, 32, 18, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'XXL', 'Beige', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(33, 32, 15, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'M', 'Beige', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(34, 32, 24, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(35, 32, 23, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(36, 32, 22, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(37, 32, 21, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(38, 32, 5, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(39, 32, 3, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(40, 32, 2, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'S', 'Blanc', 1, 3.60, NULL, 1, 1, '2025-01-14 18:33:31', '2025-01-14 18:33:31'),
(41, 4, 1, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XS', 'Blanc', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(42, 4, 2, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'S', 'Blanc', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(43, 4, 3, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'M', 'Blanc', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(44, 4, 4, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'L', 'Blanc', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(45, 4, 5, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XL', 'Blanc', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(46, 4, 6, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XXL', 'Blanc', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(47, 4, 7, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XS', 'Noir', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(48, 4, 8, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'S', 'Noir', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(49, 4, 9, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'M', 'Noir', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(50, 4, 10, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'L', 'Noir', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(51, 4, 11, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XL', 'Noir', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(52, 4, 12, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XXL', 'Noir', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(53, 4, 19, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(54, 4, 20, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(55, 4, 21, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(56, 4, 22, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(57, 4, 23, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(58, 4, 24, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(59, 4, 13, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XS', 'Beige', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(60, 4, 14, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'S', 'Beige', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(61, 4, 15, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'M', 'Beige', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(62, 4, 16, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'L', 'Beige', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(63, 4, 17, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XL', 'Beige', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(64, 4, 18, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XXL', 'Beige', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(65, 4, 1, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XS', 'Blanc', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(66, 4, 2, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'S', 'Blanc', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(67, 4, 3, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'M', 'Blanc', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(68, 4, 4, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'L', 'Blanc', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(69, 4, 5, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XL', 'Blanc', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(70, 4, 6, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XXL', 'Blanc', 3, 3.70, NULL, 1, 1, '2025-01-15 11:49:36', '2025-01-15 11:49:36'),
(71, 5, 19, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(72, 5, 20, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(73, 5, 21, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(74, 5, 22, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(75, 5, 23, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(76, 5, 24, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(77, 5, 13, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XS', 'Beige', 3, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(78, 5, 14, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'S', 'Beige', 3, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(79, 5, 15, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'M', 'Beige', 3, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(80, 5, 16, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'L', 'Beige', 3, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(81, 5, 17, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XL', 'Beige', 3, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(82, 5, 18, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XXL', 'Beige', 3, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(83, 5, 1, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XS', 'Blanc', 4, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(84, 5, 2, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'S', 'Blanc', 4, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(85, 5, 3, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'M', 'Blanc', 4, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(86, 5, 4, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'L', 'Blanc', 4, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(87, 5, 5, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XL', 'Blanc', 4, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(88, 5, 6, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XXL', 'Blanc', 4, 3.80, NULL, 1, 1, '2025-01-15 11:56:25', '2025-01-15 11:56:25'),
(89, 35, 7, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'XS', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(90, 35, 8, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'S', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(91, 35, 9, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'M', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(92, 35, 10, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'L', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(93, 35, 11, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'XL', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(94, 35, 12, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'XXL', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(95, 35, 1, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XS', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(96, 35, 2, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'S', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(97, 35, 3, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'M', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(98, 35, 4, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'L', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(99, 35, 5, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XL', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(100, 35, 6, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XXL', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(101, 35, 7, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XS', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(102, 35, 8, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'S', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(103, 35, 9, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'M', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(104, 35, 10, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'L', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(105, 35, 11, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XL', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(106, 35, 12, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XXL', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(107, 35, 19, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(108, 35, 20, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(109, 35, 21, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(110, 35, 22, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(111, 35, 23, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(112, 35, 24, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(113, 35, 1, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XS', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(114, 35, 2, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'S', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(115, 35, 3, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'M', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(116, 35, 4, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'L', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(117, 35, 5, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XL', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(118, 35, 6, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XXL', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 11:59:07', '2025-01-15 11:59:07'),
(119, 36, 7, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(120, 36, 8, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(121, 36, 9, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(122, 36, 10, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(123, 36, 11, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(124, 36, 12, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(125, 36, 1, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(126, 36, 2, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(127, 36, 3, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(128, 36, 4, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(129, 36, 5, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(130, 36, 6, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(131, 36, 7, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XS', 'Noir', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(132, 36, 8, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'S', 'Noir', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(133, 36, 9, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'M', 'Noir', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(134, 36, 10, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'L', 'Noir', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(135, 36, 11, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XL', 'Noir', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(136, 36, 12, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XXL', 'Noir', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(137, 36, 19, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(138, 36, 20, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(139, 36, 21, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(140, 36, 22, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(141, 36, 23, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(142, 36, 24, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(143, 36, 1, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XS', 'Blanc', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(144, 36, 2, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'S', 'Blanc', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(145, 36, 3, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'M', 'Blanc', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(146, 36, 4, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'L', 'Blanc', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(147, 36, 5, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XL', 'Blanc', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(148, 36, 6, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XXL', 'Blanc', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(149, 36, 13, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XS', 'Beige', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(150, 36, 14, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'S', 'Beige', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(151, 36, 15, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'M', 'Beige', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(152, 36, 16, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'L', 'Beige', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(153, 36, 17, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XL', 'Beige', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(154, 36, 18, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XXL', 'Beige', 1, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(155, 36, 1, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(156, 36, 2, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(157, 36, 3, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(158, 36, 4, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(159, 36, 5, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(160, 36, 6, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:03:52', '2025-01-15 12:03:52'),
(161, 37, 7, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(162, 37, 8, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(163, 37, 9, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(164, 37, 10, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(165, 37, 11, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(166, 37, 12, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(167, 37, 1, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(168, 37, 2, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(169, 37, 3, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(170, 37, 4, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(171, 37, 5, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(172, 37, 6, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(173, 37, 1, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(174, 37, 2, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(175, 37, 3, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(176, 37, 4, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(177, 37, 5, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(178, 37, 6, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(179, 37, 19, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(180, 37, 20, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(181, 37, 21, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(182, 37, 22, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(183, 37, 23, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(184, 37, 24, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(185, 37, 13, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XS', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(186, 37, 14, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'S', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(187, 37, 15, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'M', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(188, 37, 16, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'L', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(189, 37, 17, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XL', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(190, 37, 18, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XXL', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:08:20', '2025-01-15 12:08:20'),
(191, 38, 7, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XS', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(192, 38, 8, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'S', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(193, 38, 9, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'M', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(194, 38, 10, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'L', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(195, 38, 11, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XL', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(196, 38, 12, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XXL', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(197, 38, 1, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XS', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(198, 38, 2, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'S', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(199, 38, 3, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'M', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(200, 38, 4, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'L', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(201, 38, 5, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XL', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(202, 38, 6, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XXL', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(203, 38, 1, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XS', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(204, 38, 2, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'S', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(205, 38, 3, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'M', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(206, 38, 4, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'L', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(207, 38, 5, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XL', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(208, 38, 6, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XXL', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(209, 38, 13, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XS', 'Beige', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(210, 38, 14, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'S', 'Beige', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(211, 38, 15, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'M', 'Beige', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(212, 38, 16, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'L', 'Beige', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(213, 38, 17, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XL', 'Beige', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(214, 38, 18, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XXL', 'Beige', 3, 3.80, NULL, 1, 1, '2025-01-15 12:10:39', '2025-01-15 12:10:39'),
(215, 41, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 144, 0.60, NULL, 1, 1, '2025-01-15 12:28:57', '2025-01-15 12:28:57'),
(216, 42, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 240, 0.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(217, 42, 1, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(218, 42, 2, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(219, 42, 3, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(220, 42, 4, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(221, 42, 5, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(222, 42, 6, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(223, 42, 7, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(224, 42, 8, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(225, 42, 9, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(226, 42, 10, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(227, 42, 11, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(228, 42, 12, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(229, 42, 1, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(230, 42, 2, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(231, 42, 3, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(232, 42, 4, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(233, 42, 5, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(234, 42, 6, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(235, 42, 7, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(236, 42, 8, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(237, 42, 9, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(238, 42, 10, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(239, 42, 11, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(240, 42, 12, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(241, 42, 19, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(242, 42, 20, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(243, 42, 21, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(244, 42, 22, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(245, 42, 23, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(246, 42, 24, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(247, 42, 13, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'XS', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(248, 42, 14, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'S', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(249, 42, 15, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'M', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(250, 42, 16, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'L', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(251, 42, 17, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'XL', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(252, 42, 18, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'XXL', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(253, 42, 1, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(254, 42, 2, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(255, 42, 3, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(256, 42, 4, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(257, 42, 5, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(258, 42, 6, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(259, 42, 13, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'XS', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(260, 42, 14, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'S', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(261, 42, 15, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'M', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(262, 42, 16, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'L', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(263, 42, 17, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'XL', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(264, 42, 18, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'XXL', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(265, 42, 19, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(266, 42, 20, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(267, 42, 21, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(268, 42, 22, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(269, 42, 23, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(270, 42, 24, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:32:04', '2025-01-15 12:32:04'),
(271, 43, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 240, 0.60, NULL, 1, 1, '2025-01-15 12:33:53', '2025-01-15 12:33:53'),
(272, 44, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 50, 0.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(273, 44, 1, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'XS', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(274, 44, 2, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'S', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(275, 44, 3, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'M', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(276, 44, 4, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'L', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(277, 44, 5, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'XL', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(278, 44, 6, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'XXL', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(279, 44, 19, 26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(280, 44, 20, 26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(281, 44, 21, 26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(282, 44, 22, 26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(283, 44, 23, 26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(284, 44, 24, 26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-15 12:35:41', '2025-01-15 12:35:41'),
(285, 45, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 120, 0.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(286, 45, 1, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(287, 45, 2, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(288, 45, 3, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(289, 45, 4, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(290, 45, 5, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(291, 45, 6, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(292, 45, 7, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(293, 45, 8, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(294, 45, 9, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(295, 45, 10, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(296, 45, 11, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(297, 45, 12, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(298, 45, 19, 14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(299, 45, 20, 14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(300, 45, 21, 14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(301, 45, 22, 14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(302, 45, 23, 14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(303, 45, 24, 14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(304, 45, 7, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(305, 45, 8, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(306, 45, 9, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(307, 45, 10, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(308, 45, 11, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(309, 45, 12, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(310, 45, 7, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(311, 45, 8, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(312, 45, 9, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(313, 45, 10, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(314, 45, 11, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(315, 45, 12, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(316, 45, 13, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'XS', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(317, 45, 14, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'S', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(318, 45, 15, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'M', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(319, 45, 16, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'L', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(320, 45, 17, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'XL', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(321, 45, 18, 29, 'TSH-008-BG', 'T-shirt Modèle TSH-008-BG Beige', NULL, 'XXL', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 12:38:04', '2025-01-15 12:38:04'),
(322, 46, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 120, 0.60, NULL, 1, 1, '2025-01-15 12:38:32', '2025-01-15 12:38:32'),
(323, 47, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 100, 0.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(324, 47, 1, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(325, 47, 2, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(326, 47, 3, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(327, 47, 4, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(328, 47, 5, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(329, 47, 6, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(330, 47, 7, 8, 'TSH-003-NR', 'T-shirt Modèle TSH-003-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(331, 47, 8, 8, 'TSH-003-NR', 'T-shirt Modèle TSH-003-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(332, 47, 9, 8, 'TSH-003-NR', 'T-shirt Modèle TSH-003-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(333, 47, 10, 8, 'TSH-003-NR', 'T-shirt Modèle TSH-003-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(334, 47, 11, 8, 'TSH-003-NR', 'T-shirt Modèle TSH-003-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(335, 47, 12, 8, 'TSH-003-NR', 'T-shirt Modèle TSH-003-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(336, 47, 19, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(337, 47, 20, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06');
INSERT INTO `order_lines` (`id`, `order_id`, `product_id`, `design_id`, `reference`, `name`, `description`, `size`, `color`, `quantity`, `price`, `comment`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(338, 47, 21, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(339, 47, 22, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(340, 47, 23, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(341, 47, 24, 10, 'TSH-003-BMF', 'T-shirt Modèle TSH-003-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(342, 47, 7, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(343, 47, 8, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(344, 47, 9, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(345, 47, 10, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(346, 47, 11, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(347, 47, 12, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(348, 47, 1, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(349, 47, 2, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(350, 47, 3, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(351, 47, 4, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(352, 47, 5, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(353, 47, 6, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(354, 47, 19, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(355, 47, 20, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(356, 47, 21, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(357, 47, 22, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(358, 47, 23, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(359, 47, 24, 30, 'TSH-008-BMF', 'T-shirt Modèle TSH-008-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 12:41:06', '2025-01-15 12:41:06'),
(360, 48, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 120, 0.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(361, 48, 1, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(362, 48, 2, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(363, 48, 3, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(364, 48, 4, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(365, 48, 5, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(366, 48, 6, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(367, 48, 13, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XS', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(368, 48, 14, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'S', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(369, 48, 15, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'M', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(370, 48, 16, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'L', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(371, 48, 17, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XL', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(372, 48, 18, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XXL', 'Beige', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(373, 48, 19, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(374, 48, 20, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(375, 48, 21, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(376, 48, 22, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(377, 48, 23, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(378, 48, 24, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(379, 48, 1, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(380, 48, 2, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(381, 48, 3, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(382, 48, 4, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(383, 48, 5, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(384, 48, 6, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(385, 48, 7, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(386, 48, 8, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(387, 48, 9, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(388, 48, 10, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(389, 48, 11, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(390, 48, 12, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:56:27', '2025-01-15 14:56:27'),
(391, 49, 7, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(392, 49, 8, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(393, 49, 9, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(394, 49, 10, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(395, 49, 11, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(396, 49, 12, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(397, 49, 1, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(398, 49, 2, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(399, 49, 3, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(400, 49, 4, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(401, 49, 5, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(402, 49, 6, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(403, 49, 7, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(404, 49, 8, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(405, 49, 9, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(406, 49, 10, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(407, 49, 11, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(408, 49, 12, 27, 'TSH-008-NR', 'T-shirt Modèle TSH-008-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(409, 49, 1, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(410, 49, 2, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(411, 49, 3, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(412, 49, 4, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(413, 49, 5, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(414, 49, 6, 28, 'TSH-008-BL', 'T-shirt Modèle TSH-008-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(415, 49, 7, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'XS', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(416, 49, 8, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'S', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(417, 49, 9, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'M', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(418, 49, 10, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'L', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(419, 49, 11, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'XL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(420, 49, 12, 23, 'TSH-007-NR', 'T-shirt Modèle TSH-007-NR Noir', NULL, 'XXL', 'Noir', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(421, 49, 1, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(422, 49, 2, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'S', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(423, 49, 3, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'M', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(424, 49, 4, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'L', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(425, 49, 5, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(426, 49, 6, 24, 'TSH-007-BL', 'T-shirt Modèle TSH-007-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(427, 49, 19, 26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(428, 49, 20, 26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(429, 49, 21, 26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(430, 49, 22, 26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(431, 49, 23, 26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(432, 49, 24, 26, 'TSH-007-BMF', 'T-shirt Modèle TSH-007-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 2, 3.60, NULL, 1, 1, '2025-01-15 14:58:49', '2025-01-15 14:58:49'),
(433, 50, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 216, 0.60, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(434, 50, 1, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(435, 50, 2, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'S', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(436, 50, 3, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'M', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(437, 50, 4, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'L', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(438, 50, 5, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(439, 50, 6, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(440, 50, 13, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XS', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(441, 50, 14, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'S', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(442, 50, 15, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'M', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(443, 50, 16, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'L', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(444, 50, 17, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XL', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(445, 50, 18, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XXL', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(446, 50, 7, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XS', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(447, 50, 8, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'S', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(448, 50, 9, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'M', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(449, 50, 10, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'L', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(450, 50, 11, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XL', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(451, 50, 12, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XXL', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(452, 50, 1, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(453, 50, 2, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'S', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(454, 50, 3, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'M', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(455, 50, 4, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'L', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(456, 50, 5, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XL', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(457, 50, 6, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XXL', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(458, 50, 7, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XS', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(459, 50, 8, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'S', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(460, 50, 9, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'M', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(461, 50, 10, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'L', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(462, 50, 11, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XL', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(463, 50, 12, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XXL', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:01:33', '2025-01-15 15:01:33'),
(464, 51, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 108, 0.60, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(465, 51, 7, 19, 'TSH-006-NR', 'T-shirt Modèle TSH-006-NR Noir', NULL, 'XS', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(466, 51, 8, 19, 'TSH-006-NR', 'T-shirt Modèle TSH-006-NR Noir', NULL, 'S', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(467, 51, 9, 19, 'TSH-006-NR', 'T-shirt Modèle TSH-006-NR Noir', NULL, 'M', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(468, 51, 10, 19, 'TSH-006-NR', 'T-shirt Modèle TSH-006-NR Noir', NULL, 'L', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(469, 51, 11, 19, 'TSH-006-NR', 'T-shirt Modèle TSH-006-NR Noir', NULL, 'XL', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(470, 51, 12, 19, 'TSH-006-NR', 'T-shirt Modèle TSH-006-NR Noir', NULL, 'XXL', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(471, 51, 13, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'XS', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(472, 51, 14, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'S', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(473, 51, 15, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'M', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(474, 51, 16, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'L', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(475, 51, 17, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'XL', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(476, 51, 18, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'XXL', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(477, 51, 19, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(478, 51, 20, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(479, 51, 21, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(480, 51, 22, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(481, 51, 23, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(482, 51, 24, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 2, 3.80, NULL, 1, 1, '2025-01-15 15:06:10', '2025-01-15 15:06:10'),
(483, 52, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 192, 0.60, NULL, 1, 1, '2025-01-15 15:07:30', '2025-01-15 15:07:30'),
(484, 53, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 192, 0.60, NULL, 1, 1, '2025-01-15 15:09:26', '2025-01-15 15:09:26'),
(485, 54, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 96, 0.60, NULL, 1, 1, '2025-01-15 15:13:09', '2025-01-15 15:13:09'),
(486, 55, 25, 39, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, '', 84, 0.60, NULL, 1, 1, '2025-01-16 08:39:07', '2025-01-16 08:39:07'),
(487, 56, 19, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(488, 56, 20, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(489, 56, 21, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(490, 56, 22, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(491, 56, 23, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(492, 56, 24, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(493, 56, 13, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XS', 'Beige', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(494, 56, 14, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'S', 'Beige', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(495, 56, 15, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'M', 'Beige', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(496, 56, 16, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'L', 'Beige', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(497, 56, 17, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XL', 'Beige', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(498, 56, 18, 5, 'TSH-002-BG', 'T-shirt Modèle TSH-002-BG Beige', NULL, 'XXL', 'Beige', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(499, 56, 7, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XS', 'Noir', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(500, 56, 8, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'S', 'Noir', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(501, 56, 9, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'M', 'Noir', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(502, 56, 10, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'L', 'Noir', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(503, 56, 11, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XL', 'Noir', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(504, 56, 12, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XXL', 'Noir', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(505, 56, 1, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XS', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(506, 56, 2, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'S', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(507, 56, 3, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'M', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(508, 56, 4, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'L', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(509, 56, 5, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XL', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(510, 56, 6, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XXL', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(511, 56, 7, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XS', 'Noir', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(512, 56, 8, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'S', 'Noir', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(513, 56, 9, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'M', 'Noir', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(514, 56, 10, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'L', 'Noir', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(515, 56, 11, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XL', 'Noir', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(516, 56, 12, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XXL', 'Noir', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(517, 56, 1, 20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', NULL, 'XS', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(518, 56, 2, 20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', NULL, 'S', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(519, 56, 3, 20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', NULL, 'M', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(520, 56, 4, 20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', NULL, 'L', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(521, 56, 5, 20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', NULL, 'XL', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(522, 56, 6, 20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', NULL, 'XXL', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(523, 56, 19, 22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(524, 56, 20, 22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(525, 56, 21, 22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(526, 56, 22, 22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(527, 56, 23, 22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(528, 56, 24, 22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:40:53', '2025-01-16 08:40:53'),
(529, 29, 23, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 1, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(530, 29, 21, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 3, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(531, 29, 22, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 2, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(532, 29, 4, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'L', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(533, 29, 3, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'M', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(534, 29, 1, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(535, 29, 12, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XXL', 'Noir', 1, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(536, 29, 10, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'L', 'Noir', 4, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(537, 29, 9, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'M', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(538, 29, 7, 4, 'TSH-002-NR', 'T-shirt Modèle TSH-002-NR Noir', NULL, 'XS', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(539, 29, 12, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XXL', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(540, 29, 11, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XL', 'Noir', 5, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(541, 29, 10, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'L', 'Noir', 5, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(542, 29, 9, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'M', 'Noir', 5, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(543, 29, 8, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'S', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(544, 29, 7, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XS', 'Noir', 3, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(545, 29, 4, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'L', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(546, 29, 3, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'M', 'Blanc', 4, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(547, 29, 2, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'S', 'Blanc', 1, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(548, 29, 1, 12, 'TSH-004-BL', 'T-shirt Modèle TSH-004-BL Blanc', NULL, 'XS', 'Blanc', 2, 3.80, NULL, 1, 1, '2025-01-16 08:46:59', '2025-01-16 08:46:59'),
(549, 30, 1, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XS', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(550, 30, 2, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'S', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(551, 30, 3, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'M', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(552, 30, 4, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'L', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(553, 30, 5, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XL', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(554, 30, 6, 3, 'TSH-002-BL', 'T-shirt Modèle TSH-002-BL Blanc', NULL, 'XXL', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(555, 30, 19, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(556, 30, 20, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(557, 30, 21, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(558, 30, 22, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(559, 30, 23, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(560, 30, 24, 6, 'TSH-002-BMF', 'T-shirt Modèle TSH-002-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(561, 30, 1, 20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', NULL, 'XS', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(562, 30, 2, 20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', NULL, 'S', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(563, 30, 3, 20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', NULL, 'M', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(564, 30, 4, 20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', NULL, 'L', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(565, 30, 5, 20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', NULL, 'XL', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(566, 30, 6, 20, 'TSH-006-BL', 'T-shirt Modèle TSH-006-BL Blanc', NULL, 'XXL', 'Blanc', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(567, 30, 19, 22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(568, 30, 20, 22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(569, 30, 21, 22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(570, 30, 22, 22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(571, 30, 23, 22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(572, 30, 24, 22, 'TSH-006-BMF', 'T-shirt Modèle TSH-006-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:50:01', '2025-01-16 08:50:01'),
(573, 31, 7, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'XS', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(574, 31, 8, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'S', 'Noir', 5, 3.80, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(575, 31, 9, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'M', 'Noir', 2, 3.80, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(576, 31, 10, 11, 'TSH-004-NR', 'T-shirt Modèle TSH-004-NR Noir', NULL, 'L', 'Noir', 4, 3.80, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(577, 31, 2, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'S', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(578, 31, 3, 7, 'TSH-003-BL', 'T-shirt Modèle TSH-003-BL Blanc', NULL, 'M', 'Blanc', 3, 3.80, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(579, 31, 14, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'S', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(580, 31, 15, 9, 'TSH-003-BG', 'T-shirt Modèle TSH-003-BG Beige', NULL, 'M', 'Beige', 2, 3.80, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(581, 31, 19, 14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', NULL, 'XS', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(582, 31, 20, 14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', NULL, 'S', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(583, 31, 21, 14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', NULL, 'M', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(584, 31, 22, 14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', NULL, 'L', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(585, 31, 23, 14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', NULL, 'XL', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47'),
(586, 31, 24, 14, 'TSH-004-BMF', 'T-shirt Modèle TSH-004-BMF Bleu marine', NULL, 'XXL', 'Bleu Marine', 3, 3.60, NULL, 1, 1, '2025-01-16 08:53:47', '2025-01-16 08:53:47');

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
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `reference`, `name`, `size`, `description`, `image`, `price`, `price_buy`, `category_id`, `tva_id`, `color_id`, `stock`, `published`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '11380102XS', 'T-shirt Sol\'s Regent 11380', 'XS', NULL, 't-shirts/BL.png', 1.30, NULL, 1, 1, 11, 56, 1, 1, 1, '2025-01-10 05:44:05', '2025-01-15 10:29:10'),
(2, '11380102S', 'T-shirt Sol\'s Regent 11380', 'S', NULL, 't-shirts/BL.png', 1.30, NULL, 1, 1, 11, 62, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-15 10:30:10'),
(3, '11380102M', 'T-shirt Sol\'s Regent 11380', 'M', NULL, 't-shirts/BL.png', 1.50, NULL, 1, 1, 11, 59, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-15 10:30:22'),
(4, '11380102L', 'T-shirt Sol\'s Regent 11380', 'L', NULL, 't-shirts/BL.png', 1.50, NULL, 1, 1, 11, 61, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-15 10:30:33'),
(5, '11380102XL', 'T-shirt Sol\'s Regent 11380', 'XL', NULL, 't-shirts/BL.png', 1.50, NULL, 1, 1, 11, 65, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-15 10:30:46'),
(6, '11380102XXL', 'T-shirt Sol\'s Regent 11380', 'XXL', NULL, 't-shirts/BL.png', 1.50, NULL, 1, 1, 11, 71, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-15 10:30:53'),
(7, '11380309XS', 'T-shirt Sol\'s Regent 11380 Nior', 'XS', NULL, 't-shirts/NR.png', 1.50, NULL, 1, 1, 10, 18, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-15 11:39:18'),
(8, '11380309S', 'T-shirt Sol\'s Regent 11380 Nior', 'S', NULL, 't-shirts/NR.png', 1.50, NULL, 1, 1, 10, 19, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-15 11:39:28'),
(9, '11380309M', 'T-shirt Sol\'s Regent 11380 Nior', 'M', NULL, 't-shirts/NR.png', 1.50, NULL, 1, 1, 10, 21, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-15 11:39:40'),
(10, '11380309L', 'T-shirt Sol\'s Regent 11380 Nior', 'L', NULL, 't-shirts/NR.png', 1.50, NULL, 1, 1, 10, 26, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-15 11:39:53'),
(11, '11380309XL', 'T-shirt Sol\'s Regent 11380 Nior', 'XL', NULL, 't-shirts/NR.png', 1.50, NULL, 1, 1, 10, 19, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-15 11:40:06'),
(12, '11380309XXL', 'T-shirt Sol\'s Regent 11380 Nior', 'XXL', NULL, 't-shirts/NR.png', 1.50, NULL, 1, 1, 10, 29, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-15 11:40:20'),
(13, '11380115XS', 'T-shirt Sol\'s Regent 11380 Sable', 'XS', NULL, 't-shirts/BG.png', 1.30, NULL, 1, 1, 16, 7, 1, 1, 1, '2025-01-10 05:44:05', '2025-01-15 11:40:34'),
(14, '11380115S', 'T-shirt Sol\'s Regent 11380 Sable', 'S', NULL, 't-shirts/BG.png', 1.50, NULL, 1, 1, 16, 8, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-15 11:40:46'),
(15, '11380115M', 'T-shirt Sol\'s Regent 11380 Sable', 'M', NULL, 't-shirts/BG.png', 1.50, NULL, 1, 1, 16, 5, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-15 11:40:58'),
(16, '11380115L', 'T-shirt Sol\'s Regent 11380 Sable', 'L', NULL, 't-shirts/BG.png', 1.50, NULL, 1, 1, 16, 11, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-15 11:41:09'),
(17, '11380115XL', 'T-shirt Sol\'s Regent 11380 Sable', 'XL', NULL, 't-shirts/BG.png', 1.50, NULL, 1, 1, 16, 11, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-15 11:41:20'),
(18, '11380115XXL', 'T-shirt Sol\'s Regent 11380 Sable', 'XXL', NULL, 't-shirts/BG.png', 1.50, NULL, 1, 1, 16, 9, 1, 1, 1, '2025-01-10 06:07:37', '2025-01-15 11:41:40'),
(19, '11380319XS', 'T-shirt Sol\'s Regent 11380 FRENCH MARINE', 'XS', NULL, 't-shirts/BMF.png', 1.50, NULL, 1, 1, 28, 8, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-15 11:42:00'),
(20, '11380319S', 'T-shirt Sol\'s Regent 11380 FRENCH MARINE', 'S', NULL, 't-shirts/BMF.png', 1.50, NULL, 1, 1, 28, 8, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-15 11:42:13'),
(21, '11380319M', 'T-shirt Sol\'s Regent 11380 FRENCH MARINE', 'M', NULL, 't-shirts/BMF.png', 1.50, NULL, 1, 1, 28, 4, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-15 11:42:25'),
(22, '11380319L', 'T-shirt Sol\'s Regent 11380 FRENCH MARINE', 'L', NULL, 't-shirts/BMF.png', 1.50, NULL, 1, 1, 28, 1, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-15 11:42:38'),
(23, '11380319XL', 'T-shirt Sol\'s Regent 11380 FRENCH MARINE', 'XL', NULL, 't-shirts/BMF.png', 1.50, NULL, 1, 1, 28, 7, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-15 11:42:49'),
(24, '11380319XXL', 'T-shirt Sol\'s Regent 11380 FRENCH MARINE', 'XXL', NULL, 't-shirts/BMF.png', 1.50, NULL, 1, 1, 28, 11, 1, 1, 1, '2025-01-12 06:52:51', '2025-01-15 11:43:01'),
(25, 'MGT50', 'Magnet carré 50mmx50mm', NULL, NULL, 'magnets/MGT50.JPG', NULL, NULL, 2, 1, NULL, NULL, 1, 1, 1, '2025-01-15 12:16:20', '2025-01-15 12:16:20'),
(26, '1197010202A', 'T-shirt Sol\'s Regent  KIDS 11970 Blanc 2Y', '2Y', NULL, NULL, NULL, NULL, 1, 1, 11, NULL, 1, 1, 1, '2025-01-15 12:49:28', '2025-01-15 12:49:28'),
(27, '1197010204A', 'T-shirt Sol\'s Regent  KIDS 11970 Blanc 4Y', '4Y', NULL, NULL, NULL, NULL, 1, 1, 11, NULL, 1, 1, 1, '2025-01-15 12:52:01', '2025-01-15 12:52:01'),
(28, '1197010206A', 'T-shirt Sol\'s Regent  KIDS 11970 Blanc 6Y', '6Y', NULL, NULL, NULL, NULL, 1, 1, 11, NULL, 1, 1, 1, '2025-01-15 12:53:04', '2025-01-15 12:53:04'),
(29, '1197010208A', 'T-shirt Sol\'s Regent  KIDS 11970 Blanc 8Y', '8Y', NULL, NULL, NULL, NULL, 1, 1, 11, NULL, 1, 1, 1, '2025-01-15 12:53:40', '2025-01-15 12:53:40'),
(30, '1197010210A', 'T-shirt Sol\'s Regent  KIDS 11970 Blanc 10Y', '10Y', NULL, NULL, NULL, NULL, 1, 1, 11, NULL, 1, 1, 1, '2025-01-15 12:54:01', '2025-01-15 12:54:01'),
(31, '1197010212A', 'T-shirt Sol\'s Regent  KIDS 11970 Blanc 12Y', '12Y', NULL, NULL, NULL, NULL, 1, 1, 11, NULL, 1, 1, 1, '2025-01-15 12:54:21', '2025-01-15 12:54:21'),
(32, '1197030902A', 'T-shirt Sol\'s Regent  KIDS 11970 Noir profond 2Y', '2Y', NULL, NULL, NULL, NULL, 1, 1, 10, NULL, 1, 1, 1, '2025-01-15 11:49:28', '2025-01-15 11:49:28'),
(33, '1197030904A', 'T-shirt Sol\'s Regent  KIDS 11970 Noir profond 4Y', '4Y', NULL, NULL, NULL, NULL, 1, 1, 10, NULL, 1, 1, 1, '2025-01-15 11:52:01', '2025-01-15 11:52:01'),
(34, '1197030906A', 'T-shirt Sol\'s Regent  KIDS 11970 Noir profond 6Y', '6Y', NULL, NULL, NULL, NULL, 1, 1, 10, NULL, 1, 1, 1, '2025-01-15 11:53:04', '2025-01-15 11:53:04'),
(35, '1197030908A', 'T-shirt Sol\'s Regent  KIDS 11970 Noir profond 8Y', '8Y', NULL, NULL, NULL, NULL, 1, 1, 10, NULL, 1, 1, 1, '2025-01-15 11:53:40', '2025-01-15 11:53:40'),
(36, '1197030910A', 'T-shirt Sol\'s Regent  KIDS 11970 Noir profond 10Y', '10Y', NULL, NULL, NULL, NULL, 1, 1, 10, NULL, 1, 1, 1, '2025-01-15 11:54:01', '2025-01-15 11:54:01'),
(37, '1197030912A', 'T-shirt Sol\'s Regent  KIDS 11970 Noir profond 12Y', '12Y', NULL, NULL, NULL, NULL, 1, 1, 10, NULL, 1, 1, 1, '2025-01-15 11:54:21', '2025-01-15 11:54:21'),
(38, '1197031902A', 'T-shirt Sol\'s Regent  KIDS 11970 French marine 2Y', '2Y', NULL, NULL, NULL, NULL, 1, 1, 28, NULL, 1, 1, 1, '2025-01-15 11:49:28', '2025-01-15 11:49:28'),
(39, '1197031904A', 'T-shirt Sol\'s Regent  KIDS 11970 French marine 4Y', '4Y', NULL, NULL, NULL, NULL, 1, 1, 28, NULL, 1, 1, 1, '2025-01-15 11:52:01', '2025-01-15 11:52:01'),
(40, '1197031906A', 'T-shirt Sol\'s Regent  KIDS 11970 French marine 6Y', '6Y', NULL, NULL, NULL, NULL, 1, 1, 28, NULL, 1, 1, 1, '2025-01-15 11:53:04', '2025-01-15 11:53:04'),
(41, '1197031908A', 'T-shirt Sol\'s Regent  KIDS 11970 French marine 8Y', '8Y', NULL, NULL, NULL, NULL, 1, 1, 28, NULL, 1, 1, 1, '2025-01-15 11:53:40', '2025-01-15 11:53:40'),
(42, '1197031910A', 'T-shirt Sol\'s Regent  KIDS 11970 French marine 10Y', '10Y', NULL, NULL, NULL, NULL, 1, 1, 28, NULL, 1, 1, 1, '2025-01-15 11:54:01', '2025-01-15 11:54:01'),
(43, '1197031912A', 'T-shirt Sol\'s Regent  KIDS 11970 French marine 12Y', '12Y', NULL, NULL, NULL, NULL, 1, 1, 28, NULL, 1, 1, 1, '2025-01-15 11:54:21', '2025-01-15 11:54:21');

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
