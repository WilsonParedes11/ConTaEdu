<?php

use App\Http\Controllers\Estudiante\StudentDashboardController;
use App\Http\Controllers\ManagedTeacherController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ManagetStudentController;
use App\Http\Controllers\ManagetExerciseController;
use Illuminate\Support\Str;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes for admin
Route::middleware('checkPermission:1')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');

    Route::get('/managetTeacher/create', [ManagedTeacherController::class, 'create'])->name('student.create');
    Route::post('/managetTeacher/', [ManagedTeacherController::class, 'store'])->name('student.store');
    Route::resource('teachers', ManagedTeacherController::class);
    Route::resource('students', ManagetStudentController::class);
});


// Routes for docente
Route::middleware('checkPermission:2')->prefix('docente')->group(function () {
    Route::get('/dashboard', function () {
        return view('docente/dashboard');
    })->name('docente.dashboard');

    //rutas para crear student
    Route::get('/managetStudent/create', [ManagetStudentController::class, 'create'])->name('student.create');
    Route::post('/managetStudent', [ManagetStudentController::class, 'store'])->name('student.store');
    Route::get('/managetStudent/index', [ManagetStudentController::class, 'index'])->name('student.index');
    Route::get('/managetStudent/{id}/edit', [ManagetStudentController::class, 'edit'])->name('student.edit');
    Route::put('/managetStudent/{id}', [ManagetStudentController::class, 'update'])->name('student.update');
    Route::delete('/manageStudent/{id}', [ManagetStudentController::class, 'destroy'])->name('student.destroy');
    Route::get('/manageStudent/{id}', [ManagetStudentController::class, 'show'])->name('student.show');

    //rutas para crear ejercicios
    Route::get('/manageExercises/create', [ManagetExerciseController::class, 'create'])->name('exercise.create');
    Route::post('/manageExercises', [ManagetExerciseController::class, 'store'])->name('exercise.store');
    Route::get('/manageExercises/index', [ManagetExerciseController::class, 'index'])->name('exercise.index');
    Route::get('/manageExercises/{id}/edit', [ManagetExerciseController::class, 'edit'])->name('exercise.edit');
    Route::put('/manageExercises/{id}', [ManagetExerciseController::class, 'update'])->name('exercise.update');
    Route::delete('/manageExercises/{id}', [ManagetExerciseController::class, 'destroy'])->name('exercise.destroy');
    Route::get('/manageExercises/{id}', [ManagetExerciseController::class, 'show'])->name('exercise.show');
    Route::post('/manageExercises/{id}/view', [ManagetExerciseController::class, 'updateViewed'])->name('managetExercises.view');
    Route::get('/docente/manageExercises/search', [ManagetExerciseController::class, 'search'])->name('exercise.search');
    // Route::get('/manageExercises/{page}', 'ManageExerciseController@indexp')->name('exercises.index');

});

// Routes for estudiante
Route::middleware('checkPermission:3')->group(function () {
    Route::get('/estudiante/dashboard', [StudentDashboardController::class, 'index'])->name('estudiante.dashboard');
    Route::post('/search_exercise', [StudentDashboardController::class, 'searchExercise'])->name('estudiante.search_exercise');
    Route::post('/join_exercise', [StudentDashboardController::class, 'joinExercise'])->name('estudiante.join_exercise');
});

require __DIR__ . '/auth.php';
