<?php

declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/response.php";

$db = Database::connect();

$stmt = $db->query("

SELECT

    id,
    name,
    icon

FROM amenities

WHERE is_active = 1

ORDER BY name ASC

");

$amenities = $stmt->fetchAll();

jsonResponse(

    true,

    "Amenities Loaded",

    $amenities

);