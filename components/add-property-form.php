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

                Add New Property

            </h2>

            <p>

                Fill in the details to publish your student accommodation.

            </p>

        </div>

    </div>

    <!-- ==========================
            Form Card
    =========================== -->

    <div class="form-card">

        <form
            id="addPropertyForm"
            action="../backend/api/property/create.php"
            method="POST"
            enctype="multipart/form-data">

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
                        placeholder="Modern Student PG"
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

                        <option value="PG">PG</option>

                        <option value="Hostel">Hostel</option>

                        <option value="Flat">Flat</option>

                        <option value="Room">Room</option>

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
                        required
                        placeholder="Write property description...">
                    </textarea>

                    <div class="col-md-6">

                        <label class="form-label">

                            Room Type

                        </label>

                        <select
                            name="room_type"
                            class="form-select"
                            required>

                            <option value="">Select Room Type</option>

                            <option value="Single">Single</option>

                            <option value="Double">Double</option>

                            <option value="Triple">Triple</option>

                            <option value="Shared">Shared</option>

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
                        value="0">

                </div>

                <div class="col-md-4">

                    <label class="form-label">

                        Available For

                    </label>

                    <select
                        name="gender_preference"
                        class="form-select">

                        <option value="Unisex">Select</option>

                        <option value="Boys">Boys</option>

                        <option value="Girls">Girls</option>

                        <option value="Unisex">Unisex</option>

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

                        <i class="bi bi-cloud-upload"></i>

                        Publish Property

                    </button>

                </div>

            </div>

        </form>

    </div>

</section>