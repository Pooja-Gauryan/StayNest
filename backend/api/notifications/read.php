<?php
declare(strict_types=1);
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../helpers/session.php';
require_once __DIR__ . '/../../helpers/response.php';
require_once __DIR__ . '/../../middleware/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'Method not allowed', [], 405);
}

$userId = (int)($_SESSION['user']['id'] ?? 0);
$notificationId = (int)($_POST['notification_id'] ?? 0);
$db = Database::connect();

if ($notificationId > 0) {
    $stmt = $db->prepare("UPDATE notifications SET is_read = 1
        WHERE id = ? AND user_id = ? AND notification_status = 'active'");
    $stmt->execute([$notificationId, $userId]);
} else {
    $stmt = $db->prepare("UPDATE notifications SET is_read = 1
        WHERE user_id = ? AND notification_status = 'active' AND is_read = 0");
    $stmt->execute([$userId]);
}

jsonResponse(true, 'Notification updated');
