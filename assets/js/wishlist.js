document.addEventListener("click", async (event) => {
    const removeButton = event.target.closest("[data-wishlist-remove]");
    if (!removeButton) return;

    const propertyId = removeButton.dataset.wishlistRemove;
    const card = removeButton.closest("[data-wishlist-item]");

    const confirmed = window.Swal
        ? (await Swal.fire({
            title: "Remove from wishlist?",
            text: "You can save this property again anytime.",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Remove",
            cancelButtonText: "Keep it",
            confirmButtonColor: "#dc3545"
        })).isConfirmed
        : window.confirm("Remove this property from your wishlist?");

    if (!confirmed) return;

    const body = new URLSearchParams({ property_id: propertyId });

    try {
        const response = await fetch("../backend/api/wishlist/remove.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body
        });
        const result = await response.json();

        if (!response.ok || !result.success) {
            throw new Error(result.message || "Could not remove this property.");
        }

        card?.remove();

        const grid = document.getElementById("wishlistGrid");
        if (grid && !grid.querySelector("[data-wishlist-item]")) {
            grid.remove();
            document.querySelector(".wishlist-page").insertAdjacentHTML("beforeend", `
                <div class="empty-state" id="wishlistEmpty">
                    <div class="empty-icon"><i class="bi bi-heart"></i></div>
                    <h3>Your wishlist is empty</h3>
                    <p>When you save a property, it will appear here so you can find it easily later.</p>
                    <a href="properties.php" class="btn browse-btn">Explore Properties</a>
                </div>
            `);
        }

        if (window.Swal) {
            Swal.fire({ toast: true, position: "top-end", icon: "success", title: result.message, showConfirmButton: false, timer: 1800 });
        }
    } catch (error) {
        if (window.Swal) Swal.fire({ icon: "error", title: "Could not update wishlist", text: error.message });
        else window.alert(error.message);
    }
});
