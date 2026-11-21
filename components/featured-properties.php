<?php

declare(strict_types=1);

/* StayNest - Latest Featured Properties
Shows the three newest approved and currently available listings.*/

require_once __DIR__ . '/../backend/config/database.php';

$featuredProperties = [];
$featuredPropertiesError = false;

try {
    $db = Database::connect();

    $sql = "
        SELECT
            p.id,
            p.title,
            p.description,
            p.property_type,
            p.monthly_rent,
            p.city,
            p.state,
            (
                SELECT pi.image_path
                FROM property_images pi
                WHERE pi.property_id = p.id
                ORDER BY pi.is_cover DESC, pi.display_order ASC, pi.id ASC
                LIMIT 1
            ) AS cover_image
        FROM properties p
        WHERE p.deleted_at IS NULL
          AND p.is_available = 1
          AND p.approval_status = 'Approved'
        ORDER BY p.created_at DESC, p.id DESC
        LIMIT 3
    ";

    $stmt = $db->query($sql);
    $featuredProperties = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    // Keep the public landing page available if the listings database is down.
    $featuredPropertiesError = true;
    error_log('StayNest featured properties error: ' . $e->getMessage());
}
?>

<section class="featured-properties" id="properties">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="section-badge">
                    <i class="bi bi-buildings" aria-hidden="true"></i>
                    FEATURED PROPERTIES
                </span>

                <h2 class="section-title">
                    Explore Popular
                    <span>Student Homes</span>
                </h2>

                <p class="section-description">
                    Discover recently listed, approved and available student accommodations on StayNest.
                </p>
            </div>
        </div>

        <?php if (!empty($featuredProperties)): ?>
            <div class="row mt-5 g-4">
                <?php foreach ($featuredProperties as $property): ?>
                    <?php
                    $title = htmlspecialchars((string) $property['title'], ENT_QUOTES, 'UTF-8');
                    $city = htmlspecialchars((string) $property['city'], ENT_QUOTES, 'UTF-8');
                    $state = htmlspecialchars((string) $property['state'], ENT_QUOTES, 'UTF-8');
                    $type = htmlspecialchars((string) $property['property_type'], ENT_QUOTES, 'UTF-8');
                    $description = trim((string) $property['description']);
                    $description = mb_substr($description, 0, 115);
                    if (mb_strlen((string) $property['description']) > 115) {
                        $description .= '...';
                    }
                    $description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
                    $imagePath = trim((string) ($property['cover_image'] ?? ''));
                    $imagePath = $imagePath !== '' ? htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') : '';
                    ?>

                    <div class="col-lg-4 col-md-6">
                        <article class="property-card h-100">
                            <div class="property-image">
                                <?php if ($imagePath !== ''): ?>
                                    <img
                                        src="<?= $imagePath ?>"
                                        class="img-fluid"
                                        alt="<?= $title ?> accommodation"
                                        loading="lazy">
                                <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center w-100 h-100"
                                         style="min-height:220px;background:linear-gradient(135deg,#172554,#334155);color:#fff;">
                                        <i class="bi bi-house-heart" style="font-size:3rem;" aria-hidden="true"></i>
                                        <span class="visually-hidden">No property photo available</span>
                                    </div>
                                <?php endif; ?>

                                <span class="property-badge">Recently Added</span>
                            </div>

                            <div class="property-content">
                                <div class="property-top">
                                    <span class="property-location">
                                        <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                                        <?= $city ?>, <?= $state ?>
                                    </span>
                                    <span class="property-rating"><?= $type ?></span>
                                </div>

                                <h4><?= $title ?></h4>
                                <p><?= $description ?></p>

                                <div class="property-footer">
                                    <div>
                                        <h5>₹<?= number_format((float) $property['monthly_rent']) ?></h5>
                                        <small>/ month</small>
                                    </div>

                                    <a href="auth/login.php" class="property-btn">
                                        Login to View
                                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <div class="row mt-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center p-5 rounded-4"
                         style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.10);">
                        <i class="bi bi-houses" style="font-size:2.5rem;color:#94a3b8;" aria-hidden="true"></i>
                        <h3 class="mt-3 mb-2">
                            <?= $featuredPropertiesError ? 'Properties are temporarily unavailable' : 'New student homes are coming soon' ?>
                        </h3>
                        <p class="mb-0">
                            <?= $featuredPropertiesError
                                ? 'Please check back in a little while.'
                                : 'Approved and available properties will appear here as soon as they are listed.' ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>
