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

$imagePath = null;

/*
|--------------------------------------------------------------------------
| Upload Image
|--------------------------------------------------------------------------
*/

if (

    isset($_FILES["profile_image"]) &&

    $_FILES["profile_image"]["error"] === 0

) {

    $uploadDir = "../../../uploads/profile/";

    if (!is_dir($uploadDir)) {

        mkdir($uploadDir, 0777, true);

    }

    $fileName = time() . "_" . basename($_FILES["profile_image"]["name"]);

    move_uploaded_file(

        $_FILES["profile_image"]["tmp_name"],

        $uploadDir . $fileName

    );

    $imagePath = "uploads/profile/" . $fileName;

}

/*
|--------------------------------------------------------------------------
| Update
|--------------------------------------------------------------------------
*/

$sql = "

UPDATE users

SET

full_name=?,

username=?,

phone=?,

college=?,

occupation=?,

gender=?,

city=?,

state=?,

bio=?,

updated_at=NOW()

";

$params = [

$_POST["full_name"],

$_POST["username"],

$_POST["phone"],

$_POST["college"],

$_POST["occupation"],

$_POST["gender"],

$_POST["city"],

$_POST["state"],

$_POST["bio"]

];

if ($imagePath != null) {

    $sql .= ", profile_image=?";

    $params[] = $imagePath;

}

$sql .= "

WHERE id=?

";

$params[] = $_SESSION["user"]["id"];

$stmt = $db->prepare($sql);

$stmt->execute($params);

$_SESSION["user"]["name"] = $_POST["full_name"];

if($imagePath!=null){

    $_SESSION["user"]["profile_image"]=$imagePath;

}
jsonResponse(

    true,

    "Profile Updated Successfully"

);