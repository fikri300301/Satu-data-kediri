<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DinasController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\PriviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FrontDinasController;
use App\Http\Controllers\FrontDatasetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [WelcomeController::class, 'index'])->name('beranda');
Route::get('/search', [WelcomeController::class, 'search'])->name('search-welcome-dataset');
Route::get('/dataset-search', [FrontDatasetController::class, 'search'])->name('search-front-dataset');
Route::get('/dinas-search', [FrontDinasController::class, 'search'])->name('search-front-dinas');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/front-dataset', [FrontDatasetController::class, 'index'])->name('front-dataset');
Route::get('/front-dataset/{id}', [FrontDatasetController::class, 'detail'])->name('front-dataset-detail');
Route::get('/front-dinas', [FrontDinasController::class, 'index'])->name('front-dinas');
Route::get('/front-dinas/{id}', [FrontDinasController::class, 'detail'])->name('front-dinas-detail');


Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// route user
Route::get('/user', [UserController::class, 'index'])->name('user.index');

// route dinas
Route::get('/dinas', [DinasController::class, 'index'])->name('dinas.index');
Route::get('/dinas-create', [DinasController::class, 'create'])->name('dinas.create');
Route::post('/dinas', [DinasController::class, 'store'])->name('dinas.store');
Route::get('/dinas/{id}', [DinasController::class, 'show'])->name('dinas.show');
Route::delete('/dinas/{id}', [DinasController::class, 'destroy'])->name('dinas.delete');
Route::get('/dinas/{id}/edit', [DinasController::class, 'edit'])->name('dinas.edit');
Route::put('/dinas/{id}/update', [DinasController::class, 'update'])->name('dinas.update');

// route dataset
Route::get('/dataset', [DatasetController::class, 'index'])->name('dataset.index');
Route::get('/dataset-create', [DatasetController::class, 'create'])->name('dataset.create');
Route::post('/dataset', [DatasetController::class, 'store'])->name('dataset.store');
Route::get('/dataset/{id}', [DatasetController::class, 'show'])->name('dataset.show');
Route::get('/dataset/{id}/edit', [DatasetController::class, 'edit'])->name('dataset.edit');
Route::put('/dataset/{id}/update', [DatasetController::class, 'update'])->name('dataset.update');
Route::delete('/dataset/{id}', [DatasetController::class, 'destroy'])->name('dataset.destroy');
Route::post('/dataset/preview', [DatasetController::class, 'previewEndpoint'])->name('dataset.preview');

Route::post('preview', [PriviewController::class, 'index'])->name('fetch.data');
