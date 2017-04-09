<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Monitor;

/**
 * Contains the suite of unit tests for Monitor model class methods.
 *
 * All tests' names MUST start with 'test' word.
 */
class MonitorTest extends TestCase
{
    /**
     * Tests the setMonitorId and getId functions.
     *
     * @return void
     */
    public function testGetSetMonitorId()
    {
        $fake_monitor = new Monitor;
        $fake_id = 12345;
        $fake_monitor->setMonitorId($fake_id);
        $this->assertEquals($fake_id, $fake_monitor->getMonitorId());
    }

    /**
     * Tests the setMonitorName and getCourseName functions.
     *
     * @return void
     */
    public function testGetSetMonitorName()
    {
        $fake_monitor = new Monitor;
        $fake_name = "Andre";
        $fake_monitor->setMonitorName($fake_name);
        $this->assertEquals($fake_name, $fake_monitor->getMonitorName());
    }

    /**
     * Tests the setMonitorCourseId and getMonitorCourseId functions.
     *
     * @return void
     */
    public function testGetSetMonitorCourseId()
    {
        $fake_monitor = new Monitor;
        $fake_course_id = 201294;
        $fake_monitor->setMonitorCourseId($fake_course_id);
        $this->assertEquals($fake_course_id, $fake_monitor
            ->getMonitorCourseId());
    }
}
