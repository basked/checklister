<?php

namespace Tests\Feature;

use App\Http\Livewire\TasksTable;
use App\Models\Checklist;
use App\Models\ChecklistGroup;
use App\Models\Task;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminChecklistsTest extends TestCase
{
    use RefreshDatabase;

    // Управление группами контрольных списков
    public function test_manage_checklist_grpups()
    {
        $admin = User::factory()->create(['is_admin' => 1]);

        $response = $this->actingAs($admin)->post('admin/checklist_groups', [
            'name' => 'First group'
        ]);
        $response->assertRedirect('welcome');

        $group = ChecklistGroup::where('name', 'First group')->first();
        $this->assertNotNull($group);

        // Test EDITING the checklist group
        $response = $this->actingAs($admin)->get('admin/checklist_groups/' . $group->id . '/edit');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->put('admin/checklist_groups/' . $group->id, [
            'name' => 'Updated first group'
        ]);
        $response->assertRedirect('welcome');

        $group = ChecklistGroup::where('name', 'Updated first group')->first();
        $this->assertNotNull($group);

        //Test menu
        $menu = (new MenuService())->get_menu();
        $this->assertEquals(1, $menu['admin_menu']->where('name', 'Updated first group')->count());
        // Test DELETING the checklist group
        $response = $this->actingAs($admin)->delete('admin/checklist_groups/' . $group->id);
        $response->assertRedirect('welcome');
        //Test menu after delete Checklistgroup
        $menu = (new MenuService())->get_menu();
        $this->assertEquals(0, $menu['admin_menu']->where('name', 'Updated first group')->count());
    }

    // Управление контрольными списками
    public function test_manage_checklists()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $checklist_group = ChecklistGroup::factory()->create();
        $checklists_url = 'admin/checklist_groups/' . $checklist_group->id . '/checklists';
        // Test CREATING the checklist
        $response = $this->actingAs($admin)->get($checklists_url . '/create');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->post($checklists_url, ['name' => 'First checklist']);
        $response->assertRedirect('welcome');

        $checklist = Checklist::where('name', 'First checklist')->first();
        $this->assertNotNull($checklist);
        $this->assertEquals($checklist->name, 'First checklist');
        // Test EDITING the checklist
        $response = $this->actingAs($admin)->get($checklists_url . '/' . $checklist->id . '/edit');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->put($checklists_url . '/' . $checklist->id,
            [
                'name' => 'Updated checklist'
            ]);
        $response->assertRedirect('welcome');

        $checklist = Checklist::where('name', 'Updated checklist')->first();
        $this->assertNotNull($checklist);

        $menu = (new MenuService())->get_menu();
        $this->assertTrue($menu['admin_menu']->first()->checklists->contains($checklist));

        // Test DELETED the checklist
        $response = $this->actingAs($admin)->delete($checklists_url . '/' . $checklist->id);
        $response->assertRedirect('welcome');

        $menu = (new MenuService())->get_menu();
        $this->assertFalse($menu['admin_menu']->first()->checklists->contains($checklist));
    }
}
