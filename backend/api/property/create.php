<?php

declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/session.php";
require_once "../../helpers/response.php";
require_once "../../helpers/property-validator.php";
require_once "../../helpers/property-upload.php";
require_once "../../middleware/auth.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    jsonResponse(false, "Invalid Request", [], 405);
}

$db = Database::connect();

$data = validateProperty($_POST);

$db->beginTransaction();

try {

    /*
    |--------------------------------------------------------------------------
    | Generate Slug
    |--------------------------------------------------------------------------
    */

    $slug = strtolower($data["title"]);

    $slug = preg_replace("/[^a-z0-9]+/i", "-", $slug);

    $slug = trim($slug, "-");

    $slug .= "-" . uniqid();
    /*
    |--------------------------------------------------------------------------
    | Insert Property
    |--------------------------------------------------------------------------
    */

    $stmt = $db->prepare("

        INSERT INTO properties (

            user_id,
            title,
            slug,
            description,
            property_type,
            room_type,
            gender_preference,
            monthly_rent,
            security_deposit,
            address,
            city,
            state,
            pincode

        )

        VALUES(

            ?,?,?,?,?,?,?,?,?,?,?,?,?

        )

    ");

    $stmt->execute([

        $_SESSION["user"]["id"],

        $data["title"],

        $slug,

        $data["description"],

        $data["property_type"],

        $data["room_type"],

        $data["gender_preference"],

        $data["monthly_rent"],

        $data["security_deposit"],

        $data["address"],

        $data["city"],

        $data["state"],

        $data["pincode"]
        

    ]);

    $propertyId = (int)$db->lastInsertId();

    /*
    |--------------------------------------------------------------------------
    | Save Amenities
    |--------------------------------------------------------------------------
    */

    if (!empty($data["amenities"])) {

        $amenityStmt = $db->prepare("

            INSERT INTO property_amenities(

                property_id,
                amenity_id

            )

            VALUES(

                ?,?

            )

        ");

        foreach ($data["amenities"] as $amenityId) {

            $amenityStmt->execute([

                $propertyId,

                (int)$amenityId

            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Images
    |--------------------------------------------------------------------------
    */

    if (

        isset($_FILES["images"]) &&

        !empty($_FILES["images"]["name"][0])

    ) {

        $images = uploadPropertyImages($_FILES["images"]);

        $imageStmt = $db->prepare("

            INSERT INTO property_images(

                property_id,
                image_path,
                image_name,
                image_size,
                image_type,
                is_cover

            )

            VALUES(

                ?,?,?,?,?,?

            )

        ");

        foreach ($images as $index => $image) {

            $imageStmt->execute([

                $propertyId,

                $image["path"],

                $image["name"],

                $image["size"],

                $image["type"],

                $index === 0 ? 1 : 0

            ]);
        }
    }

    $db->commit();

    jsonResponse(

        true,

        "Property Published Successfully"

    );
    
} catch (Exception $e) {

    $db->rollBack();

    $message = "Something went wrong.";

    if (defined("APP_DEBUG") && APP_DEBUG) {

        $message = $e->getMessage();
    }

    jsonResponse(

        false,

        $message,

        [],

        500

    );
}
