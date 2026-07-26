<?php

declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/session.php";
require_once "../../helpers/response.php";
require_once "../../middleware/auth.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    jsonResponse(false, "Invalid Request", [], 405);
}

$db = Database::connect();

$userId = $_SESSION["user"]["id"];
$propertyId = (int)($_POST["property_id"] ?? 0);

if ($propertyId <= 0) {
    jsonResponse(false, "Invalid Property");
}

/*
|--------------------------------------------------------------------------
| Already Exists?
|--------------------------------------------------------------------------
*/

$check = $db->prepare("
SELECT id
FROM wishlist
WHERE user_id=?
AND property_id=?
LIMIT 1
");

$check->execute([
    $userId,
    $propertyId
]);

if ($check->fetch()) {

    jsonResponse(
        false,
        "Already Added"
    );

}

/*
|--------------------------------------------------------------------------
| Save Wishlist
|--------------------------------------------------------------------------
*/

$stmt = $db->prepare("
INSERT INTO wishlist(

user_id,
property_id

)

VALUES(

?,?

)
");

$stmt->execute([

$userId,

$propertyId

]);

jsonResponse(

true,

"Added To Wishlist"

);