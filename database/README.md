# SmartHire Flow Database Documentation

This document describes the database tables, columns, and relationships used by the SmartHire Flow application.

## Tables

### `users`
Stores platform users and authentication data.

Columns:
- `id` BIGINT UNSIGNED PRIMARY KEY
- `name` VARCHAR(255) NOT NULL
- `email` VARCHAR(255) NOT NULL UNIQUE
- `email_verified_at` DATETIME NULL
- `password` VARCHAR(255) NOT NULL
- `remember_token` VARCHAR(100) NULL
- `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
- `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

### `job_applications`
Tracks job applications for each user.

Columns:
- `id` BIGINT UNSIGNED PRIMARY KEY
- `user_id` BIGINT UNSIGNED NOT NULL
- `company_name` VARCHAR(255) NOT NULL
- `job_title` VARCHAR(255) NOT NULL
- `location` VARCHAR(255) NULL
- `job_description` TEXT NULL
- `source` VARCHAR(255) NULL
- `external_url` VARCHAR(1024) NULL
- `status` ENUM('Applied','Interview','Offer','Rejected') NOT NULL DEFAULT 'Applied'
- `applied_at` DATE NULL
- `next_action_at` DATETIME NULL
- `salary_range` VARCHAR(255) NULL
- `recruiter_name` VARCHAR(255) NULL
- `recruiter_email` VARCHAR(255) NULL
- `recruiter_phone` VARCHAR(50) NULL
- `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
- `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

Indexes:
- `idx_job_applications_user_id` (`user_id`)
- `idx_job_applications_status` (`status`)

Foreign key:
- `user_id` → `users.id`

### `notes`
Stores notes, reminders, and follow-up content for job applications.

Columns:
- `id` BIGINT UNSIGNED PRIMARY KEY
- `job_application_id` BIGINT UNSIGNED NOT NULL
- `user_id` BIGINT UNSIGNED NOT NULL
- `content` TEXT NOT NULL
- `note_type` ENUM('note','reminder','follow_up') NOT NULL DEFAULT 'note'
- `pinned` TINYINT(1) NOT NULL DEFAULT 0
- `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
- `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

Indexes:
- `idx_notes_job_application_id` (`job_application_id`)
- `idx_notes_user_id` (`user_id`)

Foreign keys:
- `job_application_id` → `job_applications.id`
- `user_id` → `users.id`

### `generated_documents`
Stores generated AI documents and automation outputs.

Columns:
- `id` BIGINT UNSIGNED PRIMARY KEY
- `job_application_id` BIGINT UNSIGNED NOT NULL
- `user_id` BIGINT UNSIGNED NOT NULL
- `document_type` ENUM('cover_letter','follow_up_email','job_summary','recommendation') NOT NULL DEFAULT 'cover_letter'
- `provider` ENUM('openai','other') NOT NULL DEFAULT 'openai'
- `prompt` TEXT NULL
- `content` LONGTEXT NULL
- `status` ENUM('pending','completed','failed') NOT NULL DEFAULT 'pending'
- `error_message` TEXT NULL
- `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
- `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

Indexes:
- `idx_generated_documents_job_application_id` (`job_application_id`)
- `idx_generated_documents_user_id` (`user_id`)

Foreign keys:
- `job_application_id` → `job_applications.id`
- `user_id` → `users.id`

### `activities`
Stores activity timeline events and audit records.

Columns:
- `id` BIGINT UNSIGNED PRIMARY KEY
- `job_application_id` BIGINT UNSIGNED NOT NULL
- `user_id` BIGINT UNSIGNED NOT NULL
- `activity_type` ENUM('status_change','note_added','document_generated','workflow_triggered','application_updated') NOT NULL
- `description` TEXT NULL
- `changes` JSON NULL
- `metadata` JSON NULL
- `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
- `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

Indexes:
- `idx_activities_job_application_id` (`job_application_id`)
- `idx_activities_user_id` (`user_id`)

Foreign keys:
- `job_application_id` → `job_applications.id`
- `user_id` → `users.id`

## Relationships

- `users` 1 → many `job_applications`
- `job_applications` 1 → many `notes`
- `job_applications` 1 → many `generated_documents`
- `job_applications` 1 → many `activities`
- `users` 1 → many `notes`
- `users` 1 → many `generated_documents`
- `users` 1 → many `activities`

