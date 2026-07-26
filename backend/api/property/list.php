<?php

declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/response.php";
require_once "../../helpers/session.php";
require_once "../../middleware/auth.php";

$db = Database::connect();

$sql = "

SELECT

p.*,

u.full_name,

u.profile_image,

(

SELECT image_path

FROM property_images

WHERE property_id=p.id

AND is_cover=1

LIMIT 1

) AS cover_image

FROM properties p

INNER JOIN users u

ON p.user_id=u.id

WHERE

p.user_id = ?

AND p.deleted_at IS NULL

ORDER BY p.created_at DESC

ORDER BY p.created_at DESC

";

$stmt = $db->prepare($sql);

$stmt->execute([
    $_SESSION["user"]["id"]
]);

$properties = $stmt->fetchAll();

jsonResponse(
    true,
    "Properties Loaded",
    $properties
);
