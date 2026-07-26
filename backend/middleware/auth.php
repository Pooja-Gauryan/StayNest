<?php

require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../helpers/response.php';



if (!isset($_SESSION['user'])) {

    jsonResponse(
        false,
        "Unauthorized",
        [],
        401
    );

}