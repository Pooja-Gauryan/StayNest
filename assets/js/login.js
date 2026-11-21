document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("loginForm");
    if (!form) return;

    // Only the feedback entry point may return to the landing page.
    const requestedRedirect = new URLSearchParams(window.location.search).get("redirect");
    const redirectAfterLogin = requestedRedirect === "../index.php#reviews"
        ? "../index.php#reviews"
        : "../dashboard/home.php";

    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const submitBtn = form.querySelector("button[type='submit']");
        if (!submitBtn) return;

        const originalButtonText = submitBtn.textContent.trim() || "Login";
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
            Logging in...
        `;

        try {
            const response = await fetch("../backend/api/auth/login.php", {
                method: "POST",
                body: new FormData(form),
                credentials: "same-origin"
            });
            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.message || "Unable to log in. Please try again.");
            }

            await Swal.fire({
                icon: "success",
                title: "Welcome Back!",
                text: result.message || "Login successful.",
                timer: 1000,
                showConfirmButton: false
            });

            window.location.href = redirectAfterLogin;
        } catch (error) {
            console.error(error);
            await Swal.fire({
                icon: "error",
                title: "Login Failed",
                text: error.message || "Please check your connection and try again."
            });
            submitBtn.disabled = false;
            submitBtn.textContent = originalButtonText;
        }
    });
});
