<?php
declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/session.php";
require_once "../../helpers/response.php";
require_once "../../middleware/auth.php";

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    jsonResponse(false, "Invalid request method.", [], 405);
}

$db = Database::connect();
$userId = (int)$_SESSION["user"]["id"];

$stmt = $db->prepare("
    SELECT
        p.id, p.title, p.property_type, p.room_type, p.gender_preference,
        p.monthly_rent, p.city, p.state, p.approval_status,
        COALESCE(pi.image_path, '') AS cover_image,
        w.created_at AS saved_at
    FROM wishlist w
    INNER JOIN properties p ON p.id = w.property_id
    LEFT JOIN property_images pi
        ON pi.property_id = p.id AND pi.is_cover = 1
    WHERE w.user_id = ?
      AND p.deleted_at IS NULL
      AND p.is_available = 1
    ORDER BY w.created_at DESC
");
$stmt->execute([$userId]);

jsonResponse(true, "Wishlist loaded.", ["properties" => $stmt->fetchAll()]);
