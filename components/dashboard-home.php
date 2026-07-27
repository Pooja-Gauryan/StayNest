<section class="dashboard-home">

    <!-- ==========================
            Welcome Section
    =========================== -->

    <div class="welcome-card">

        <div class="welcome-text">

            <h2>

                Welcome Back, <?= htmlspecialchars($_SESSION["user"]["name"]) ?> 👋

            </h2>

            <p>

                Find, save and manage your perfect student accommodation from one place.

            </p>

        </div>

    </div>

    <!-- ==========================
            Quick Stats
    =========================== -->

    <div class="row g-4 mt-1">

        <div class="col-xl-3 col-lg-6 col-md-6">

            <div class="stats-card">

                <i class="bi bi-buildings-fill"></i>

                <h3><?= $totalProperties ?></h3>

                <p>Total Properties</p>

            </div>

        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">

            <div class="stats-card">

                <i class="bi bi-heart-fill"></i>

                <h3><?= $wishlistCount ?></h3>

                <p>Wishlist</p>

            </div>

        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">

            <div class="stats-card">

                <i class="bi bi-house-check-fill"></i>

                <h3><?= $myProperties ?></h3>

                <p>My Properties</p>

            </div>

        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">

            <div class="stats-card">

                <i class="bi bi-eye-fill"></i>

                <h3><?= $totalViews ?></h3>

                <p>Total Views</p>

            </div>

        </div>

    </div>

    <!-- ==========================
            Recent Properties
    =========================== -->

    <div class="content-card mt-5">

    <div class="section-header">

        <h4>Recent Properties</h4>

        <a href="properties.php">
            View All
        </a>

    </div>

    <div class="row g-4 mt-2">

        <?php if (!empty($recentProperties)): ?>

            <?php foreach ($recentProperties as $property): ?>

                <div class="col-lg-4">

                    <?php include "../components/property-card.php"; ?>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-12">

                <p class="text-center text-muted">

                    No properties available.

                </p>

            </div>

        <?php endif; ?>

    </div>

</div>

    <!-- ==========================
            Recent Activity
    =========================== -->

    <div class="content-card mt-4">

        <div class="section-header">

            <h4>

                Recent Activity

            </h4>

        </div>

        <ul class="activity-list">

            <li>

                <i class="bi bi-check-circle-fill"></i>

                You added a property.

            </li>

            <li>

                <i class="bi bi-heart-fill"></i>

                You saved a property to Wishlist.

            </li>

            <li>

                <i class="bi bi-eye-fill"></i>

                Someone viewed your property.

            </li>

        </ul>

    </div>

</section>

