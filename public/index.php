<?php

define('PATHBASE', dirname(__DIR__));
define("WEB_ROUTE", "http://localhost:8000");

require_once(PATHBASE. "/vendor/autoload.php");

use App\Core\Router as R;

R::router();