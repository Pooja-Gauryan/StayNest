<!-- ==========================================================
     StayNest Dashboard Topbar
========================================================== -->

<?php

require_once "../backend/config/database.php";

$db = Database::connect();

$stmt = $db->prepare("
SELECT full_name, profile_image
FROM users
WHERE id=?
LIMIT 1
");

$stmt->execute([
    $_SESSION["user"]["id"]
]);

$currentUser = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<header class="dashboard-topbar">

    <div class="topbar-left">

        <h3>

            Welcome Back 👋

        </h3>

        <p>

            Find your perfect student accommodation.

        </p>

    </div>

    <div class="topbar-right">

        <!-- Search -->

        <div class="topbar-search">

            <i class="bi bi-search"></i>

            <input
                type="text"
                placeholder="Search properties...">

        </div>

        <!-- Notifications -->

        <button class="topbar-icon">

            <i class="bi bi-bell"></i>

            <span class="notification-badge">

                3

            </span>

        </button>

        <!-- Messages -->

        <button class="topbar-icon">

            <i class="bi bi-chat-dots"></i>

        </button>

        <!-- User -->

        <div class="dropdown">

            <button
                class="profile-btn dropdown-toggle"
                data-bs-toggle="dropdown">

                <img
                    src="../<?= !empty($currentUser["profile_image"])
                                ? $currentUser["profile_image"]
                                : "assets/images/user/default-user.png" ?>"
                    alt="User">

                <div>

                    <h6>

                        <?= htmlspecialchars($currentUser["full_name"]) ?>

                    </h6>

                    <small>

                        Student

                    </small>

                </div>

            </button>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>

                    <a class="dropdown-item"
                        href="../dashboard/profile.php">

                        <i class="bi bi-person"></i>

                        My Profile

                    </a>

                </li>

                <li>

                    <a class="dropdown-item"
                        href="../dashboard/settings.php">

                        <i class="bi bi-gear"></i>

                        Settings

                    </a>

                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

                    <a class="dropdown-item text-danger"
                        href="../dashboard/logout.php">

                        <i class="bi bi-box-arrow-right"></i>

                        Logout

                    </a>

                </li>

            </ul>

        </div>

    </div>

    <?php if (isset($_SESSION["success"])): ?>

        <script>
            showSuccess("<?= $_SESSION["success"] ?>");
        </script>

        <?php unset($_SESSION["success"]); ?>

    <?php endif; ?>


    <?php if (isset($_SESSION["error"])): ?>

        <script>
            showError("<?= $_SESSION["error"] ?>");
        </script>

        <?php unset($_SESSION["error"]); ?>

    <?php endif; ?>

</header>