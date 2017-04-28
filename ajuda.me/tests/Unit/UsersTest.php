<?php

namespace Tests\Unit;

use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    /**
     * Tests the setUserName and getUserName functions.
     *
     * @return void
     */
    public function testGetSetUserName()
    {
        $fakeUser = new User;
        $fakeName = "Jailson";
        $fakeUser->setUserName($fakeName);
        $this->assertEquals($fakeName, $fakeUser->getUserName());
    }
}
