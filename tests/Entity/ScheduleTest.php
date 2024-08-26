<?php

use App\Entity\Schedule;
use PHPUnit\Framework\TestCase;

class ScheduleTest extends TestCase
{
    public function testSetDays()
    {
        $schedule = new Schedule();
        $this->assertNull($schedule->getDays());

        $day = "lundi";
        $schedule->setDays("lundi");
        $this->assertEquals($day,$schedule->getDays());
    }

    public function testSetSchedule()
    {
        $schedule = new Schedule();
        $this->assertNull($schedule->getSchedule());

        $scheduleDay = '18h';
        $schedule->setSchedule("18h");
        $this->assertEquals($scheduleDay,$schedule->getSchedule());
    }
}