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

Route::get('/sending-queue-emails', 'TestQueueEmails@send');

Route::get('/', function () {
    // if (Auth::check()) {
    //     return redirect()->route('home');
    // }
    // return view('welcome');
     return view('welcome');
})->name('welcome');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/docs', function () {
    return view('docs');
})->name('docs');

// Route::get('contact-api', function () {
//     return view('contact-api');
// });


// Route::get('/verify-email', 'UserController@emailVerification')->name('verify-email');

Route::get('/verify-email/{email}/{code}', 'UserController@verifyEmail')->name('verify-email');

Route::get('/forgot-password', function(){
    return view('auth.passwords.forgot-password_rebirth');
})->name('forgot-password');

Route::post('/send-password-reset-link', 'UserController@sendPasswordResetLink')->name('send-password-reset-link');
Route::get('password-reset-feedback',  'UserController@PasswordResetFeedBack')->name('password-reset-feedback');
Route::get('password-reset/{email}/{token}', 'UserController@PasswordReset')->name('password-reset');
Route::post('change-password', 'UserController@changePassword')->name('change-password');
Route::post('send-contact-form-mail', 'GenericController@submitContactForm')->name('send-contact-form-mail');

Auth::routes(['verify' => true]);

// authenticated user routes
Route::group(['middleware' => ['auth']], function () {
    // unverified users route
    Route::post('/resend-verification', 'UserController@resendVerificationMail')->name('resend-verification');

    // verified user routes
    Route::group(['middleware'=>['verified']], function () {
        Route::get('/home', 'HomeController@index')->name('home');

        // sms routes
        Route::group(['prefix' => 'sms'], function () {
            Route::get('/compose', 'SmsController@compose')->name('compose-sms');
            Route::post('/save', 'SmsController@save')->name('save-message');
            Route::post('/send-composed', 'SmsController@sendComposed')->name('send-composed-message');
            Route::get('/sent', 'SmsController@sent')->name('sent-sms');
            Route::get('/draft', 'SmsController@draft')->name('draft');
            Route::get('/{slug}/edit', 'SmsController@edit')->name('edit-message');
            Route::post('/delete', 'SmsController@delete')->name('delete-message');
            Route::post('/schedule', 'SmsController@schedule')->name('shedule-message');
            Route::get('/scheduled', 'SmsController@scheduled')->name('scheduled-sms');
            Route::post('/delete-schedule', 'SmsController@deleteScheduled')->name('delete-schedule');
        });

        Route::group(['prefix' => 'contacts'], function () {
            Route::get('/', 'ContactController@index')->name('contacts');
            Route::get('/create', 'ContactController@create')->name('create-contact');
            Route::post('/save', 'ContactController@save')->name('save-contact');
            Route::get('/{slug}', 'ContactController@detail')->name('contact-detail');
            Route::post('/edit-number', 'ContactController@editNumber')->name('edit-number');
            Route::post('/delete-number', 'ContactController@deleteNumber')->name('delete-number');
            Route::post('/rename', 'ContactController@rename')->name('rename-contact');
            Route::post('/add-numbers', 'ContactController@addNumbers')->name('add-numbers-to-contact');
            Route::post('/delete', 'ContactController@delete')->name('delete-contact');
            Route::post('/batch-delete', 'ContactController@batchDelete')->name('delete-multiple-contact');
            Route::post('/upload', 'ContactController@upload')->name('upload-contact');
            Route::post('/rename-column', 'ContactController@renamePhoneColumn')->name('rename-contact-column');
            Route::post('/rename-name-column', 'ContactController@renameNameColumn')->name('rename-name-column');
            Route::get('/skip-name-column/{slug}', 'ContactController@skipNameColumn')->name('skip-name-column');
            Route::post('/update-file', 'ContactController@updateFile')->name('update-contact-file');


        });

         // credit routes
        Route::group(['prefix' => 'credits'], function () {
            Route::get('/', 'CreditController@index')->name('credits');
            Route::get('/buy', 'CreditController@buy')->name('buy-unit');
            Route::get('/pay-with-paystack', 'CreditController@buy')->name('buy-unit');
        });


         // credit routes
        Route::group(['prefix' => 'payments'], function () {
            Route::post('/create', 'PaymentController@create')->name('create-payment');
            Route::post('/pay-with-paystack', 'PaymentController@payWithPaystack')->name('pay-with-paystack');
            Route::get('/verify-paystack-payment', 'PaymentController@verifyPaystackPayment')->name('verify-paystack-payment');
            Route::post('/update', 'PaymentController@update')->name('update-payment');
        });

        // 1. GET route to display the API Key management dashboard (shows the Blade view)
        Route::get('/reseller/api-credentials', 'ResellerController@manageApiKeys')->name('reseller.api_keys.index');
        
        // 2. POST route to handle the request to generate and save a new key
        Route::post('/reseller/api-credentials/generate', 'ResellerController@generateNewApiKey')->name('reseller.api_keys.generate');

    });

    
});
// Route::group(['prefix' => 'sms', 'middleware' => ['auth', 'verified']], function () {
//     Route::get('/compose', 'SmsController@compose')->name('compose-sms');
// });
// email verification
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

