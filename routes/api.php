<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/telegram/webhook', function () {
    try {
        $update = Telegram::getWebhookUpdates();
        \App\Actions\ProcessUpdate::run($update);
    } catch (\Throwable $exception) {
        \Illuminate\Support\Facades\Log::error($exception->getMessage(), $exception->getTrace());
    }

    return response('ok', 200);
});
