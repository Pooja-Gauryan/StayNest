/* ==========================================================
   StayNest Database
   File : 13_reports.sql
   Table : reports
========================================================== */

CREATE TABLE reports (

    /* ==========================================
       Primary Key
    ========================================== */

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    /* ==========================================
       Reporter
    ========================================== */

    reported_by INT UNSIGNED NOT NULL,

    /* ==========================================
       Report Target
    ========================================== */

    report_type ENUM(
        'property',
        'user',
        'message',
        'review'
    ) NOT NULL,

    reference_id INT UNSIGNED NOT NULL,

    /* ==========================================
       Report Details
    ========================================== */

    reason VARCHAR(150) NOT NULL,

    description TEXT DEFAULT NULL,

    /* ==========================================
       Status
    ========================================== */

    report_status ENUM(
        'Pending',
        'Under Review',
        'Resolved',
        'Rejected'
    ) DEFAULT 'Pending',

    /* ==========================================
       Audit
    ========================================== */

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    resolved_at TIMESTAMP NULL DEFAULT NULL,

    /* ==========================================
       Foreign Key
    ========================================== */

    CONSTRAINT fk_report_user
        FOREIGN KEY (reported_by)
        REFERENCES users(id)
        ON DELETE CASCADE

);