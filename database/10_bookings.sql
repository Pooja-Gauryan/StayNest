/* ==========================================================
   StayNest Database
   File : 10_bookings.sql
   Table : bookings
========================================================== */

CREATE TABLE bookings (

    /* ==========================================
       Primary Key
    ========================================== */

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    /* ==========================================
       Relations
    ========================================== */

    user_id INT UNSIGNED NOT NULL,

    property_id INT UNSIGNED NOT NULL,

    /* ==========================================
       Visit Information
    ========================================== */

    visit_date DATE NOT NULL,

    visit_time TIME NOT NULL,

    message TEXT DEFAULT NULL,

    /* ==========================================
       Booking Status
    ========================================== */

    booking_status ENUM(
        'Pending',
        'Accepted',
        'Rejected',
        'Completed',
        'Cancelled'
    ) DEFAULT 'Pending',

    /* ==========================================
       Audit
    ========================================== */

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    deleted_at TIMESTAMP NULL DEFAULT NULL,

    /* ==========================================
       Foreign Keys
    ========================================== */

    CONSTRAINT fk_booking_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_booking_property
        FOREIGN KEY (property_id)
        REFERENCES properties(id)
        ON DELETE CASCADE

);