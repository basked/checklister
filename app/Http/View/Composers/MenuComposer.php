<?php

namespace App\Http\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;

class MenuComposer
{

    public function compose(View $view)
    {
        // список основных групп(которые добавил админ)
        $menu = \App\Models\ChecklistGroup::with(['checklists' => function ($query) {
            $query->whereNull('user_id');
        }])->get()
            ->toArray();
        $groups = [];
        foreach ($menu as $group) {
            $group['is_new'] =TRUE;
            $group['is_updated'] =  FAlSE;
            foreach ($group['checklists'] as &$checklist) {
                $checklist['is_new'] = FALSE;
                $checklist['is_updated'] = TRUE;
                $checklist['tasks'] = 1;
                $checklist['comleted_tasks'] = 2;
            }
            $groups[] = $group;
        }

        $view->with('user_menu', $groups);
    }
}
