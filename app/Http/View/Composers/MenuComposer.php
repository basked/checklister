<?php

namespace App\Http\View\Composers;

use App\Models\Checklist;
use Illuminate\View\View;
use Carbon\Carbon;

class MenuComposer
{

    public function compose(View $view)
    {
        // список основных групп(которые добавил админ)
        $menu = \App\Models\ChecklistGroup::with(['checklists' => function ($query) {
            $query->whereNull('user_id');
        }])->get();
        $view->with('admin_menu', $menu);

        $groups = [];
        $last_action_at = auth()->user()->last_action_at;
        // если дата обновления пуста то присвоим дату -10 лет
        if (is_null($last_action_at)) {
            $last_action_at = Carbon::now()->subYears(2);
        }
        $user_checklists = Checklist::where('user_id', auth()->id())->get();
        foreach ($menu->toArray() as $group) {
            if (count($group['checklists']) > 0) {
                $group_updated_at = $user_checklists->where('checklist_group_id', $group['id'])->max('updated_at');
                $group['is_new'] = Carbon::create($group['created_at'])->greaterThan($group_updated_at);
                $group['is_updated'] = !($group['is_new']) && Carbon::create($group['updated_at'])->greaterThan($last_action_at);
                foreach ($group['checklists'] as &$checklist) {
                    $checklist_updated_at = $user_checklists->where('checklist_id', $group['id'])->max('updated_at');
                    $checklist['is_new'] = !($group['is_new']) &&
                        Carbon::create($checklist['created_at'])->greaterThan($checklist_updated_at);
                    $checklist['is_updated'] = !($group['is_updated']) && !($checklist['is_new']) && Carbon::create($checklist['updated_at'])->greaterThan($last_action_at);
                    $checklist['tasks'] = 1;
                    $checklist['comleted_tasks'] = 2;
                }
                $groups[] = $group;
            }
        }

        $view->with('user_menu', $groups);
    }
}
