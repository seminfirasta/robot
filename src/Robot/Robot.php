<?php

namespace App\Robot;

use App\Area\Area;
use App\Speed\Speed;
use App\Battery\Battery;

class Robot {

    const FLOOR_TYPES = ['hard' => 1, 'carpet' => 0.5];
    const MINUTES_POWER = 60;
    const MINUTES_CHARGE = 30;

    // to store objects of respective classes
    private $areaObj;
    private $speedObj;
    private $batteryObj;

    // creating objects 
    public function __construct(string $floorType, float $area) {
        $this->areaObj = new Area($area);    // 70
        $this->speedObj = new Speed(self::FLOOR_TYPES[$floorType]);
        $this->batteryObj = new Battery(self::MINUTES_POWER, self::MINUTES_CHARGE);
    }

    // managing cleaning and charging
    public function run(): array {
        $tasks = [];
        $i = 0;

        while (TRUE) {
            $i++;
            [$area, $cleaningTime] = $this->getCleaningAreaTime();

            //Cleaning task
            $this->areaObj->clean($area);
            $this->batteryObj->work($cleaningTime);
            $tasks["Task no : ". $i ." => CLEANING process started at"] = $cleaningTime;
            
            //Charging task
            $i++;
            $timeToCharge = $this->batteryObj->charge();
            $tasks["Task no : ". $i ." => CHARGING process started at"] = $timeToCharge;
            
            if($this->areaObj->isCleaned()) {
                break;
            }
        }
        return $tasks;
    }

    // finding how much area robot needs to clean
    // finding how much time robot needs to clean the floor
    private function getCleaningAreaTime() {
        $maxWorkingTime = $this->batteryObj->getMaxWorkingTime(); // 60 seconds max robot working time in single charge
        $maxCleaningArea = $this->areaObj->getMaxCleaningArea();  // 90-0=90 max area robot needs to clean - area already cleaned

        $areaCanBeCleanedInMaxTime = $this->speedObj->getAreaForTime($maxWorkingTime); // 60, how much area Robot can clean in 60 seconds which are passing
        $maxCleaningAreaTime = $this->speedObj->getTimeForArea($maxCleaningArea);     // 90, how much time robot needs to clean the area
        
        $minArea = min($areaCanBeCleanedInMaxTime, $maxCleaningArea);   // how much time robot can work max, and how much time max robot needs to work
        $minCleaningTime = min($maxWorkingTime, $maxCleaningAreaTime);  // for how much time robot can clean max, and for how much time robot needs to clean
        
        return [$minArea, $minCleaningTime];
    }
}