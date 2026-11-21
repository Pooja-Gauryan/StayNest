<?php
declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/session.php";
require_once "../../helpers/response.php";
require_once "../../middleware/auth.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    jsonResponse(false, "Invalid request method.", [], 405);
}

$db = Database::connect();
$userId = (int)$_SESSION["user"]["id"];
$propertyId = filter_input(INPUT_POST, "property_id", FILTER_VALIDATE_INT);

if (!$propertyId || $propertyId < 1) {
    jsonResponse(false, "Please select a valid property.", [], 422);
}

$property = $db->prepare("
    SELECT id FROM properties
    WHERE id = ? AND deleted_at IS NULL AND is_available = 1
    LIMIT 1
");
$property->execute([$propertyId]);

if (!$property->fetch()) {
    jsonResponse(false, "This property is no longer available.", [], 404);
}

$insert = $db->prepare("
    INSERT IGNORE INTO wishlist (user_id, property_id)
    VALUES (?, ?)
");
$insert->execute([$userId, $propertyId]);

if ($insert->rowCount() === 0) {
    jsonResponse(true, "This property is already in your wishlist.", ["saved" => true]);
}

jsonResponse(true, "Property added to your wishlist.", ["saved" => true]);
