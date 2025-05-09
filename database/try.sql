-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for try
CREATE DATABASE IF NOT EXISTS `try` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `try`;

-- Dumping structure for table try.access_requests
CREATE TABLE IF NOT EXISTS `access_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint unsigned NOT NULL,
  `doctor_id` bigint unsigned NOT NULL,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `access_requests_patient_id_foreign` (`patient_id`),
  KEY `access_requests_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `access_requests_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `access_requests_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.access_requests: ~0 rows (approximately)

-- Dumping structure for table try.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.cache: ~0 rows (approximately)

-- Dumping structure for table try.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.cache_locks: ~0 rows (approximately)

-- Dumping structure for table try.checkups
CREATE TABLE IF NOT EXISTS `checkups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `schedule_id` bigint unsigned NOT NULL,
  `complaint` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `diagnosis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('checkup','waiting_medicine','done','canceled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkup_price` bigint NOT NULL DEFAULT '0',
  `total_price` bigint NOT NULL DEFAULT '0',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `checkups_user_id_foreign` (`user_id`),
  KEY `checkups_schedule_id_foreign` (`schedule_id`),
  CONSTRAINT `checkups_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`),
  CONSTRAINT `checkups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.checkups: ~0 rows (approximately)
INSERT IGNORE INTO `checkups` (`id`, `patient_id`, `user_id`, `schedule_id`, `complaint`, `diagnosis`, `status`, `checkup_price`, `total_price`, `note`, `created_at`, `updated_at`) VALUES
	(20, NULL, 16, 6, 'p', NULL, 'done', 150000, 210000, 'istirahat cukup', '2025-03-12 21:11:20', '2025-03-12 21:17:18'),
	(21, NULL, 16, 4, 'p', NULL, 'checkup', 0, 0, NULL, '2025-03-12 23:14:59', '2025-03-12 23:14:59');

-- Dumping structure for table try.details
CREATE TABLE IF NOT EXISTS `details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `checkup_id` bigint unsigned NOT NULL,
  `medicine_id` bigint unsigned NOT NULL,
  `application` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `price` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `details_checkup_id_foreign` (`checkup_id`),
  KEY `details_medicine_id_foreign` (`medicine_id`),
  CONSTRAINT `details_checkup_id_foreign` FOREIGN KEY (`checkup_id`) REFERENCES `checkups` (`id`),
  CONSTRAINT `details_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.details: ~0 rows (approximately)
INSERT IGNORE INTO `details` (`id`, `checkup_id`, `medicine_id`, `application`, `qty`, `price`, `created_at`, `updated_at`) VALUES
	(14, 20, 3, '3 kali 1', 6, 10000, '2025-03-12 21:16:34', '2025-03-12 21:16:34');

-- Dumping structure for table try.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table try.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.jobs: ~0 rows (approximately)

-- Dumping structure for table try.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.job_batches: ~0 rows (approximately)

-- Dumping structure for table try.medical_access_requests
CREATE TABLE IF NOT EXISTS `medical_access_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint unsigned NOT NULL,
  `patient_id` bigint unsigned NOT NULL,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medical_access_requests_doctor_id_foreign` (`doctor_id`),
  KEY `medical_access_requests_patient_id_foreign` (`patient_id`),
  CONSTRAINT `medical_access_requests_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `medical_access_requests_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.medical_access_requests: ~2 rows (approximately)
INSERT IGNORE INTO `medical_access_requests` (`id`, `doctor_id`, `patient_id`, `status`, `expires_at`, `created_at`, `updated_at`) VALUES
	(16, 9, 16, 'approved', '2025-03-12 21:14:28', '2025-03-12 21:12:07', '2025-03-12 21:12:28'),
	(17, 9, 16, 'approved', '2025-03-12 21:19:46', '2025-03-12 21:17:24', '2025-03-12 21:17:46'),
	(18, 9, 16, 'approved', '2025-03-12 23:20:22', '2025-03-12 23:16:46', '2025-03-12 23:18:22');

-- Dumping structure for table try.medical_requests
CREATE TABLE IF NOT EXISTS `medical_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint unsigned NOT NULL,
  `patient_id` bigint unsigned NOT NULL,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medical_requests_doctor_id_foreign` (`doctor_id`),
  KEY `medical_requests_patient_id_foreign` (`patient_id`),
  CONSTRAINT `medical_requests_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `medical_requests_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.medical_requests: ~0 rows (approximately)

-- Dumping structure for table try.medicines
CREATE TABLE IF NOT EXISTS `medicines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.medicines: ~0 rows (approximately)
INSERT IGNORE INTO `medicines` (`id`, `name`, `unit`, `price`, `created_at`, `updated_at`) VALUES
	(3, 'paracetamol', '500gr', 10000, '2025-03-12 21:15:41', '2025-03-12 21:15:41');

