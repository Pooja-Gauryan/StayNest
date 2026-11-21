<?php

declare(strict_types=1);
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../helpers/session.php';
require_once __DIR__ . '/../../helpers/response.php';
require_once __DIR__ . '/../../middleware/auth.php';
if ($_SERVER['REQUEST_METHOD'] !== 'GET') jsonResponse(false, 'Method not allowed', [], 405);
$userId = (int)$_SESSION['user']['id'];
$conversationId = (int)($_GET['conversation_id'] ?? 0);
if ($conversationId <= 0) jsonResponse(false, 'Conversation is required', [], 422);
$db = Database::connect();
$access = $db->prepare("SELECT id FROM conversations WHERE id=? AND (user_one_id=? OR user_two_id=?) AND conversation_status='active' LIMIT 1");
$access->execute([$conversationId, $userId, $userId]);
if (!$access->fetch()) jsonResponse(false, 'Conversation not found', [], 404);
$mark = $db->prepare("UPDATE messages SET is_read=1 WHERE conversation_id=? AND sender_id<>? AND is_read=0");
$mark->execute([$conversationId, $userId]);
$stmt = $db->prepare("SELECT m.id,m.sender_id,m.message,m.created_at,u.full_name AS sender_name FROM messages m JOIN users u ON u.id=m.sender_id WHERE m.conversation_id=? AND m.deleted_at IS NULL ORDER BY m.id ASC LIMIT 500");
$stmt->execute([$conversationId]);
jsonResponse(true, 'Messages loaded', ['messages' => $stmt->fetchAll()]);
