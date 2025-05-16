<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\RepositoryDashboardController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PaperSubmissionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\AdminController;
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
    return redirect()->route('login');
});
// Accessible by all roles
Route::get('/collections/{collection}/papers', [PaperController::class, 'index'])->middleware(['auth', 'role:student,faculty,librarian']);
// Route::get('/papers/{id}', [PaperController::class, 'show'])->middleware(['auth', 'role:student,faculty,librarian']);
Route::get('/papers/{paper}', [PaperController::class, 'show'])
    ->middleware(['auth', 'role:student,faculty,librarian'])
    ->name('papers.show');
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'student' => redirect('/repository-dashboard'),
        'faculty' => redirect('/faculty/dashboard'),
        'librarian' => redirect('/admin/dashboard'),
        default => abort(403),
    };
})->middleware(['auth'])->name('dashboard');
Route::middleware(['auth', 'role:student,faculty,librarian'])->get('/repository-dashboard', [RepositoryDashboardController::class, 'index'])->name('repository.dashboard');

// View access for all roles (student, faculty, librarian)
Route::middleware(['auth', 'role:student,faculty,librarian'])->group(function () {
    Route::get('/communities', [CommunityController::class, 'index'])->name('communities.index');
    Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
    Route::get('/collections/{collection}/papers', [PaperController::class, 'index']);
    Route::get('/papers/{paper}', [PaperController::class, 'show'])->name('papers.show');
});
Route::middleware(['auth', 'role:faculty,librarian'])->group(function () {
    Route::get('/submission/step1', [PaperSubmissionController::class, 'step1']);
    Route::post('/submission/step1', [PaperSubmissionController::class, 'storeStep1']);
    // ... other submission steps
});
Route::middleware(['auth', 'role:librarian'])->group(function () {
    Route::get('/collections/{collection}/papers/create', [PaperController::class, 'create']);
    Route::post('/collections/{collection}/papers', [PaperController::class, 'store']);
    Route::get('/collections/{collection}/papers/{paper}/edit', [PaperController::class, 'edit']);
    Route::put('/collections/{collection}/papers/{paper}', [PaperController::class, 'update']);
    Route::delete('/collections/{collection}/papers/{paper}', [PaperController::class, 'destroy']);
});
//Route::get('/papers/{paper}/preview', [PaperController::class, 'preview'])->name('papers.preview');
Route::get('/papers/view-pdf/{paper}', [PaperController::class, 'streamPdf'])->name('papers.stream');

//Route::get('/papers/preview/{paper}', [PaperController::class, 'preview'])->name('papers.preview');

// Faculty & Librarian submission access
Route::middleware(['auth', 'role:faculty,librarian'])->group(function () {
    Route::get('/submission', [PaperSubmissionController::class, 'index']);
    Route::get('/submission/step1', [PaperSubmissionController::class, 'step1']);
    Route::post('/submission/step1', [PaperSubmissionController::class, 'storeStep1']);
    Route::get('/submission/step2', [PaperSubmissionController::class, 'step2']);
    Route::post('/submission/step2', [PaperSubmissionController::class, 'storeStep2']);
    Route::get('/submission/step3', [PaperSubmissionController::class, 'step3']);
    Route::post('/submission/step3', [PaperSubmissionController::class, 'storeStep3']);
    Route::get('/submission/review', [PaperSubmissionController::class, 'review']);
    Route::post('/submission/submit', [PaperSubmissionController::class, 'submit']);
});
Route::patch('/admin/users/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::get('/admin/analytics', [AdminController::class, 'viewAnalytics'])->name('admin.analytics')->middleware('auth');

// Librarian only for edit/delete
Route::middleware(['auth', 'role:librarian'])->group(function () {
    Route::get('/collections/{collection}/papers/create', [PaperController::class, 'create']);
    Route::post('/collections/{collection}/papers', [PaperController::class, 'store']);
    Route::get('/collections/{collection}/papers/{paper}/edit', [PaperController::class, 'edit']);
    Route::put('/collections/{collection}/papers/{paper}', [PaperController::class, 'update']);
    Route::delete('/collections/{collection}/papers/{paper}', [PaperController::class, 'destroy']);
});

Route::middleware(['auth', 'role:faculty'])->get('/faculty/dashboard', function () {
    return view('faculty.dashboard');
});
Route::middleware(['auth', 'role:librarian'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::patch('/admin/users/{id}/approve', [AdminController::class, 'approveUser'])->name('admin.users.approve');
});
Route::post('/papers/{paper}/request-permission', [PaperController::class, 'requestDownloadPermission'])
    ->name('papers.requestDownloadPermission')
    ->middleware('auth');

Route::get('/papers/{paper}/download', [PaperController::class, 'download'])
    ->middleware('auth')
    ->name('papers.download');

Route::get('/admin/download-requests', [AdminController::class, 'viewDownloadRequests'])
    ->middleware(['auth', 'role:librarian'])
    ->name('admin.downloadRequests');

Route::post('/admin/download-requests/{request}/approve', [AdminController::class, 'approveRequest'])
    ->middleware(['auth', 'role:librarian'])
    ->name('admin.downloadRequests.approve');

Route::post('/admin/download-requests/{request}/deny', [AdminController::class, 'denyRequest'])
    ->middleware(['auth', 'role:librarian'])
    ->name('admin.downloadRequests.deny');

// Route::get('/repository-dashboard', [RepositoryDashboardController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('repository.dashboard');
    // Route::get('/dashboard', [RepositoryDashboardController::class, 'index'])
    // ->middleware(['auth', 'verified'])
    // ->name('dashboard');

    Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('communities', CommunityController::class);
    Route::resource('collections', CollectionController::class);
});
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/collections/{id}', [CollectionController::class, 'show'])->name('collections.show');
//Route::get('/papers/{paper}', [PaperController::class, 'show'])->name('papers.show');

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

require __DIR__.'/auth.php';
