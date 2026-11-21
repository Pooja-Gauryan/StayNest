document.addEventListener("DOMContentLoaded", () => {
    const searchBtn = document.getElementById("searchBtn");

    if (searchBtn) {
        searchBtn.addEventListener("click", () => {
            const keyword = (document.getElementById("searchInput")?.value || "").trim().toLowerCase();
            const city = (document.getElementById("cityFilter")?.value || "City").toLowerCase();
            const gender = (document.getElementById("genderFilter")?.value || "Gender").toLowerCase();

            document.querySelectorAll(".property-card").forEach(card => {
                const text = card.innerText.toLowerCase();
                const matches = (!keyword || text.includes(keyword))
                    && (city === "city" || text.includes(city))
                    && (gender === "gender" || text.includes(gender));
                card.parentElement.style.display = matches ? "" : "none";
            });
        });
    }
});

document.addEventListener("click", async (event) => {
    const button = event.target.closest(".wishlist-btn");
    if (!button) return;

    const body = new URLSearchParams({ property_id: button.dataset.id });

    try {
        const response = await fetch("../backend/api/wishlist/add.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body
        });
        const result = await response.json();

        if (response.status === 401) {
            const loginUrl = "../auth/login.php";
            if (window.Swal) {
                const choice = await Swal.fire({
                    icon: "info",
                    title: "Login required",
                    text: "Please log in to save properties to your wishlist.",
                    showCancelButton: true,
                    confirmButtonText: "Login",
                    cancelButtonText: "Later"
                });
                if (choice.isConfirmed) window.location.href = loginUrl;
            } else {
                window.alert("Please log in to save properties to your wishlist.");
                window.location.href = loginUrl;
            }
            return;
        }

        if (!response.ok || !result.success) throw new Error(result.message || "Could not save property.");

        button.classList.add("is-saved");
        button.querySelector("i")?.classList.replace("bi-heart", "bi-heart-fill");

        if (window.Swal) {
            Swal.fire({ toast: true, position: "top-end", icon: "success", title: result.message, showConfirmButton: false, timer: 1800 });
        } else {
            window.alert(result.message);
        }
    } catch (error) {
        if (window.Swal) Swal.fire({ icon: "error", title: "Wishlist error", text: error.message });
        else window.alert(error.message);
    }
});
