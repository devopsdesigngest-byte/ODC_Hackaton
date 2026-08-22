<?php

require_once dirname(__DIR__) . "/app/core/router.php";
require_once dirname(__DIR__) . "/app/config/database.php";

require_once dirname(__DIR__)."/app/core/SessionManager.php";
init_session();

Router();