<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Mail;
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
});
// Route::get('/send-mail', function () {
//     Mail::raw('هذه رسالة اختبار من Laravel باستخدام Mail-in-a-Box.', function ($message) {
//         $message->to('mr.askar1984@gmail.com')
//                 ->subject('اختبار بريد Laravel');
//     });

//     return 'تم إرسال البريد الإلكتروني بنجاح!';
// });


// Activation route

Route::get('/activate/{code}', [AuthController::class, 'activateAccount']);