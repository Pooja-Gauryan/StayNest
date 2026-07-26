<?php

declare(strict_types=1);

require_once __DIR__ . "/../config/database.php";

/*
|--------------------------------------------------------------------------
| Delete Property Image
|--------------------------------------------------------------------------
*/

function deletePropertyImage(int $imageId): bool
{
    $db = Database::connect();

    $stmt = $db->prepare("

        SELECT image_path

        FROM property_images

        WHERE id=?

        LIMIT 1

    ");

    $stmt->execute([$imageId]);

    $image = $stmt->fetch();

    if (!$image) {

        return false;

    }

    $absolutePath = dirname(__DIR__) . "/../" . $image["image_path"];

    if (file_exists($absolutePath)) {

        unlink($absolutePath);

    }

    $db->prepare("

        DELETE FROM property_images

        WHERE id=?

    ")->execute([$imageId]);

    return true;
}