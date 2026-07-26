/* ==========================================================
   StayNest Database
   File : 05_property_amenities.sql
   Table : property_amenities
========================================================== */

CREATE TABLE property_amenities (

    /* ==========================================
       Primary Key
    ========================================== */

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    /* ==========================================
       Relations
    ========================================== */

    property_id INT UNSIGNED NOT NULL,

    amenity_id INT UNSIGNED NOT NULL,

    /* ==========================================
       Audit
    ========================================== */

    created_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP,

    /* ==========================================
       Prevent Duplicate Amenities
    ========================================== */

    UNIQUE KEY unique_property_amenity (
        property_id,
        amenity_id
    ),

    /* ==========================================
       Foreign Keys
    ========================================== */

    CONSTRAINT fk_pa_property
        FOREIGN KEY (property_id)
        REFERENCES properties(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_pa_amenity
        FOREIGN KEY (amenity_id)
        REFERENCES amenities(id)
        ON DELETE CASCADE

);