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

        // Test EDITING the checklist group
        $response = $this->put('admin/checklist_groups/' . $group->id, [
            'name' => 'Updated first group'
        ]);
        $response->assertRedirect('welcome');

        $group = ChecklistGroup::where('name', 'Updated first group')->first();
        $this->assertNotNull($group);

        // Test DELETING the checklist group
        $response = $this->delete('admin/checklist_groups/' . $group->id);
        $response->assertRedirect('welcome');
    }
}
