<?php
declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/session.php";
require_once "../../helpers/response.php";
require_once "../../middleware/auth.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    jsonResponse(false, "Invalid request method.", [], 405);
}

$propertyId = filter_input(INPUT_POST, "property_id", FILTER_VALIDATE_INT);
if (!$propertyId || $propertyId < 1) {
    jsonResponse(false, "Please select a valid property.", [], 422);
}

$db = Database::connect();
$stmt = $db->prepare("
    DELETE FROM wishlist
    WHERE user_id = ? AND property_id = ?
");
$stmt->execute([(int)$_SESSION["user"]["id"], $propertyId]);

jsonResponse(true, $stmt->rowCount() ? "Property removed from your wishlist." : "This property was not in your wishlist.");
