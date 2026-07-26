<!-- ==========================================================
     My Properties Page
========================================================== -->

<section class="my-properties-page">

    <!-- ==========================
            Page Header
    =========================== -->

    <div class="page-title">

        <div>

            <h2>

                My Properties

            </h2>

            <p>

                Manage all your listed student accommodations.

            </p>

        </div>

        <a href="add-property.php" class="btn add-property-btn">

            <i class="bi bi-plus-circle"></i>

            Add Property

        </a>

    </div>


    <!-- ==========================
            Statistics
    =========================== -->

    <div class="row g-4 mb-4">

        <div class="col-md-4">

            <div class="stats-card">

                <h3>

                    12

                </h3>

                <p>

                    Total Properties

                </p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="stats-card">

                <h3>

                    8

                </h3>

                <p>

                    Available

                </p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="stats-card">

                <h3>

                    4

                </h3>

                <p>

                    Occupied

                </p>

            </div>

        </div>

    </div>


    <!-- ==========================
            Property List
    =========================== -->

    <div class="row g-4">

        <?php if (count($properties) > 0): ?>

            <?php foreach ($properties as $property): ?>

                <?php include "../components/my-property-card.php"; ?>

            <?php endforeach; ?>

        <?php else: ?>

            <h3 class="text-center">

                No Properties Found

            </h3>

        <?php endif; ?>

    </div>


    <!-- ==========================
            Empty State
    =========================== -->

    <!--

    <div class="empty-state">

        <div class="empty-icon">

            <i class="bi bi-house"></i>

        </div>

        <h3>

            No Properties Found

        </h3>

        <p>

            Start by adding your first property.

        </p>

        <a href="add-property.php"
           class="btn browse-btn">

            Add Property

        </a>

    </div>

    -->

</section>