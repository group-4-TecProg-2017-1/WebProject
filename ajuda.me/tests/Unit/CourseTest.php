<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Course;

class CourseTest extends TestCase
{
    /**
     * Tests the setCourseId and getCourseId functions.
     *
     * @return void
     */
    public function testGetSetCourseId()
    {
        $fake_course = new Course;
        $fake_id = 12345;
        $fake_course->setCourseId($fake_id);
        $this->assertEquals($fake_id, $fake_course->getCourseId());
    }

    public function testGetSetCourseName()
    {
        $fake_course = new Course;
        $fake_name = "Programming Techniques";
        $fake_course->setCourseName($fake_name);
        $this->assertEquals($fake_name, $fake_course->getCourseName());
    }
}
