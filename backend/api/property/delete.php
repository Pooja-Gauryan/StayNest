<?php

declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/session.php";
require_once "../../helpers/response.php";
require_once "../../middleware/auth.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    jsonResponse(false, "Invalid Request", [], 405);
}

$propertyId = (int)($_POST["property_id"] ?? 0);

if ($propertyId <= 0) {
    jsonResponse(false, "Invalid Property");
}

$db = Database::connect();

$stmt = $db->prepare("

UPDATE properties

SET deleted_at = NOW()

WHERE

id=?

AND user_id=?

");

$stmt->execute([

    $propertyId,

    $_SESSION["user"]["id"]

]);

$_SESSION["success"] = "Property Deleted Successfully";

jsonResponse(

    true,

    "Property Deleted Successfully"

);