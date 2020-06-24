<?php

namespace Tests\Robot;

use App\Robot\Robot;
use PHPUnit\Framework\TestCase;

class RobotTest extends TestCase{

    /**
     * @dataProvider getTestRobotProvider
     */
    public function testRobot(string $floorType, float $area, array $expectedTasks){
         $robot = new Robot($floorType, $area);
         $tasks = $robot->run();
         $this->assertSame($tasks, $expectedTasks);
     }

    /**
     * Provides data for testRobot.
     */
    public function getTestRobotProvider(): array {
        return [
            "valid_hard_60" => ["hard", 60.0, ["Task no : 1 => CLEANING process started at" => 60.0, "Task no : 2 => CHARGING process started at" => 30.0]],
            "valid_carpet_60" => ["carpet", 30.0, ["Task no : 1 => CLEANING process started at" => 60.0, "Task no : 2 => CHARGING process started at" => 30.0]],
            "valid_hard_90" => ["hard", 90.0, ["Task no : 1 => CLEANING process started at" => 60.0, "Task no : 2 => CHARGING process started at" => 30.0, "Task no : 3 => CLEANING process started at" => 30.0, "Task no : 4 => CHARGING process started at" => 15.0]],
            "valid_carpet_90" => ["carpet", 90.0, ["Task no : 1 => CLEANING process started at" => 60.0, "Task no : 2 => CHARGING process started at" => 30.0, "Task no : 3 => CLEANING process started at" => 60.0, "Task no : 4 => CHARGING process started at" => 30.0, "Task no : 5 => CLEANING process started at" => 60.0, "Task no : 6 => CHARGING process started at" => 30.0]]
        ];
    }
}