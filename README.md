# smarthire-flow
AI-powered job application tracking platform built with Laravel, n8n automation, and smart follow-up workflows.

Overview

SmartHire Flow is a full-stack job application management platform designed to help users organize, track, and automate their job search process.

The platform allows users to manage job applications, track interview progress, store notes, and automate repetitive tasks such as generating personalized cover letters and scheduling follow-up reminders.

SmartHire Flow combines Laravel for the application layer, n8n for workflow automation, and OpenAI for AI-powered document generation.

This project is built to demonstrate modern full-stack development, workflow automation, API integrations, and real-world SaaS architecture.

⸻

Features

Core Features

* User authentication and account management
* Job application tracking dashboard
* Create, update, and manage job applications
* Track application stages (Applied, Interview, Offer, Rejected)
* Add personal notes for each application
* Activity timeline for application updates
* Search and filter job applications

Automation Features

* Trigger automated workflows when a new job application is created
* Generate personalized AI cover letters
* Automate follow-up reminders
* Generate recruiter follow-up email drafts
* Send status-based notifications
* Weekly application summary automation

AI Features

* AI-generated personalized cover letters
* AI-generated follow-up email drafts
* Job description summarization
* Smart job insights and recommendations

⸻

Tech Stack

Backend

* Laravel 11
* PHP 8.3
* Laravel Sanctum
* Laravel Queues
* Laravel Scheduler

Frontend

* Blade
* Tailwind CSS
* Vite

Database

* MySQL

Automation

* n8n

AI Integration

* OpenAI API

Dev Tools

* Docker
* Redis
* Mailpit
* Postman

⸻

Architecture

SmartHire Flow uses a hybrid architecture where Laravel manages the core application and n8n handles automation workflows.

System Flow

1. User creates a new job application
2. Laravel stores the application in the database
3. Laravel sends job data to n8n via webhook
4. n8n triggers an automation workflow
5. OpenAI generates personalized content
6. n8n sends generated content back to Laravel
7. Laravel stores and displays the generated result

Architecture Overview

User → Laravel UI → Laravel Backend → n8n Workflow → OpenAI API → Laravel Database

⸻

Project Structure

smarthire-flow/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── n8n-workflows/
├── docs/
├── screenshots/
└── README.md

⸻

MVP Scope

The first version of SmartHire Flow focuses on the core job tracking workflow.

MVP Includes

* User authentication
* Dashboard
* Job application CRUD
* Application status tracking
* Notes
* Basic Kanban board
* n8n webhook integration
* AI-generated cover letter workflow

Planned for Later

* Recruiter contact management
* Interview calendar sync
* Resume version tracking
* Job match scoring
* Team collaboration
* Export reports

⸻

Database Design

Main tables planned for MVP:

* users
* job_applications
* notes
* generated_documents
* activities

⸻

API Workflow

Laravel → n8n

When a new job application is created, Laravel sends job data to an n8n webhook.

n8n → OpenAI

n8n processes the payload and sends a prompt to OpenAI for content generation.

n8n → Laravel

n8n returns the generated content to Laravel through a callback endpoint.

⸻

Local Development Setup

Requirements

* PHP 8.2+
* Composer
* Node.js
* MySQL
* Docker
* Git

Setup

git clone https://github.com/your-username/smarthire-flow.git
cd smarthire-flow
composer install
npm install
cp .env.example .env
php artisan key:generate

⸻

Development Roadmap

Phase 1

* Project setup
* Authentication
* Database schema
* Job application CRUD

Phase 2

* Dashboard
* Kanban board
* Notes
* Activity timeline

Phase 3

* n8n integration
* AI cover letter workflow
* Follow-up automation

Phase 4

* Notifications
* Analytics
* Advanced automation

⸻

Screenshots

Screenshots will be added as the UI is implemented.

Planned screenshots:

* Dashboard
* Job application board
* Job detail page
* AI-generated cover letter
* n8n workflow overview

⸻

Future Improvements

* AI resume optimization
* Recruiter CRM
* Interview preparation assistant
* Multi-user collaboration
* Advanced analytics dashboard
* Chrome extension for saving job posts

⸻

Why This Project

SmartHire Flow was built to demonstrate practical full-stack engineering using Laravel, workflow automation using n8n, and modern AI-powered product thinking.

This project focuses on solving a real-world problem while showcasing backend architecture, API integrations, async workflows, and scalable SaaS design.

⸻

License

MIT