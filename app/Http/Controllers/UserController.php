<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
       $users = User::where('is_admin',0)->latest()->paginate(5);
       return view('admin.users.index', compact('users'));
    }

}
