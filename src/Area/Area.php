<?php

namespace App\Area;

class Area {

    private $metersSquaredArea;
    private $metersSquaredCleaned;

    public function __construct(float $metersSquaredArea) {
        $this->metersSquaredArea = $metersSquaredArea;
        $this->metersSquaredCleaned = 0;
    }

    // for cleaning the floor
    public function clean(float $metersSquared) {
        $this->metersSquaredCleaned += $metersSquared;
    }

    // get maximum area to clean
    public function getMaxCleaningArea(): float {
        return $this->metersSquaredArea - $this->metersSquaredCleaned;
    }

    // to check whether whole area is cleaned or not
    public function isCleaned(): bool {
        return ($this->metersSquaredCleaned >= $this->metersSquaredArea) ? TRUE : FALSE;
    }
}