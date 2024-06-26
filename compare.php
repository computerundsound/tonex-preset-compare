<?php

global $config;

use App\cleaner\Cleaner;
use App\compare\Compare;
use App\db\TonexDb;
use App\PresetsDir\GetPresetsFromInstallFolder;

require_once __DIR__ . '/inc/boot.php';

$compare =
    new Compare(
        new TonexDb($config->getTonexDbFile(), new Cleaner()),
        new GetPresetsFromInstallFolder($config));

$notInstalledPresets = $compare->getNotInstalledPresets();

print_r($notInstalledPresets);