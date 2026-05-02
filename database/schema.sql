-- SmartHire Flow database schema for MySQL
-- Based on README MVP requirements and planned tables.

CREATE DATABASE IF NOT EXISTS `smarthire_flow` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `smarthire_flow`;

CREATE TABLE `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `email_verified_at` DATETIME NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `job_applications` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `company_name` VARCHAR(255) NOT NULL,
  `job_title` VARCHAR(255) NOT NULL,
  `location` VARCHAR(255) NULL,
  `job_description` TEXT NULL,
  `source` VARCHAR(255) NULL,
  `external_url` VARCHAR(1024) NULL,
  `status` ENUM('Applied','Interview','Offer','Rejected') NOT NULL DEFAULT 'Applied',
  `applied_at` DATE NULL,
  `next_action_at` DATETIME NULL,
  `salary_range` VARCHAR(255) NULL,
  `recruiter_name` VARCHAR(255) NULL,
  `recruiter_email` VARCHAR(255) NULL,
  `recruiter_phone` VARCHAR(50) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_job_applications_user_id` (`user_id`),
  INDEX `idx_job_applications_status` (`status`),
  CONSTRAINT `fk_job_applications_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `notes` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_application_id` BIGINT UNSIGNED NOT NULL,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `content` TEXT NOT NULL,
  `note_type` ENUM('note','reminder','follow_up') NOT NULL DEFAULT 'note',
  `pinned` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_notes_job_application_id` (`job_application_id`),
  INDEX `idx_notes_user_id` (`user_id`),
  CONSTRAINT `fk_notes_job_application` FOREIGN KEY (`job_application_id`) REFERENCES `job_applications`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_notes_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `generated_documents` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_application_id` BIGINT UNSIGNED NOT NULL,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `document_type` ENUM('cover_letter','follow_up_email','job_summary','recommendation') NOT NULL DEFAULT 'cover_letter',
  `provider` ENUM('openai','other') NOT NULL DEFAULT 'openai',
  `prompt` TEXT NULL,
  `content` LONGTEXT NULL,
  `status` ENUM('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `error_message` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_generated_documents_job_application_id` (`job_application_id`),
  INDEX `idx_generated_documents_user_id` (`user_id`),
  CONSTRAINT `fk_generated_documents_job_application` FOREIGN KEY (`job_application_id`) REFERENCES `job_applications`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_generated_documents_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `activities` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_application_id` BIGINT UNSIGNED NOT NULL,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `activity_type` ENUM('status_change','note_added','document_generated','workflow_triggered','application_updated') NOT NULL,
  `description` TEXT NULL,
  `changes` JSON NULL,
  `metadata` JSON NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_activities_job_application_id` (`job_application_id`),
  INDEX `idx_activities_user_id` (`user_id`),
  CONSTRAINT `fk_activities_job_application` FOREIGN KEY (`job_application_id`) REFERENCES `job_applications`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_activities_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
