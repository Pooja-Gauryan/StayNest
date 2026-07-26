<?php

declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/validator.php";
require_once "../../helpers/response.php";
require_once "../../helpers/session.php";
require_once "../../middleware/guest.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    jsonResponse(false, "Invalid Request", [], 405);
}

$name = clean($_POST["name"] ?? "");
$email = clean($_POST["email"] ?? "");
$phone = clean($_POST["phone"] ?? "");
$password = $_POST["password"] ?? "";

if (isEmpty($name, $email, $phone, $password)) {
    jsonResponse(false, "All fields are required");
}

if (!isEmail($email)) {
    jsonResponse(false, "Invalid email");
}

if (strlen($password) < 8) {
    jsonResponse(false, "Password must be at least 8 characters");
}

$db = Database::connect();

/* Check Email */
$stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->fetch()) {
    jsonResponse(false, "Email already registered");
}

/* Create User */
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $db->prepare("

INSERT INTO users(

full_name,
email,
phone,
password

)

VALUES(

?,?,?,?

)

");

$stmt->execute([

    $name,

    $email,

    $phone,

    $hash

]);

jsonResponse(true, "Account created successfully");
