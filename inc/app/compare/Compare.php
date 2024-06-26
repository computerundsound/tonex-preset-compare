<?php

namespace App\compare;

use App\db\TonexDb;
use App\PresetsDir\GetPresetsFromInstallFolder;

class Compare
{

    private TonexDb $tonexDb;
    private GetPresetsFromInstallFolder $getPresetsFromInstallFolder;

    public function __construct(TonexDb                     $tonexDb,
                                GetPresetsFromInstallFolder $getPresetsFromInstallFolder)
    {
        $this->tonexDb                     = $tonexDb;
        $this->getPresetsFromInstallFolder = $getPresetsFromInstallFolder;
    }

    public function getNotInstalledPresets(): array
    {

        $installedPresets         = $this->tonexDb->getInstalledPresets();
        $presetsFromInstallFolder = $this->getPresetsFromInstallFolder->getPresetsFromInstallFolder();

        $notInstalledPresets = $this->compare($installedPresets, $presetsFromInstallFolder);

        return $notInstalledPresets;


    }

    protected function compare(array $installedPresets, array $presetsFromInstallFolder): array
    {

        $notInstalledPresets = [];

        foreach ($presetsFromInstallFolder as $presetFromInstallFolder) {

            if (!in_array($presetFromInstallFolder, $installedPresets)) {
                $notInstalledPresets[] = $presetFromInstallFolder;
            }

        }

        return $notInstalledPresets;
    }

}