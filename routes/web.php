<?php

use App\Models\Child;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/login', \App\Http\Livewire\Auth\Login::class)->name('login')->middleware('guest');

Route::middleware('auth')->group(function (){

    Route::get('/dashboard', \App\Http\Livewire\Parent\Overview::class)->name('parent-dashboard');

});

Route::get('/logout', function (){
    if (Auth::check()) {
        Auth::logout();
    }
    return redirect()->route('home');
})->name('logout');

//Route::get('/login/{user_id}', function ($user_id){
//    Auth::login(User::find($user_id));
//    return redirect()->route('parent-dashboard');
//});

Route::get('/test', function (){
    $child = Child::first();

    \App\Jobs\SendVaccinationNotification::dispatch($child);
});
