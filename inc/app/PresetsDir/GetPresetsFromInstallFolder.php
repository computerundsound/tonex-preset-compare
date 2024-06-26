<?php

namespace App\PresetsDir;

use App\config\Config;

class GetPresetsFromInstallFolder
{


    private Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }


    public function getPresetsFromInstallFolder(): array
    {

        $dir = $this->config->getPresetInstallPath()->path;

        $directoryContent = scandir($dir);

        $presets = [];

        foreach ($directoryContent as $file) {

            if (is_file($dir . '/' . $file)) {

                $preset    = trim($file);
                $presets[] = substr($preset, 0, -4);
            }

        }

        return $presets;


    }
}