<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepositoryDashboardController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PaperSubmissionController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/repository-dashboard', [RepositoryDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('repository.dashboard');
    Route::get('/dashboard', [RepositoryDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('communities', CommunityController::class);
    Route::resource('collections', CollectionController::class);
});
Route::prefix('submission')->name('submission.')->group(function () {
    Route::get('/', [PaperSubmissionController::class, 'index'])->name('index');
    Route::get('/step1', [PaperSubmissionController::class, 'step1'])->name('step1');
    Route::post('/step1', [PaperSubmissionController::class, 'storeStep1'])->name('storeStep1');
    Route::get('/step2', [PaperSubmissionController::class, 'step2'])->name('step2');
    Route::post('/step2', [PaperSubmissionController::class, 'storeStep2'])->name('storeStep2');
    Route::get('/step3', [PaperSubmissionController::class, 'step3'])->name('step3');
    Route::post('/step3', [PaperSubmissionController::class, 'storeStep3'])->name('storeStep3');
    Route::get('/review', [PaperSubmissionController::class, 'review'])->name('review');
    Route::post('/submit', [PaperSubmissionController::class, 'submit'])->name('submit');
    Route::get('/{id}', [PaperSubmissionController::class, 'show'])->name('show'); // <== THIS
});
Route::get('/papers', [PaperSubmissionController::class, 'index'])->name('papers.index');


// Route::get('/communities', [CommunityController::class, 'index'])->name('communities.index');
// Route::get('/communities/{community}', [CommunityController::class, 'show'])->name('communities.show');

// Route::get('/collections/{collection}', [CollectionController::class, 'show'])->name('collections.show');
// Route::resource('communities', CommunityController::class);
// Route::resource('collections', CollectionController::class);
// Route::get('/thesis', [ThesisController::class, 'index'])->name('thesis.index');
// Route::get('/upload', [ThesisController::class, 'create'])->name('thesis.create');
// Route::post('/upload', [ThesisController::class, 'store'])->name('thesis.store');
// Route::get('/thesis/view/{id}', [ThesisController::class, 'view'])->name('thesis.view');

// Route::prefix('submission')->group(function () {
//     Route::get('step1', [PaperSubmissionController::class, 'step1'])->name('submission.step1');
//     Route::post('step1', [PaperSubmissionController::class, 'storeStep1']);

//     Route::get('step2', [PaperSubmissionController::class, 'step2'])->name('submission.step2');
//     Route::post('step2', [PaperSubmissionController::class, 'storeStep2']);

//     Route::get('step3', [PaperSubmissionController::class, 'step3'])->name('submission.step3');
//     Route::post('step3', [PaperSubmissionController::class, 'storeStep3']);

//     Route::get('review', [PaperSubmissionController::class, 'review'])->name('submission.review');
//     Route::post('submit', [PaperSubmissionController::class, 'submit'])->name('submission.submit');

//     Route::get('/papers/{id}', [PaperSubmissionController::class, 'show'])->name('papers.show');
//
// });
// Route::get('/papers', [PaperSubmissionController::class, 'index'])->name('papers.index');
// Route::get('/papers/{id}', [PaperSubmissionController::class, 'show'])->name('papers.show');

require __DIR__.'/auth.php';
