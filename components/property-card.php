<div class="col-12 col-sm-6 col-lg-4">

    <div class="property-card">

        <!-- ==========================
                Property Image
        =========================== -->

        <div class="property-image">

            <img src="../<?= $property["cover_image"] ?>" alt="Property">

            <span class="status-badge">

                <?= htmlspecialchars($property["approval_status"]) ?>

            </span>

            <!-- Wishlist -->

            <button
                class="wishlist-btn"
                data-id="<?= $property["id"] ?>">

                <i class="bi bi-heart"></i>

            </button>

            <!-- Badge -->

            <span class="property-badge">

                <?= htmlspecialchars($property["approval_status"]) ?>

            </span>

        </div>

        <!-- ==========================
                Card Body
        =========================== -->

        <div class="property-body">

            <div class="property-rating">

                <i class="bi bi-star-fill"></i>

                <span>

                    4.8

                </span>

            </div>

            <h4>

                <?= htmlspecialchars($property["title"]) ?>

            </h4>

            <p class="location">

                <i class="bi bi-geo-alt-fill"></i>

                <?= htmlspecialchars($property["city"]) ?>,
                <?= htmlspecialchars($property["state"]) ?>

            </p>

            <div class="property-info">

                <span>

                    <i class="bi bi-house-door-fill"></i>

                    <?= htmlspecialchars($property["gender_preference"]) ?>

                </span>

                <span>

                    <i class="bi bi-wifi"></i>

                    Free WiFi

                </span>

                <span>

                    <i class="bi bi-car-front-fill"></i>

                    Parking

                </span>

            </div>

            <div class="property-footer">

                <div>

                    <small>

                        Starting From

                    </small>

                    <h5>

                        ₹<?= number_format($property["monthly_rent"]) ?>

                        <span>/month</span>

                    </h5>

                </div>

                <a
                    href="property-details.php?id=<?= $property["id"] ?>"
                    class="btn view-btn">

                    View

                </a>

            </div>

        </div>

    </div>

</div>