-- Dumping structure for table try.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.migrations: ~17 rows (approximately)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_12_11_143421_create_polies_table', 1),
	(5, '2024_12_11_143505_create_schedules_table', 1),
	(7, '2024_12_11_144404_create_checkups_table', 1),
	(15, '2024_12_11_144055_create_medicines_table', 2),
	(16, '2024_12_11_145920_create_details_table', 2),
	(17, '2024_12_29_035022_create_personal_access_tokens_table', 2),
	(18, '2025_02_25_042653_create_medical_requests_table', 2),
	(19, '2025_02_25_080123_create_medical_access_requests_table', 2),
	(20, '2025_02_25_081225_create_access_requests_table', 2),
	(22, '2025_03_08_195106_add_expires_at_to_medical_access_requests', 3),
	(23, '2025_03_10_112358_add_birth_date_to_users_table', 4),
	(24, '2025_03_10_123305_add_blood_type_to_users_table', 5),
	(25, '2025_03_10_123613_make_id_number_nullable', 6),
	(26, '2025_03_10_133727_add_diagnosis_to_checkups', 7);

-- Dumping structure for table try.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table try.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table try.polies
CREATE TABLE IF NOT EXISTS `polies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.polies: ~2 rows (approximately)
INSERT IGNORE INTO `polies` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Poli Gigi', 'Keluhan Gigi dan Mulut', '2025-02-24 21:19:14', '2025-03-08 11:06:13'),
	(2, 'Poli Umum', 'Keluhan umum', '2025-03-08 11:06:00', '2025-03-08 11:06:00');

-- Dumping structure for table try.schedules
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `poly_id` bigint unsigned NOT NULL,
  `day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_user_id_foreign` (`user_id`),
  KEY `schedules_poly_id_foreign` (`poly_id`),
  CONSTRAINT `schedules_poly_id_foreign` FOREIGN KEY (`poly_id`) REFERENCES `polies` (`id`),
  CONSTRAINT `schedules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.schedules: ~2 rows (approximately)
INSERT IGNORE INTO `schedules` (`id`, `user_id`, `poly_id`, `day`, `start`, `finish`, `status`, `created_at`, `updated_at`) VALUES
	(4, 9, 2, 'monday', '10:00:00', '17:00:00', 1, '2025-03-08 11:09:07', '2025-03-08 11:13:56'),
	(5, 9, 2, 'tuesday', '10:00:00', '17:00:00', 1, '2025-03-08 11:10:45', '2025-03-08 11:10:49'),
	(6, 9, 1, 'wednesday', '00:10:00', '14:10:00', 1, '2025-03-12 21:10:01', '2025-03-12 21:10:05');

-- Dumping structure for table try.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.sessions: ~2 rows (approximately)
INSERT IGNORE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('nSCDlzQsRKiQayyGbudeVzJWFAMuxRdCXFClc7vr', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMGhabnhMYTdrQ3VKTmptcFVlZktSTXl6OHZBRHVoVmpkQUdEeHdVZSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyOToiaHR0cDovL3Byb2R1Y3Rpb24udGVzdC9sb2dvdXQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyODoiaHR0cDovL3Byb2R1Y3Rpb24udGVzdC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1741847421),
	('ysgsUf1dLbXRtL9o0JzdxdnHlg3XJKH9XOrdNm64', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoienpFdFpXREpnOW84VGIzbnZhbE4wWGxsbFhwb0I5Z3Y4SEZ5UjJ5dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9wcm9kdWN0aW9uLnRlc3QvYWRtaW4vdXNlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1744438330);

-- Dumping structure for table try.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('patient','pharmacist','doctor','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'patient',
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table try.users: ~3 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `phone`, `blood_type`, `id_number`, `rm`, `role`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `birth_date`) VALUES
	(1, 'admin', 'admin@gmail.com', '082158863345', NULL, '3326132010000001', NULL, 'admin', 'semarang', NULL, '$2y$12$ugtXeTgKy25KeRCcqk/QmOyRT9dwX3AzZVhzmDKGaJZB1wVmMzody', NULL, '2025-02-24 21:17:00', '2025-02-24 21:17:00', NULL),
	(9, 'Putra', 'putradokter@gmail.com', '080101010101', NULL, '0101010101010101', NULL, 'doctor', 'Jakarta', NULL, '$2y$12$uxE9qO0GDCMqGykofKjF0eaqJxdJqb49lG2ztc92s9y2K69u5F8jq', NULL, '2025-03-08 11:05:05', '2025-03-08 11:05:05', NULL),
	(15, 'Wisnu', '20040306@example.com', '090909090909', 'O', NULL, '202503-001', 'patient', 'Jakarta', NULL, '$2y$12$8.Fo8l4MtfeDa4XYaby.5uHITZC.Y8nwbOktmla9bNwdMtVXyID0O', NULL, '2025-03-10 05:37:41', '2025-03-10 05:37:41', '2004-03-06'),
	(16, 'Amanda Afri liandini', '20250306@example.com', '085226103501', 'A', NULL, '202503-002', 'patient', 'Purwokerto', NULL, '$2y$12$Nb.Ca2j/kYAP3YDzDykzhOV7OppGmSzuw1doO5.xkfBbUhv2NXO06', NULL, '2025-03-12 21:10:52', '2025-03-12 21:10:52', '2025-03-06');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
