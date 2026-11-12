document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("loginForm");

    if (!form) return;

    form.addEventListener("submit", async function (e) {

        e.preventDefault();

        const submitBtn = form.querySelector("button[type='submit']");

        submitBtn.disabled = true;

        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm"></span>
            Logging in...
        `;

        try {

            const formData = new FormData(form);

            const response = await fetch(
                "../backend/api/auth/login.php",
                {
                    method: "POST",
                    body: formData,
                    credentials: "same-origin"
                }
            );

            const result = await response.json();

            if (result.success) {

                Swal.fire({
                    icon: "success",
                    title: "Welcome Back!",
                    text: result.message,
                    timer: 1200,
                    showConfirmButton: false
                });

                setTimeout(() => {

                    window.location.href = "../dashboard/home.php";

                }, 1200);

            } else {

                Swal.fire({
                    icon: "error",
                    title: "Login Failed",
                    text: result.message
                });

            }

        } catch (error) {

            console.error(error);

            Swal.fire({
                icon: "error",
                title: "Network Error",
                text: "Please try again."
            });

        }

        submitBtn.disabled = false;

        submitBtn.innerHTML = "Login";

    });

});