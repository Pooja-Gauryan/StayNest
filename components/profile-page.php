<!-- ==========================================================
     Profile Page
========================================================== -->

<section class="profile-page">

    <!-- =====================================
            Page Header
    ====================================== -->

    <div class="page-title">

        <div>

            <h2>

                My Profile

            </h2>

            <p>

                Manage your personal information and account settings.

            </p>

        </div>

    </div>


    <div class="row g-4">

        <!-- =====================================
                Left Profile Card
        ====================================== -->

        <div class="col-lg-4">

            <div class="profile-card">

                <div class="profile-image">

                    <img
                        src="<?= BASE_URL . '/' . (!empty($user["profile_image"])
                                    ? $user["profile_image"]
                                    : "assets/images/user/default-user.png") ?>"
                        alt="Profile">

                </div>

                <h3>

                    <?= htmlspecialchars($user["full_name"]) ?>

                </h3>

                <span class="account-type">

                    <?= htmlspecialchars($user["occupation"] ?: "Student") ?>

                </span>

                <button
                    type="button"
                    class="btn upload-btn">

                    <i class="bi bi-camera-fill"></i>

                    Change Photo

                </button>

                <hr>

                <div class="profile-progress">

                    <div class="d-flex justify-content-between">

                        <span>

                            Profile Completion

                        </span>

                        <span>

                            80%

                        </span>

                    </div>

                    <div class="progress mt-2">

                        <div
                            class="progress-bar"
                            style="width:80%">

                        </div>

                    </div>

                </div>

                <div class="account-info mt-4">

                    <p>

                        <i class="bi bi-calendar-event-fill"></i>

                        Member Since :

                        <?= date(
                            "d M Y",
                            strtotime($user["created_at"])
                        ) ?>

                    </p>

                    <p>

                        <i class="bi bi-envelope-fill"></i>

                        <?= htmlspecialchars($user["email"]) ?>

                    </p>

                    <p>

                        <i class="bi bi-telephone-fill"></i>

                        <?= htmlspecialchars(
                            $user["phone"] ?: "Not Added"
                        ) ?>

                    </p>

                </div>

            </div>

        </div>

        <!-- =====================================
                Right Form
        ====================================== -->

        <div class="col-lg-8">

            <div class="profile-form-card">

                <form
                    id="profileForm"
                    enctype="multipart/form-data">

                    <div class="row g-4">

                        <div class="col-md-6">

                            <label class="form-label">

                                Full Name

                            </label>

                            <input
                                type="text"
                                name="full_name"
                                class="form-control"
                                value="<?= htmlspecialchars($user["full_name"]) ?>">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Username

                            </label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                value="<?= htmlspecialchars($user["username"]) ?>">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                class="form-control"
                                value="<?= htmlspecialchars($user["email"]) ?>"
                                readonly>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Phone

                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="<?= htmlspecialchars($user["phone"]) ?>">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                College

                            </label>

                            <input
                                type="text"
                                name="college"
                                class="form-control"
                                value="<?= htmlspecialchars($user["college"]) ?>">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Occupation

                            </label>

                            <input
                                type="text"
                                name="occupation"
                                class="form-control"
                                value="<?= htmlspecialchars($user["occupation"]) ?>">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Gender

                            </label>

                            <select
                                name="gender"
                                class="form-select">

                                <option value="">Select</option>

                                <option value="Male"
                                    <?= $user["gender"] == "Male" ? "selected" : "" ?>>
                                    Male
                                </option>

                                <option value="Female"
                                    <?= $user["gender"] == "Female" ? "selected" : "" ?>>
                                    Female
                                </option>

                                <option value="Other"
                                    <?= $user["gender"] == "Other" ? "selected" : "" ?>>
                                    Other
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                City

                            </label>

                            <input
                                type="text"
                                name="city"
                                class="form-control"
                                value="<?= htmlspecialchars($user["city"]) ?>">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                State

                            </label>

                            <input
                                type="text"
                                name="state"
                                class="form-control"
                                value="<?= htmlspecialchars($user["state"]) ?>">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Profile Image

                            </label>

                            <input
                                type="file"
                                name="profile_image"
                                class="form-control">

                        </div>

                        <div class="col-12">

                            <label class="form-label">

                                Bio

                            </label>

                            <textarea
                                name="bio"
                                class="form-control"
                                rows="5"><?= htmlspecialchars($user["bio"]) ?></textarea>

                        </div>

                        <div class="col-12">

                            <button
                                type="submit"
                                class="btn save-profile-btn">

                                <i class="bi bi-check-circle-fill"></i>

                                Save Changes

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>