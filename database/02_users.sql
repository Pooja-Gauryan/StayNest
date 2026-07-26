/* ==========================================================
   StayNest Database
   File : 02_users.sql
   Table : users
========================================================== */

CREATE TABLE users (

    /* ==========================================
       Primary Key
    ========================================== */

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    /* ==========================================
       Basic Information
    ========================================== */

    full_name VARCHAR(100) NOT NULL,

    username VARCHAR(50) UNIQUE DEFAULT NULL,

    email VARCHAR(150) NOT NULL UNIQUE,

    phone VARCHAR(15) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    /* ==========================================
       Profile
    ========================================== */

    profile_image VARCHAR(255)
        DEFAULT 'default-profile.png',

    bio TEXT DEFAULT NULL,

    gender ENUM(
        'Male',
        'Female',
        'Other'
    ) DEFAULT NULL,

    occupation ENUM(
        'Student',
        'Working Professional',
        'Other'
    ) DEFAULT 'Student',

    college VARCHAR(150) DEFAULT NULL,

    city VARCHAR(100) DEFAULT NULL,

    state VARCHAR(100) DEFAULT NULL,

    /* ==========================================
       Social Login
    ========================================== */

    google_id VARCHAR(255) UNIQUE DEFAULT NULL,

    github_id VARCHAR(255) UNIQUE DEFAULT NULL,

    login_provider ENUM(
        'email',
        'google',
        'github'
    ) DEFAULT 'email',

    /* ==========================================
       Account Status
    ========================================== */

    is_verified BOOLEAN DEFAULT FALSE,

    account_status ENUM(
        'active',
        'inactive',
        'suspended'
    ) DEFAULT 'active',

    last_login TIMESTAMP NULL DEFAULT NULL,

    /* ==========================================
       Audit
    ========================================== */

    created_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    deleted_at TIMESTAMP NULL DEFAULT NULL

);


