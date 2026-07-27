<?php

declare(strict_types=1);

require_once "../../helpers/session.php";

session_unset();
session_destroy();

header("Location: http://localhost/StayNest/");
exit;