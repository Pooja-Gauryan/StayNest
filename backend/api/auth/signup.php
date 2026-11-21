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
    $name = clean($_POST["name"] ?? "");
    $email = clean($_POST["email"] ?? "");
    $phone = clean($_POST["phone"] ?? "");
    $password = $_POST["password"] ?? "";

    /* Validate Required Fields*/
    if (isEmpty($name, $email, $phone, $password)) {
        jsonResponse(false, "All fields are required");
    }

    /* Validate Email */
    if (!isEmail($email)) {
        jsonResponse(false, "Invalid email");
    }

    /* Validate Password    */
    if (strlen($password) < 8) {
        jsonResponse(false, "Password must be at least 8 characters");
    }

    /*  Database Connection    */
    $db = Database::connect();

    /* Check Email */
    $stmt = $db->prepare("
        SELECT id
        FROM users
        WHERE email = ?
        LIMIT 1
    ");

    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        jsonResponse(false, "Email already registered");
    }

    /* Check Phone */
    $stmt = $db->prepare("
        SELECT id
        FROM users
        WHERE phone = ?
        LIMIT 1
    ");

    $stmt->execute([$phone]);
    if ($stmt->fetch()) {
        jsonResponse(false, "Phone number already registered");
    }

    /* Create User */
    $hash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $stmt = $db->prepare("
        INSERT INTO users (
            full_name,
            email,
            phone,
            password
        )
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        $name,
        $email,
        $phone,
        $hash
    ]);

    /*  Success Response  */
    jsonResponse(
        true,
        "Account created successfully"
    );

} catch (Throwable $e) {

    http_response_code(500);

    header("Content-Type: application/json");

    echo json_encode([
        "success" => false,
        "message" => "Signup Error",
        "error" => $e->getMessage()
    ]);
    exit;
}