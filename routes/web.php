<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\WordController;
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

Route::get('/', [HomeController::class, 'index'])->name('front.index');
Route::get('/unregularverb/{level}', [HomeController::class, 'unregularverb'])->name('front.unregularverb');
Route::post('/unregularverb/{level}', [HomeController::class, 'unregularverbPost'])->name('front.unregularverbPost');

Route::get('/unregularverb/learn/{level}', [HomeController::class, 'learnUnregularverb'])->name('front.learnUnregularverb');

Route::get('/words', [WordController::class, 'words'])->name('front.words');
Route::get('/words/{level}', [WordController::class, 'wordsLevel'])->name('front.wordsLevel');
Route::get('/words/learn/{level}/{teil}/{page?}', [WordController::class, 'learnWords'])->name('front.learnWords');
Route::get('/words/test/{level}/{teil}/{page?}', [WordController::class, 'testWords'])->name('front.testWords');
Route::post('/words/test/{level}/{teil}/{page?}', [WordController::class, 'testWordsPost'])->name('front.testWordsPost');

Route::get('/goethe', [WordController::class, 'goethe'])->name('front.goethe');
Route::get('/goethe/{level}', [WordController::class, 'goetheLevel'])->name('front.goetheLevel');
Route::get('/goethe/learn/{level}/{teil}/{page?}', [WordController::class, 'learnGoethe'])->name('front.learnGoethe');
Route::get('/goethe/test/{level}/{teil}/{page?}', [WordController::class, 'testGoethe'])->name('front.testGoethe');
Route::post('/goethe/test/{level}/{teil}/{page?}', [WordController::class, 'testGoethePost'])->name('front.testGoethePost');