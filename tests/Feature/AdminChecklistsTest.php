<?php

namespace Tests\Feature;

use App\Http\Livewire\TasksTable;
use App\Models\Checklist;
use App\Models\ChecklistGroup;
use App\Models\Task;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminChecklistsTest extends TestCase
{
    use RefreshDatabase;

    public function test_example()
    {

        $admin = User::factory()->create(['is_admin' => 1]);

        $response = $this->actingAs($admin)->post('admin/checklist_groups', [
            'name' => 'First group'
        ]);
        $response->assertRedirect('welcome');

        $group = ChecklistGroup::where('name', 'First group')->first();
        $this->assertNotNull($group);

        $response = $this->actingAs($admin)->get("admin/checklist_groups/ $group->id /edit");
        $response->assertStatus(200);
/*
        $response = $this->actingAs($admin)->put('admin/checklist_groups/' . $group->id, [
            'name' => 'Updated First group'
        ]);
        $response->assertStatus(200);

        $group = ChecklistGroup::where('name', 'Updated First group')->first();
        $this->assertNotNull($group);*/
    }

}
