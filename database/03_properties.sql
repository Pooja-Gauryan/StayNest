/* ==========================================================
   StayNest Database
   File : 03_properties.sql
   Table : properties
========================================================== */

CREATE TABLE properties (

    /* ==========================================
       Primary Key
    ========================================== */

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    /* ==========================================
       Owner
    ========================================== */

    user_id INT UNSIGNED NOT NULL,

    /* ==========================================
       Property Details
    ========================================== */

    title VARCHAR(150) NOT NULL,

    slug VARCHAR(180) UNIQUE NOT NULL,

    description TEXT NOT NULL,

    property_type ENUM(
        'PG',
        'Hostel',
        'Flat',
        'Room'
    ) NOT NULL,

    room_type ENUM(
        'Single',
        'Double',
        'Triple',
        'Shared'
    ) NOT NULL,

    gender_preference ENUM(
        'Boys',
        'Girls',
        'Unisex'
    ) DEFAULT 'Unisex',

    /* ==========================================
       Pricing
    ========================================== */

    monthly_rent DECIMAL(10,2) NOT NULL,

    security_deposit DECIMAL(10,2)
        DEFAULT 0,

    /* ==========================================
       Address
    ========================================== */

    address TEXT NOT NULL,

    city VARCHAR(100) NOT NULL,

    state VARCHAR(100) NOT NULL,

    pincode VARCHAR(10) NOT NULL,

    latitude DECIMAL(10,8)
        DEFAULT NULL,

    longitude DECIMAL(11,8)
        DEFAULT NULL,

    /* ==========================================
       Status
    ========================================== */

    is_available BOOLEAN DEFAULT TRUE,

    is_featured BOOLEAN DEFAULT FALSE,

    approval_status ENUM(
        'Pending',
        'Approved',
        'Rejected'
    ) DEFAULT 'Pending',

    /* ==========================================
       Statistics
    ========================================== */

    views INT UNSIGNED DEFAULT 0,

    /* ==========================================
       Audit
    ========================================== */

    created_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    deleted_at TIMESTAMP NULL DEFAULT NULL,

    /* ==========================================
       Foreign Key
    ========================================== */

    CONSTRAINT fk_property_owner
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE

);