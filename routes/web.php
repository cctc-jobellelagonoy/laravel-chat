<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect()->route('chat');
});

Auth::routes();

// GET request that returns the view for the chat page.
Route::get('/chat', [App\Http\Controllers\ChatsController::class, 'index'])->name('chat');

// GET request that returns all messages and their corresponding users from the database.
Route::get('/messages', [App\Http\Controllers\ChatsController::class, 'fetchMessages']);

// POST request that creates and saves a message to the database.
Route::post('/messages', [App\Http\Controllers\ChatsController::class, 'sendMessage']);

// GET request that calls the chatgpt method of the ChatsController class. 
// It is wrapped in a middleware group to restrict it the API calls to 1 request per 10 minute.
Route::middleware(['api'])->group(function () {
    Route::get('/chatgpt', [App\Http\Controllers\ChatsController::class, 'chatgpt']);
});
