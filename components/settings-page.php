<!-- ==========================================================
     Settings Page
========================================================== -->

<section class="settings-page">

    <div class="page-title">

        <div>

            <h2>Settings</h2>

            <p>Manage your account information and password.</p>

        </div>

        <?php if ($success == "password"): ?>

            <div class="alert alert-success">

                <i class="bi bi-check-circle-fill"></i>

                Password Updated Successfully.

            </div>

        <?php endif; ?>

    </div>

    <!-- ==========================
            Change Password
    =========================== -->

    <form
        action="../backend/api/profile/change-password.php"
        method="POST"
        class="mt-4">

        <div class="settings-card">

            <h4>

                <i class="bi bi-shield-lock-fill"></i>

                Change Password

            </h4>

            <div class="row g-4 mt-2">

                <div class="col-md-4">

                    <label class="form-label">

                        Current Password

                    </label>

                    <input
                        type="password"
                        name="current_password"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        New Password

                    </label>

                    <input
                        type="password"
                        name="new_password"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Confirm Password

                    </label>

                    <input
                        type="password"
                        name="confirm_password"
                        class="form-control"
                        required>

                </div>

                <div class="col-12">

                    <button
                        type="submit"
                        class="btn save-settings-btn">

                        <i class="bi bi-key-fill"></i>

                        Update Password

                    </button>

                </div>

            </div>

        </div>

    </form>

</section>