<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | StayNest</title>

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Main CSS -->

    <link rel="stylesheet" href="../assets/css/main.css">

    <!-- Login CSS -->

    <link rel="stylesheet" href="../assets/css/login.css">



</head>

<body>

    <section class="login-section">

        <div class="container">

            <div class="row justify-content-center align-items-center min-vh-100">

                <div class="col-lg-5 col-md-7">

                    <div class="login-card">

                        <div class="text-center mb-4">

                            <div class="login-logo">

                                <i class="bi bi-house-heart-fill"></i>

                            </div>

                            <h2>Welcome Back</h2>

                            <p>

                                Login to continue your StayNest journey.

                            </p>

                        </div>


                        <form action="../backend/api/auth/login.php" method="POST">

                            <input type="hidden" name="abc" value="12345">

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

                            <!-- Password -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Password

                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Enter your password"
                                    required>
                            </div>

                            <!-- Forgot Password -->

                            <div class="text-end mb-4">

                                <a href="#" class="forgot-link">

                                    Forgot Password?

                                </a>

                            </div>

                            <!-- Login Button -->

                            <button
                                type="submit"
                                class="btn-login-page">

                                Login

                            </button>

                        </form>

                        <div class="signup-text">

                            Don't have an account?

                            <a href="signup.php">

                                Create Account

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