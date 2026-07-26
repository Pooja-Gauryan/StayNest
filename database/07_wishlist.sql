/* ==========================================================
   StayNest Database
   File : 07_wishlist.sql
   Table : wishlist
========================================================== */

CREATE TABLE wishlist (

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
       Audit
    ========================================== */

    created_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP,

    /* ==========================================
       Prevent Duplicate Wishlist
    ========================================== */

    UNIQUE KEY unique_wishlist (
        user_id,
        property_id
    ),

    /* ==========================================
       Foreign Keys
    ========================================== */

    CONSTRAINT fk_wishlist_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_wishlist_property
        FOREIGN KEY (property_id)
        REFERENCES properties(id)
        ON DELETE CASCADE

);