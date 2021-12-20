<?php


namespace App\Services;


use App\Models\Checklist;

class ChecklistService
{
    public function sync_checklist(Checklist $checklist, int $user_id)
    {
        $checklist= Checklist::firstOrCreate(
            // Существует ли такой список для текущего пользователя
            [
                'user_id' => $user_id,
                'checklist_id' => $checklist->id,
            ],
            [
                'name' => $checklist->name,
                'checklist_group_id' => $checklist->checklist_group_id,
            ]);
        $checklist->touch();
        return  $checklist;
    }

}
