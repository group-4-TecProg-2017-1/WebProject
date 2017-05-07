<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Subject;

/**
 * Contains the suite of unit tests for Monitor model class methods.
 *
 * All tests' names MUST start with 'test' word.
 */
class SubjectTest extends TestCase
{
    /**
     * Tests the setSubjectId and getSubjectId functions.
     *
     * @return void
     */
    public function testGetSetSubjectId()
    {
        $fake_subject = new Subject;
        $fake_id = 12345;
        $fake_subject->setSubjectId($fake_id);
        $this->assertEquals($fake_id, $fake_subject->getSubjectId());
    }

    /**
     * Tests the setSubjectName and getSubjectName functions.
     *
     * @return void
     */
    public function testGetSetSubjectName()
    {
        $fake_subject = new Subject;
        $fake_name = "Teste";
        $fake_subject->setSubjectName($fake_name);
        $this->assertEquals($fake_name, $fake_subject->getSubjectName());
    }
}
