<section class="container-fluid py-4">

    <div class="card shadow border-0">

        <div class="row g-0">

            <div class="col-lg-5">

                <img

                    src="../<?= htmlspecialchars($property["cover_image"]) ?>"

                    class="img-fluid w-100"

                    style="height:420px;object-fit:cover;">

                    

            </div>

            <div class="col-lg-7">

                <div class="card-body p-4">

                    <h2>

                        <?= htmlspecialchars($property["title"]) ?>

                    </h2>

                    <span class="badge bg-success">

                        <?= htmlspecialchars($property["approval_status"]) ?>

                    </span>

                    <hr>

                    <h4 class="text-primary">

                        ₹<?= number_format($property["monthly_rent"]) ?>

                        <span class="fs-6">/ Month</span>

                    </h4>

                    <table class="table mt-4">

                        <tr>

                            <th>Property Type</th>

                            <td><?= $property["property_type"] ?></td>

                        </tr>

                        <tr>

                            <th>Room Type</th>

                            <td><?= $property["room_type"] ?></td>

                        </tr>

                        <tr>

                            <th>Gender</th>

                            <td><?= $property["gender_preference"] ?></td>

                        </tr>

                        <tr>

                            <th>Security</th>

                            <td>₹<?= number_format($property["security_deposit"]) ?></td>

                        </tr>

                        <tr>

                            <th>Owner</th>

                            <td><?= htmlspecialchars($property["full_name"]) ?></td>

                        </tr>

                        <tr>

                            <th>Location</th>

                            <td>

                                <?= htmlspecialchars($property["address"]) ?>

                                <br>

                                <?= htmlspecialchars($property["city"]) ?>,

                                <?= htmlspecialchars($property["state"]) ?>

                                -

                                <?= htmlspecialchars($property["pincode"]) ?>

                            </td>

                        </tr>

                    </table>

                    <h5>Description</h5>

                    <p>

                        <?= nl2br(htmlspecialchars($property["description"])) ?>

                    </p>

                    <a

                        href="edit-property.php?id=<?= $property["id"] ?>"

                        class="btn btn-warning">

                        Edit

                    </a>

                    <a

                        href="my-properties.php"

                        class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>