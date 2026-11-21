
<?php
require_once __DIR__ . '/../backend/helpers/session.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit;
}

$currentUserId = (int)($_SESSION['user']['id'] ?? 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages | StayNest</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/topbar.css">
    <link rel="stylesheet" href="../assets/css/messages.css">
    <link rel="stylesheet" href="../assets/css/logout.css">
</head>

<body>

    <?php include __DIR__ . '/../components/sidebar.php'; ?>

    <main class="dashboard-content">

        <?php include __DIR__ . '/../components/topbar.php'; ?>

        <?php include __DIR__ . '/../components/messages-page.php'; ?>

    </main>

    <?php include __DIR__ . '/../components/logout-modal.php'; ?>

    <script>
        window.CURRENT_USER_ID = <?= $currentUserId ?>;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/alerts.js"></script>

    <!-- New Chat Script -->
    <script src="../assets/js/staynest-messages.js?v=3"></script>

</body>
</html>
