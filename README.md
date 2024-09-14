# Tickets Booking System Documentation

## Overview

The Tickets Booking System allows users to browse, select, and reserve tickets for various events. It provides a user-friendly interface for customers to book tickets, and an administration panel to manage events and bookings. This document provides detailed information about the system's structure, functionality, and usage.

---

## Table of Contents
1. [System Architecture](#system-architecture)
2. [Features](#features)
3. [User Roles](#user-roles)
4. [Installation Guide](#installation-guide)
5. [Configuration](#configuration)
6. [Database Schema](#database-schema)
7. [API Endpoints](#api-endpoints)
8. [Usage Guide](#usage-guide)
    - [Booking a Ticket](#booking-a-ticket)
    - [Admin Panel](#admin-panel)
9. [Testing](#testing)
10. [Troubleshooting](#troubleshooting)

---

## System Architecture

The Tickets Booking System is built using the **PHP Laravel framework** with **Livewire** for interactive components and **Alpine.js** for dynamic UI updates. The backend is supported by a **MySQL** database for storing user and event data, while the front end provides responsive interfaces.

- **Backend**: Laravel
- **Frontend**: Blade templates, Livewire components, Alpine.js
- **Database**: MySQL
- **Version Control**: Git

---

## Features

### User Features:
- Browse available events.
- View event details (venue, date, price).
- Reserve tickets for events.
- View booking history.
- Receive email confirmation for bookings.

### Admin Features:
- Manage events (create, edit, delete).
- View and manage ticket bookings.
- Export booking data to CSV.
- Set ticket limits per event.
- Send notifications to users.

---

## User Roles

1. **Admin**:
   - Can manage all events and bookings.
   - Access to the admin panel for advanced functionality.
   
2. **User**:
   - Can browse events and book tickets.
   - Access to booking history and personal account details.

---

## Installation Guide

1. **Clone the repository**:
   ```bash
   git clone https://github.com/mohabzalat22/booking-app.git
   cd ticket-booking-system
