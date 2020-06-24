<?php

namespace App\Battery;

class Battery {

    private $minutesPower;
    private $minutesCharge;
    private $capacity;

    public function __construct(float $minutesPower, float $minutesCharge) {    // 60, 30
        $this->minutesPower = $minutesPower;
        $this->minutesCharge = $minutesCharge;
        $this->capacity = 1;
    }

    // get maximum robot working time in single charge
    public function getMaxWorkingTime(): float {
        return $this->minutesPower * $this->capacity;
    }

    // charge the battery
    public function charge(): float {
        $timeToCharge = $this->minutesCharge * (1 - $this->capacity);
        $this->capacity = 1;
        return $timeToCharge;
    }

    // set the battery capacity in percentage
    public function work(float $seconds) {
        return $this->capacity = 1 - ($seconds / $this->minutesPower);
    }
}