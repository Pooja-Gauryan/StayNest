/* ==========================================================
   StayNest Database
   File : 09_messages.sql
   Table : messages
========================================================== */

CREATE TABLE messages (

    /* ==========================================
       Primary Key
    ========================================== */

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    /* ==========================================
       Conversation
    ========================================== */

    conversation_id INT UNSIGNED NOT NULL,

    /* ==========================================
       Sender
    ========================================== */

    sender_id INT UNSIGNED NOT NULL,

    /* ==========================================
       Message
    ========================================== */

    message TEXT NOT NULL,

    message_type ENUM(
        'text',
        'image',
        'file'
    ) DEFAULT 'text',

    /* ==========================================
       Message Status
    ========================================== */

    is_read BOOLEAN DEFAULT FALSE,

    is_edited BOOLEAN DEFAULT FALSE,

    deleted_at TIMESTAMP NULL DEFAULT NULL,

    /* ==========================================
       Audit
    ========================================== */

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    /* ==========================================
       Foreign Keys
    ========================================== */

    CONSTRAINT fk_message_conversation
        FOREIGN KEY (conversation_id)
        REFERENCES conversations(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_message_sender
        FOREIGN KEY (sender_id)
        REFERENCES users(id)
        ON DELETE CASCADE

);