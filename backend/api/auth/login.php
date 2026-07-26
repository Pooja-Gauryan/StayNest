<?php

declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/validator.php";
require_once "../../helpers/response.php";
require_once "../../helpers/session.php";
require_once "../../middleware/guest.php";

$email = clean($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if (isEmpty($email, $password)) {
    jsonResponse(false, "All fields are required");
}

$db = Database::connect();

$stmt = $db->prepare("
SELECT *
FROM users
WHERE email=?
LIMIT 1
");

$stmt->execute([$email]);

$user = $stmt->fetch();

if (!$user) {
    jsonResponse(false, "Invalid Credentials");
}

if (!password_verify($password, $user["password"])) {
    jsonResponse(false, "Invalid Credentials");
}

$_SESSION["user"] = [

    "id" => $user["id"],
    "name" => $user["full_name"],
    "email" => $user["email"],
    "profile_image" => $user["profile_image"]

];

$_SESSION["success"] = "Welcome Back!";

header("Location: http://localhost/StayNest/dashboard/home.php");
exit;