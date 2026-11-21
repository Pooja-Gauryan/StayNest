<?php

declare(strict_types=1);
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../helpers/session.php';
require_once __DIR__ . '/../../helpers/response.php';
require_once __DIR__ . '/../../middleware/auth.php';

$db = Database::connect();
$userId = (int)$_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $db->prepare("SELECT c.id, c.property_id, c.last_message_at,
        CASE WHEN c.user_one_id = ? THEN c.user_two_id ELSE c.user_one_id END AS other_user_id,
        u.full_name AS other_user_name, u.profile_image,
        p.title AS property_title,
        (SELECT m.message FROM messages m WHERE m.conversation_id=c.id AND m.deleted_at IS NULL ORDER BY m.id DESC LIMIT 1) AS last_message,
        (SELECT COUNT(*) FROM messages um WHERE um.conversation_id=c.id AND um.sender_id<>? AND um.is_read=0 AND um.deleted_at IS NULL) AS unread_count
        FROM conversations c
        JOIN users u ON u.id = CASE WHEN c.user_one_id = ? THEN c.user_two_id ELSE c.user_one_id END
        LEFT JOIN properties p ON p.id=c.property_id
        WHERE (c.user_one_id=? OR c.user_two_id=?) AND c.conversation_status='active'
        ORDER BY COALESCE(c.last_message_at,c.created_at) DESC");
    $stmt->execute([$userId, $userId, $userId, $userId, $userId]);
    jsonResponse(true, 'Conversations loaded', ['conversations' => $stmt->fetchAll()]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otherId = (int)($_POST['user_id'] ?? 0);
    $propertyId = (int)($_POST['property_id'] ?? 0);
    if ($otherId <= 0 || $otherId === $userId) jsonResponse(false, 'Invalid chat participant', [], 422);
    $check = $db->prepare("SELECT id FROM users WHERE id=? AND account_status='active' LIMIT 1");
    $check->execute([$otherId]);
    if (!$check->fetch()) jsonResponse(false, 'User not found', [], 404);
    if ($propertyId > 0) {
        $prop = $db->prepare("SELECT id,user_id FROM properties WHERE id=? AND deleted_at IS NULL LIMIT 1");
        $prop->execute([$propertyId]);
        $property = $prop->fetch();
        if (!$property || (int)$property['user_id'] !== $otherId) jsonResponse(false, 'Property owner does not match', [], 422);
    } else {
        $propertyId = 0;
    }
    $one = min($userId, $otherId);
    $two = max($userId, $otherId);
    $find = $db->prepare("SELECT id FROM conversations WHERE user_one_id=? AND user_two_id=? AND property_id <=> ? LIMIT 1");
    $find->execute([$one, $two, $propertyId ?: null]);
    $conversation = $find->fetch();
    if (!$conversation) {
        try {
            $insert = $db->prepare("INSERT INTO conversations (user_one_id,user_two_id,property_id) VALUES (?,?,?)");
            $insert->execute([$one, $two, $propertyId ?: null]);
            $conversationId = (int)$db->lastInsertId();
        } catch (PDOException $e) {
            $find->execute([$one, $two, $propertyId ?: null]);
            $conversation = $find->fetch();
            if (!$conversation) throw $e;
            $conversationId = (int)$conversation['id'];
        }
    } else $conversationId = (int)$conversation['id'];
    jsonResponse(true, 'Conversation ready', ['conversation_id' => $conversationId]);
}
jsonResponse(false, 'Method not allowed', [], 405);
