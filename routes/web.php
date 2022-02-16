<?php

use App\Models\Child;
use Illuminate\Support\Facades\Route;


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
    return view('welcome');
})->name('home');

Route::get('/dashboard', \App\Http\Livewire\Parent\Overview::class)->name('parent-dashboard');

Route::get('/test', function (){
    $child = Child::first();

    \App\Jobs\SendVaccinationNotification::dispatch($child);
});
