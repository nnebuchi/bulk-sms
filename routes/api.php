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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'sms'], function () {
    
    Route::post('/feedback', 'SmsController@feedback')->name('upload-contact');

    
});

// --- NEW RESELLER SMS API ROUTES ---

// All routes here require a valid API key using our custom 'api_key_guard'
Route::middleware('auth:api')->group(function () {

    // POST /api/sms/send
    Route::post('/sms/send', 'Api\SmsController@send');

    // GET /api/user/balance
    Route::get('/user/balance', 'Api\SmsController@balance');

    // GET /api/sms/status/{message} (NEW)
    // We use Route-Model binding here to automatically fetch the Message
    Route::get('/sms/status/{message}', 'Api\SmsController@status');

});
