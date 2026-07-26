/* ==========================================================
   StayNest Database
   Startup MVP v1.0
========================================================== */

DROP DATABASE IF EXISTS staynest;

CREATE DATABASE staynest
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE staynest;

/* ==========================================================
   USERS
========================================================== */

CREATE TABLE users (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    full_name VARCHAR(100) NOT NULL,

    username VARCHAR(30) NOT NULL UNIQUE,

    email VARCHAR(255) NOT NULL UNIQUE,

    phone VARCHAR(20) UNIQUE,

    password VARCHAR(255) NOT NULL,

    profile_image VARCHAR(255)
        DEFAULT 'default-profile.png',

    bio TEXT,

    occupation ENUM(
        'Student',
        'Working Professional',
        'Other'
    ) DEFAULT 'Student',

    gender ENUM(
        'Male',
        'Female',
        'Other'
    ),

    college VARCHAR(150),

    city VARCHAR(100),

    state VARCHAR(100),

    country VARCHAR(100)
    DEFAULT 'India'

    google_id VARCHAR(255),

    github_id VARCHAR(255),

    login_provider ENUM(
        'email',
        'google',
        'github'
    ) DEFAULT 'email',

    is_verified BOOLEAN DEFAULT FALSE,

    account_status ENUM(
        'active',
        'inactive',
        'suspended'
    ) DEFAULT 'active',

    created_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    deleted_at TIMESTAMP NULL DEFAULT NULL

);