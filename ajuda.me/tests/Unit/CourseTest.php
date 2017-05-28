<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Course;

/**
 * Contains the suite of unit tests for Course model class methods.
 *
 * All tests' names MUST start with 'test' word.
 */
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

    /**
     * Tests the setCourseName and getCourseName functions.
     *
     * @return void
     */
    public function testGetSetCourseName()
    {
        $fake_course = new Course;
        $fake_name = "Programming Techniques";
        $fake_course->setCourseName($fake_name);
        $this->assertEquals($fake_name, $fake_course->getCourseName());
    }
    
    public function testCourseIsNotNull()
    {
        $fake_course = null;
        $fake_course = new Course;
        $this->assertNotNull($fake_course);   
    }

    public function testCourseHasAttributeCourse_id(){
        $this->assertObjectHasAttribute('course_id' , new Course);
    }
   
    public function testCourseHasAttributeName(){
        $this->assertObjectHasAttribute('name' , new Course);
    }

    
}
