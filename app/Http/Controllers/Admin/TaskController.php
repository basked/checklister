<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Checklist;
use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTaskRequest $request
     * @param Checklist $checklist
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request, Checklist $checklist)
    {
        // максимальная позизия для текущего списка + 1
        $position= $checklist->tasks()->max('position')+1;
        $checklist->tasks()->create($request->validated()+['position'=> $position]);
        return redirect()->route('admin.checklist_groups.checklists.edit',
            [$checklist->checklist_group_id,
                $checklist]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Checklist $checklist
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist, Task $task)
    {
         return view('admin.tasks.edit', compact('checklist','task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTaskRequest $request
     * @param Checklist $checklist
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskRequest $request, Checklist $checklist, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('admin.checklist_groups.checklists.edit',
            [$checklist->checklist_group_id,
                $checklist]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist, Task $task)
    {
        $task->delete();
        $checklist->tasks()->where('position','>',$task->position)->update(
            ['position'=>\DB::raw('position-1')]
        );
        return redirect()->route('admin.checklist_groups.checklists.edit',
            [$checklist->checklist_group_id,
                $checklist]);
    }
}
