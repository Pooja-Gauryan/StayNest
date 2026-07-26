/* ==========================================================
   StayNest Database
   File : 11_reviews.sql
   Table : reviews
========================================================== */

CREATE TABLE reviews (

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
       Review
    ========================================== */

    rating TINYINT UNSIGNED NOT NULL,

    review TEXT DEFAULT NULL,

    /* ==========================================
       Status
    ========================================== */

    review_status ENUM(
        'visible',
        'hidden'
    ) DEFAULT 'visible',

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
       Constraints
    ========================================== */

    CHECK (rating BETWEEN 1 AND 5),

    UNIQUE KEY unique_review (
        user_id,
        property_id
    ),

    /* ==========================================
       Foreign Keys
    ========================================== */

    CONSTRAINT fk_review_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_review_property
        FOREIGN KEY (property_id)
        REFERENCES properties(id)
        ON DELETE CASCADE

);