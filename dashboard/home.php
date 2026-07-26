<?php

require_once "../backend/helpers/session.php";

if (!isset($_SESSION["user"])) {

    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | StayNest</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/topbar.css">
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/logout.css">


</head>

<body>

    <?php include "../components/sidebar.php"; ?>

    <div class="dashboard-content">

        <?php include "../components/topbar.php"; ?>

        <?php

        $db = Database::connect();

        $userId = $_SESSION["user"]["id"];

        /*
|--------------------------------------------------------------------------
| Total Properties
|--------------------------------------------------------------------------
*/

        $stmt = $db->prepare("
SELECT COUNT(*)
FROM properties
");

        $stmt->execute();

        $totalProperties = $stmt->fetchColumn();

        /*
|--------------------------------------------------------------------------
| My Properties
|--------------------------------------------------------------------------
*/

        $stmt = $db->prepare("
SELECT COUNT(*)
FROM properties
WHERE user_id=?
");



        $stmt->execute([$userId]);

        $myProperties = $stmt->fetchColumn();

        /*
|--------------------------------------------------------------------------
| Wishlist
|--------------------------------------------------------------------------
*/

        $stmt = $db->prepare("
SELECT COUNT(*)
FROM wishlist
WHERE user_id=?
");

        $stmt->execute([$userId]);

        $wishlistCount = $stmt->fetchColumn();

        /*
|--------------------------------------------------------------------------
| Total Views (Future Feature)
|--------------------------------------------------------------------------
*/

        $totalViews = 0;

        ?>

        <?php include "../components/dashboard-home.php"; ?>

        <?php include "../components/logout-modal.php"; ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/alerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>