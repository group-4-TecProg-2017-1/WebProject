<?php

namespace Tests\Unit;

use App\Http\Controllers\UsersController;

use App\User;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersControllerTest extends TestCase
{
    /**
     * @test Should create an user
     */
    public function testCreate()
    {
        $response = $this->get('/users/create/');
        $response->assertRedirect('/login');
    }

    /**
     * @test Should edit an user
     */
    public function testEdit(){
        $response = $this->get('/users/{id}/edit');
        $response->assertRedirect('/login');
    }

}
