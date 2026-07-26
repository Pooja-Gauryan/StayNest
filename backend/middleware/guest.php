<?php

declare(strict_types=1);

require_once __DIR__ . "/../helpers/session.php";

if (isset($_SESSION["user"])) {

    header("Location: http://localhost/StayNest/dashboard/home.php");
    exit;

}