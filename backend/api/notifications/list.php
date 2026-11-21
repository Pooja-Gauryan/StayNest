<?php
declare(strict_types=1);
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../helpers/session.php';
require_once __DIR__ . '/../../helpers/response.php';
require_once __DIR__ . '/../../middleware/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonResponse(false, 'Method not allowed', [], 405);
}

$userId = (int)($_SESSION['user']['id'] ?? 0);
$db = Database::connect();

$count = $db->prepare("SELECT COUNT(*) FROM notifications
    WHERE user_id = ? AND is_read = 0 AND notification_status = 'active'");
$count->execute([$userId]);
$unreadCount = (int)$count->fetchColumn();

$stmt = $db->prepare("SELECT id, notification_type, title, message,
        reference_id, is_read, created_at
    FROM notifications
    WHERE user_id = ? AND notification_status = 'active'
    ORDER BY created_at DESC, id DESC
    LIMIT 15");
$stmt->execute([$userId]);

jsonResponse(true, 'Notifications loaded', [
    'unread_count' => $unreadCount,
    'notifications' => $stmt->fetchAll(PDO::FETCH_ASSOC)
]);
