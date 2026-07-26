/* ==========================================================
   StayNest Database
   File : 12_notifications.sql
   Table : notifications
========================================================== */

CREATE TABLE notifications (

    /* ==========================================
       Primary Key
    ========================================== */

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    /* ==========================================
       Receiver
    ========================================== */

    user_id INT UNSIGNED NOT NULL,

    /* ==========================================
       Notification
    ========================================== */

    notification_type ENUM(
        'message',
        'booking',
        'wishlist',
        'review',
        'system'
    ) NOT NULL,

    title VARCHAR(150) NOT NULL,

    message TEXT NOT NULL,

    reference_id INT UNSIGNED DEFAULT NULL,

    /* ==========================================
       Status
    ========================================== */

    is_read BOOLEAN DEFAULT FALSE,

    notification_status ENUM(
        'active',
        'deleted'
    ) DEFAULT 'active',

    /* ==========================================
       Audit
    ========================================== */

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    deleted_at TIMESTAMP NULL DEFAULT NULL,

    /* ==========================================
       Foreign Key
    ========================================== */

    CONSTRAINT fk_notification_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE

);