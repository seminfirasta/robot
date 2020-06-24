<?php

namespace App\Speed;

class Speed {

    private $cleaningSpeed;

    public function __construct(float $cleaningSpeed) {
        $this->cleaningSpeed = $cleaningSpeed;
    }

    // get area for time
    public function getAreaForTime(float $seconds): float {
        return $seconds * $this->cleaningSpeed;
    }

    // get time for area
    public function getTimeForArea(float $metersSquaredArea): float {
        return $metersSquaredArea / $this->cleaningSpeed;
    }
}