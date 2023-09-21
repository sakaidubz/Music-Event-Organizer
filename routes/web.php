<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\CreateEventController;
use App\Http\Controllers\CostManagerController;
use App\Http\Controllers\EventEditorController;
use App\Http\Controllers\AddPlanController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\GuestlistController;
use App\Http\Controllers\ToDoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/create-event', [CreateEventController::class, 'index'])->name('create-event')->middleware('auth');
Route::get('/cost-manager', [CostManagerController::class, 'index'])->name('cost-manager')->middleware('auth');
Route::get('/event-editor', [EventEditorController::class, 'index'])->name('event-editor')->middleware('auth');
Route::get('/add-plan', [AddPlanController::class, 'index'])->name('add-plan')->middleware('auth');
Route::get('/calender', [CalenderController::class, 'index'])->name('calender')->middleware('auth');
Route::get('/guestlist', [GuestlistController::class, 'index'])->name('guestlist')->middleware('auth');
Route::get('/to-do', [ToDoController::class, 'index'])->name('to-do')->middleware('auth');

Route::delete('/events/{event}/leave', [EventEditorController::class, 'leave'])->name('events.leave')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
