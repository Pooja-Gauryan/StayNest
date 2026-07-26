<?php

declare(strict_types=1);

session_start();

require_once "../../config/database.php";
require_once "../../helpers/response.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid Request");
}

$db = Database::connect();

$currentPassword = $_POST["current_password"] ?? "";
$newPassword = $_POST["new_password"] ?? "";
$confirmPassword = $_POST["confirm_password"] ?? "";

if (
    empty($currentPassword) ||
    empty($newPassword) ||
    empty($confirmPassword)
) {
    die("All fields are required.");
}

if ($newPassword !== $confirmPassword) {
    die("Passwords do not match.");
}

$stmt = $db->prepare("
SELECT password
FROM users
WHERE id=?
LIMIT 1
");

$stmt->execute([
    $_SESSION["user"]["id"]
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}

if (!password_verify($currentPassword, $user["password"])) {
    die("Current password is incorrect.");
}

$newHash = password_hash(
    $newPassword,
    PASSWORD_DEFAULT
);

$update = $db->prepare("
UPDATE users
SET password=?
WHERE id=?
");

$update->execute([
    $newHash,
    $_SESSION["user"]["id"]
]);

$_SESSION["success"] = "Account Created Successfully";
header("Location: ../../../dashboard/settings.php?success=password");
exit;