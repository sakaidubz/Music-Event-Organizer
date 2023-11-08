<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\CreateEventController;
use App\Http\Controllers\CostManagerController;
use App\Http\Controllers\EventEditorController;
use App\Http\Controllers\AddPlanController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GuestlistController;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\PerformerController;

// 各ページへのアクセス
Route::get('/cost-manager', [CostManagerController::class, 'index'])->name('cost-manager')->middleware('auth');
Route::get('/guestlist', [GuestlistController::class, 'index'])->name('guestlist')->middleware('auth');

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
Route::post('/event-editor/{event_id}/performers', [PerformerController::class, 'store'])->name('performers.store');// 出演者登録フォーム
Route::get('/event-editor/{event_id}/performers', [PerformerController::class, 'show'])->name('performers.show'); // タイムテーブル表示



// Add Planページ関連
// Route::get('/add-plan', [AddPlanController::class, 'create'])->name('add-plan.create')->middleware('auth'); // Add Planページの表示
Route::post('/add-plan', [AddPlanController::class, 'store'])->name('add-plan.store')->middleware('auth'); // 予定の保存

// ToDoページ関連
Route::get('/to-do', [ToDoController::class, 'index'])->name('to-do')->middleware('auth'); // ToDoページの表示とToDo作成フォームの表示
Route::post('/to-do', [ToDoController::class, 'store'])->name('to-do.store')->middleware('auth'); // ToDoの保存
Route::post('/to-do/update-status/{id}', [ToDoController::class, 'updateStatus'])->name('to-do.update-status')->middleware('auth'); // statusの更新
Route::delete('/to-do/{id}', [ToDoController::class, 'destroy'])->name('to-do.destroy')->middleware('auth'); // ToDoの削除

// Calendarページ関連
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar')->middleware('auth'); // Calendarページの表示
Route::get('/calendar/getPlans', [CalendarController::class, 'getPlans'])->name('calendar.getPlans')->middleware('auth'); // Calendarに表示する予定を返す
Route::post('/calendar/create', [CalendarController::class, 'create'])->name('calendar.create')->middleware('auth'); // Calendarの予定を新規追加する
Route::post('/calendar/get', [CalendarController::class, 'get'])->name('calendar.get')->middleware('auth'); // Calendarの予定を
Route::get('/user-events', [CalendarController::class, 'getUserEvents'])->middleware('auth'); // ユーザーに関連付けられたイベントを取得
Route::put('/calendar/update', [CalendarController::class, 'update'])->name('plan.update')->middleware('auth'); // 予定の更新
Route::delete('/calendar/delete', [CalendarController::class, 'destroy'])->name('plan.destroy')->middleware('auth'); // 予定の削除

// Homeページ関連
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');



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
