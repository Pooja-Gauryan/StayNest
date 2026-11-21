<?php
require_once __DIR__ . '/backend/helpers/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StayNest | Find Your Perfect Student Home</title>

    <meta name="description"
        content="Discover student-friendly PGs, hostels and accommodations with StayNest. Find a comfortable and affordable student home.">

    <meta name="robots" content="index, follow">

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="/assets/css/main.css?v=20261113">

</head>

<body>

    <!-- Landing Navbar -->
    <?php include __DIR__ . "/components/landing-navbar.php"; ?>

    <main>

        <!-- Hero Section -->
        <?php include __DIR__ . "/components/landing-hero.php"; ?>

        <!-- Why Choose StayNest -->
        <?php include __DIR__ . "/components/why-choose-us.php"; ?>

        <!-- Featured Properties -->
        <?php include __DIR__ . "/components/featured-properties.php"; ?>


    </main>

    <!-- Footer -->
    <footer class="landing-footer" id="contact">
        <div class="container">

            <div class="row align-items-center gy-3">

                <div class="col-md-6 text-center text-md-start">

                    <a href="index.php" class="footer-brand"
                       aria-label="StayNest Home">

                        <i class="bi bi-house-heart-fill"
                           aria-hidden="true"></i>

                        StayNest
                    </a>

                    <p class="footer-description mb-0">
                        Find a place where your student journey feels like home.
                    </p>

                </div>

                <div class="col-md-6 text-center text-md-end">

                    <p class="footer-copyright mb-0">
                        &copy; <?php echo date("Y"); ?> StayNest.
                        All rights reserved.
                    </p>

                </div>

            </div>

        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


</body>
</html>