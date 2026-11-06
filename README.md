# Allo Maalem — On-Demand Artisans & Trade Services Platform

[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net/)
[![Laravel Framework](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com/)
[![MySQL Database](https://img.shields.io/badge/Database-MySQL%208.0-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Docker Compose](https://img.shields.io/badge/Container-Docker%20Compose-2496ED?style=flat-square&logo=docker&logoColor=white)](https://www.docker.com/)
[![Tailwind CSS](https://img.shields.io/badge/Frontend-Tailwind%20CSS-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)](https://tailwindcss.com/)
[![Stripe API](https://img.shields.io/badge/Payments-Stripe-008CDD?style=flat-square&logo=stripe&logoColor=white)](https://stripe.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)

> A full-stack marketplace web application connecting property owners and clients with certified Moroccan tradesmen (*Maalems*), featuring automated Stripe subscription billing, concurrency-safe hiring logic, multi-criteria geolocation filtering, and real-time proposal workflows.

---

## 📸 Visual Walkthrough & Screenshots

### 1. Visitor & Onboarding Experience
| Landing Page Hero & Trades Feed | Role Selection Registration | Authentication Screen |
| :---: | :---: | :---: |
| ![Landing Page](Docs/screenshots/01-landing-page.png) | ![Register](Docs/screenshots/03-register.png) | ![Login](Docs/screenshots/02-login.png) |
| *Showcases platform benefits, active listings, and trade categories* | *Client vs. Maalem account selection with custom role validation* | *Secure authentication with password recovery and session cookies* |

---

### 2. Client Workspace (Property Owners)
| Client Overview Dashboard | Active Job Management & Statuses | Received Offers & Safe Acceptance |
| :---: | :---: | :---: |
| ![Client Dashboard](Docs/screenshots/04-client-dashboard.png) | ![Client Jobs](Docs/screenshots/05-client-jobs.png) | ![Client Job Offers](Docs/screenshots/06-client-job-offers.png) |
| *Real-time statistics on open, active, and completed requests* | *Tabbed filtering across Open, In-Progress, and Completed projects* | *Inspect artisan proposals, verify quotes, and accept offers* |

| New Job Request Form | Client Account Profile & Verification |
| :---: | :---: |
| ![Create Job](Docs/screenshots/07-client-create-job.png) | ![Client Profile](Docs/screenshots/08-client-profile.png) |
| *Set trade category, budget, Moroccan city, urgency flag, and photos* | *Profile settings and Stripe "Verified Buyer" badge upgrade modal* |

---

### 3. Maalem Workspace (Artisans & Contractors)
| Maalem Performance Dashboard | Marketplace Work Search & Filters | Job Inspection & Proposal Submission |
| :---: | :---: | :---: |
| ![Maalem Dashboard](Docs/screenshots/09-maalem-dashboard.png) | ![Find Work](Docs/screenshots/10-maalem-find-work.png) | ![Job Details](Docs/screenshots/11-maalem-job-details.png) |
| *Active job tracking, pending quote states, and profile rating overview* | *Real-time faceted search by Moroccan city, trade, and minimum budget* | *Review client specifications and submit custom price quotations* |

| My Applications & Client Contact Unlock | Client Reviews & Star Ratings |
| :---: | :---: |
| ![My Applications](Docs/screenshots/12-maalem-applications.png) | ![Reviews](Docs/screenshots/13-maalem-reviews.png) |
| *Direct access to client phone upon offer acceptance; status tracking* | *Client feedback ratings (1-5 stars) and project reviews breakdown* |

---

### 4. Administrator Control Room
| Analytics & Platform Statistics | User Moderation & Sanctions | Category & City Master Data |
| :---: | :---: | :---: |
| ![Admin Dashboard](Docs/screenshots/14-admin-dashboard.png) | ![Admin Users](Docs/screenshots/15-admin-users.png) | ![Admin Settings](Docs/screenshots/17-admin-settings.png) |
| *System KPIs: Total clients, artisans, premium members, and open jobs* | *Search, filter, and ban malicious users with automatic data cleanup* | *Manage Moroccan cities and trade specialties master records* |

| Premium User Roster & Revocation | Financial Ledger & Revenue Tracking |
| :---: | :---: |
| ![Premium Users](Docs/screenshots/16-admin-premium-users.png) | ![Admin Payments](Docs/screenshots/18-admin-payments.png) |
| *Audit verified accounts with immediate administrative status revocation* | *Full Stripe payment transaction audit log with gross platform volume* |

---

## ⚡ Key Features (Verified in Code)

### 👥 Role-Based Access Control (RBAC) & Dedicated Portals
* **Strict Role Segregation:** Custom middleware enforces role authorization (`role:client`, `role:maalem`, `role:admin`), redirecting users automatically to their designated dashboard.
* **Account Sanctions Engine:** Banned users are rejected via `check.banned` middleware; banning a client automatically culls open jobs, while banning a maalem deletes pending proposals.

### 🛡️ Concurrency Safeguards & Anti-Tampering Protections
* **Anti-Price Tampering (Race Condition Defense):** When a client accepts an artisan's offer, the backend matches the client's submitted `expected_price` with the database price in real time. If the artisan modified the quote while the client was reviewing the page, the transaction aborts with an instant warning notice.
* **Anti-Double Recruitment:** Once an offer is accepted, the job status transitions to `in_progress` and all other competing bids are automatically marked `rejected` in a single transaction.
* **Anti-Ghost Application:** Proposals cannot be submitted to jobs that were deleted or closed by the owner while browsing.

### 💼 Quotas & Tiered Premium Subscriptions
* **Free Tier Limits:**
  * Clients: Up to 3 simultaneous open jobs and a maximum of 3 postings per month.
  * Maalems: Maximum 3 simultaneous pending proposals and 10 job bids per month.
* **Stripe Hosted Checkout:** Automated payment processing ($29.99 for Clients, $19.99 for Maalems) that unlocks a verified badge and removes all application and posting quotas.

### ⭐ Quality Assurance & Notifications
* **Post-Completion Review System:** After marking a job `completed`, the client can publish a verified star rating (1–5) and review text for the artisan.
* **Email Notification Engine:** Dispatches notification mailings via `SystemNotificationMail` whenever proposal statuses update.

---

## 🛠️ Tech Stack

| Layer | Technology | Purpose / Highlights |
|---|---|---|
| **Backend Framework** | **Laravel 12.x** (PHP 8.2+) | MVC architecture, Eloquent ORM, custom middleware, form validation |
| **Database** | **MySQL 8.0** | Relational schemas, foreign key constraints, cascading deletions |
| **Frontend UI** | **Blade & Tailwind CSS** | Component architecture, responsive modern design, interactive states |
| **Payments** | **Stripe API (v20.0)** | Stripe Checkout Sessions, subscription fulfillment, and revenue audit |
| **Mailing** | **Symfony Mailer** | System transactional notifications with log driver simulation |
| **Containerization** | **Docker & Docker Compose** | Reproducible multi-service stack with health checks and auto-seeding |
| **E2E Automation** | **Playwright** | Headless browser automation script for screenshot generation and test flows |

---

## 🏛️ Architecture & System Design

### 1. High-Level System Architecture

```mermaid
flowchart TD
    subgraph ClientLayer["Frontend Client Layer"]
        B["Web Browser / Mobile View"]
        BL["Blade Templates + Tailwind CSS + Alpine.js"]
    end

    subgraph AppLayer["Laravel 12 Application Layer"]
        R["Routing (web.php)"]
        M["Middleware (Auth, Role, CheckBanned, CSRF)"]
        C["Controllers (Client, Maalem, Admin, Stripe)"]
        ORM["Eloquent Models (User, Job, Application, Review, Payment)"]
    end

    subgraph StorageLayer["Data & Persistence Layer"]
        DB[("MySQL 8.0 Database")]
        FS["Local File Storage (Job Images)"]
        LOG["Storage Logs / Mail Sink"]
    end

    subgraph ExternalServices["External APIs"]
        STRIPE["Stripe Payment Gateway"]
    end

    B --> BL
    BL -->|HTTP / Session Cookie| R
    R --> M
    M --> C
    C --> ORM
    ORM -->|PDO MySQL| DB
    C -->|Store Uploads| FS
    C -->|Audit Logs| LOG
    C -->|Checkout Sessions| STRIPE
```

---

### 2. Concurrency-Safe Hiring Sequence

```mermaid
sequenceDiagram
    autonumber
    actor Client
    participant Server as Laravel Backend
    participant DB as MySQL Database
    actor Maalem

    Client->>Server: POST /client/jobs (Create Job)
    Server->>DB: INSERT into jobs (status: open)
    Server-->>Client: Job Created Confirmation

    Maalem->>Server: POST /maalem/jobs/{id}/apply
    Server->>DB: INSERT into applications (status: pending, price: 500)
    Server-->>Maalem: Proposal Submitted

    Note over Maalem,Server: Maalem edits quote to 600 MAD concurrently
    Maalem->>Server: PUT /maalem/applications/{id} (price: 600)
    Server->>DB: UPDATE applications (price: 600)

    Note over Client,Server: Client attempts accepting with original 500 MAD quote
    Client->>Server: POST /client/offer/{id}/accept (expected_price: 500)
    Server->>DB: SELECT proposed_price FROM applications WHERE id = {id}
    DB-->>Server: proposed_price = 600
    Server-->>Client: 400 Warning: Price changed by Maalem to 600 MAD. Re-verify!

    Client->>Server: POST /client/offer/{id}/accept (expected_price: 600)
    Server->>DB: UPDATE applications SET status = 'accepted' WHERE id = {id}
    Server->>DB: UPDATE jobs SET status = 'in_progress' WHERE id = {job_id}
    Server->>DB: UPDATE applications SET status = 'rejected' WHERE job_id = {job_id} AND id != {id}
    Server-->>Client: Offer Accepted! Contact Details Unlocked
    Server-->>Maalem: Email Notification Sent
```

---

### 3. Entity-Relationship (ER) Diagram

```mermaid
erDiagram
    USERS ||--o{ JOBS : "publishes (client)"
    USERS ||--o{ APPLICATIONS : "submits (maalem)"
    USERS ||--o{ REVIEWS : "reviews_written (client)"
    USERS ||--o{ REVIEWS : "reviews_received (maalem)"
    USERS ||--o{ PAYMENTS : "subscribes"
    USERS }o--|| CITIES : "located_in"

    CATEGORIES ||--o{ JOBS : "categorizes"
    CITIES ||--o{ JOBS : "located_at"

    JOBS ||--o{ APPLICATIONS : "receives"
    JOBS ||--o| REVIEWS : "evaluated_by"

    USERS {
        bigint id PK
        string name
        string email UK
        string password
        string phone
        enum role "client, maalem, admin"
        string avatar
        text bio
        boolean is_verified
        boolean is_baned
        enum verification_status "unverified, pending, verified"
        timestamp created_at
    }

    JOBS {
        bigint id PK
        string title
        text description
        decimal budget
        enum status "open, in_progress, completed"
        boolean is_urgent
        string image
        bigint user_id FK
        bigint category_id FK
        bigint city_id FK
        timestamp created_at
    }

    APPLICATIONS {
        bigint id PK
        decimal proposed_price
        text message
        enum status "pending, accepted, rejected"
        bigint job_id FK
        bigint user_id FK
        timestamp created_at
    }

    REVIEWS {
        bigint id PK
        int rating "1 to 5"
        text comment
        bigint job_id FK
        bigint reviewer_id FK
        bigint reviewed_id FK
        timestamp created_at
    }

    PAYMENTS {
        bigint id PK
        bigint user_id FK
        string name
        string email
        decimal price
        timestamp created_at
    }

    CATEGORIES {
        bigint id PK
        string name UK
    }

    CITIES {
        bigint id PK
        string name UK
    }
```

---

## 🚀 Getting Started

### Prerequisites
* **[Docker](https://docs.docker.com/get-docker/)** and **[Docker Compose](https://docs.docker.com/compose/)** installed and running on your system.
* No local PHP, Composer, or MySQL installation is required on your host machine.

---

### 1. Clone the Repository
```bash
git clone https://github.com/yassinmaftah/AlloMaalem.git
cd AlloMaalem
```

---

### 2. Environment Configuration
Copy the provided environment template:
```bash
cp .env.example .env
```
*(The Docker Compose setup comes preconfigured with default database credentials and container DNS routing out of the box).*

---

### 3. Run with Docker Compose (Recommended)
Launch the entire stack (PHP 8.2 application server + MySQL 8.0 database):
```bash
docker compose up --build -d
```

#### What Docker handles automatically on first boot:
1. Builds the container with all required PHP extensions (`pdo_mysql`, `pdo_sqlite`, `mbstring`, `zip`, `bcmath`).
2. Installs Composer dependencies and optimizes autoload files.
3. Awaits MySQL database readiness.
4. Executes database migrations and seeds 15 Moroccan cities, 10 trades, demo accounts, and 30 realistic jobs with proposals and reviews.
5. Serves the application on **`http://localhost:8000`**.

---

### 4. Default Seeded Credentials

| Role | Email | Password | Access Level & Features |
|---|---|---|---|
| **Administrator** | `admin1@allomaalem.com` | `password123` | Platform analytics, revenue history, user ban/unban, master data |
| **Client** | `ahmed@example.com` | `password123` | Post jobs, inspect applications, safe-hire maalems, review completed work |
| **Maalem (Artisan)** | `hassan@example.com` | `password123` | Search jobs by city/trade, submit price proposals, track status |

*Additional demo accounts:*
* Clients: `fatima@example.com`, `mohammed@example.com` (password: `password123`)
* Maalems: `youssef@example.com`, `samir@example.com` (password: `password123`)
* Admins: `admin2@allomaalem.com`, `admin3@allomaalem.com` (password: `password123`)

---

### 5. Running Without Docker (Manual Local Setup)

If you have a local PHP 8.2+, MySQL, and Node environment configured:

```bash
# 1. Install dependencies
composer install
npm install && npm run build

# 2. Configure environment
cp .env.example .env
php artisan key:generate

# 3. Setup database (Configure MySQL credentials in .env first)
php artisan migrate --seed

# 4. Create storage symlink
php artisan storage:link

# 5. Start development server
php artisan serve
```

---

## 📁 Project Structure

```plaintext
AlloMaalem/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/               # Admin dashboards, moderation, settings, revenue
│   │   │   ├── Auth/                # Auth, registration, 6-digit password recovery
│   │   │   ├── Client/              # Client job postings, offer accept/reject, reviews
│   │   │   ├── Maalem/              # Maalem job search, bidding, and proposal tracking
│   │   │   ├── StripePaymentController.php # Stripe checkout and payment callbacks
│   │   │   └── DashboardController.php     # RBAC redirection controller
│   │   └── Middleware/              # Role verification and banned account blocker
│   ├── Mail/                        # Transactional mailable notifications
│   └── Models/                      # Eloquent models (User, Job, Application, Review, Payment)
├── database/
│   ├── migrations/                  # Schema definitions with foreign key constraints
│   └── seeders/                     # DatabaseSeeder with Moroccan cities, trades, & jobs
├── docs/
│   ├── screenshots/                 # High-resolution application screenshots
│   └── api-examples.md              # Detailed API endpoint & lifecycle documentation
├── resources/
│   └── views/                       # Blade templates styled with Tailwind CSS
│       ├── admin/                   # Admin management views
│       ├── auth/                    # Login, registration, and reset views
│       ├── client/                  # Client job boards and offer views
│       └── maalem/                  # Artisan marketplace and application tracking
├── routes/
│   └── web.php                      # Application routes grouped by role middleware
├── scripts/
│   ├── package.json                 # Script dependencies descriptor
│   └── screenshots.js               # Headless Playwright script capturing all app flows
├── docker-compose.yml               # Multi-container orchestration (App + MySQL 8.0)
├── docker-entrypoint.sh             # Self-healing container startup & database seeder
├── Dockerfile                       # Multi-stage production PHP 8.2 Alpine build
└── README.md                        # Portfolio documentation
```

---

## 📑 API Reference & Endpoints

A complete endpoint specification including request payloads, validation rules, error handling, and authorization requirements is available in:

👉 **[Docs/api-examples.md](Docs/api-examples.md)**

---

## 💡 Key Engineering Challenges & Learnings

1. **Mitigating Asynchronous Price Modifications (Race Conditions):**
   * *Problem:* In an active marketplace, an artisan could modify their quoted price while a client is reviewing an earlier bid on screen, leading to unexpected charges upon acceptance.
   * *Solution:* Implemented an optimistic locking verification in `ClientJobController@accept` that cross-checks the client's submitted `expected_price` with the persisted quotation in the database before finalizing the deal.
2. **Containerizing Modern Laravel 12 on Alpine Linux:**
   * *Problem:* Minimizing Docker image sizes while compiling required native C extensions (`pdo_mysql`, `pdo_sqlite`, `bcmath`, `mbstring`) and maintaining swift startup times.
   * *Solution:* Leveraged Docker layer caching by copying `composer.json` and `composer.lock` first, compiling the vendor tree during image build, and implementing a self-healing entrypoint script that handles database availability checks before running migrations.
3. **Decoupled Quota Enforcement:**
   * *Problem:* Free-tier abuse prevention without degrading user experience for paying subscribers.
   * *Solution:* Implemented date-based monthly query constraints (`whereMonth('created_at', date('m'))`) and active status counters that dynamically bypass checks when `verification_status === 'verified'`.

---

## 🔮 Future Improvements

- [ ] **Real-Time WebSockets:** Implement Laravel Reverb or Pusher for instant in-app notifications when a new quotation arrives.
- [ ] **Interactive Geolocation Map:** Integrate Leaflet.js / OpenStreetMap for visual distance calculations between clients and nearby Maalems.
- [ ] **Escrow Payment Integration:** Hold job funds in escrow via Stripe until both parties confirm project sign-off.
- [ ] **Multi-Language Support (i18n):** Add full Darija (Moroccan Arabic) and French localization toggles.

---

## 👤 Author

* **Developer:** Yassin Maftah
* **GitHub:** [@yassinmaftah](https://github.com/yassinmaftah)
* **LinkedIn:** [Yassin Maftah](https://www.linkedin.com/in/yassine-maftah-b5793933b/)
* **Project Repository:** [https://github.com/yassinmaftah/AlloMaalem](https://github.com/yassinmaftah/AlloMaalem)

