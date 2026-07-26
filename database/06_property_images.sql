/* ==========================================================
   StayNest Database
   File : 06_property_images.sql
   Table : property_images
========================================================== */

CREATE TABLE property_images (

    /* ==========================================
       Primary Key
    ========================================== */

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    /* ==========================================
       Relation
    ========================================== */

    property_id INT UNSIGNED NOT NULL,

    /* ==========================================
       Image Information
    ========================================== */

    image_path VARCHAR(255) NOT NULL,

    image_name VARCHAR(150) DEFAULT NULL,

    image_size INT UNSIGNED DEFAULT NULL,

    image_type VARCHAR(50) DEFAULT NULL,

    image_caption VARCHAR(255) DEFAULT NULL,

    /* ==========================================
       Display Settings
    ========================================== */

    is_cover BOOLEAN DEFAULT FALSE,

    display_order TINYINT UNSIGNED DEFAULT 1,

    /* ==========================================
       Audit
    ========================================== */

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    /* ==========================================
       Foreign Key
    ========================================== */

    CONSTRAINT fk_property_images
        FOREIGN KEY (property_id)
        REFERENCES properties(id)
        ON DELETE CASCADE

);