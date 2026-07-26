<!-- ==========================================================
        Properties Page
========================================================== -->

<?php

require_once "../backend/config/database.php";

$db = Database::connect();

$stmt = $db->query("

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

p.deleted_at IS NULL

ORDER BY p.created_at DESC

");

$properties = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="properties-page">

    <!-- ======================================
            Page Header
    ======================================= -->

    <div class="page-title">

        <div>

            <h2>

                Properties

            </h2>

            <p>

                Explore verified student accommodations.

            </p>

        </div>

        <a href="add-property.php" class="btn add-property-btn">

            <i class="bi bi-plus-circle"></i>

            Add Property

        </a>

    </div>


    <!-- ======================================
            Search & Filters
    ======================================= -->

    <div class="property-filter">

        <div class="row g-3">

            <!-- Search -->

            <div class="col-xl-4 col-lg-12">

                <div class="search-box">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        class="form-control"
                        id="searchInput"
                        placeholder="Search by property name">

                </div>

            </div>

            <!-- City -->

            <div class="col-xl-2 col-md-4">

                <select
                    class="form-select"
                    id="cityFilter">

                    <option>City</option>

                    <option>Delhi</option>

                    <option>Noida</option>

                    <option>Gurgaon</option>

                </select>

            </div>

            <!-- Budget -->

            <div class="col-xl-2 col-md-4">

                <select
                    class="form-select"
                    id="budgetFilter">

                    <option>Budget</option>

                    <option>₹3000 - ₹5000</option>

                    <option>₹5000 - ₹8000</option>

                    <option>₹8000+</option>

                </select>

            </div>

            <!-- Gender -->

            <div class="col-xl-2 col-md-4">

                <select
                    class="form-select"
                    id="genderFilter">

                    <option>Gender</option>

                    <option>Boys</option>

                    <option>Girls</option>

                    <option>Co-Living</option>

                </select>

            </div>

            <!-- Button -->

            <div class="col-xl-2">

                <button
                    class="btn search-btn w-100"
                    id="searchBtn">

                    Search

                </button>

            </div>

        </div>

    </div>


    <!-- ======================================
            Property Grid
    ======================================= -->

    <div class="row mt-4 g-4">

        <?php if (count($properties) > 0): ?>

            <?php foreach ($properties as $property): ?>

                <?php include "../components/property-card.php"; ?>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-12">

                <h3 class="text-center">

                    No Properties Found

                </h3>

            </div>

        <?php endif; ?>

    </div>


    <!-- ======================================
            Pagination
    ======================================= -->

    <nav class="mt-5">

        <ul class="pagination justify-content-center">

            <li class="page-item disabled">

                <a class="page-link">

                    Previous

                </a>

            </li>

            <li class="page-item active">

                <a class="page-link">

                    1

                </a>

            </li>

            <li class="page-item">

                <a class="page-link">

                    2

                </a>

            </li>

            <li class="page-item">

                <a class="page-link">

                    3

                </a>

            </li>

            <li class="page-item">

                <a class="page-link">

                    Next

                </a>

            </li>

        </ul>

    </nav>

</section>