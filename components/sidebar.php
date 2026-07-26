<?php

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<!-- ==========================================
                Mobile Toggle
=========================================== -->

<button class="sidebar-toggle d-lg-none"
    type="button"
    data-bs-toggle="offcanvas"
    data-bs-target="#sidebarMenu">

    <i class="bi bi-list"></i>

</button>

<!-- ==========================================
                Sidebar
=========================================== -->

<div class="offcanvas-lg offcanvas-start sidebar"
    tabindex="-1"
    id="sidebarMenu">

    <!-- Sidebar Header -->

    <div class="sidebar-header">

        <a href="../dashboard/home.php" class="sidebar-logo">

            <div class="logo-box">

                <i class="bi bi-house-heart-fill"></i>

            </div>

            <div class="logo-text">

                <h4>

                    Stay<span>Nest</span>

                </h4>

                <small>

                    Student Accommodation

                </small>

            </div>

        </a>

    </div>

    <!-- Navigation -->

    <div class="sidebar-menu">

        <ul>

            <li>

                <a href="../dashboard/home.php"
                    class="<?= ($currentPage == "home.php") ? "active" : "" ?>">

                    <i class="bi bi-grid-1x2-fill"></i>

                    <span>Dashboard</span>

                </a>

            </li>

            <li>

                <a href="../dashboard/properties.php"
                    class="<?= ($currentPage == "properties.php") ? "active" : "" ?>">

                    <i class="bi bi-buildings-fill"></i>

                    <span>Properties</span>

                </a>

            </li>

            <li>

                <a href="../dashboard/add-property.php"
                    class="<?= ($currentPage == "add-property.php") ? "active" : "" ?>">

                    <i class="bi bi-plus-circle-fill"></i>

                    <span>Add Property</span>

                </a>

            </li>

            <li>

                <a href="../dashboard/my-properties.php"
                    class="<?= ($currentPage == "my-properties.php") ? "active" : "" ?>">

                    <i class="bi bi-house-check-fill"></i>

                    <span>My Properties</span>

                </a>

            </li>

            <li>

                <a href="../dashboard/wishlist.php"
                    class="<?= ($currentPage == "wishlist.php") ? "active" : "" ?>">

                    <i class="bi bi-heart-fill"></i>

                    <span>Wishlist</span>

                </a>

            </li>

            <li class="sidebar-item">

                <a href="../dashboard/messages.php"
                    class="sidebar-link <?= ($currentPage == "messages.php") ? "active" : "" ?>">

                    <i class="bi bi-chat-dots-fill"></i>

                    <span>

                        Messages

                    </span>

                </a>

            </li>

            <li>

                <a href="../dashboard/profile.php"
                    class="<?= ($currentPage == "profile.php") ? "active" : "" ?>">

                    <i class="bi bi-person-circle"></i>

                    <span>Profile</span>

                </a>

            </li>

        </ul>

    </div>

    <!-- Bottom Menu -->

    <div class="sidebar-footer">

        <a href="../dashboard/settings.php"
            class="<?= ($currentPage == "settings.php") ? "active" : "" ?>">

            <i class="bi bi-gear-fill"></i>

            <span>Settings</span>

            <a href="#"

                data-bs-toggle="modal"

                data-bs-target="#logoutModal"

                class="sidebar-link logout-link">

                <i class="bi bi-box-arrow-right"></i>

                <span>Logout</span>

            </a>

    </div>

</div>