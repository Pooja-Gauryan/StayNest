<?php
session_start();

require_once "../backend/config/database.php";

$db = Database::connect();
$stmt = $db->prepare("

SELECT
p.*,
(

SELECT image_path
FROM property_images

WHERE property_id=p.id
AND is_cover=1
LIMIT 1
) AS cover_image
FROM properties p
WHERE
p.user_id=?
AND p.deleted_at IS NULL
ORDER BY p.created_at DESC
");

$stmt->execute([
$_SESSION["user"]["id"]
]);

$properties=$stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport"
            content="width=device-width, initial-scale=1.0">
      <title>My Properties | StayNest</title>

      <!-- Bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet">

      <!-- Bootstrap Icons -->
      <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

      <!-- CSS -->
      <link rel="stylesheet" href="../assets/css/main.css">
      <link rel="stylesheet" href="../assets/css/sidebar.css">
      <link rel="stylesheet" href="../assets/css/dashboard.css">
      <link rel="stylesheet" href="../assets/css/topbar.css">
      <link rel="stylesheet" href="../assets/css/property-card.css">
      <link rel="stylesheet" href="../assets/css/my-properties.css">
      <link rel="stylesheet" href="../assets/css/logout.css">
</head>
<body>
      <?php include "../components/sidebar.php"; ?>
      <main class="dashboard-content">
            <?php include "../components/topbar.php"; ?>
            <?php include "../components/my-properties-page.php"; ?>

            <!-- logout Page -->
            <?php include "../components/logout-modal.php"; ?>


      </main>
      <script src="../assets/js/my-properties.js"></script>
      <script src="../assets/js/alerts.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


