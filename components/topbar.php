<?php
require_once __DIR__ . '/../backend/helpers/session.php';
require_once __DIR__ . '/../backend/config/database.php';

$db = Database::connect();
$stmt = $db->prepare("SELECT full_name, profile_image FROM users WHERE id = ? LIMIT 1");
$stmt->execute([(int)($_SESSION['user']['id'] ?? 0)]);
$currentUser = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
$fullName = $currentUser['full_name'] ?? 'Student';
$profileImage = !empty($currentUser['profile_image'])
    ? '../' . ltrim($currentUser['profile_image'], '/')
    : '../assets/images/user/default-user.png';
?>
<header class="dashboard-topbar">
    <div class="topbar-left">
        <h3>Welcome Back 👋</h3>
        <p>Find your perfect student accommodation.</p>
    </div>

    <div class="topbar-right">
        <div class="topbar-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Search properties..." aria-label="Search properties">
        </div>

        <div class="topbar-notification-wrap">
            <button type="button" class="topbar-icon" id="notificationToggle"
                    aria-label="Notifications" aria-expanded="false">
                <i class="bi bi-bell"></i>
                <span class="notification-badge" id="notificationBadge" hidden>0</span>
            </button>
            <div class="notification-dropdown" id="notificationDropdown" hidden>
                <div class="notification-dropdown-head">
                    <strong>Notifications</strong>
                    <button type="button" id="markAllNotificationsRead">Mark all read</button>
                </div>
                <div id="notificationItems" class="notification-items">
                    <div class="notification-empty">Loading notifications...</div>
                </div>
            </div>
        </div>

        <a class="topbar-icon topbar-message-link" href="../dashboard/messages.php"
           aria-label="Open messages" title="Messages">
            <i class="bi bi-chat-dots"></i>
        </a>

        <div class="dropdown">
            <button class="profile-btn dropdown-toggle" data-bs-toggle="dropdown" type="button">
                <img src="<?= htmlspecialchars($profileImage, ENT_QUOTES, 'UTF-8') ?>"
                     alt="Profile" onerror="this.src='../assets/images/user/default-user.png'">
                <div>
                    <h6><?= htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8') ?></h6>
                    <small>Student</small>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="../dashboard/profile.php"><i class="bi bi-person"></i> My Profile</a></li>
                <li><a class="dropdown-item" href="../dashboard/settings.php"><i class="bi bi-gear"></i> Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="../dashboard/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</header>
<script src="../assets/js/dashboard-notifications.js?v=1" defer></script>
