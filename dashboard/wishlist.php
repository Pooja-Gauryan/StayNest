<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Wishlist | StayNest</title>

    <!-- Bootstrap CSS -->

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

    <link rel="stylesheet" href="../assets/css/wishlist.css">

    <link rel="stylesheet" href="../assets/css/property-card.css">
    <link rel="stylesheet" href="../assets/css/logout.css">

</head>

<body>

    <?php include "../components/sidebar.php"; ?>

    <main class="dashboard-content">

        <?php include "../components/topbar.php"; ?>

        <?php include "../components/wishlist-page.php"; ?>

        <!-- logout Page -->

        <?php include "../components/logout-modal.php"; ?>


    </main>
    <script src="../assets/js/alerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>