<?php

namespace Tests\Feature;

use http\Client\Curl\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminChecklistsTest extends TestCase
{
    use RefreshDatabase;

    public function test_example()
    {

        $user= User::factory()->create(['is_admin'=>1]);
        // войти как админ
        $response=$this->actingAs($admin)->post('admin/checklists_groups',['name'=>'First group']);
        $response->assertRedirect('welcome');
    }
}









