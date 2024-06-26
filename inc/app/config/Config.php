<?php

namespace App\config;

use Directory;
use SplFileInfo;
use Symfony\Component\Yaml\Yaml;

class Config
{


    private SplFileInfo $configFile;

    private ?array $configuration = null;

    public function __construct(SplFileInfo $configFile)
    {
        $this->configFile = $configFile;
    }

    public function readAll()
    {

        if (null === $this->configuration) {

            $this->configuration = Yaml::parseFile($this->configFile->getRealPath());
        }

        return $this->configuration;
    }

    public function getTonexDbFile(): SplFileInfo
    {
        $configuration = $this->readAll();

        return new SplFileInfo($configuration['tonex_db_path']);

    }

    public function getPresetInstallPath(): Directory
    {
        $configuration = $this->readAll();

        return dir($configuration['tonex_presets_install_dir_path']);

    }

}