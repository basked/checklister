<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Checklist;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request, Checklist $checklist): RedirectResponse
    {
        // максимальная позизия для текущего списка + 1
        $position = $checklist->tasks()->max('position') + 1;
        $checklist->tasks()->where('user_id',NULL)->create($request->validated() + ['position' => $position]);
        return redirect()->route('admin.checklist_groups.checklists.edit',
            [$checklist->checklist_group_id, $checklist]
        );
    }

    public function edit(Checklist $checklist, Task $task): View
    {
        return view('admin.tasks.edit', compact('checklist', 'task'));
    }

    public function update(StoreTaskRequest $request, Checklist $checklist, Task $task): RedirectResponse
    {
        $task->update($request->validated());
        return redirect()->route('admin.checklist_groups.checklists.edit',
            [$checklist->checklist_group_id, $checklist]
        );
    }

    public function destroy(Checklist $checklist, Task $task): RedirectResponse
    {
        $task->delete();
        $checklist->tasks()->where('user_id',NULL)->where('position', '>', $task->position)->update(
            ['position' => \DB::raw('position-1')]
        );
        return redirect()->route('admin.checklist_groups.checklists.edit',
            [$checklist->checklist_group_id, $checklist]
        );
    }
}
