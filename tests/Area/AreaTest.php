<?php
namespace Area;

use PHPUnit\Framework\TestCase;
use App\Area\Area;

class AreaTest extends TestCase {

    /**
     * Test for cleaning.
     *
     * @dataProvider getAreaProvider
     */
    public function testArea(float $metersSquaredArea, float $clean, float $expectedMaxCleaningArea, bool $expectedIsCleaned) {
        $area = new Area($metersSquaredArea);
        $area->clean($clean);
        $maxCleaningArea = $area->getMaxCleaningArea();
        $isCleaned = $area->isCleaned();
        $this->assertSame($expectedMaxCleaningArea, $maxCleaningArea);
        $this->assertSame($expectedIsCleaned, $isCleaned);
    }

    /**
     * Provides data for testArea.
     */
    public function getAreaProvider(): array {
        return [
            "one" => [90.0, 60.0, 30.0, false],
            "two" => [40.0, 40.0, 0.0, true],
            "three" => [0.0, 0.0, 0.0, true]
        ];
    }
}