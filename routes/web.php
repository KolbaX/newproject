<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', [App\Http\Controllers\PageController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/shop', [App\Http\Controllers\PageController::class, 'shop'])->name('shop');
Route::get('/shop/product/{product}', [App\Http\Controllers\PageController::class, 'product'])->name('product');
Route::post('/add/cart/{product}', [App\Http\Controllers\PageController::class, 'addCart'])->name('add.cart');
Route::post('/filter', [App\Http\Controllers\PageController::class, 'filter']);
Route::get('/checkout', [App\Http\Controllers\PageController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [App\Http\Controllers\PageController::class, 'order'])->name('order');
Route::get('/thank-order', [App\Http\Controllers\PageController::class, 'thankOrder'])->name('thank.order');
Route::get('/thank-order-contact', [App\Http\Controllers\PageController::class, 'thankOrderContact'])->name('thank.order.contact');
Route::get('/order/{order}/account/info', [App\Http\Controllers\PageController::class, 'orderAccountInfo'])->name('order.account.info');
Route::post('/order/{order}/account/info', [App\Http\Controllers\PageController::class, 'orderAccountInfoStore'])->name('order.account.info.store');
Route::get('/order/pay/{order}', [App\Http\Controllers\PageController::class, 'pay'])->name('pay');


Route::post('/profile/update/name', [App\Http\Controllers\HomeController::class, 'updateName'])->name('update.name');
Route::get('/profile/update/news-latter', [App\Http\Controllers\HomeController::class, 'newsLatter']);
Route::get('/profile/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change.password');
Route::post('/profile/change-password', [App\Http\Controllers\HomeController::class, 'changePasswordSet'])->name('change.password.set');
Route::post('/profile/update/avatar', [App\Http\Controllers\HomeController::class, 'updateAvatar'])->name('update.avatar');

Route::get('/trash/{cart}', [App\Http\Controllers\PageController::class, 'cartDelete'])->name('cart.delete');

Route::post('/contact', [App\Http\Controllers\PageController::class, 'contactForm'])->name('contact.form');
Route::post('/subscribe', [App\Http\Controllers\PageController::class, 'subscribe'])->name('subscribe');

Route::get('/load/game', [App\Http\Controllers\PageController::class, 'loadGame']);

Route::get('/init/bot', [App\Http\Controllers\BotController::class, 'initBot']);
Route::post('/init/bot', [App\Http\Controllers\BotController::class, 'initBot']);

Route::get('/search/product', [App\Http\Controllers\PageController::class, 'searchProductAjax']);

Route::post('/send/news-letter', [App\Http\Controllers\MailerController::class, 'sendNewLetter'])->name('send.news.letter');
Route::get('/cancel-subscribe', [App\Http\Controllers\MailerController::class, 'cancel'])->name('cancel');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/{page}', [App\Http\Controllers\PageController::class, 'page'])->name('page');

Route::get('/change/locale/{lang}', function($lang){
    Session::put('locale', $lang);
    return redirect('/');
});

