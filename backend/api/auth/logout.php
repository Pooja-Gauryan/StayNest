<?php

declare(strict_types=1);

require_once "../../helpers/session.php";
require_once "../../helpers/response.php";

session_unset();
session_destroy();

jsonResponse(
    true,
    "Logout Successful"
);