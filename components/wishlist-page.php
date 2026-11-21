<?php
require_once __DIR__ . "/../backend/config/database.php";

$db = Database::connect();
$userId = (int)($_SESSION["user"]["id"] ?? 0);

$stmt = $db->prepare("
    SELECT
        p.id, p.title, p.property_type, p.room_type, p.gender_preference,
        p.monthly_rent, p.city, p.state,
        COALESCE(pi.image_path, '') AS cover_image
    FROM wishlist w
    INNER JOIN properties p ON p.id = w.property_id
    LEFT JOIN property_images pi
        ON pi.property_id = p.id AND pi.is_cover = 1
    WHERE w.user_id = ?
      AND p.deleted_at IS NULL
      AND p.is_available = 1
    ORDER BY w.created_at DESC
");
$stmt->execute([$userId]);
$wishlistProperties = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="wishlist-page">
    <div class="page-title">
        <div>
            <h2>My Wishlist</h2>
            <p>Your favourite student accommodations, all in one place.</p>
        </div>
        <a href="properties.php" class="btn browse-btn">
            <i class="bi bi-search"></i> Browse Properties
        </a>
    </div>

    <?php if ($wishlistProperties): ?>
        <div class="row g-4" id="wishlistGrid">
            <?php foreach ($wishlistProperties as $property): ?>
                <div class="col-12 col-sm-6 col-xl-4" data-wishlist-item="<?= (int)$property['id'] ?>">
                    <article class="wishlist-card">
                        <div class="wishlist-card-image">
                            <?php if (!empty($property['cover_image'])): ?>
                                <img src="../<?= htmlspecialchars($property['cover_image'], ENT_QUOTES, 'UTF-8') ?>"
                                     alt="<?= htmlspecialchars($property['title'], ENT_QUOTES, 'UTF-8') ?>">
                            <?php else: ?>
                                <div class="wishlist-image-placeholder"><i class="bi bi-house"></i></div>
                            <?php endif; ?>
                            <button type="button" class="wishlist-remove-btn"
                                    data-wishlist-remove="<?= (int)$property['id'] ?>"
                                    aria-label="Remove <?= htmlspecialchars($property['title'], ENT_QUOTES, 'UTF-8') ?> from wishlist">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        </div>
                        <div class="wishlist-card-body">
                            <span class="wishlist-type"><?= htmlspecialchars($property['property_type']) ?> · <?= htmlspecialchars($property['room_type']) ?></span>
                            <h3><?= htmlspecialchars($property['title']) ?></h3>
                            <p class="wishlist-location"><i class="bi bi-geo-alt"></i>
                                <?= htmlspecialchars($property['city']) ?>, <?= htmlspecialchars($property['state']) ?>
                            </p>
                            <div class="wishlist-card-footer">
                                <div><small>Starting from</small><strong>₹<?= number_format((float)$property['monthly_rent']) ?><span>/month</span></strong></div>
                                <a class="btn view-btn" href="property-details.php?id=<?= (int)$property['id'] ?>">View Details</a>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state" id="wishlistEmpty">
            <div class="empty-icon"><i class="bi bi-heart"></i></div>
            <h3>Your wishlist is empty</h3>
            <p>When you save a property, it will appear here so you can find it easily later.</p>
            <a href="properties.php" class="btn browse-btn">Explore Properties</a>
        </div>
    <?php endif; ?>
</section>
