<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account | StayNest</title>

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Main CSS -->

    <link rel="stylesheet" href="../assets/css/main.css">

    <!-- Signup CSS -->

    <link rel="stylesheet" href="../assets/css/signup.css">

</head>

<body>

    <section class="signup-section">

        <div class="container">

            <div class="row justify-content-center align-items-center min-vh-100">

                <div class="col-lg-6 col-md-8">

                    <div class="signup-card">

                        <div class="text-center mb-4">

                            <div class="signup-logo">

                                <i class="bi bi-house-heart-fill"></i>

                            </div>

                            <h2>Create Your Account</h2>

                            <p>

                                Join StayNest and discover your perfect student home.

                            </p>

                        </div>

                        <form action="../backend/api/auth/signup.php" method="POST">
                            <!-- Full Name -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Full Name

                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Enter your full name"
                                    required>
                            </div>

                            <!-- Email -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Email Address

                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Enter your email"
                                    required>

                            </div>

                            <!-- Phone -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Mobile Number

                                </label>

                                <input
                                    type="tel"
                                    name="phone"
                                    class="form-control"
                                    placeholder="Enter your mobile number"
                                    required>
                            </div>

                            <!-- Password -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Password

                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Create a password"
                                    required>

                            </div>

                            <!-- Confirm Password -->

                            <div class="mb-4">

                                <label class="form-label">

                                    Confirm Password

                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Confirm your password"
                                    required>

                            </div>

                            <!-- Signup Button -->

                            <button
                                type="submit"
                                class="btn-signup-page">

                                Create Account

                            </button>

                        </form>

                        <div class="login-text">

                            Already have an account?

                            <a href="login.php">

                                Login

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>