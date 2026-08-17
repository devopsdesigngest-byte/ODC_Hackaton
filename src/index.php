<?php

function sessionStart(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

sessionStart();

require_once ('Router/router.php');

$demarrer = new router();
$demarrer->router();