<?php

// this is the project entry point

use src\Kernel;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../app/config/routes.php';

$Kernel = new Kernel();
