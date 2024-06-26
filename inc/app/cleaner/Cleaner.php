<?php

namespace App\cleaner;

class Cleaner
{

    public function clean(array $names, int $cutLastSigns = 0): array
    {

        $newNames = [];

        foreach ($names as $name) {

            $newName = trim($name);

            if ($cutLastSigns !== 0) {

                $lastSign = $cutLastSigns * -1;

                $newName = substr(0, $lastSign);

            }

            $newNames[] = $newName;

        }

        return $newNames;
    }

}