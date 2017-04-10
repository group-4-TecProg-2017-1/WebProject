<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Monitoring;

/**
 * Contains the suite of unit tests for Monitoring model class methods.
 *
 * All tests' names MUST start with 'test' word.
 */
class MonitoringTest extends TestCase
{
    /**
     * Tests the setMonitoringId and getMonitoringId functions.
     *
     * @return void
     */
    public function testGetSetMonitoringId()
    {
        $fake_monitoring = new Monitoring;
        $fake_id = 12345;
        $fake_monitoring->setMonitoringId($fake_id);
        $this->assertEquals($fake_id, $fake_monitoring->getMonitoringId());
    }

    /**
    * Tests the setMonitoringPlace and getMonitoringPlace functions.
    *
    * @return void
    */
    public function testGetSetMonitoringPlace()
    {
        $fake_monitoring = new Monitoring;
        $fake_place = "UED Lab. MOCAP";
        $fake_monitoring->setMonitoringPlace($fake_place);
        $this->assertEquals($fake_place, $fake_monitoring
            ->getMonitoringPlace());
    }

    /**
    * Tests the setMonitoringSubject and getMonitoringSubject functions.
    *
    * @return void
    */
    public function testGetSetMonitoringSubject()
    {
        $fake_monitoring = new Monitoring;
        $fake_subject = "UED Lab. MOCAP";
        $fake_monitoring->setMonitoringSubject($fake_subject);
        $this->assertEquals($fake_subject, $fake_monitoring
            ->getMonitoringSubject());
    }

    /**
    * Tests the setMonitoringStartingTime and getMonitoringStartingTime
    * functions.
    *
    * @return void
    */
    public function testGetSetMonitoringStartingTime()
    {
        $fake_monitoring = new Monitoring;
        $fake_starting_time = "12:00";
        $fake_monitoring->setMonitoringStartingTime($fake_starting_time);
        $this->assertEquals($fake_starting_time, $fake_monitoring
            ->getMonitoringStartingTime());
    }

    /**
    * Tests the setMonitoringDuration and getMonitoringDuration functions.
    *
    * @return void
    */
    public function testGetSetMonitoringDuration()
    {
        $fake_monitoring = new Monitoring;
        $fake_duration = "01:00";
        $fake_monitoring->setMonitoringDuration($fake_duration);
        $this->assertEquals($fake_duration, $fake_monitoring
            ->getMonitoringDuration());
    }

    /**
     * Tests the setMonitoringCourseId and getMonitoringCourseId functions.
     *
     * @return void
     */
    public function testGetSetMonitoringCourseId()
    {
        $fake_monitoring = new Monitoring;
        $fake_id = 12345;
        $fake_monitoring->setMonitoringCourseId($fake_id);
        $this->assertEquals($fake_id, $fake_monitoring
            ->getMonitoringCourseId());
    }

    /**
     * Tests the setMonitoringMonitorId and getMonitoringMonitorId functions.
     *
     * @return void
     */
    public function testGetSetMonitoringMonitorId()
    {
        $fake_monitoring = new Monitoring;
        $fake_id = 12345;
        $fake_monitoring->setMonitoringMonitorId($fake_id);
        $this->assertEquals($fake_id, $fake_monitoring
            ->getMonitoringMonitorId());
    }
}
