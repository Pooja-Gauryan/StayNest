<?php

declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/session.php";
require_once "../../helpers/response.php";
require_once "../../middleware/auth.php";

$db = Database::connect();

$userId = $_SESSION["user"]["id"];
$propertyId = (int)($_POST["property_id"] ?? 0);

$stmt = $db->prepare("
DELETE FROM wishlist
WHERE user_id=?
AND property_id=?
");

$stmt->execute([
    $userId,
    $propertyId
]);

jsonResponse(
    true,
    "Removed From Wishlist"
);