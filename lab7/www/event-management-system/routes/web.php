<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\ParticipantController;
// use App\Http\Controllers\EventParticipantController; // Цей контролер більше не потрібен для управління учасниками події

/*
|--------------------------------------------------------------------------
| Головна
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => redirect()->route('events.index'));

/*
|--------------------------------------------------------------------------
| Організатори
|--------------------------------------------------------------------------
| Використовує Route::resource для базових CRUD операцій:
| GET    /organizers           (index)
| GET    /organizers/create    (create)
| POST   /organizers           (store)
| GET    /organizers/{organizer}        (show)
| GET    /organizers/{organizer}/edit   (edit)
| PUT    /organizers/{organizer}        (update)
| DELETE /organizers/{organizer}        (destroy)
*/

Route::resource('organizers', OrganizerController::class);

/*
|--------------------------------------------------------------------------
| Події
|--------------------------------------------------------------------------
| Використовує Route::resource для базових CRUD операцій:
| GET    /events           (index)
| GET    /events/create    (create)
| POST   /events           (store)
| GET    /events/{event}        (show)
| GET    /events/{event}/edit   (edit)
| PUT    /events/{event}        (update)
| DELETE /events/{event}        (destroy)
*/

Route::resource('events', EventController::class);

/*
|--------------------------------------------------------------------------
| Управління учасниками події (спеціальні маршрути)
|--------------------------------------------------------------------------
|
| - «Призначити / зняти учасників» у масовому режимі (форма з чекбоксами)
| - Окремий простий “Add participant” shortcut для додавання одного учасника
|
*/

// Маршрут для відображення форми управління учасниками для конкретної події
Route::get('/events/{event}/participants/manage', [EventController::class, 'editParticipants'])->name('events.participants.manage');

// Маршрут для збереження змін учасників для конкретної події (метод PUT)
Route::put('/events/{event}/participants/sync', [EventController::class, 'updateParticipants'])->name('events.participants.sync');

// Маршрут для відображення форми додавання одного учасника до події (shortcut)
Route::get('/events/{event}/add-participant', [EventController::class, 'addParticipantForm'])->name('events.participants.add.form');

// Маршрут для збереження додавання одного учасника до події (shortcut)
Route::post('/events/{event}/add-participant', [EventController::class, 'addParticipant'])->name('events.participants.add');

/*
|--------------------------------------------------------------------------
| Учасники як під-ресурс події
|--------------------------------------------------------------------------
|
| Route::resource створить маршрути для управління учасниками, прив'язаними до конкретної події:
|   GET    /events/{event}/participants                      (events.participants.index)
|   GET    /events/{event}/participants/create               (events.participants.create)
|   POST   /events/{event}/participants                      (events.participants.store)
|   GET    /events/{event}/participants/{participant}        (events.participants.show)
|   GET    /events/{event}/participants/{participant}/edit   (events.participants.edit)
|   PUT    /events/{event}/participants/{participant}        (events.participants.update)
|   DELETE /events/{event}/participants/{participant}        (events.participants.destroy)
|
| Параметри event та participant Laravel підставляє автоматично.
*/
Route::resource('events.participants', ParticipantController::class);

/*
|--------------------------------------------------------------------------
| Глобальні операції з учасниками (не прив'язані до конкретної події)
|--------------------------------------------------------------------------
| Ці маршрути дозволяють управляти учасниками в загальному списку (наприклад, з бічної панелі).
*/

// Список усіх учасників
Route::get('/participants', [ParticipantController::class, 'listAll'])->name('participants.list'); // Змінено назву маршруту з 'participants.list' на 'participants.index' для більшої відповідності (можна залишити 'list' якщо вам зручніше)

// Маршрути для створення, редагування та видалення учасників як незалежних сутностей
Route::get('/participants/create', [ParticipantController::class, 'createGlobal'])->name('participants.create_global');
Route::post('/participants', [ParticipantController::class, 'storeGlobal'])->name('participants.store_global');
Route::get('/participants/{participant}/edit', [ParticipantController::class, 'editGlobal'])->name('participants.edit_global');
Route::put('/participants/{participant}', [ParticipantController::class, 'updateGlobal'])->name('participants.update_global');
Route::delete('/participants/{participant}', [ParticipantController::class, 'destroyGlobal'])->name('participants.destroy_global');


/*
|--------------------------------------------------------------------------
| Звіт
|--------------------------------------------------------------------------
*/

Route::get('/report', [ReportController::class, 'index'])->name('report.index');