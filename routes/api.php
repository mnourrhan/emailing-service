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
Route::group(['prefix' => 'v1',
], function () {
    Route::group(['middleware' => ['api', 'token.validation']], function () {
        Route::post('send-emails', 'API\V1\SendingMailsController')->name('send.mails');
        Route::get('emails', 'API\V1\MailController@index')->name('mails.index');
    });
    Route::get('download/{id}/attachment', 'API\V1\DownloadingAttachmentController')
        ->middleware('auth.download.attachment')->name('attachment.download');
});
