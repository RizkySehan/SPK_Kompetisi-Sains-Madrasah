<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HeadmasterController;
use App\Http\Controllers\KSMTeacherController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\HomeroomTeacherController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
});

// Route UserMangement
Route::middleware(['auth', 'role:administration'])
    ->prefix('administration')
    ->as('administration.')
    ->group(function () {
        Route::get('/dashboard', [AdministrationController::class, 'index'])->name('dashboard');
        Route::resource('users', UserManagementController::class);
        Route::resource('students', StudentController::class);
        Route::resource('criterias', CriteriaController::class);
        Route::resource('scores', ScoreController::class);
        Route::resource('results', ResultController::class);
        Route::post('/results/generate', [ResultController::class, 'generate'])->name('results.generate');
    });

Route::middleware(['auth', 'role:homeroom-teacher'])
    ->prefix('homeroom-teacher')
    ->as('homeroom-teacher.')
    ->group(function () {
        Route::get('/dashboard', [HomeroomTeacherController::class, 'index'])->name('dashboard');
        Route::resource('students', StudentController::class);
        Route::resource('scores', ScoreController::class);
        Route::resource('results', ResultController::class);

        // Route::post('/homeroom-teacher/set-subject', [ScoreController::class, 'setSubject'])->name('set.subject');
        Route::delete('/scores', [ScoreController::class, 'destroyAll'])->name('scores.destroyAll'); // Menampilkan hasil (tanpa proses hitung ulang)
        Route::delete('/scores/student/{student}', [ScoreController::class, 'deleteByStudent'])->name('scores.deleteByStudent');
        Route::post('/results/generate', [ResultController::class, 'generate'])->name('results.generate');
        Route::get('/download-result', [ResultController::class, 'downloadPdf'])->name('results.download');
    });

Route::middleware(['auth', 'role:headmaster'])
    ->prefix('headmaster')
    ->as('headmaster.')
    ->group(function () {
        Route::get('/dashboard', [ResultController::class, 'dashboardForRole'])->name('dashboard');
        Route::resource('scores', ScoreController::class);
        Route::resource('results', ResultController::class);
        Route::post('/results/generate', [ResultController::class, 'generate'])->name('results.generate');
    });

Route::middleware(['auth', 'role:ksm-teacher'])
    ->prefix('ksm-teacher')
    ->as('ksm-teacher.')
    ->group(function () {
        Route::get('/dashboard', [ResultController::class, 'dashboardForRole'])->name('dashboard');
        Route::resource('scores', ScoreController::class);
        Route::resource('results', ResultController::class);
        Route::post('/results/generate', [ResultController::class, 'generate'])->name('results.generate');
    });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
