# Cyber Crime Management System

## Overview

The Cyber Crime Management System is a web-based application designed to provide an efficient and transparent platform for reporting, managing, and tracking cyber crime complaints. It connects citizens, police stations, and administrators through a centralized system to improve communication, case tracking, and administrative control.

This system replaces traditional manual complaint handling with a secure and structured digital solution.

---

## Problem Statement

Traditional cyber crime reporting systems suffer from:

* Manual and time-consuming complaint registration
* Lack of transparency in case progress
* Inefficient complaint management by police stations
* Lack of centralized monitoring and control

This system solves these problems by providing a centralized online complaint management platform.

---

## Objectives

* Provide an easy platform for citizens to report cyber crimes
* Enable police stations to manage and update complaints efficiently
* Allow administrators to monitor and manage the system
* Improve transparency and efficiency in cyber crime handling
* Maintain secure and organized complaint records

---

## System Users and Modules

### 1. Citizen Module

* User registration and login
* Submit cyber crime complaints
* View complaint status
* Track complaint progress

### 2. Police Station Module

* Police station login
* View complaints assigned to their station
* View complainant details
* Update complaint status

### 3. Admin Module

* Full system monitoring
* Add and manage states
* Add and manage districts
* Add and manage police stations
* View all complaints in the system

---

## Technology Stack

**Frontend**

* HTML
* CSS
* JavaScript

**Backend**

* PHP

**Database**

* MySQL

**Server**

* Apache (XAMPP)

**Development Environment**

* Visual Studio Code

**Operating System**

* Windows / Linux

---

## Database Design

The system includes the following main tables:

* tbl_login
* tbl_register
* tbl_state
* tbl_district
* tbl_policestation
* tbl_case
* tbl_casestatus
* tbl_statusupdates

These tables maintain relationships between users, complaints, and police stations.

---

## Installation Guide

### Prerequisites

* XAMPP installed
* Web browser
* MySQL database
* PHP support

### Steps

1. Copy project folder into:

   ```
   C:\xampp\htdocs\
   ```

2. Start XAMPP

   * Start Apache
   * Start MySQL

3. Open phpMyAdmin:

   ```
   http://localhost/phpmyadmin
   ```

4. Create database:

   ```
   cyber_crime_system
   ```

5. Import the SQL file into the database

6. Run the project:

   ```
   http://localhost/CYBER CRIME SYSTEM/
   ```

---

## Admin Setup (Important)

The system allows only one administrator account. The admin account must be created manually by accessing a hidden setup page.

### Steps to Create Admin

Open browser and go to:

```
http://localhost/CYBER CRIME SYSTEM/adminsetupt.php
```

Enter:

* Admin username
* Admin password

Submit to create admin account.

---

## Important Admin Setup Notes

* This page is not linked anywhere in the system
* It must be accessed manually via URL
* Only one admin account can exist
* Additional admin accounts cannot be created
* This prevents unauthorized admin creation

---

## Key Features

* Online complaint registration
* Complaint status tracking
* Role-based access control
* Centralized complaint management
* Secure login system
* Admin control over system structure

---

## Advantages

* Reduces manual paperwork
* Improves efficiency
* Enhances transparency
* Easy to use interface
* Secure data management

---

## Future Improvements

* Email notifications
* Evidence file upload
* Mobile application version
* Advanced security features
* Complaint analytics dashboard

---

## Project Information

This project was developed as part of Bachelor of Computer Science under Mahatma Gandhi University.

---

## Author

Dinil Balachandran

GitHub: https://github.com/dinilbalachandran

---

## License

This project is created for educational purposes.
