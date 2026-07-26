<?php

declare(strict_types=1);

require_once "../../helpers/session.php";
require_once "../../helpers/response.php";

if (!isset($_SESSION["user"])) {

    jsonResponse(
        false,
        "Unauthorized",
        [],
        401
    );

}

jsonResponse(
    true,
    "Authenticated",
    $_SESSION["user"]
);