<?php

use App\config\Config;

require_once __DIR__ . '/vendor/autoload.php';

$config = new Config(new SplFileInfo(__DIR__ . '/../config.yaml'));