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

// 各ページへのアクセス
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/cost-manager', [CostManagerController::class, 'index'])->name('cost-manager')->middleware('auth');
Route::get('/add-plan', [AddPlanController::class, 'index'])->name('add-plan')->middleware('auth');
Route::get('/calender', [CalenderController::class, 'index'])->name('calender')->middleware('auth');
Route::get('/guestlist', [GuestlistController::class, 'index'])->name('guestlist')->middleware('auth');
Route::get('/to-do', [ToDoController::class, 'index'])->name('to-do')->middleware('auth');

Route::delete('/events/{event}/leave', [EventEditorController::class, 'leave'])->name('events.leave')->middleware('auth'); // 後で考え直す

// Create Eventページ関係
Route::get('/create-event', [CreateEventController::class, 'index'])->name('create-event')->middleware('auth');
Route::post('/create-event', [CreateEventController::class, 'store'])->middleware('auth');

// Event Editorページ関係
Route::get('/event-editor', [EventEditorController::class, 'index'])->name('event-editor')->middleware('auth'); // イベント一覧ページへアクセス
Route::get('/event-editor/{event_id}', [EventEditorController::class, 'edit'])->name('event-editor.edit'); // イベント編集ページへアクセス
Route::post('/event-editor/{event}', [EventEditorController::class, 'update'])->name('event-editor.update'); // イベントを編集（更新）
Route::delete('/event-editor/{event_id}', [EventEditorController::class, 'destroy'])->name('event-editor.destroy')->middleware('auth'); // イベントを削除
Route::post('/event-editor/{event_id}/add-user', [EventEditorController::class, 'addUser'])->name('event-editor.addUser'); // イベントにユーザーを追加

// Dashboardページ関係(不要)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profileページ関係
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 認証関連（別ファイルで定義）
require __DIR__.'/auth.php';
