<?php

namespace App\db;

use App\cleaner\Cleaner;
use PDO;
use SplFileInfo;

class TonexDb
{

    private SplFileInfo $tonexDbPath;
    private Cleaner $cleaner;

    public function __construct(SplFileInfo $tonexDbPath, Cleaner $cleaner)
    {

        $this->tonexDbPath = $tonexDbPath;
        $this->cleaner = $cleaner;
    }

    public function getInstalledPresets(): array
    {

        $dbh = new PDO('sqlite:' . $this->tonexDbPath->getRealPath(), '', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $result = $dbh->query(
            "SELECT `Tag_PresetName` 
                    FROM `Presets` WHERE Presets.Tag_UserName IS NOT 'IK Multimedia' ORDER BY Tag_PresetName ASC"
        );


        $presets = $result->fetchAll(PDO::FETCH_COLUMN);

        sort($presets);

        $presets = $this->cleaner->clean($presets);

        return $presets;

    }

}