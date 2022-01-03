<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ChecklistController;
use App\Http\Controllers\Admin\ChecklistGroupController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TaskController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'welcome');

Auth::routes();

Auth::routes();
Route::group(['middleware' => ['auth','save_last_action_at']], function () {
    Route::get('/welcome', [\App\Http\Controllers\PageController::class, 'welcome'])->name('welcome');
    Route::get('/checklists/{checklist}', [\App\Http\Controllers\User\ChecklistController::class, 'show'])->name('users.checklists.show');
    Route::get('/consultation', [\App\Http\Controllers\PageController::class, 'consultation'])->name('consultation');
    Route::get('checklists/{checklist}', [\App\Http\Controllers\User\ChecklistController::class, 'show'])
        ->name('user.checklists.show');
    Route::get('tasklist/{list_type}', [\App\Http\Controllers\User\ChecklistController::class, 'tasklist'])
        ->name('user.tasklist');
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function () {
        Route::resource('pages', PageController::class)->only(['edit', 'update']);
        Route::resource('checklist_groups', ChecklistGroupController::class);
        Route::resource('checklist_groups.checklists', ChecklistController::class);
        Route::resource('checklists.tasks', TaskController::class);
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::post('/images', [\App\Http\Controllers\Admin\ImageController::class, 'store'])->name('images.store');
    });
});
