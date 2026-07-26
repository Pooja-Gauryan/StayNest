<?php

session_start();

require_once "../backend/config/database.php";

if (!isset($_SESSION["user"])) {

    header("Location: ../auth/login.php");
    exit;
}

$id = (int)($_GET["id"] ?? 0);

if ($id <= 0) {

    die("Invalid Property");
}

$db = Database::connect();

$stmt = $db->prepare("

SELECT

p.*,
u.full_name,

(
SELECT image_path
FROM property_images
WHERE property_id=p.id
AND is_cover=1
LIMIT 1

) AS cover_image

FROM properties p

INNER JOIN users u

ON p.user_id=u.id

WHERE

p.id=?

LIMIT 1

");

$stmt->execute([$id]);

$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {

    die("Property Not Found");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Property Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/topbar.css">
    <link rel="stylesheet" href="../assets/css/property-details.css">

</head>

<body>

    <?php include "../components/sidebar.php"; ?>

    <main class="dashboard-content">

        <?php include "../components/topbar.php"; ?>

        <?php include "../components/property-details-page.php"; ?>

    </main>
    <script src="../assets/js/alerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>