## Notes

- The schema is intended for MySQL with `utf8mb4` support.
- Foreign keys should use `ON DELETE CASCADE` so related child records are cleaned up when a parent record is removed.
- This document is separate from the main `README.md` and focused solely on database design.
# SmartHire Flow Database Schema

This document describes the database tables, columns, and relationships used by SmartHire Flow.

## Tables

### users
Stores application users and authentication metadata.

Columns:
- `id` BIGINT UNSIGNED PK
- `name` VARCHAR(255)
- `email` VARCHAR(255) UNIQUE
- `email_verified_at` DATETIME NULL
- `password` VARCHAR(255)
- `remember_token` VARCHAR(100) NULL
- `created_at` TIMESTAMP
- `updated_at` TIMESTAMP

### job_applications
Tracks job applications submitted by users.

Columns:
- `id` BIGINT UNSIGNED PK
- `user_id` BIGINT UNSIGNED FK → `users.id`
- `company_name` VARCHAR(255)
- `job_title` VARCHAR(255)
- `location` VARCHAR(255) NULL
- `job_description` TEXT NULL
- `source` VARCHAR(255) NULL
- `external_url` VARCHAR(1024) NULL
- `status` ENUM('Applied','Interview','Offer','Rejected')
- `applied_at` DATE NULL
- `next_action_at` DATETIME NULL
- `salary_range` VARCHAR(255) NULL
- `recruiter_name` VARCHAR(255) NULL
- `recruiter_email` VARCHAR(255) NULL
- `recruiter_phone` VARCHAR(50) NULL
- `created_at` TIMESTAMP
- `updated_at` TIMESTAMP

Indexes:
- `idx_job_applications_user_id`
- `idx_job_applications_status`

### notes
Stores notes and reminders for each job application.

Columns:
- `id` BIGINT UNSIGNED PK
- `job_application_id` BIGINT UNSIGNED FK → `job_applications.id`
- `user_id` BIGINT UNSIGNED FK → `users.id`
- `content` TEXT
- `note_type` ENUM('note','reminder','follow_up')
- `pinned` TINYINT(1)
- `created_at` TIMESTAMP
- `updated_at` TIMESTAMP

Indexes:
- `idx_notes_job_application_id`
- `idx_notes_user_id`

### generated_documents
Stores AI-generated documents and workflow outputs.

Columns:
- `id` BIGINT UNSIGNED PK
- `job_application_id` BIGINT UNSIGNED FK → `job_applications.id`
- `user_id` BIGINT UNSIGNED FK → `users.id`
- `document_type` ENUM('cover_letter','follow_up_email','job_summary','recommendation')
- `provider` ENUM('openai','other')
- `prompt` TEXT NULL
- `content` LONGTEXT NULL
- `status` ENUM('pending','completed','failed')
- `error_message` TEXT NULL
- `created_at` TIMESTAMP
- `updated_at` TIMESTAMP

Indexes:
- `idx_generated_documents_job_application_id`
- `idx_generated_documents_user_id`

### activities
Stores application activity timeline events and audit metadata.

Columns:
- `id` BIGINT UNSIGNED PK
- `job_application_id` BIGINT UNSIGNED FK → `job_applications.id`
- `user_id` BIGINT UNSIGNED FK → `users.id`
- `activity_type` ENUM('status_change','note_added','document_generated','workflow_triggered','application_updated')
- `description` TEXT NULL
- `changes` JSON NULL
- `metadata` JSON NULL
- `created_at` TIMESTAMP
- `updated_at` TIMESTAMP

Indexes:
- `idx_activities_job_application_id`
- `idx_activities_user_id`

## Relationships

- `users` 1 → many `job_applications`
- `job_applications` 1 → many `notes`
- `job_applications` 1 → many `generated_documents`
- `job_applications` 1 → many `activities`
- `users` 1 → many `notes`
- `users` 1 → many `generated_documents`
- `users` 1 → many `activities`

## Notes

- All foreign key relations use `ON DELETE CASCADE` for cleanup when a user or job application is removed.
- The schema is designed for MySQL with `utf8mb4` character support.
