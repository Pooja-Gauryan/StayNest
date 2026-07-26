/* ==========================================================
   StayNest Database
   File : 08_conversations.sql
   Table : conversations
========================================================== */

CREATE TABLE conversations (

    /* ==========================================
       Primary Key
    ========================================== */

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    /* ==========================================
       Participants
    ========================================== */

    user_one_id INT UNSIGNED NOT NULL,

    user_two_id INT UNSIGNED NOT NULL,

    /* ==========================================
       Related Property
    ========================================== */

    property_id INT UNSIGNED DEFAULT NULL,

    /* ==========================================
       Conversation Status
    ========================================== */

    conversation_status ENUM(
        'active',
        'archived',
        'blocked'
    ) DEFAULT 'active',

    last_message_at TIMESTAMP NULL DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    /* ==========================================
       Prevent Duplicate Conversation
    ========================================== */

    UNIQUE KEY unique_conversation (
        user_one_id,
        user_two_id,
        property_id
    ),

    /* ==========================================
       Foreign Keys
    ========================================== */

    CONSTRAINT fk_conversation_user_one
        FOREIGN KEY (user_one_id)
        REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_conversation_user_two
        FOREIGN KEY (user_two_id)
        REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_conversation_property
        FOREIGN KEY (property_id)
        REFERENCES properties(id)
        ON DELETE SET NULL

);