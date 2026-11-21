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
$conversationId = (int)($_POST['conversation_id'] ?? 0);
$message = trim((string)($_POST['message'] ?? ''));

if ($conversationId <= 0 || $message === '') {
    jsonResponse(false, 'Please enter a message', [], 422);
}
if (mb_strlen($message) > 2000) {
    jsonResponse(false, 'Message must be 2000 characters or less', [], 422);
}

$db = Database::connect();
$access = $db->prepare("SELECT id, user_one_id, user_two_id, property_id
    FROM conversations
    WHERE id = ? AND (user_one_id = ? OR user_two_id = ?)
      AND conversation_status = 'active'
    LIMIT 1");
$access->execute([$conversationId, $userId, $userId]);
$conversation = $access->fetch(PDO::FETCH_ASSOC);

if (!$conversation) {
    jsonResponse(false, 'Conversation not found', [], 404);
}

$receiverId = ((int)$conversation['user_one_id'] === $userId)
    ? (int)$conversation['user_two_id']
    : (int)$conversation['user_one_id'];

$db->beginTransaction();
try {
    $insert = $db->prepare("INSERT INTO messages
        (conversation_id, sender_id, message, message_type)
        VALUES (?, ?, ?, 'text')");
    $insert->execute([$conversationId, $userId, $message]);
    $messageId = (int)$db->lastInsertId();

    $update = $db->prepare("UPDATE conversations SET last_message_at = NOW() WHERE id = ?");
    $update->execute([$conversationId]);
    $db->commit();
} catch (Throwable $e) {
    if ($db->inTransaction()) $db->rollBack();
    throw $e;
}

// Notifications are best-effort: a notification-table issue must not lose a sent chat message.
$notificationCreated = false;
try {
    $sender = $db->prepare("SELECT full_name FROM users WHERE id = ? LIMIT 1");
    $sender->execute([$userId]);
    $senderName = (string)($sender->fetchColumn() ?: 'New user');

    $propertyTitle = 'your conversation';
    if (!empty($conversation['property_id'])) {
        $property = $db->prepare("SELECT title FROM properties WHERE id = ? LIMIT 1");
        $property->execute([(int)$conversation['property_id']]);
        $propertyTitle = (string)($property->fetchColumn() ?: $propertyTitle);
    }

    $notice = $db->prepare("INSERT INTO notifications
        (user_id, notification_type, title, message, reference_id)
        VALUES (?, 'message', ?, ?, ?)");
    $notice->execute([
        $receiverId,
        'New message from ' . $senderName,
        mb_substr($message, 0, 240),
        $conversationId
    ]);
    $notificationCreated = true;
} catch (Throwable $e) {
    error_log('StayNest notification insert failed: ' . $e->getMessage());
}

jsonResponse(true, 'Message sent', [
    'message' => [
        'id' => $messageId,
        'sender_id' => $userId,
        'message' => $message,
        'created_at' => date('Y-m-d H:i:s')
    ],
    'notification_created' => $notificationCreated
]);
