<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function show(Checklist $checklist)
    {
        return view('users.checklists.show', compact('checklist'));
    }
}
