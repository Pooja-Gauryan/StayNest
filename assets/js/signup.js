document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("signupForm");

    if (!form) {
        console.error("Signup form not found");
        return;
    }

    form.addEventListener("submit", async function (e) {

        e.preventDefault();

        const submitBtn = form.querySelector(
            "button[type='submit']"
        );

        submitBtn.disabled = true;

        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm"></span>
            Creating Account...
        `;

        try {

            const formData = new FormData(form);

            console.log("Name:", formData.get("name"));
            console.log("Email:", formData.get("email"));
            console.log("Phone:", formData.get("phone"));
            console.log("Password:", formData.get("password"));

            const response = await fetch(
                "../backend/api/auth/signup.php",
                {
                    method: "POST",
                    body: formData,
                    credentials: "same-origin"
                }
            );

            const result = await response.json();

            console.log("Signup Response:", result);

            if (result.success) {

                alert("Account created successfully!");

                form.reset();

                window.location.href = "login.php";

            } else {

                alert(result.message);

            }

        } catch (error) {

            console.error("Signup Error:", error);

            alert("Something went wrong. Please try again.");

        } finally {

            submitBtn.disabled = false;

            submitBtn.innerHTML = "Create Account";

        }

    });

});