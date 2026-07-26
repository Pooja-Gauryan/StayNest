<!-- ==========================================================
     Add Property Form
========================================================== -->

<section class="add-property-page">

    <!-- ==========================
            Page Header
    =========================== -->

    <div class="page-title">

        <div>

            <h2>

                Edit Property

            </h2>

            <p>
                Update your property details.
            </p>

        </div>

    </div>

    <!-- ==========================
            Form Card
    =========================== -->

    <div class="form-card">

        <form
            id="editPropertyForm"
            action="../backend/api/property/update.php"
            method="POST"
            enctype="multipart/form-data">

            <input
                type="hidden"
                name="property_id"
                value="<?= $property["id"] ?>">


            <div class="row g-4">

                <!-- =====================================
                        Property Information
                ====================================== -->

                <div class="col-12">

                    <h4 class="form-heading">

                        Property Information

                    </h4>

                </div>

                <div class="col-md-6">

                    <label class="form-label">

                        Property Name

                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?= htmlspecialchars($property["title"]) ?>"
                        required>
                </div>

                <div class="col-md-6">

                    <label class="form-label">

                        Property Type

                    </label>

                    <select
                        name="property_type"
                        class="form-select"
                        required>

                        <option value="">Select Type</option>

                        <option value="PG"
                            <?= $property["property_type"] == "PG" ? "selected" : "" ?>>
                            PG
                        </option>

                        <option value="Hostel"
                            <?= $property["property_type"] == "Hostel" ? "selected" : "" ?>>
                            Hostel
                        </option>

                        <option value="Flat"
                            <?= $property["property_type"] == "Flat" ? "selected" : "" ?>>
                            Flat
                        </option>

                        <option value="Room"
                            <?= $property["property_type"] == "Room" ? "selected" : "" ?>>
                            Room
                        </option>

                    </select>

                </div>

                <div class="col-12">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="5"
                        required><?= htmlspecialchars($property["description"]) ?></textarea>

                    <div class="col-md-6">

                        <label class="form-label">

                            Room Type

                        </label>

                        <select
                            name="room_type"
                            class="form-select"
                            required>

                            <option value="">Select Room Type</option>

                            <option value="Single"
                                <?= $property["room_type"] == "Single" ? "selected" : "" ?>>
                                Single
                            </option>

                            <option value="Double"
                                <?= $property["room_type"] == "Double" ? "selected" : "" ?>>
                                Double
                            </option>

                            <option value="Triple"
                                <?= $property["room_type"] == "Triple" ? "selected" : "" ?>>
                                Triple
                            </option>

                            <option value="Shared"
                                <?= $property["room_type"] == "Shared" ? "selected" : "" ?>>
                                Shared
                            </option>

                        </select>

                    </div>
                </div>

                <!-- =====================================
                        Location
                ====================================== -->

                <div class="col-12 mt-3">

                    <h4 class="form-heading">

                        Location

                    </h4>

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        State

                    </label>

                    <input
                        type="text"
                        name="state"
                        class="form-control"
                        value="<?= htmlspecialchars($property["state"]) ?>"
                        required>
                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        City

                    </label>

                    <input
                        type="text"
                        name="city"
                        class="form-control"
                        value="<?= htmlspecialchars($property["city"]) ?>"
                        required>

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Area

                    </label>

                    <input
                        type="text"
                        name="area"
                        class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="form-label">

                        Full Address

                    </label>

                    <input
                        type="text"
                        name="address"
                        class="form-control"
                        value="<?= htmlspecialchars($property["address"]) ?>"
                        required>

                </div>

                <div class="col-md-6">

                    <label class="form-label">

                        Pincode

                    </label>

                    <input
                        type="text"
                        name="pincode"
                        class="form-control"
                        value="<?= htmlspecialchars($property["pincode"]) ?>"
                        required>

                </div>

                <!-- =====================================
                        Rent Details
                ====================================== -->

                <div class="col-12 mt-3">

                    <h4 class="form-heading">

                        Rent Details

                    </h4>

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Monthly Rent

                    </label>

                    <input
                        type="number"
                        name="monthly_rent"
                        class="form-control"
                        value="<?= $property["monthly_rent"] ?>"
                        required>

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Security Deposit

                    </label>

                    <input
                        type="number"
                        name="security_deposit"
                        class="form-control"
                        value="<?= $property["security_deposit"] ?>">
                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Available For

                    </label>

                    <select
                        name="gender_preference"
                        class="form-select">

                        <option value="Boys"
                            <?= $property["gender_preference"] == "Boys" ? "selected" : "" ?>>
                            Boys
                        </option>

                        <option value="Girls"
                            <?= $property["gender_preference"] == "Girls" ? "selected" : "" ?>>
                            Girls
                        </option>

                        <option value="Unisex"
                            <?= $property["gender_preference"] == "Unisex" ? "selected" : "" ?>>
                            Unisex
                        </option>

                    </select>

                </div>

                <!-- =====================================
                        Amenities
                ====================================== -->

                <div
                    class="row"

                    id="amenitiesContainer">

                </div>

                <!-- =====================================
                        Upload Images
                ====================================== -->

                <div class="col-12 mt-3">

                    <h4 class="form-heading">

                        Upload Images

                    </h4>

                </div>

                <div class="col-12">

                    <input
                        type="file"
                        name="images[]"
                        class="form-control"
                        multiple
                        accept=".jpg,.jpeg,.png,.webp">

                </div>

                <!-- =====================================
                        Submit
                ====================================== -->

                <div class="col-12 mt-4">

                    <button
                        type="submit"
                        class="btn publish-btn">

                        <i class="bi bi-pencil-upload"></i>

                        update Property

                    </button>

                </div>

            </div>

        </form>

    </div>

</section>