<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Property Image Upload Helper
|--------------------------------------------------------------------------
*/

function uploadPropertyImages(array $files): array
{
    $uploadDir = __DIR__ . '/../uploads/properties/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    $uploadedImages = [];

    foreach ($files['name'] as $key => $name) {

        if ($files['error'][$key] !== UPLOAD_ERR_OK) {
            continue;
        }

        if (!in_array($files['type'][$key], $allowedTypes)) {
            continue;
        }

        $extension = pathinfo($name, PATHINFO_EXTENSION);

        $newName = uniqid('property_', true) . '.' . $extension;

        $destination = $uploadDir . $newName;

        if ($files["size"][$key] > 5 * 1024 * 1024) {
            continue;
        }

        if (
            move_uploaded_file(
                $files['tmp_name'][$key],
                $destination
            )
        ) {

            $uploadedImages[] = [

                'path' => 'backend/uploads/properties/' . $newName,

                'name' => $name,

                'size' => $files['size'][$key],

                'type' => $files['type'][$key]

            ];
        }
    }

    return $uploadedImages;
}
