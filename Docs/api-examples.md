# Allo Maalem — API & Endpoint Reference

This document provides a comprehensive reference of all HTTP routes, controllers, request payloads, and response lifecycles implemented in **Allo Maalem**.

---

## Table of Contents

1. [Authentication & Guest Endpoints](#1-authentication--guest-endpoints)
2. [Password Reset Flow](#2-password-reset-flow)
3. [Client Endpoints](#3-client-endpoints)
4. [Maalem (Artisan) Endpoints](#4-maalem-artisan-endpoints)
5. [Premium Verification & Stripe Integration](#5-premium-verification--stripe-integration)
6. [Administrator Endpoints](#6-administrator-endpoints)

---

## 1. Authentication & Guest Endpoints

### 1.1 User Registration
* **Endpoint:** `POST /register`
* **Controller:** `AuthController@register`
* **Middleware:** `guest`
* **Request Payload (Form / Multi-part):**
  ```json
  {
    "name": "Youssef Bennani",
    "email": "youssef@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "0622000002",
    "role": "maalem",
    "bio": "Expert electrician with 10 years experience"
  }
  ```
* **Validation Rules:**
  * `name`: `required|string|max:255`
  * `email`: `required|string|email|max:255|unique:users`
  * `password`: `required|string|min:8|confirmed`
  * `phone`: `required|string|max:20`
  * `role`: `required|in:client,maalem`
* **Response:** Redirect to `/dashboard` with active session.

### 1.2 User Login
* **Endpoint:** `POST /login`
* **Controller:** `AuthController@login`
* **Middleware:** `guest`
* **Request Payload:**
  ```json
  {
    "email": "ahmed@example.com",
    "password": "password123",
    "remember": true
  }
  ```
* **Response:**
  * **Success:** Redirects to role-specific dashboard (`/client/dashboard`, `/maalem/dashboard`, or `/admin/dashboard`).
  * **Banned Account:** Blocks login with error: `"Your account has been suspended by the administration."`

### 1.3 User Logout
* **Endpoint:** `POST /logout`
* **Controller:** `AuthController@logout`
* **Middleware:** `auth`
* **Response:** Redirect to `/login` with session invalidated and CSRF token regenerated.

---

## 2. Password Reset Flow

The platform implements a secure, custom 6-digit verification code mechanism for account recovery.

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/forgot-password` | Displays email prompt form |
| `POST` | `/forgot-password` | Generates 6-digit code, stores with expiration, dispatches email |
| `GET` | `/verify-code` | Screen to enter 6-digit recovery code |
| `POST` | `/verify-code` | Validates code matching and TTL |
| `GET` | `/reset-password` | Password change form |
| `POST` | `/reset-password` | Updates user password and flushes reset token |

---

## 3. Client Endpoints

All client routes require `auth`, `role:client`, and `check.banned`.

### 3.1 Job Creation
* **Endpoint:** `POST /client/jobs`
* **Controller:** `ClientJobController@store`
* **Request Payload:**
  ```json
  {
    "title": "Kitchen Plumbing Repair",
    "description": "Urgent sink leakage repair under the main cabinet.",
    "budget": 450.00,
    "category_id": 1,
    "city_id": 1,
    "is_urgent": "1",
    "image": "<binary_upload>"
  }
  ```
* **Business Safeguards:**
  * Unverified clients are limited to **3 simultaneous open jobs** and **3 job postings per month**.
  * Verified (Premium) clients enjoy unlimited job postings.

### 3.2 Accept Maalem Offer (With Anti-Race Condition Protection)
* **Endpoint:** `POST /client/offer/{id}/accept`
* **Controller:** `ClientJobController@accept`
* **Request Payload:**
  ```json
  {
    "expected_price": 400.00
  }
  ```
* **Race Condition Defense:**
  ```php
  // app/Http/Controllers/Client/ClientJobController.php
  if ($request->expected_price != $offer->proposed_price) {
      return redirect()->back()->with('error',
          'Wait! The Maalem just updated their price to ' . $offer->proposed_price . ' MAD. Please review the new offer before accepting.'
      );
  }
  ```
* **System Operations upon Acceptance:**
  1. Sets selected proposal `status = 'accepted'`.
  2. Sets job `status = 'in_progress'`.
  3. Bulk-updates all competing offers on the job to `status = 'rejected'`.
  4. Sends an automated email notification via `SystemNotificationMail` to the accepted artisan.

### 3.3 Mark Job Complete & Review Artisan
* **Complete Job:** `POST /client/job/{id}/complete` &rarr; Sets status to `'completed'`.
* **Submit Review:** `POST /client/job/{id}/review`
  ```json
  {
    "rating": 5,
    "comment": "Exceptional masonry work, prompt arrival and tidy cleanup."
  }
  ```

---

## 4. Maalem (Artisan) Endpoints

All Maalem routes require `auth`, `role:maalem`, and `check.banned`.

### 4.1 Browse Available Jobs (Filtered)
* **Endpoint:** `GET /maalem/find-work?city_id=1&category_id=2&budget=300`
* **Controller:** `MaalemJobController@index`
* **Features:**
  * Only displays jobs with `status = 'open'`.
  * Automatically hides jobs the Maalem has already applied to (`whereDoesntHave('applications')`).
  * Persists query string filters across paginated results.

### 4.2 Submit Proposal / Application
* **Endpoint:** `POST /maalem/jobs/{id}/apply`
* **Controller:** `MaalemJobController@store`
* **Request Payload:**
  ```json
  {
    "proposed_price": 350.00,
    "message": "I can arrive with all necessary equipment tomorrow morning."
  }
  ```
* **Business Quotas:**
  * Free accounts: maximum **3 pending applications** concurrently, and **10 applications per calendar month**.
  * Premium accounts: unlimited applications.
  * Rejection safeguard: Prevents ghost applications if the client closes or deletes the job concurrently.

### 4.3 Update or Re-apply
* **Update Proposal:** `PUT /maalem/applications/{id}` (Updates price or message while status is `pending`).
* **Re-apply:** `POST /maalem/applications/{id}/reapply` (Re-opens application with revised quote if previously rejected).

---

## 5. Premium Verification & Stripe Integration

Allo Maalem provides a built-in monetization model with automated Stripe Checkout sessions.

### 5.1 Initiate Stripe Checkout
* **Endpoint:** `POST /upgrade/checkout`
* **Controller:** `StripePaymentController@checkout`
* **Pricing Rules:**
  * Client verification: **$29.99** (one-time fee for Verified Buyer badge and unlimited jobs).
  * Maalem verification: **$19.99** (one-time fee for Verified Maalem badge and unlimited bids).
* **Payment Flow:**
  1. Controller initializes Stripe API with `STRIPE_SECRET`.
  2. Generates dynamic Stripe Hosted Checkout Session.
  3. Redirects user to Stripe's secure payment modal.

### 5.2 Stripe Callback & Fulfillment
* **Endpoint:** `GET /upgrade/success?session_id={CHECKOUT_SESSION_ID}`
* **Lifecycle:**
  1. Validates checkout session via Stripe API.
  2. Verifies `payment_status === 'paid'`.
  3. Updates user: `verification_status = 'verified'`, `is_verified = true`.
  4. Records immutable entry in `payments` table for administrative audit and revenue reporting.

---

## 6. Administrator Endpoints

Protected by `auth` and `role:admin`.

### 6.1 Platform Overview
* **Endpoint:** `GET /admin/dashboard`
* **Aggregations:**
  * Total clients count
  * Total maalems count
  * Active admins count
  * Verified premium users count
  * Total open jobs count
  * Real-time user registration log and job creation stream

### 6.2 User Moderation & Sanctions
* **Ban User:** `POST /admin/users/{id}/ban`
  * Sets `is_baned = 1`.
  * **Automatic Data Cascade:** If client is banned, open jobs are removed; if maalem is banned, pending bids are culled.
* **Unban User:** `POST /admin/users/{id}/unban`
* **Revoke Premium Badge:** `POST /admin/users/{id}/revoke` &rarr; Reverts status to `unverified`.

### 6.3 Category & City Master Data CRUD
* **Add Category:** `POST /admin/settings/categories` (`name`)
* **Delete Category:** `POST /admin/settings/categories/{id}/delete`
* **Add City:** `POST /admin/settings/cities` (`name`)
* **Delete City:** `POST /admin/settings/cities/{id}/delete`

### 6.4 Financial Audit
* **Endpoint:** `GET /admin/payment-history`
* **Returns:** Full chronological payment ledger (`user_id`, `name`, `email`, `price`, `created_at`) with total platform gross volume calculation.
