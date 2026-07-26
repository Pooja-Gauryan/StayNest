/* ==========================================================
   StayNest Database
   File : 04_amenities.sql
   Table : amenities
========================================================== */

CREATE TABLE amenities (

    /* ==========================================
       Primary Key
    ========================================== */

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    /* ==========================================
       Amenity Information
    ========================================== */

    name VARCHAR(100) NOT NULL UNIQUE,

    icon VARCHAR(100) DEFAULT NULL,

    description VARCHAR(255) DEFAULT NULL,

    /* ==========================================
       Status
    ========================================== */

    is_active BOOLEAN DEFAULT TRUE,

    /* ==========================================
       Audit
    ========================================== */

    created_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP

);