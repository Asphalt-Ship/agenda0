<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ContactController;
    // le path est directement dans la Route (Laravel ver. 8.x)

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

Route::get('/', [App\Http\Controllers\ContactController::class, "index"])->name("contact.index");

Route::get('/contact/create', [App\Http\Controllers\ContactController::class, "create"])->name("contact.create");
// on demande une route où on veut que '/contact/create' DANS L'URL soit le trigger pour que le Controller active sa fonction "create"
// avec un nom de route qui est "contact.create" ; on pourra donc faire appel plus facilement à cette route
    // comme dans index.blade.php

Route::post('/contact/store', [App\Http\Controllers\ContactController::class, "store"])->name("contact.store");
    // le form étant en méthode post, on doit utiliser Route::post au lieu de Route::get

