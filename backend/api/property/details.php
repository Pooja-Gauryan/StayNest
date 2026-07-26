<?php

declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/response.php";

$id = $_GET["id"] ?? 0;

$db = Database::connect();

/*
Increase Views
*/

$db->prepare("
UPDATE properties

SET views=views+1

WHERE id=?

")->execute([$id]);

/*
Property
*/

$stmt = $db->prepare("

SELECT

p.*,

u.full_name,

u.phone,

u.email,

u.profile_image

FROM properties p

JOIN users u

ON p.user_id=u.id

WHERE p.id=?

LIMIT 1

");

$stmt->execute([$id]);

$property = $stmt->fetch();

if (!$property) {

    jsonResponse(false,"Property Not Found");

}

/*
Images
*/

$imageStmt = $db->prepare("

SELECT *

FROM property_images

WHERE property_id=?

ORDER BY

is_cover DESC,

display_order ASC

");

$imageStmt->execute([$id]);

$property["images"] =
$imageStmt->fetchAll();

/*
Amenities
*/

$amenityStmt=$db->prepare("

SELECT

a.*

FROM amenities a

INNER JOIN property_amenities pa

ON a.id=pa.amenity_id

WHERE pa.property_id=?

");

$amenityStmt->execute([$id]);

$property["amenities"] =
$amenityStmt->fetchAll();

jsonResponse(
true,
"Property Loaded",
$property
);