<?php

namespace Tests\Battery;

use App\Battery\Battery;
use PHPUnit\Framework\TestCase;

class BatteryTest extends TestCase {

    /**
     * Test for battery capacity.
     *
     * @dataProvider getTestWorkProvider
     */
    public function testWork(float $minutesPower, float $workTime, float $expectedMinutesCapacity) {
        $battery = new Battery($minutesPower, 0);
        $battery->work($workTime);
        $minutesCapacity = $battery->getMaxWorkingTime();
        $this->assertSame($expectedMinutesCapacity, $minutesCapacity);
    }

    /**
     * Provides data for testWork.
     */
    public function getTestWorkProvider(): array {
        return [
            "60" => [60.0, 10.0, 50.0],
            "50" => [60.0, 20.0, 40.0],
            "40" => [60.0, 30.0, 30.0],
            "30" => [60.0, 40.0, 20.0],
            "20" => [60.0, 50.0, 10.0],
            "10" => [60.0, 60.0, 0.0]
        ];
    }

    /**
     * Test for charging
     *
     * @dataProvider getTestChargeProvider
     */
    public function testCharge(float $minutesPower, float $workTime, float $minutesCharge, float $expectedMinutesCharge) {
        $battery = new Battery($minutesPower, $minutesCharge);
        $battery->work($workTime);
        $minutesCharge = $battery->charge();
        $this->assertSame($expectedMinutesCharge, $minutesCharge);
    }

    /**
     * Provides data for testCharge.
     */
    public function getTestChargeProvider(): array {
        return [
            "60_30" => [60.0, 30.0, 30.0, 15.0],
            "60_60" => [60.0, 60.0, 30.0, 30.0],
            "60_0" => [60.0, 0.0, 30.0, 0.0]
        ];
    }
}