<div class="col-12 col-sm-6 col-xl-4">

    <div class="my-property-card">

        <!-- =====================================
                Property Image
        ====================================== -->

        <div class="my-property-image">

            <img src="../<?= $property["cover_image"] ?>" alt="Property">

            <span class="status-badge">

                <?= htmlspecialchars($property["approval_status"]) ?>

            </span>

        </div>

        <!-- =====================================
                Property Details
        ====================================== -->

        <div class="my-property-body">

            <h4>

                <?= htmlspecialchars($property["title"]) ?>

            </h4>

            <p class="property-location">

                <i class="bi bi-geo-alt-fill"></i>

                <?= htmlspecialchars($property["city"]) ?>

            </p>

            <div class="property-price">

                ₹<?= number_format($property["monthly_rent"]) ?>

                <span>/ Month</span>

            </div>

            <div class="property-rating">

                <i class="bi bi-star-fill"></i>

                4.8

            </div>

        </div>

        <!-- =====================================
                Actions
        ====================================== -->

        <div class="property-actions">

            <a
                href="../dashboard/property-details.php?id=<?= $property["id"] ?>"

                class="btn btn-view">

                <i class="bi bi-eye-fill"></i>

                View

            </a>

            <a
                href="edit-property.php?id=<?= $property["id"] ?>"
                class="btn btn-edit">

                <i class="bi bi-pencil-square"></i>

                Edit

            </a>

            <button

                class="btn btn-delete"

                data-id="<?= $property["id"] ?>">

                <i class="bi bi-trash-fill"></i>

                Delete

            </button>

        </div>

    </div>

</div>