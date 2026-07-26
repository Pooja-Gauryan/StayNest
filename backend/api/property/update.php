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

$propertyId = (int)($_POST["property_id"] ?? 0);

if ($propertyId <= 0) {
    jsonResponse(false, "Invalid Property");
}

$db->beginTransaction();

try {

    /*
    |--------------------------------------------------------------------------
    | Check Ownership
    |--------------------------------------------------------------------------
    */

    $check = $db->prepare("
        SELECT id
        FROM properties
        WHERE id=?
        AND user_id=?
        LIMIT 1
    ");

    $check->execute([
        $propertyId,
        $_SESSION["user"]["id"]
    ]);

    if (!$check->fetch()) {

        jsonResponse(false, "Property Not Found");
    }

    /*
    |--------------------------------------------------------------------------
    | Update Property
    |--------------------------------------------------------------------------
    */

    $stmt = $db->prepare("

        UPDATE properties

        SET

            title=?,
            description=?,
            property_type=?,
            room_type=?,
            gender_preference=?,
            monthly_rent=?,
            security_deposit=?,
            address=?,
            city=?,
            state=?,
            pincode=?

        WHERE

            id=?
            AND user_id=?

    ");

    $stmt->execute([

        $data["title"],
        $data["description"],
        $data["property_type"],
        $data["room_type"],
        $data["gender_preference"],
        $data["monthly_rent"],
        $data["security_deposit"],
        $data["address"],
        $data["city"],
        $data["state"],
        $data["pincode"],

        $propertyId,
        $_SESSION["user"]["id"]

    ]);

    /*
    |--------------------------------------------------------------------------
    | Update Amenities
    |--------------------------------------------------------------------------
    */

    $db->prepare("
        DELETE FROM property_amenities
        WHERE property_id=?
    ")->execute([$propertyId]);

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
    | Upload New Images (Optional)
    |--------------------------------------------------------------------------
    */

    if (

        isset($_FILES["images"]) &&

        !empty($_FILES["images"]["name"][0])

    ) {

        $db->prepare("
        DELETE FROM property_images
        WHERE property_id=?
        ")->execute([$propertyId]);

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

    header("Location: http://localhost/StayNest/dashboard/my-properties.php");
    exit;
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

    jsonResponse(
        true,
        "Property Updated Successfully"
    );
}
