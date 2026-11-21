<?php

declare(strict_types=1);

require_once "../../config/database.php";
require_once "../../helpers/validator.php";
require_once "../../helpers/response.php";
require_once "../../helpers/session.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    jsonResponse(false, "Invalid Request", [], 405);
}

try {

    $email = clean($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    /*
    |--------------------------------------------------------------------------
    | Validate
    |--------------------------------------------------------------------------
    */

    if (isEmpty($email, $password)) {
        jsonResponse(false, "All fields are required");
    }

    if (!isEmail($email)) {
        jsonResponse(false, "Invalid email");
    }

    /*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    */

    $db = Database::connect();

    $stmt = $db->prepare("
        SELECT *
        FROM users
        WHERE email = ?
          AND deleted_at IS NULL
        LIMIT 1
    ");

    $stmt->execute([$email]);

    $user = $stmt->fetch();

    /*
    |--------------------------------------------------------------------------
    | Check User
    |--------------------------------------------------------------------------
    */

    if (!$user || $user["account_status"] !== "active") {
        jsonResponse(false, "Invalid credentials or inactive account", [], 401);
    }

    /*
    |--------------------------------------------------------------------------
    | Check Password
    |--------------------------------------------------------------------------
    */

    if (!password_verify($password, $user["password"])) {
        jsonResponse(false, "Invalid Credentials");
    }

    /*
    |--------------------------------------------------------------------------
    | Create Session
    |--------------------------------------------------------------------------
    */

    session_regenerate_id(true);

    $_SESSION["user"] = [
        "id" => $user["id"],
        "name" => $user["full_name"],
        "email" => $user["email"],
        "profile_image" => $user["profile_image"]
    ];

    $_SESSION["success"] = "Welcome Back!";

    /*
    |--------------------------------------------------------------------------
    | Success
    |--------------------------------------------------------------------------
    */

    jsonResponse(
        true,
        "Login successful"
    );

} catch (Throwable $e) {

    http_response_code(500);

    header("Content-Type: application/json");

    echo json_encode([
        "success" => false,
        "message" => "Login Error",
        "error" => $e->getMessage()
    ]);

    exit;
}